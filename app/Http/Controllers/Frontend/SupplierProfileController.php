<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierProfileController extends Controller
{
    public function show(User $supplier): View|RedirectResponse
    {
        if ($supplier->role->value !== 'supplier' || $supplier->status !== 'verified') {
            return back()->with('error', 'Pemasok tidak ditemukan atau tidak valid.');
        }

        $supplier->load([
            'profile',
            'products' => function ($query) {
                $query->where('is_active', true);
            }
        ]);

        $products = $supplier->products()->where('is_active', true)
            ->latest()
            ->paginate(8);

        return view('app.frontend.pages.supplier.show', compact('supplier', 'products'));
    }
}
