<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'news_id', 'name', 'content', 'approved'
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
