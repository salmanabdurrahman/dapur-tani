<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyer\UpdateAddressRequest;
use App\Http\Requests\Buyer\UpdateBankDetailsRequest;
use App\Http\Requests\Buyer\UpdatePasswordRequest;
use App\Http\Requests\Buyer\UpdateProfileRequest;
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
        $openTab = in_array($request->query('tab'), ['profile', 'address', 'security', 'bank'])
            ? $request->query('tab')
            : 'profile';

        return view('app.buyer.pages.profile.edit', compact('user', 'openTab'));
    }

    public function updateProfile(UpdateProfileRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $user = $request->user();
            $profile = $user->profile()->firstOrCreate();

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
                'data' => $request->all(),
            ]);

            return back()->with('error', 'Profil gagal diperbarui.');
        }
    }

    public function updateAddress(UpdateAddressRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $profile = $request->user()->profile()->firstOrCreate();
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

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $request->user()->update([
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

    public function updateBankDetails(UpdateBankDetailsRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $profile = $request->user()->profile()->firstOrCreate();
            $profile->update([
                'bank_name' => $validated['bank_name'],
                'bank_account_number' => $validated['bank_account_number'],
                'bank_account_name' => $validated['bank_account_name'],
            ]);

            return back()->with('success', 'Detail bank berhasil diperbarui.')->withInput(['tab' => 'bank']);
        } catch (\Exception $e) {
            Log::error('Bank details update failed', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return back()->with('error', 'Detail bank gagal diperbarui.');
        }
    }
}
