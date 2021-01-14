<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvisoryInfo extends Model
{
    use SoftDeletes;

    protected $softDelete = true;

    protected $table = 'advisory_info';

    protected $fillable = [
        'phone', 'email', 'note', 'completed',
    ];
}
