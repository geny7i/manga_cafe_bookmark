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

    protected $fillable = [
        'user_id',
        'shop_id',
        'id_in_platform',
        'title',
        'shelf_info',
        'isbn',
    ];

    public function shop() {
        return $this->belongsTo(Shop::class);
    }
}

