<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{

    use SoftDeletes;

    protected $softDelete = true;

    protected $table = 'customer';

    protected $fillable = [
        'day_month', 'name', 'email', 'phone', 'info_contact', 'address', 'note'
    ];
}
