<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = 'users';

    protected $dates = [
        'updated_at',
        'created_at',
        'email_verified_at',
        'two_factor_expires_at',
    ];
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_deleted',
        'role_id',
        'created_at',
        'updated_at',
        'two_factor_code',
        'two_factor_expires_at',
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

    public function roles()
    {
        return $this->belongsTo('App\models\Role','role_id');
    }

    public static function totalUsers(){
        return self::with(['roles'])->where('is_deleted',0)->get()->count();
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
//        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_code = 123456;
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

}
