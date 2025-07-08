<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class UserProfile extends Model
{
    use SoftDeletes;

    protected $table = 'user_profiles';

    protected $guarded = [
        'id'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::creating(function ($profile) {
            if ($profile->business_name ?? $profile->user->name) {
                $profile->slug = Str::slug($profile->business_name ?? $profile->user->name);
            }
        });

        static::updating(function ($profile) {
            if ($profile->isDirty('business_name')) {
                $profile->slug = Str::slug($profile->business_name ?? $profile->user->name);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
