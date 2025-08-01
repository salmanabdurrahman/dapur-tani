<?php

namespace App\Filament\Supplier\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'Akun';
    protected static string $view = 'filament.supplier.pages.edit-profile';
    protected static ?string $navigationLabel = 'Pengaturan Profil';
    protected static ?string $title = 'Pengaturan Profil';
    protected static ?int $navigationSort = 6;

    public ?array $profileData = [];
    public ?array $passwordData = [];

    public function mount(): void
    {
        $user = Auth::user();
        $profile = $user->profile()->firstOrCreate();

        $formData = array_merge(
            $user->only(['name', 'email']),
            $profile->only(['business_name', 'phone_number', 'address', 'city', 'province', 'bank_name', 'bank_account_number', 'bank_account_name', 'profile_photo_path'])
        );

        $this->profileForm->fill($formData);
        $this->passwordForm->fill();
    }

    protected function getForms(): array
    {
        return [
            'profileForm',
            'passwordForm',
        ];
    }

    public function profileForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profil Bisnis & Kontak')
                    ->schema([
                        FileUpload::make('profile_photo_path')
                            ->label('Logo / Foto Profil')
                            ->image()
                            ->imageEditor()
                            ->directory('profile-photos'),
                        TextInput::make('business_name')
                            ->label('Nama Bisnis')
                            ->required(),
                        TextInput::make('name')
                            ->label('Nama Kontak (PIC)')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->disabled(),
                        TextInput::make('phone_number')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->required(),
                    ])->columns(2),

                Section::make('Alamat')
                    ->schema([
                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->required(),
                        TextInput::make('city')
                            ->label('Kota/Kabupaten')
                            ->required(),
                        TextInput::make('province')
                            ->label('Provinsi')
                            ->required(),
                    ])->columns(2),

                Section::make('Informasi Bank untuk Payout')
                    ->description('Data ini akan digunakan untuk mentransfer hasil penjualan Anda.')
                    ->schema([
                        TextInput::make('bank_name')
                            ->label('Nama Bank')
                            ->required(),
                        TextInput::make('bank_account_number')
                            ->label('Nomor Rekening')
                            ->required()
                            ->numeric(),
                        TextInput::make('bank_account_name')
                            ->label('Nama Pemilik Rekening')
                            ->required(),
                    ])->columns(3),
            ])
            ->statePath('profileData');
    }

    public function passwordForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ganti Password')
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Password Saat Ini')
                            ->password()
                            ->required()
                            ->currentPassword(),
                        TextInput::make('new_password')
                            ->label('Password Baru')
                            ->password()
                            ->required()
                            ->rule(Password::defaults()),
                        TextInput::make('new_password_confirmation')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->required()
                            ->same('new_password'),
                    ]),
            ])
            ->statePath('passwordData');
    }

    protected function getProfileFormActions(): array
    {
        return [
            Action::make('saveProfile')
                ->label('Simpan Perubahan Profil')
                ->submit('saveProfile'),
        ];
    }

    protected function getPasswordFormActions(): array
    {
        return [
            Action::make('savePassword')
                ->label('Ganti Password')
                ->submit('savePassword'),
        ];
    }

    public function saveProfile(): void
    {
        $user = Auth::user();
        $data = $this->profileForm->getState();

        $userData = ['name' => $data['name']];
        $profileData = [
            'business_name' => $data['business_name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'city' => $data['city'],
            'province' => $data['province'],
            'bank_name' => $data['bank_name'],
            'bank_account_number' => $data['bank_account_number'],
            'bank_account_name' => $data['bank_account_name'],
        ];

        if (isset($data['profile_photo_path']) && !is_string($data['profile_photo_path'])) {
            if ($user->profile->profile_photo_path) {
                Storage::disk('public')->delete($user->profile->profile_photo_path);
            }
            $profileData['profile_photo_path'] = $data['profile_photo_path'][0] ?? null;
        }

        $user->update($userData);
        $user->profile->update($profileData);

        Notification::make()
            ->title('Profil berhasil disimpan!')
            ->success()
            ->send();

        $this->mount();
    }

    public function savePassword(): void
    {
        $data = $this->passwordForm->getState();
        Auth::user()->update(['password' => Hash::make($data['new_password'])]);
        $this->passwordForm->fill();

        Notification::make()
            ->title('Password berhasil diganti!')
            ->success()
            ->send();
    }
}
