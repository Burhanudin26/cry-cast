<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;


class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('login.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        Auth::login($user);
        $user->save();

        return view('login.login');
    }

    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name_or_email' => 'required',
            'password' => 'required',
        ]);

        if (filter_var($credentials['name_or_email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $credentials['name_or_email'])->first(); // If the user is logging in with their email
        } else {
            $user = User::where('name', $credentials['name_or_email'])->first(); // If the user is logging in with their username
        }

        if (!$user || !password_verify($credentials['password'], $user->password)) {
            return back()->withErrors([
                'name_or_email' => 'The provided credentials do not match our records.', //
            ]);
        }

        // Update email_verified_at column for the user who just logged in
        $user->update(['email_verified_at' => Carbon::now()]); // Set waktu ketika user login

        Auth::login($user);

        return view('menu');
    }

    // public function logout()
    // {
    //     $user = Auth::user(); // Get the authenticated user

    //     if ($user) {
    //         $user->update(['email_verified_at' => null]); // Set email_verified_at to null
    //     }

    //     Auth::logout(); // Log the user out

    //     return view('home');
    // }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,' . $id,
            'password' => 'required|min:8',
        ]);

        $user = User::findOrFail($id);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if(!empty($validatedData['password'])){
            $user->password = bcrypt($validatedData['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'User details have been updated.');
    }

}

