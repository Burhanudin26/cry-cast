<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
// Auth
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
            'email' => 'The provided credentials do not match our records.',
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