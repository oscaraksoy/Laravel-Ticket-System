<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

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

    public function add(){
        return view('panel.users.add', [
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

    public function store(){
        $attributes = request()->validate([
            'name' => ['required', 'min:5'],
            'username' => ['required', Rule::unique('users', 'username')],
            'password' => ['required', 'min:7'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'role' => ['required'],
        ]);

        $role = $attributes['role'];
        unset($attributes['role']);
        $attributes['role_id'] = $role;

        User::create($attributes);

        return redirect('/admin/users')->with('dialogMessage', 'User created successfully.');
    }
}
