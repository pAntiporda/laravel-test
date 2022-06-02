<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that are ignored and not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    // $guarded & $fillable should only be used one of them.

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Mutator -> mutate the value before it is saved to the database. Syntax is: SETAttributeNameATTRIBUTE(value)
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    // Accessor -> mutate the value before it is returned to the user. Syntax is: GETAttributeNameATTRIBUTE()
    // public function getPasswordAttribute($password) {
    //     return '********';
    // };


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
