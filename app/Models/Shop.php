<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Shop
 *
 * @mixin Eloquent
 */
class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'platform_id',
        'id_in_platform',
        'name'
    ];
}
