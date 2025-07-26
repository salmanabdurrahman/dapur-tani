<?php

namespace App\Filament\Supplier\Resources;

use App\Filament\Supplier\Resources\PromotionResource\Pages;
use App\Filament\Supplier\Resources\PromotionResource\RelationManagers;
use App\Models\Product;
use App\Models\Promotion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Manajemen Toko';
    protected static ?string $pluralModelLabel = 'Promosi';
    protected static ?string $label = 'Promosi';
    protected static ?string $pluralLabel = 'Promosi';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Buat Promosi Baru')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->label('Pilih Produk')
                            ->options(Product::where('supplier_id', Auth::id())->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('type')
                            ->label('Jenis Diskon')
                            ->options([
                                'percentage' => 'Persentase (%)',
                                'fixed' => 'Potongan Harga (Rp)',
                            ])
                            ->required()
                            ->live(),
                        Forms\Components\TextInput::make('value')
                            ->label('Nilai Diskon')
                            ->required()
                            ->numeric()
                            ->prefix(fn(Forms\Get $get) => $get('type') === 'fixed' ? 'Rp' : '%'),
                        Forms\Components\TextInput::make('min_quantity')
                            ->label('Kuantitas Minimum')
                            ->numeric()
                            ->default(1)
                            ->helperText('Jumlah minimum pembelian untuk mendapatkan promo ini.')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Jadwal & Status')
                    ->schema([
                        Forms\Components\DateTimePicker::make('starts_at')
                            ->label('Tanggal Mulai')
                            ->required(),
                        Forms\Components\DateTimePicker::make('expires_at')
                            ->label('Tanggal Berakhir')
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktifkan Promo')
                            ->default(true),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Jenis')
                    ->badge(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai Diskon')
                    ->money(fn($record) => $record->type === 'fixed' ? 'IDR' : null)
                    ->formatStateUsing(fn($state, $record) => $record->type === 'percentage' ? $state . '%' : $state),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('expires_at')
                    ->label('Berakhir Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                ])
            ]);
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
            'index' => Pages\ListPromotions::route('/'),
            'create' => Pages\CreatePromotion::route('/create'),
            'edit' => Pages\EditPromotion::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('supplier_id', Auth::id())
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['supplier_id'] = Auth::id();
        return $data;
    }
}
