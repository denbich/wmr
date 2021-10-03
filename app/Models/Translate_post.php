<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translate_post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'post_id',
        'locale',
        'title',
        'content',
        'created_at',
        'updated_at',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
