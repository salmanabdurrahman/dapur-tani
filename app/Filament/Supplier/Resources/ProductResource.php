<?php

namespace App\Filament\Supplier\Resources;

use App\Filament\Supplier\Resources\ProductResource\Pages;
use App\Filament\Supplier\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Manajemen Toko';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Produk Saya';
    protected static ?string $pluralModelLabel = 'Produk';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Produk')
                    ->description('Deskripsikan produk Anda sejelas mungkin agar menarik bagi pembeli.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Produk')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Product::class, 'slug', ignoreRecord: true)
                            ->readOnly()
                            ->helperText('Slug akan dibuat otomatis berdasarkan nama produk.'),

                        Forms\Components\Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi Lengkap Produk')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Harga, Satuan & Stok')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Harga')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),

                        Forms\Components\TextInput::make('unit')
                            ->label('Satuan')
                            ->required()
                            ->placeholder('Contoh: kg, ikat, buah, pack'),

                        Forms\Components\TextInput::make('stock_quantity')
                            ->label('Jumlah Stok')
                            ->required()
                            ->numeric(),
                    ])->columns(3),

                Forms\Components\Section::make('Media & Status')
                    ->schema([
                        Forms\Components\FileUpload::make('main_image_path')
                            ->label('Gambar Utama Produk')
                            ->image()
                            ->imageEditor()
                            ->directory('product-images')
                            ->required(),

                        Forms\Components\Toggle::make('status')
                            ->label('Status Jual')
                            ->helperText('Jika tidak aktif, produk tidak akan tampil di halaman depan.')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image_path')->label('Gambar'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock_quantity')
                    ->label('Stok')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Filter Kategori'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('supplier_id', Auth::id());
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['supplier_id'] = Auth::id();
        return $data;
    }
}
