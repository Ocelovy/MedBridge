<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Aginev\SearchFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    protected $fillable = ['name', 'email', 'birth_number', 'insurance_code', 'address', 'phone'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
