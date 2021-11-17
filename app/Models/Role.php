<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    CONST SUPER_ADMIN = 1;
    CONST USER = 2;
    CONST SALES_MANAGER = 3;
    protected $primaryKey = 'role_id';
    protected $fillable = [
        'role_name',
        'role_slug',
        'created_at',
        'updated_at'
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User','role_id');
    }
}
