<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        'systemID', 'task', 'assignedToUserId', 'status', 'closed_at', 'operatorUserName', 'created_at', 'updated_at', 
    ];
}
