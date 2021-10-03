<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'firstname',
        'lastname',
        'gender',
        'photo_src',
        'telephone',
        'agreement_src',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function message()
    {
        return $this->hasMany(Message::class, 'sender', 'id');
    }

    public function volunteer()
    {
        return $this->hasOne(Volunteer::class);
    }

    public function author_form()
    {
        return $this->hasOne(Form::class);
    }

    public function signed_form()
    {
        return $this->hasMany(Translate_form::class);
    }

    public function prize_order()
    {
        return $this->belongsTo(Order_prize::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
