<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class SocialiteController extends Controller
{
    public function redirectToProvider(string $provider): RedirectResponse
    {
        if (!in_array($provider, ['google', 'github'])) {
            return redirect()->route('login')->withErrors(['error' => 'Invalid provider']);
        }

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(string $provider): RedirectResponse
    {
        try {
            if (!in_array($provider, ['google', 'github'])) {
                return redirect()->route('login')->withErrors(['error' => 'Invalid provider']);
            }

            $socialUser = Socialite::driver($provider)->user();

            // Check if user exists with this provider
            $user = User::where('provider', $provider)
                       ->where('provider_id', $socialUser->getId())
                       ->first();

            if ($user) {
                // Update user info and login
                $user->update([
                    'name' => $socialUser->getName(),
                    'avatar' => $socialUser->getAvatar(),
                    'provider_token' => $socialUser->token,
                ]);

                Auth::login($user);
                return redirect()->intended(route('blog.index')); // ✅ Fixed
            }

            // Check if user exists with same email
            $existingUser = User::where('email', $socialUser->getEmail())->first();

            if ($existingUser) {
                // Link provider to existing account
                $existingUser->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'provider_token' => $socialUser->token,
                    'avatar' => $socialUser->getAvatar(),
                ]);

                Auth::login($existingUser);
                return redirect()->intended(route('blog.index')); // ✅ Fixed
            }

            // Create new user
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'provider_token' => $socialUser->token,
                'avatar' => $socialUser->getAvatar(),
                'password' => Hash::make(Str::random(16)), // Random password
                'email_verified_at' => now(),
            ]);

            // Assign default role (reader)
            $user->assignRole('reader');

            Auth::login($user);
            return redirect()->intended(route('blog.index')); // ✅ Fixed

        } catch (\Exception $e) {
            \Log::error('OAuth error: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->route('login')->withErrors(['error' => 'Authentication failed. Please try again.']);
        }
    }
}
