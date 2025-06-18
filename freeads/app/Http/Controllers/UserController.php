<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
       
        ]);

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));
        Auth::login($user);

        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }


    public function showLoginForm(){
        return view('login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            return redirect('/home');
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

 


    public function edit()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please login first!');
        }

        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please login first!');
        }

        $user = Auth::user();
        
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',

        ]);

        $user->email = $request->input('email');
        $user->name = $request->input('name');

        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        
        $user->save();
        
        return redirect('/home')->with('success', 'Profile updated successfully!');
    }

    
    

    public function logout(Request $request): RedirectResponse
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/login');
}
    }


