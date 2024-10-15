<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function manualLogin(Request $request){
        $validated = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:8',
        ], [
            'email' => 'Email is invalid',
            'password.required' => 'Password is invalid',
        ]);

        if(!Auth::attempt($validated)){
            return back()
                ->withInput()
                ->with('error', 'Email or Password wrong!');
        }

        $request->session()->regenerate();
 
        return redirect()->intended('/');
    }

    public function registerView(){
        return view('auth.register', [
            'title' => 'Sign Up',
        ]);
    }

    public function register(Request $request){
        $validated = $request->validate([
            'username' => 'required|max:25',
            'password' => 'required|min:8',
            'email' => 'required|email:dns',
        ]);

        User::create($validated);
        return redirect('/login')->with('success', 'Register Successfully! Login Right Now!');
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('/');
            } else {
                $newUser = User::create([
                    'username' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'image' => $user->avatar,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', "Email already used");
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();

        return redirect('/');
    }
}
