<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translate_prize extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'prize_id',
        'locale',
        'title',
        'description',
        'category',
        'created_at',
        'updated_at',
    ];

    public function form()
    {
        return $this->belongsTo(Prize::class);
    }
}
