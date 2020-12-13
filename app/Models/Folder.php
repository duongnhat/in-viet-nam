<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use SoftDeletes;

    protected $softDelete = true;

    protected $table = 'folder';

    protected $fillable = [
        'name', 'folder_father_id', 'description',
    ];
}
