<?php

namespace App\Filament\Resources\Admin\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfileRelationManager extends RelationManager
{
    protected static string $relationship = 'profile';
    protected static ?string $label = 'Profil Pengguna';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('business_name')
                    ->label('Nama Usaha')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->label('No. Telepon')
                    ->tel()
                    ->required(),
                Forms\Components\Textarea::make('address')
                    ->label('Alamat')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('city')
                    ->label('Kota')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('province')
                    ->label('Provinsi')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Section::make('Informasi Bank')->schema([
                    Forms\Components\TextInput::make('bank_name')
                        ->label('Nama Bank'),
                    Forms\Components\TextInput::make('bank_account_number')
                        ->label('Nomor Rekening')
                        ->numeric(),
                    Forms\Components\TextInput::make('bank_account_name')
                        ->label('Nama Pemilik Rekening'),
                ])->columns(3),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('business_name')
            ->columns([
                Tables\Columns\TextColumn::make('business_name')
                    ->label('Nama Usaha')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('No. Telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('Kota')
                    ->sortable(),
                Tables\Columns\TextColumn::make('province')
                    ->label('Provinsi')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
