<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class claims extends Model
{
    use HasFactory;
    protected $table = 'claims';
    protected $fillable = [
        'MemberID',
        'PayerID',
        'ProviderID',
        'EmiratesIDNumber',
        'Gross',
        'PatientShare',
        'Net',
        'created_at',
        'updated_at',
        'xmlfile'
    ];

    public function encounter()
    {
        return $this->hasOne('App\Models\encounter','ClaimID');
    }
    public function activity()
    {
        return $this->hasOne('App\Models\activity','ClaimID');
    }
    public function observation()
    {
        return $this->hasOne('App\Models\observation','ClaimID');
    }
    public function diagnosis()
    {
        return $this->hasOne('App\Models\diagnosis','ClaimID');
    }

    public static function totalClaims(){
        return self::get()->count();
    }
}
