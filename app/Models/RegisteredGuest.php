<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisteredGuest extends Model
{
    use SoftDeletes;

    protected $softDelete = true;

    protected $table = 'registered_guest';

    protected $fillable = [
        'product_id', 'qty', 'specification', 'phone', 'email', 'note', 'completed',
    ];
}
