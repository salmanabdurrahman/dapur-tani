<?php

namespace App\Filament\Supplier\Resources;

use App\Filament\Supplier\Resources\RecurringOrderResource\Pages;
use App\Filament\Supplier\Resources\RecurringOrderResource\RelationManagers;
use App\Models\RecurringOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class RecurringOrderResource extends Resource
{
    protected static ?string $model = RecurringOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Toko';
    protected static ?string $navigationLabel = 'Pesanan Langganan';
    protected static ?string $pluralModelLabel = 'Pesanan Langganan';
    protected static ?string $label = 'Pesanan Langganan';
    protected static ?string $pluralLabel = 'Pesanan Langganan';
    protected static ?int $navigationSort = 3;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Pelanggan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Kuantitas')
                    ->formatStateUsing(fn($record) => "{$record->quantity} {$record->product->unit}"),

                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Jadwal Kirim')
                    ->formatStateUsing(function (string $state): string {
                        $days = [
                            'monday' => 'Senin',
                            'tuesday' => 'Selasa',
                            'wednesday' => 'Rabu',
                            'thursday' => 'Kamis',
                            'friday' => 'Jumat',
                            'saturday' => 'Sabtu',
                            'sunday' => 'Minggu',
                        ];
                        $day = $days[strtolower($state)] ?? $state;
                        return "Setiap Hari " . $day;
                    }),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
            ])
            ->filters([])
            ->actions([
                // Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecurringOrders::route('/'),
            // 'create' => Pages\CreateRecurringOrder::route('/create'),
            // 'view' => Pages\ViewRecurringOrder::route('/{record}'),
            // 'edit' => Pages\EditRecurringOrder::route('/{record}/edit'),
        ];
    }
}
