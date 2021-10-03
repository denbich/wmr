<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'form_id',
        'start',
        'end',
        'title',
        'created_at',
        'updated_at',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class, 'id', 'form_id');
    }
}
