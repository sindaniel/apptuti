<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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

        $states = State::orderBy('name')->get()->pluck('name', 'id');
        $cities = City::whereStateId(1)->orderBy('name')->get()->pluck('name', 'id');
        $context = compact('states', 'cities');
        return view('auth.register', $context);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            'state_id' => ['required', 'exists:'.State::class.',id'],
            'city_id' => ['required', 'exists:'.City::class.',id'],

            'document' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'document_front' => ['required', 'file', 'max:255'],
            'document_back' => ['required', 'file', 'max:255'],
            'company_document' => ['required', 'file', 'max:255'],
            'has_whatsapp' => ['required' ],
            'visit_by_tronex' => ['required'],
        ]);
        
        $validate['password'] = Hash::make($validate['password']);

        $validate['document_front'] = $request->document_front->store('documents', 'public');
        $validate['document_back'] = $request->document_back->store('documents', 'public');
        $validate['company_document'] = $request->company_document->store('documents', 'public');
      
        $user = User::create($validate);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
