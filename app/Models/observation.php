<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class observation extends Model
{
    use HasFactory;
    protected $table = 'observation';
    protected $fillable = [
        'ClaimID',
        'activityID',
        'Type',
        'Code',
        'Value',
        'ValueType',
        'created_at',
        'updated_at'
    ];
    public function claims()
    {
        return $this->belongsTo('App\Models\claims','ClaimID');
    }
    public function activity()
    {
        return $this->belongsTo('App\Models\activity','activityID');
    }
}
