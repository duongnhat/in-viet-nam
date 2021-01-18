<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zalo extends Model
{
    use SoftDeletes;

    protected $softDelete = true;

    protected $table = 'zalo';

    protected $fillable = [
        'product_id', 'page_id', 'post_id',
    ];
}
