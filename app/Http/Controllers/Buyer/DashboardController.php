<?php

namespace App\Http\Controllers\Buyer;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $activeOrdersCount = Order::where('buyer_id', $user->id)
            ->whereIn('status', [OrderStatus::PROCESSING, OrderStatus::SHIPPED])
            ->count();

        $processingOrdersCount = Order::where('buyer_id', $user->id)
            ->where('status', OrderStatus::PROCESSING)
            ->count();

        $monthlySpending = Order::where('buyer_id', $user->id)
            ->where('status', OrderStatus::PROCESSING)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        $recentOrders = Order::where('buyer_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('app.buyer.pages.dashboard.index', compact(
            'activeOrdersCount',
            'processingOrdersCount',
            'monthlySpending',
            'recentOrders'
        ));
    }
}
