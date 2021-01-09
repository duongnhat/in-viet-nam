<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $softDelete = true;

    protected $table = 'product';

    protected $fillable = [
        'name', 'folder_id', 'price', 'summary', 'introduce', 'code', 'text_domain', 'image_id', 'youtube', 'note', 'qty', 'active',
    ];
}
