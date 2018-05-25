<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    //
    protected $fillable = [
        'systemID', 'stageName', 'created_at', 'updated_at', 
    ];
}
