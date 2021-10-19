<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'points',
        'telephone',
        'birth',
        'school',
        'tshirt_size',
        'street',
        'house_number',
        'city',
        'ice',
        'description',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function signed_form()
    {
        return $this->belongsTo(User::class);
    }
}
