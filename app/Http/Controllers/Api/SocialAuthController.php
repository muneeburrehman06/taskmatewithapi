<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    protected $providers = ['google', 'facebook'];

    protected function isValidProvider($provider)
    {
        return in_array($provider, $this->providers);
    }

    public function redirect($provider)
    {
        if (!$this->isValidProvider($provider)) {
            return response()->json([
                'success' => false,
                'message' => 'Provider not supported'
            ], 400);
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback($provider)
    {
        if (!$this->isValidProvider($provider)) {
            return response()->json([
                'success' => false,
                'message' => 'Provider not supported'
            ], 400);
        }

        $socialUser = Socialite::driver($provider)->stateless()->user();

        $user = User::updateOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName() ?? 'No Name',
                'password' => bcrypt(Str::random(16)),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'provider' => $provider
            ]
        ], 200);
    }
}
