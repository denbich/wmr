<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form_signature extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'volunteer_id',
        'form_id',
        'sign_id',
        'sign_path',
        'created_at',
        'updated_at',
    ];
}
