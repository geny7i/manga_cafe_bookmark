<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Comic
 *
 * @mixin Eloquent
 */
class Comic extends Model
{
    use HasFactory;

    public function shop() {
        return $this->belongsTo(Shop::class);
    }
}

