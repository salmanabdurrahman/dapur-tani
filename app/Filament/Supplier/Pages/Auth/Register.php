<?php

namespace App\Filament\Supplier\Pages\Auth;

use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;

class Register extends BaseRegister
{
    /**
     *
     * @param  array<string, mixed>  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function handleRegistration(array $data): \Illuminate\Database\Eloquent\Model
    {
        $data['role'] = UserRole::SUPPLIER;
        $data['status'] = 'verified';

        $user = static::getUserModel()::create($data);

        $user->profile()->create([
            'business_name' => $data['name']
        ]);

        return $user;
    }
}
