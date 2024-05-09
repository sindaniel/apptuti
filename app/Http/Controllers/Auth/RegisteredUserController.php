<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        return view('auth.register');
    }

    public function complete(Request $request)
    {
        $validate = $request->validate([
            'document' => ['required', 'string', 'max:255'],
        ]);

        $document = $validate['document'];
        //Valido si el usuario existe en la base de datos
        $user = User::where('document', $document)->whereStatusId(User::ACTIVE)->first();
            
        if($user){
            //Si el usuario existe, lo redirijo a la pagina de login
            return redirect()->route('login')->with('error', 'El usuario ya se encuentra registrado, ingresá con tus credenciales.');
        }

        //busco el usuario en ax
        $client = UserRepository::getCustomRuteroId($document);
        
        if(!$client){
            return to_route('form')->with('error', 'El usuario no se encuentra registrado en el sistema.');
        }


        return view('auth.complete');


        // $validate['password'] = Hash::make($validate['password']);

        // $validate['document_front'] = $request->document_front->store('documents', 'public');
        // $validate['document_back'] = $request->document_back->store('documents', 'public');
        // $validate['company_document'] = $request->company_document->store('documents', 'public');
      
        // $user = User::create($validate);

        // event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
    }

    public function register(Request $request){
        $validate = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'numeric', 'digits:10'],
            'document' => ['required', 'string', 'max:255'],
        ]);

        $validate['password'] = Hash::make($validate['password']);
        

        $document = $validate['document'];
        $client = UserRepository::getCustomRuteroId($document);
        
        $validate['name'] = $client['name'];
        $validate['status_id'] = User::ACTIVE;
        
        $user = User::updateOrCreate([
            'document' => $document,
        ], $validate);

        $user->zones()->create([
            'route' => $client['route'],
            'zone' => $client['zone'],
            'day' => $client['day'],
            'address' => $client['address'],
            'code' => $client['code'],
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('success', 'Usuario registrado con éxito.');
    }
}
