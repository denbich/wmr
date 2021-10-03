<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_prize extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'volunteer_id',
        'prize_id',
        'info',
        'condition',
        'created_at',
        'updated_at',
    ];

    public function volunteer()
    {
        return $this->hasOne(User::class, 'id', 'volunteer_id');
    }

    public function d_prize()
    {
        return $this->hasOneThrough(Translate_prize::class, Prize::class, 'id', 'prize_id', 'prize_id');
    }

    public function prize()
    {
        return $this->hasOne(Prize::class, 'id', 'prize_id');
    }
}
