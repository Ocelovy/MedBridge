<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Aginev\SearchFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'photo'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role === 'Admin';
    }

    public function isDoktor()
    {
        return $this->role === 'Doktor';
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setFilters()
    {
        $this->filter->like('name')
                ->like('email')
                ->like('created_at');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
