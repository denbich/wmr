<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'quantity',
        'points',
        'icon_src',
        'created_at',
        'updated_at',
    ];

    public function prize_translate()
    {
        return $this->hasOne(Translate_prize::class);
    }

    public function prize_order()
    {
        return $this->belongsTo(Order_prize::class);
    }

}
