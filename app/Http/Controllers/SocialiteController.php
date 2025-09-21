<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SocialiteController extends Controller
{
    public function redirect() {
        return Socialite::driver('github')->redirect();
    }

    public function callback() {
        
            $githubUser = Socialite::driver('github')->user();

            $email = $githubUser->getEmail();
            $user = User::where('email', $email)->first();

            // User existe déjà dans la BDD
            if ($user) {
                
                $user->update([
                'name' => $githubUser->getNickname(),
                ]);
                
            } else {
                // User inexistant dans la BDD, on doit le créer

                
                $user = User::create([
                    'name' => $githubUser->getNickname(),
                    'email' => $githubUser->email,
                    'password' => null,
                    'token' => $githubUser->token,
                    'provider' => 'github',
                ]);
            }

            Auth::login($user, true);  
            return redirect('/'); 
    }
}
