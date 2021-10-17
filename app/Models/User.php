<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
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
        'agreement_date',
        'condition',
        'marketing_agreement',
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

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail); // my notification
    }

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
