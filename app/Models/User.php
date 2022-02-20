<?php

namespace App\Models;

use Illuminate\Auth\Notifications\VerifyEmail;
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
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'birth_date',
        'phone_number',
        'user_type_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|TypeOfUser
     */
    public function userType()
    {
        return $this->belongsTo(TypeOfUser::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Task[]
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'executes');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Comment[]
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

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
}
