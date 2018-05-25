<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Strain extends Model
{
    //
    protected $fillable = [
        'systemID', 'strainName', 'testingStatus', 'genetics', 'floweringTimeInDays', 'operatorUserName', 'created_at', 'updated_at', 
    ];
}
