<?php

namespace App\Filament\Supplier\Resources;

use App\Enums\OrderStatus;
use App\Filament\Supplier\Resources\PayoutResource\Pages;
use App\Filament\Supplier\Resources\PayoutResource\RelationManagers;
use App\Models\Payout;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayoutResource extends Resource
{
    protected static ?string $model = Payout::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $navigationLabel = 'Pendapatan & Payout';
    protected static ?string $pluralModelLabel = 'Pendapatan';
    protected static ?string $label = 'Payout';
    protected static ?string $pluralLabel = 'Payout';
    protected static ?int $navigationSort = 5;

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        $supplierId = Auth::id();

        $totalRevenue = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.supplier_id', $supplierId)
            ->where('orders.status', OrderStatus::COMPLETED)
            ->sum(DB::raw('order_items.quantity * order_items.price_per_unit'));

        $totalWithdrawn = Payout::where('supplier_id', $supplierId)
            ->whereIn('status', ['completed', 'pending'])
            ->sum('amount');

        $availableBalance = $totalRevenue - $totalWithdrawn;

        return $form
            ->schema([
                Forms\Components\Section::make('Ajukan Penarikan Dana')
                    ->description('Pastikan data rekening bank Anda di halaman profil sudah benar.')
                    ->schema([
                        Forms\Components\TextInput::make('amount')
                            ->label('Jumlah Penarikan')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(50000)
                            ->maxValue($availableBalance)
                            ->helperText('Saldo Anda saat ini: Rp ' . number_format($availableBalance, 0, ',', '.')),

                        Forms\Components\Placeholder::make('rekening_tujuan')
                            ->label('Akan Ditransfer ke Rekening')
                            ->content(function () {
                                $profile = Auth::user()->profile;
                                if ($profile && $profile->bank_name && $profile->bank_account_number) {
                                    return $profile->bank_name . ' - ' . $profile->bank_account_number . ' (a.n. ' . $profile->bank_account_name . ')';
                                }
                                return new \Illuminate\Support\HtmlString('<span class="text-danger-600">Harap lengkapi data rekening bank Anda di halaman Pengaturan Profil.</span>');
                            }),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'completed' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Diajukan')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('processed_at')
                    ->label('Tanggal Diproses')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('rejection_reason')
                    ->label('Alasan Penolakan')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([])
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
            'index' => Pages\ListPayouts::route('/'),
            'create' => Pages\CreatePayout::route('/create'),
            // 'edit' => Pages\EditPayout::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('supplier_id', Auth::id());
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['supplier_id'] = Auth::id();
        $data['status'] = 'pending';
        return $data;
    }
}
