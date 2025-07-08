<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = auth()->user()->load('profile');
        $openTab = in_array($request->query('tab'), ['profile', 'address', 'security'])
            ? $request->query('tab')
            : 'profile';

        return view('app.buyer.pages.profile.edit', compact('user', 'openTab'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'business_name' => 'required|string|min:3|max:255',
            'contact_name' => 'required|string|min:3|max:255',
            'phone_number' => 'required|string|min:10|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $user = $request->user();
        $profile = $user->profile()->firstOrCreate();

        try {
            if ($validated['contact_name'] !== $user->name) {
                $user->update(['name' => $validated['contact_name']]);
            }

            $profileData = $request->only(['business_name', 'phone_number']);

            if ($request->hasFile('photo')) {
                if ($profile->profile_photo_path) {
                    Storage::disk('public')->delete($profile->profile_photo_path);
                }

                $profileData['profile_photo_path'] = $request->file('photo')->store('profile-photos', 'public');
            }

            $profile->update($profileData);

            return back()->with('success', 'Profil berhasil diperbarui.')->withInput(['tab' => 'profile']);
        } catch (\Exception $e) {
            Log::error('Profile update failed', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return back()->with('error', 'Profil gagal diperbarui.');
        }
    }

    public function updateAddress(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
        ]);

        $user = $request->user();
        $profile = $user->profile()->firstOrCreate();

        try {
            $profile->update([
                'address' => $validated['address'],
                'city' => $validated['city'],
                'province' => $validated['province'],
            ]);

            return back()->with('success', 'Alamat pengiriman berhasil diperbarui.')->withInput(['tab' => 'address']);
        } catch (\Exception $e) {
            Log::error('Address update failed', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return back()->with('error', 'Alamat pengiriman gagal diperbarui.');
        }
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'new_password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = $request->user();

        try {
            if (!Hash::check($validated['current_password'], (string) $user->password)) {
                return back()->with('error', 'Kata sandi saat ini tidak valid.');
            }

            $user->update([
                'password' => Hash::make($validated['new_password']),
            ]);

            return back()->with('success', 'Kata sandi berhasil diperbarui.')->withInput(['tab' => 'security']);
        } catch (\Exception $e) {
            Log::error('Password update failed', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return back()->with('error', 'Gagal memperbarui kata sandi.');
        }
    }
}
