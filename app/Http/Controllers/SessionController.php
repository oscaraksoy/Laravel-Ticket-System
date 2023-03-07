<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SessionController extends Controller
{
    public function create(){
        return view('sessions.create');
    }

    public function store(){
        $attributes = request()->validate([
            'username' => ['required', Rule::exists('users', 'username')],
            'password' => ['required']
        ]);

        if(auth()->attempt($attributes)){
            $user = auth()->user();

            if($user->can('admin')){
                // admin route
            }
            else if($user->can('staff')){
                return redirect('/staff/dashboard');
            }else{
                return redirect('/home');
            }
        }

        return back();
    }

    public function destroy(){
        auth()->logout();
        return redirect('/')->with('dialogMessage', 'Goodbye!');
    }
}
