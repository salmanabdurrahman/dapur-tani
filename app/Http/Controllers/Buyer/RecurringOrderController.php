<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyer\StoreRecurringOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class RecurringOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $recurringOrders = Auth::user()
            ->recurringOrders()
            ->with('product')
            ->orderByDesc('created_at')
            ->paginate(6);

        return view('app.buyer.pages.recurring-orders.index', compact('recurringOrders'));
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
    public function store(StoreRecurringOrderRequest $request)
    {
        $validated = $request->validated();

        try {
            Auth::user()->recurringOrders()->updateOrCreate(
                ['product_id' => $validated['product_id']],
                $validated
            );

            return redirect()->route('buyer.recurring-orders.index')->with('success', 'Jadwal langganan berhasil disimpan!');
        } catch (\Exception $e) {
            Log::error('Failed to create recurring order', [
                'error' => $e->getMessage(),
                'data' => $validated,
            ]);

            return redirect()->back()->with('error', 'Gagal membuat jadwal langganan.');
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
        try {
            $user = Auth::user();
            $recurringOrder = $user->recurringOrders()->findOrFail($id);
            $recurringOrder->delete();

            return back()->with('success', 'Jadwal langganan berhasil dibatalkan!');
        } catch (\Exception $e) {
            Log::error('Failed to delete recurring order', [
                'error' => $e->getMessage(),
                'id' => $id,
            ]);

            return redirect()->back()->with('error', 'Gagal menghapus jadwal langganan.');
        }
    }
}
