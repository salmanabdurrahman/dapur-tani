<?php

namespace App\Filament\Supplier\Resources;

use App\Enums\OrderStatus;
use App\Exports\OrdersExport;
use App\Filament\Exports\OrderExporter;
use App\Filament\Supplier\Resources\OrderResource\Pages;
use App\Filament\Supplier\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Tables\Actions\ExportAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationGroup = 'Manajemen Toko';
    protected static ?string $navigationLabel = 'Pesanan Masuk';
    protected static ?string $pluralModelLabel = 'Pesanan Masuk';
    protected static ?string $label = 'Pesanan';
    protected static ?string $pluralLabel = 'Pesanan';
    protected static ?int $navigationSort = 2;

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
                        Forms\Components\TextInput::make('buyer_name')
                            ->label('Nama Pembeli')
                            ->formatStateUsing(fn($record) => $record->buyer->name),
                        Forms\Components\TextInput::make('total_amount')
                            ->label('Total Pembayaran')
                            ->prefix('IDR'),
                        Forms\Components\TextInput::make('status')
                            ->label('Status Pesanan'),
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Tanggal Dipesan'),
                    ])->columns(2),

                    Forms\Components\Section::make('Produk yang Dipesan')->schema([
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
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->disabled(),
                            ])
                            ->columns(3)->addable(false)->deletable(false),
                    ]),

                    Forms\Components\Section::make('Alamat Pengiriman')->schema([
                        Forms\Components\Textarea::make('shipping_address')
                            ->label('Alamat Lengkap')
                            ->rows(3),
                    ]),
                ])->columnSpanFull(),
            ]);
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
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn($state): string => match ($state instanceof OrderStatus ? $state->value : $state) {
                        OrderStatus::PENDING_PAYMENT->value => 'gray',
                        OrderStatus::PROCESSING->value => 'warning',
                        OrderStatus::SHIPPED->value => 'info',
                        OrderStatus::COMPLETED->value => 'success',
                        OrderStatus::CANCELLED->value => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Ekspor ke Excel (CSV)')
                    ->color('primary')
                    ->icon('heroicon-o-document-arrow-down')
                    ->exporter(OrderExporter::class),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('updateStatusToProcessing')
                        ->label('Tandai sebagai "Diproses"')
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(fn(Order $record) => $record->update(['status' => OrderStatus::PROCESSING]))
                        ->visible(fn(Order $record): bool => $record->status === OrderStatus::PENDING_PAYMENT),

                    Tables\Actions\Action::make('updateStatusToShipped')
                        ->label('Tandai sebagai "Dikirim"')
                        ->icon('heroicon-o-truck')
                        ->color('info')
                        ->requiresConfirmation()
                        ->action(fn(Order $record) => $record->update(['status' => OrderStatus::SHIPPED]))
                        ->visible(fn(Order $record): bool => $record->status === OrderStatus::PROCESSING),

                    Tables\Actions\Action::make('updateStatusToDelivered')
                        ->label('Tandai sebagai "Diterima Pembeli"')
                        ->icon('heroicon-o-home')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->action(fn(Order $record) => $record->update(['status' => OrderStatus::DELIVERED]))
                        ->visible(fn(Order $record): bool => $record->status === OrderStatus::SHIPPED),

                    Tables\Actions\Action::make('updateStatusToCompleted')
                        ->label('Tandai sebagai "Selesai"')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn(Order $record) => $record->update(['status' => OrderStatus::COMPLETED]))
                        ->visible(fn(Order $record): bool => $record->status === OrderStatus::DELIVERED),

                    Tables\Actions\Action::make('updateStatusToCancelled')
                        ->label('Batalkan Pesanan')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(fn(Order $record) => $record->update(['status' => OrderStatus::CANCELLED]))
                        ->visible(fn(Order $record): bool => in_array($record->status, [
                            OrderStatus::PENDING_PAYMENT,
                            OrderStatus::PROCESSING,
                            OrderStatus::SHIPPED,
                            OrderStatus::DELIVERED,
                        ])),
                ]),
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
