<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $fillable = [
        'systemID', 'roomName', 'lighting', 'hoursOfOperation', 'exhaustType', 'humidifier', 'operatorUserName', 'comment', 'created_at', 'updated_at', 
    ];
}
