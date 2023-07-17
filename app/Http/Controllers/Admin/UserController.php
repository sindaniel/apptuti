<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $users = User::query()
        ->whereNotIn('id', [1])
        ->when(request('q'), function($query, $q){
            $query->where('name', 'like', "%{$q}%");
        })
        ->orderBy('name')
        ->paginate();

        $context = compact('users'); 

        return view('users.index', $context);
    }

  

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        
        $context = compact('user');

        return view('users.edit', $context);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
            
            $user->update($request->only(['can_buy']));
    
            return to_route('users.index')->with('success', 'Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
