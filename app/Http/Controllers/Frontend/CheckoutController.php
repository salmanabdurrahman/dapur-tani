<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): RedirectResponse|View
    {
        $cartItems = Cart::content();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        return view('app.frontend.pages.checkout.index', compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|View
    {
        DB::beginTransaction();

        try {
            $user = $request->user();

            $order = Order::create([
                'buyer_id' => $user->id,
                'order_number' => 'INV-' . strtoupper(uniqid()),
                'total_amount' => (float) Cart::total(0, '', ''),
                'status' => OrderStatus::PENDING_PAYMENT->value,
                'shipping_address' => $user->profile->address,
            ]);

            foreach (Cart::content() as $item) {
                $order->items()->create([
                    'product_id' => $item->id,
                    'product_name' => $item->name,
                    'price_per_unit' => $item->price,
                    'quantity' => $item->qty,
                ]);
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => $order->total_amount
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->profile->phone,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);
            DB::commit();

            Cart::destroy();

            return view('app.frontend.pages.checkout.success', compact('order', 'snapToken'))->with('success', 'Checkout berhasil. Silakan selesaikan pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Checkout error: ', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat memproses checkout. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
