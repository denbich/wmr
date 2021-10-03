<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'expiration',
        'place_longitude',
        'place_latitude',
        'icon_src',
        'tag',
        'author_id',
        'condition',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function form_translate()
    {
        return $this->hasOne(Translate_form::class);
    }

    public function form_position()
    {
        return $this->hasManyThrough(Position_form::class, Translate_position_form::class, 'position_id', 'form_id', 'id');
    }

    public function formposition()
    {
        return $this->hasMany(Position_form::class, 'form_id', 'id');
    }

    public function signed_form()
    {
        return $this->belongsTo(Signed_form::class, 'id', 'form_id');
    }

    public function calendar()
    {
        return $this->hasOne(Calendar::class);
    }

    public function signedform()
    {
        return $this->hasMany(Signed_form::class, 'form_id', 'id');
    }

}
