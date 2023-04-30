<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class loginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Set the verified flag in the user's session
            $request->session()->put('verified', true);

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Username or password is incorrect',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->remove('verified');
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}