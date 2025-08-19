<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dj extends Model
{
    protected $fillable = [
        'name',
        'bio',
        'photo_path',
    ];
}
