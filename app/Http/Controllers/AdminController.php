<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        if (auth()->check()) {
            return redirect()->to('home');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $remember = $request->has('remember_me');
        $credentials = $request->only('email', 'password');
        if(auth()->attempt($credentials, $remember)){
            $request->session()->regenerateToken();
            return redirect()->to('home');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.showLogin');
    }
}
