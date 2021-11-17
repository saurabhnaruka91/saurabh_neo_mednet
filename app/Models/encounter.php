<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class encounter extends Model
{
    use HasFactory;
    protected $table = 'encounter';
    protected $fillable = [
        'ClaimID',
        'FacilityID',
        'Type',
        'PatientID',
        'Start',
        'End',
        'StartType',
        'EndType',
        'created_at',
        'updated_at'
    ];
    public function claims()
    {
        return $this->belongsTo('App\Models\claims','ClaimID');
    }
}
