<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translate_position_form extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'position_id',
        'locale',
        'title',
        'description',
        'created_at',
        'updated_at',
    ];

    public function form_position()
    {
        return $this->belongsTo(Position_form::class, 'position_id', 'id');
    }
}
