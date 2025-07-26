<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreCartRequest;
use App\Http\Requests\Frontend\UpdateCartRequest;
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
    public function store(StoreCartRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $product = Product::findOrFail($validated['product_id']);

            if ($product->stock_quantity < $validated['quantity']) {
                return back()->with('error', 'Stok produk tidak mencukupi.');
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
            Log::error('Cart item addition failed', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return back()->with('error', 'Gagal menambahkan produk ke keranjang.');
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
    public function update(UpdateCartRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();

        try {
            Cart::update($validated['rowId'], $validated['quantity']);

            return redirect()->route('cart.index')->with('success', 'Produk berhasil diperbarui di keranjang.');
        } catch (\Exception $e) {
            Log::error('Cart item update failed', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return back()->with('error', 'Gagal memperbarui produk di keranjang.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate(['rowId' => 'required|string']);

        try {
            Cart::remove($request->rowId);

            return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
        } catch (\Exception $e) {
            Log::error('Cart item removal failed', [
                'error' => $e->getMessage(),
                'rowId' => $request->rowId,
            ]);

            return back()->with('error', 'Gagal menghapus produk dari keranjang.');
        }
    }
}
