<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Enums\Status;

class SocialAuth extends Component
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $socialUser = Socialite::driver('facebook')->user();

        $user = User::updateOrCreate([
            'facebook_id' => $socialUser->id,
        ], [
            'name'     => $socialUser->getName(),
            'email'    => $socialUser->getEmail(),
            'password' => Hash::make(Str::random(16)), // Generate a random password
            // 'phone'    => $this->phone,
            // 'city'     => $this->city,
            // 'country'  => $this->country,
            'status' => Status::INACTIVE,
        ]);

        $role = Role::where('name', 'CLIENT')->first();

        $user->assignRole($role);

        Auth::login($user, true);

        switch (true) {
            case $user->hasRole('admin'):
                $homePage = RouteServiceProvider::ADMIN_HOME;

                break;
            default:
                $homePage = RouteServiceProvider::CLIENT_HOME;

                break;
        }

        return redirect()->intended($homePage);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $socialUser = Socialite::driver('google')->user();

        // $user = User::where('email', $socialUser->email)->first();

        $user = User::updateOrCreate([
            'google_id' => $socialUser->id,
        ], [
            'name'     => $socialUser->getName(),
            'email'    => $socialUser->getEmail(),
            'password' => Hash::make(Str::random(16)), // Generate a random password
            // Add other required fields if needed
        ]);

        Auth::login($user, true);

        // Redirect to the desired page after successful authentication
        return redirect()->intended('/home');
    }

    public function render()
    {
        return view('livewire.auth.social-auth');
    }
}
