<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'form_id',
        'author_id',
        'created_at',
        'updated_at',
    ];

    public function post_translate()
    {
        return $this->hasOne(Translate_post::class, 'post_id', 'id');
    }

    public function d_form()
    {
        return $this->hasOneThrough(Translate_form::class, Form::class, 'id', 'form_id', 'form_id');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
