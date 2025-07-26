<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyer\StoreReviewRequest;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Order $order): RedirectResponse
    {
        $validated = $request->validated();

        try {
            foreach ($validated['reviews'] as $productId => $reviewData) {
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
                'data' => $validated,
            ]);

            return back()->with('error', 'Terjadi kesalahan saat menyimpan ulasan Anda.');
        }
    }
}
