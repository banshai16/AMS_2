<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index()
    {
        return view('auth.login');
    }
    function registration()
    {
        return view('auth.registration');
    }
    function login(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,

        ];

        if(Auth::attempt($credentials))
        {
            return redirect()->intended('/home');
        }
        return redirect()->back()->with("error", "Login details is not valid");
    }
}
