<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
 
class UserController extends Controller
{   
    // Show registration form
    public function create() {
        return view("users.register");
    }
    // Create new user
    public function store(Request $request)
    {  
        $formFields = $request->validate([  
            'first_name' => ['required', 'string', 'min:3', 'max:250'],
            'last_name' => ['required', 'string', 'min:3', 'max:250'],
            'email' => ['required','email', 'max:250', Rule::unique('users','email')],
            'password' => ['required', 'confirmed', 'min:6'],
           ]);
           
        // Hash Password
        $formFields['password'] = Hash::make($formFields['password']);
    
        // Create User
        $user = User::create([
             'first_name' => $formFields['first_name'],
             'last_name' => $formFields['last_name'],
             'email' => $formFields['email'],
             'password' => $formFields['password'],
             'role' => 'user'
        ]);
        
        auth()->login($user);
        event(new Registered($user));
        return redirect()->route('verification.notice');
    }
    
    // Show Login Form
    public function login() {
        return view('users.login');
    }
    

    // // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');

    }

    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

}