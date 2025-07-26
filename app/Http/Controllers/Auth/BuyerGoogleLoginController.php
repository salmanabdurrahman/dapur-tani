<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class BuyerGoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName() ?? $googleUser->getNickname(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(32)),
                    'role' => UserRole::BUYER->value,
                    'status' => 'verified',
                ]);
            }

            if ($user->role->value !== 'buyer') {
                return redirect()->route('auth.create', ['o' => 'login'])
                    ->with('error', 'Akun ini terdaftar sebagai ' . $user->role->value . '. Silakan login dari halaman yang sesuai.');
            }

            Auth::login($user);

            return redirect()->intended(route('buyer.dashboard'))
                ->with('success', 'Selamat datang di dashboard pembeli!');
        } catch (\Exception $e) {
            Log::error('Google authentication failed.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'google_user' => $googleUser ?? null,
            ]);

            return back()->with('error', 'Gagal otentikasi Google. Silakan coba lagi.');
        }
    }
}
