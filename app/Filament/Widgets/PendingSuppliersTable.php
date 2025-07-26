<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PendingSuppliersTable extends BaseWidget
{
    protected static ?string $heading = 'Supplier Terbaru Menunggu Verifikasi';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 5;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()->where('role', 'supplier')
                    ->where('status', 'pending')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kontak'),
                Tables\Columns\TextColumn::make('profile.business_name')
                    ->label('Nama Bisnis'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->date(),
            ])
            ->actions([
                Tables\Actions\Action::make('verify')
                    ->label('Verifikasi')
                    ->url(fn(User $record): string => UserResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-o-check-circle')->color('success'),
            ])
            ->paginated(false);
    }
}
