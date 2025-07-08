<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Subscription extends Model
{
    use SoftDeletes;

    protected $table = 'subscriptions';

    protected $guarded = [
        'id'
    ];

    protected static function booted(): void
    {
        static::creating(function ($subscription) {
            $subscription->token = Str::random(32);
        });
    }
}
