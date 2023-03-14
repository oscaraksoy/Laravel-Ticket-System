<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule;

class AdminUsersController extends Controller
{
    public function create(){
        return view('panel.users.create');
    }

    public function show(User $user){
        return view('panel.users.show', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(User $user){
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'max:255'],
            'email' => ['required', 'email']
        ]);

        $user->update([
            'name' => $attributes['name'],
            'username' => $attributes['username'],
            'email' => $attributes['email'],
            'role_id' => request("role"),
        ]);

        return redirect('/admin/users')->with('dialogMessage', 'User has been updated');
    }
}
