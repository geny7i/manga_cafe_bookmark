<?php

namespace App\Http\Controllers;

use App\Models\SocialProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        $socialProfile = SocialProfile::where('social_id', $socialUser->id)
            ->where('provider', 'google')->first();
        if (!$socialProfile) {
            try {
                $socialProfile = DB::transaction(function () use ($socialUser) {
                    $user = User::create(['name' => $socialUser->name]);
                    $socialProfile = SocialProfile::create([
                        'user_id' => $user->id,
                        'social_id' => $socialUser->id,
                        'provider' => 'google'
                    ]);
                    return $socialProfile;
                });
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
            }
        }

        Auth::login($socialProfile->user);
        return redirect()->route('home');
    }
}
