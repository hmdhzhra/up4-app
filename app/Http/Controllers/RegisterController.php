<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register',[
            'title' => 'Daftar Akun'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|min:7|max:50',
            'email' => 'required|email:dns|unique:users|max:150',
            'password' => 'required|required_with:password_confirmation|confirmed|min:7|max:50',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        $request->session()->flash('success', 'Daftar akun berhasil, silahkan Login!');
        return redirect('/');
    }
}
