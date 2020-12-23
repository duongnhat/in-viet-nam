<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table = 'image';

    protected $fillable = [
        'product_id', 'user_id', 'name_to_store', 'path', 'extension',
    ];
}
