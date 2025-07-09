<?php

namespace App\Filament\Supplier\Widgets;

use App\Models\Review;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class LatestReviews extends BaseWidget
{
    protected static ?string $heading = 'Ulasan Terbaru dari Pembeli';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Review::query()
                    ->whereHas('product', fn($query) => $query->where('supplier_id', Auth::id()))
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pembeli'),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->icon('heroicon-s-star')
                    ->color('warning'),
                Tables\Columns\TextColumn::make('comment')
                    ->label('Komentar')
                    ->limit(50)
                    ->wrap(),
            ]);
    }
}
