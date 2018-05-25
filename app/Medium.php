<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    // this ws interesting - the system kept looking for a table called media
    // I could not find reference to it anywhere - tried to drop and recreate etc.
    // no luck - this seems to get past it
    public $table = "mediums";

    protected $fillable = [
        'systemID', 'mediumeName', 'created_at', 'updated_at', 
    ];
}
