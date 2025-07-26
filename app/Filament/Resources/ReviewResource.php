<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Manajemen Interaksi';
    protected static ?string $pluralModelLabel = 'Ulasan Produk';
    protected static ?string $label = 'Ulasan Produk';
    protected static ?string $pluralLabel = 'Ulasan Produk';
    protected static ?int $navigationSort = 5;

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
                Forms\Components\Section::make('Detail Ulasan')
                    ->schema([
                        Forms\Components\TextInput::make('user_name')
                            ->label('Nama Pengulas')
                            ->formatStateUsing(fn($record) => $record?->user?->name),
                        Forms\Components\TextInput::make('product_name')
                            ->label('Produk yang Diulas')
                            ->formatStateUsing(fn($record) => $record?->product?->name),
                        Forms\Components\TextInput::make('rating')
                            ->label('Rating Diberikan'),
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Tanggal Ulasan'),
                        Forms\Components\Textarea::make('comment')
                            ->label('Isi Komentar')
                            ->columnSpanFull(),
                    ])->columns(2),
            ])->disabled();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengulas')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->icon('heroicon-s-star')
                    ->color('warning'),

                Tables\Columns\TextColumn::make('comment')
                    ->label('Komentar')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Tampilkan'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')->label('Status Tampil'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListReviews::route('/'),
            // 'create' => Pages\CreateReview::route('/create'),
            'view' => Pages\ViewReview::route('/{record}'),
            // 'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['user', 'product'])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
