<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\BuyerLoginRequest;
use App\Http\Requests\Auth\BuyerRegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class BuyerAuthController extends Controller
{
    public function create(Request $request): View
    {
        $openTab = in_array($request->query('o'), ['login', 'register']) ? $request->query('o') : 'login';
        $title = ($openTab === 'register')
            ? 'Buat Akun Baru - Dapur Tani'
            : 'Masuk ke Akun Anda - Dapur Tani';

        return view('app.frontend.pages.auth.create', compact('openTab', 'title'));
    }

    public function store(BuyerRegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => UserRole::BUYER->value,
                'status' => 'verified',
            ]);

            return redirect()->route('auth.create', ['o' => 'login'])
                ->with('success', 'Akun berhasil dibuat. Silakan masuk untuk melanjutkan.');
        } catch (\Exception $e) {
            Log::error('Buyer account creation failed', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return back()->with('error', 'Gagal membuat akun. Silakan coba lagi.');
        }
    }

    public function login(BuyerLoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        $credentials['role'] = UserRole::BUYER->value;

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('buyer.dashboard'))
                ->with('success', 'Selamat datang di dashboard pembeli!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.create', ['o' => 'login'])
            ->with('success', 'Anda telah berhasil keluar.');
    }
}
