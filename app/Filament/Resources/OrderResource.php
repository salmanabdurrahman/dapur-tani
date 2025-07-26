<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Manajemen Transaksi';
    protected static ?string $pluralModelLabel = 'Semua Pesanan';
    protected static ?string $label = 'Pesanan';
    protected static ?string $pluralLabel = 'Pesanan';
    protected static ?int $navigationSort = 4;

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
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Detail Pesanan')->schema([
                        Forms\Components\TextInput::make('order_number')
                            ->label('ID Pesanan'),
                        Forms\Components\TextInput::make('buyer.name')
                            ->label('Nama Pembeli')
                            ->formatStateUsing(fn($record) => $record?->buyer?->name ?? 'N/A'),
                        Forms\Components\TextInput::make('total_amount')
                            ->label('Total Pembayaran')
                            ->prefix('IDR')
                            ->formatStateUsing(fn($state) => number_format($state, 2, ',', '.')),
                        Forms\Components\TextInput::make('status')
                            ->label('Status Pesanan'),
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Tanggal Dipesan'),
                    ])->columns(2),

                    Forms\Components\Section::make('Produk yang Dipesan')->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('product_name')
                                    ->label('Nama Produk'),
                                Forms\Components\TextInput::make('quantity')
                                    ->label('Jumlah'),
                                Forms\Components\TextInput::make('price_per_unit')
                                    ->label('Harga Satuan')
                                    ->prefix('IDR'),
                                Forms\Components\TextInput::make('product.supplier.name')
                                    ->label('Pemasok')
                                    ->formatStateUsing(fn($record) => $record?->product?->supplier?->name ?? 'N/A'),
                            ])
                            ->columns(4)
                            ->addable(false)
                            ->deletable(false),
                    ]),
                ])->columnSpan(['lg' => 4]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Info Pengiriman')->schema([
                        Forms\Components\Textarea::make('shipping_address')
                            ->label('Alamat Lengkap')
                            ->rows(4),
                    ]),
                ])->columnSpan(['lg' => 4]),
            ])->columns(4);
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

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(OrderStatus $state): string => match ($state->value) {
                        OrderStatus::PENDING_PAYMENT->value => 'gray',
                        OrderStatus::PROCESSING->value => 'warning',
                        OrderStatus::SHIPPED->value => 'info',
                        OrderStatus::COMPLETED->value => 'success',
                        OrderStatus::CANCELLED->value => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pesan')
                    ->dateTime()
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
            ->with(['buyer', 'items.product.supplier'])
            ->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
