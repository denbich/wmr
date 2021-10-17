<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signed_form extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'form_id',
        'volunteer_id',
        'position_id',
        'condition',
        'created_at',
        'updated_at',
    ];

    public function form()
    {
        return $this->hasOne(Form::class, 'id', 'form_id');
    }

    public function volunteer()
    {
        return $this->hasOne(User::class, 'id', 'volunteer_id');
    }

    public function position()
    {
        return $this->hasOneThrough(Translate_position_form::class, Position_form::class, 'id', 'position_id', 'position_id');
    }

    public function post_form()
    {
        return $this->hasOne(Position_form::class, 'id', 'position_id');
    }

    public function trans_position()
    {
        return $this->hasOne(Translate_position_form::class, 'position_id', 'position_id');
    }


}
