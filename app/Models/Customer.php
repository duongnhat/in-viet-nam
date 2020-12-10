<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
        'day_month', 'name', 'email', 'phone', 'info_contact', 'address', 'note'
    ];
}
