<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreSubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function store(StoreSubscriptionRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            Subscription::create([
                'email' => $validated['email_subscription'],
            ]);

            return back()->with('success', 'Berlangganan berhasil!');
        } catch (\Exception $e) {
            Log::error('Subscription failed', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return back()->with('error', 'Gagal berlangganan. Silakan coba lagi nanti.');
        }
    }
}
