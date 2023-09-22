<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showLogin()
    {
        return view('Login.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $login_type = filter_var($request -> input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request -> merge([
            $login_type => $request -> input('username')
        ]);

        if (Auth::attempt($request -> only($login_type, 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('/home') -> with('login_success','Login Successfully');
        }

        return back()->with('loginFailed', 'Login failed! Username/Email atau Password Salah!');
    }

    public function logoutUser()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
