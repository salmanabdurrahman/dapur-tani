<?php

namespace App\Filament\Supplier\Resources;

use App\Enums\OrderStatus;
use App\Filament\Supplier\Resources\OrderResource\Pages;
use App\Filament\Supplier\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationLabel = 'Pesanan Masuk';
    protected static ?string $pluralModelLabel = 'Pesanan Masuk';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Detail Pesanan')
                            ->schema([
                                Forms\Components\TextInput::make('order_number')
                                    ->label('ID Pesanan')
                                    ->disabled(),
                                Forms\Components\TextInput::make('buyer.name')
                                    ->label('Nama Pembeli')
                                    ->disabled(),
                                Forms\Components\TextInput::make('total_amount')
                                    ->label('Total Pembayaran')
                                    ->prefix('Rp')
                                    ->disabled(),
                                Forms\Components\Select::make('status')
                                    ->label('Status Pesanan')
                                    ->options(OrderStatus::class)
                                    ->disabled(),
                            ])->columns(2),

                        Forms\Components\Section::make('Alamat Pengiriman')
                            ->schema([
                                Forms\Components\Textarea::make('shipping_address')
                                    ->label('Alamat Lengkap')
                                    ->disabled()
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Produk yang Dipesan')
                            ->schema([
                                Forms\Components\Repeater::make('items')
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\Select::make('product_id')
                                            ->label('Produk')
                                            ->relationship('product', 'name')
                                            ->disabled(),
                                        Forms\Components\TextInput::make('quantity')
                                            ->numeric()
                                            ->disabled(),
                                        Forms\Components\TextInput::make('price_per_unit')
                                            ->label('Harga Satuan')
                                            ->prefix('Rp')
                                            ->disabled(),
                                    ])
                                    ->columns(3)
                                    ->addable(false)
                                    ->deletable(false),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('ID Pesanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('buyer.name')
                    ->label('Nama Pembeli')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pesan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options(OrderStatus::class)
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(OrderStatus::class)
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            // 'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            // 'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('items.product', function (Builder $query) {
                $query->where('supplier_id', Auth::id());
            });
    }
}
