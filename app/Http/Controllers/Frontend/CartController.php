<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cartItems = Cart::content();
        return view('app.frontend.pages.cart.index', compact('cartItems'));
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $product = Product::firstWhere('id', $validated['product_id']);
            if (!$product) {
                return back()->with('error', 'Produk tidak ditemukan.');
            }

            if ($product->stock_quantity < $validated['quantity']) {
                return back()->with('error', 'Stok produk tidak cukup.');
            }

            Cart::add(
                $product->id,
                $product->name,
                $validated['quantity'],
                $product->price,
                0,
                [
                    'image' => $product->main_image_path,
                    'unit' => $product->unit,
                ]
            );

            return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
        } catch (\Exception $e) {
            Log::error('Cart item creation failed', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return back()->with('error', 'Gagal menambahkan produk ke keranjang. Silakan coba lagi.');
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
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            Cart::update($request->rowId, $validated['quantity']);

            return redirect()->route('cart.index')->with('success', 'Produk berhasil diperbarui di keranjang.');
        } catch (\Exception $e) {
            Log::error('Cart item update failed', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return back()->with('error', 'Gagal memperbarui produk di keranjang. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            Cart::remove($id);

            return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
        } catch (\Exception $e) {
            Log::error('Cart item deletion failed', [
                'error' => $e->getMessage(),
                'rowId' => $id,
            ]);

            return back()->with('error', 'Gagal menghapus produk dari keranjang. Silakan coba lagi.');
        }
    }
}
