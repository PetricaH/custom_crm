<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalFile extends Model
{
    protected $fillable = [
        'file_name', 'file_path',
    ];
}
