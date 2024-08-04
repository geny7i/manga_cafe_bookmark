<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * SocialProfile
 *
 * @mixin Eloquent
 */
class SocialProfile extends Model
{
    protected $fillable = [
        'user_id',
        'provider',
        'social_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
