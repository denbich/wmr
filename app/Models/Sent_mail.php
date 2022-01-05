<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sent_mail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'sender_id',
        'title',
        'content',
        'created_at',
        'updated_at',
    ];
}
