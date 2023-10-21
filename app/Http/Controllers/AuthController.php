<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
	public function login() 
	{
    	return view('login');
    }

    public function register() 
    {
    	return view('register');
    }

    public function store(RegisterRequest $request) 
    {
    	$user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => Hash::make($request->password),
    	]);

        return redirect()->route('login')->with('success', 'Registration Succuessfully!');
    }

    public function authentication(LoginRequest $request) {
 		$credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dashboard() {
    	return view('customer.dashboard');
    }

    public function logout(Request $request)
	{
	    Auth::logout();
	    $request->session()->invalidate();
	    $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout Succuessfully!');
	}
}
