<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setRoleAttribute($value) {
        $this->attributes['role'] = strtolower($value);
    }

    public function setTanggalLahirAttribute($value)
    {
        if ($value != null) {
            $this->attributes['tanggal_lahir'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
        }
    }

    public function getTanggalLahirAttribute($value)
    {
        if ($value != null) {
            return Carbon::parse($value)->format(config('app.date_format'));
        }
    }

    public function getJenisKelaminAttribute($value)
    {
        if ($value != null) {
            return ucfirst($value);
        }
    }
}
