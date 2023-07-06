<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;

class authenticationController extends Controller
{
    public function register(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
        ],[
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.regex' => 'The password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one digit, and one special character.',
        ]);

        // Create a new user record
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'email_verified' => false, 
            'verification_token' => Str::random(10), 
        ]);

        // Send email verification mail to the user
        Mail::to($user->email)->send(new VerifyEmail($user));

        // Redirect or perform any other actions after successful registration

        return back()->with('success', 'Registration successful! Please check your email for verification.');
    }


    /////////////////

    public function verifyEmail(Request $request, $token)
    {
        // Find the user with the given verification token
        $user = User::where('verification_token', $token)->first();
    
        // Check if the user exists
        if (!$user) {
            return redirect('/')->with('error', 'Invalid verification token.');
        }
    
        // Mark the user as email verified
        $user->email_verified_at =Date::now();
        $user->verification_token = 1;
        $user->save();
    
        
    
        return redirect('login')->with('success', 'Email verification successful! You can now log in.');
    }


    ///////////////
    public function login(){
        return view('login');
    }
    public function loginaccess(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    

        $credentials['verification_token'] = 1;
    
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }
    
        return redirect()->back()->withErrors([
            'email' => 'Invalid email or password or email is not varified.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }


    public function dashboard(){
        return view('dashboard');
    }
}
