<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activity extends Model
{
    use HasFactory;
    protected $table = 'activity';
    protected $fillable = [
        'ClaimID',
        'Start',
        'Type',
        'Code',
        'Quantity',
        'Net',
        'Clinician',
        'created_at',
        'updated_at'
    ];

    public function claims()
    {
        return $this->belongsTo('App\Models\claims','ClaimID');
    }
    public function observationa()
    {
        return $this->hasOne('App\Models\observation','activityID');
    }
}
