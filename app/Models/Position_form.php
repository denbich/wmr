<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position_form extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'form_id',
        'points',
        'max_volunteer',
        'created_at',
        'updated_at',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function translate_form_position()
    {
        return $this->hasOne(Translate_position_form::class, 'position_id', 'id');
    }

    public function signed_form()
    {
        return $this->belongsTo(Signed_form::class, 'id', 'position_id');
    }
}
