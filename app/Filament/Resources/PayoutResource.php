<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PayoutResource\Pages;
use App\Filament\Resources\PayoutResource\RelationManagers;
use App\Models\Payout;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PayoutResource extends Resource
{
    protected static ?string $model = Payout::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Manajemen Keuangan';
    protected static ?string $navigationLabel = 'Permintaan Payout';
    protected static ?string $pluralModelLabel = 'Permintaan Payout';
    protected static ?string $label = 'Payout';
    protected static ?string $pluralLabel = 'Payout';
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
                Forms\Components\Section::make('Detail Permintaan')
                    ->schema([
                        Forms\Components\TextInput::make('supplier.name')
                            ->label('Nama Supplier')
                            ->disabled(),
                        Forms\Components\TextInput::make('amount')
                            ->label('Jumlah Diajukan')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Tanggal Diajukan')
                            ->disabled(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'completed' => 'Completed',
                                'rejected' => 'Rejected',
                            ])
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Informasi Rekening Tujuan')
                    ->schema([
                        Forms\Components\TextInput::make('supplier.profile.bank_name')->label('Nama Bank')->disabled(),
                        Forms\Components\TextInput::make('supplier.profile.bank_account_number')->label('Nomor Rekening')->disabled(),
                        Forms\Components\TextInput::make('supplier.profile.bank_account_name')->label('Nama Pemilik Rekening')->disabled(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplier.name')
                    ->label('Nama Supplier')
                    ->searchable(),
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
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Diajukan')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'rejected' => 'Rejected',
                    ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Payout $record) {
                        $record->update([
                            'status' => 'completed',
                            'processed_at' => now(),
                        ]);
                        Notification::make()->title('Payout berhasil disetujui')->success()->send();
                    })
                    ->visible(fn(Payout $record): bool => $record->status === 'pending'),

                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->action(function (Payout $record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'processed_at' => now(),
                            'rejection_reason' => $data['rejection_reason'],
                        ]);
                        Notification::make()->title('Payout berhasil ditolak')->danger()->send();
                    })
                    ->visible(fn(Payout $record): bool => $record->status === 'pending'),
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
            'index' => Pages\ListPayouts::route('/'),
            // 'create' => Pages\CreatePayout::route('/create'),
            'view' => Pages\ViewPayout::route('/{record}'),
            // 'edit' => Pages\EditPayout::route('/{record}/edit'),
        ];
    }
}
