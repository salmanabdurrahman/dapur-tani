<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        DB::beginTransaction();

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'role' => 'buyer',
                'status' => 'pending',
            ]);

            DB::commit();

            return redirect()->to('/auth?o=login')->with('success', 'Akun berhasil dibuat. Silakan tunggu konfirmasi dari admin.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Buyer account creation failed', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return redirect()->back()->with('error', 'Gagal membuat akun. Silakan coba lagi.');
        }
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('buyer.dashboard')->with('success', 'Selamat datang di dashboard pembeli!');
        }

        return redirect()->to('/auth?o=login')->with('error', 'Email atau kata sandi salah. Silakan coba lagi.');
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/auth?o=login')->with('success', 'Anda telah berhasil keluar.');
    }
}
