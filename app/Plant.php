<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    //
    protected $fillable = [
        'systemID', 'independentFromBatch', 'batchID', 'type', 'strainID', 'cloneParentID', 
        'stageID', 'roomID', 'mediumID', 'startDate', 'cycleChangeDate', 'harvestDate', 
        'completeDate', 'yield', 'operatorUserName',
    ];
}
