<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class PlatformSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $pluralModelLabel = 'Pengaturan';
    protected static ?string $label = 'Pengaturan';
    protected static ?string $pluralLabel = 'Pengaturan';
    protected static ?int $navigationSort = 7;
    protected static string $view = 'filament.pages.platform-settings';
    protected static ?string $title = 'Pengaturan Platform';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Pengaturan Keuangan')
                    ->description('Atur variabel finansial utama untuk platform Dapur Tani.')
                    ->schema([
                        TextInput::make('platform_commission')
                            ->label('Komisi Platform (%)')
                            ->numeric()
                            ->required()
                            ->helperText('Persentase yang diambil dari setiap transaksi berhasil.'),

                        TextInput::make('minimum_payout')
                            ->label('Minimum Payout (Rp)')
                            ->numeric()
                            ->required()
                            ->prefix('Rp')
                            ->helperText('Jumlah minimum yang bisa ditarik oleh supplier.'),
                    ])->columns(2),

                Section::make('Pengaturan Umum')
                    ->description('Pengaturan umum untuk tampilan dan informasi platform.')
                    ->schema([
                        TextInput::make('contact_email')
                            ->label('Email Kontak Utama')
                            ->email()
                            ->required()
                            ->helperText('Email yang ditampilkan di halaman "Hubungi Kami".'),
                        TextInput::make('contact_phone')
                            ->label('Nomor Telepon Utama')
                            ->tel()
                            ->required()
                            ->helperText('Nomor telepon yang ditampilkan di halaman "Hubungi Kami".'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }
}
