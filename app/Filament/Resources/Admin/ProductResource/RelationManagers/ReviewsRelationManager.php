<?php

namespace App\Filament\Resources\Admin\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';
    protected static ?string $label = 'Ulasan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengulas'),

                Tables\Columns\TextColumn::make('rating')
                    ->icon('heroicon-s-star')
                    ->color('warning'),

                Tables\Columns\TextColumn::make('comment')
                    ->label('Komentar')
                    ->wrap(),

                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Tampilkan'),
            ])
            ->filters([])
            ->headerActions([])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
