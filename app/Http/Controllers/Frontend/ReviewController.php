<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function store(Request $request, Order $order): RedirectResponse
    {
        if ($order->buyer_id !== auth()->id()) {
            return redirect()->route('buyer.orders.index');
        }

        $request->validate([
            'reviews' => ['required', 'array'],
            'reviews.*.rating' => ['required', 'integer', 'min:1', 'max:5'],
            'reviews.*.comment' => ['nullable', 'string', 'max:5000'],
        ]);

        try {
            foreach ($request->reviews as $productId => $reviewData) {
                Review::updateOrCreate(
                    [
                        'order_id' => $order->id,
                        'product_id' => $productId,
                        'user_id' => auth()->id(),
                    ],
                    [
                        'rating' => $reviewData['rating'],
                        'comment' => $reviewData['comment'],
                    ]
                );
            }

            return back()->with('success', 'Terima kasih atas ulasan Anda!');
        } catch (\Exception $e) {
            Log::error('Error saving review: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'data' => $request->all(),
            ]);

            return back()->with('error', 'Terjadi kesalahan saat menyimpan ulasan Anda.');
        }
    }
}
