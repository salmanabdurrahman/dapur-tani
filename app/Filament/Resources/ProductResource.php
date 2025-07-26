<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Admin\ProductResource\RelationManagers\ReviewsRelationManager;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Manajemen Platform';
    protected static ?string $navigationLabel = 'Semua Produk';
    protected static ?string $pluralModelLabel = 'Semua Produk';
    protected static ?string $label = 'Produk';
    protected static ?string $pluralLabel = 'Produk';
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
                Forms\Components\Section::make('Informasi Produk')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Produk'),
                        Forms\Components\TextInput::make('supplier.name')
                            ->label('Nama Supplier')
                            ->formatStateUsing(fn($record) => $record?->supplier?->name),
                        Forms\Components\TextInput::make('category.name')
                            ->label('Kategori')
                            ->formatStateUsing(fn($record) => $record?->category?->name),
                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Harga & Stok')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Harga')
                            ->prefix('IDR'),
                        Forms\Components\TextInput::make('unit')
                            ->label('Satuan'),
                        Forms\Components\TextInput::make('stock_quantity')
                            ->label('Jumlah Stok'),
                    ])->columns(3),

                Forms\Components\Section::make('Media & Status')
                    ->schema([
                        Forms\Components\FileUpload::make('main_image_path')
                            ->label('Gambar Utama'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Jual'),
                    ]),
            ])->disabled();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image_path')
                    ->label('Gambar'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable(),

                Tables\Columns\TextColumn::make('supplier.name')
                    ->label('Supplier')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Status Jual'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('supplier')
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Jual'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            ReviewsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            // 'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            // 'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['supplier', 'category'])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
