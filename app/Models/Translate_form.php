<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translate_form extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'form_id',
        'locale',
        'title',
        'description',
        'created_at',
        'updated_at',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
