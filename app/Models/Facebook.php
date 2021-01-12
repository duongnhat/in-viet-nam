<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facebook extends Model
{
    use SoftDeletes;

    protected $softDelete = true;

    protected $table = 'facebook';

    protected $fillable = [
        'product_id', 'page_id', 'post_id',
    ];
}
