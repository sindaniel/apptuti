<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->whereRelation('roles', 'name', 'seller')
            ->when(request('q'), function ($query, $q) {
                $query->where('name', 'ilike', "%{$q}%")
                ->orWhere('email', 'ilike', "%{$q}%");
            })
            ->orderBy('name')
            ->paginate();

        $context = compact('users');

        return view('sellers.index', $context);
    }

    public function create()
    {
        return view('sellers.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'zone'=>['required', 'integer'],
        ]);

        $validate['password'] = bcrypt($validate['password']);

        $user = User::create($validate);


        $user->assignRole('seller');

        return to_route('admins.index')->with('success', 'Usuario creado');
    }


    public function edit($id)
    {
        $user = User::findorFail($id);
        $context = compact('user');

        return view('sellers.edit', $context);
    }


    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);
        $validations =  [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class . ',email,' . $user->id],
            'zone' => 'required|integer',
        ];

        if ($request->filled('password')) {
            $validations['password'] = 'required|confirmed';
        }

        $validate = $request->validate($validations);

        if ($request->filled('password')) {
            $validate['password']  = bcrypt($validate['password']);
        }

        $user->update($validate);

      


        return to_route('sellers.index')->with('success', 'Vendedor actualizado');
    }
}
