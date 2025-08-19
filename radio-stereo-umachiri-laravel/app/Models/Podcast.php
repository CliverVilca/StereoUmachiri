<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    protected $fillable = [
        'program_id',
        'title',
        'description',
        'audio_path',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
