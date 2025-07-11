<?php

namespace App\Http\Controllers\Buyer;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = auth()->user();

        $ordersQuery = Order::query()
            ->where('buyer_id', $user->id)
            ->latest();

        $validStatuses = [
            OrderStatus::PROCESSING->value,
            OrderStatus::SHIPPED->value,
            OrderStatus::COMPLETED->value,
            OrderStatus::CANCELLED->value,
            OrderStatus::DELIVERED->value,
        ];

        if ($request->filled('status') && in_array($request->status, $validStatuses)) {
            $ordersQuery->where('status', $request->status);
        }

        $orders = $ordersQuery->paginate(5)->withQueryString();

        return view('app.buyer.pages.orders.index', compact('orders'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View|RedirectResponse
    {
        $order = Order::find($id);

        if (!$order || $order->buyer_id !== auth()->id()) {
            return redirect()->route('buyer.orders.index');
        }

        $order->load('items.product');

        return view('app.buyer.pages.orders.show', compact('order'));
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
