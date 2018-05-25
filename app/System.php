<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    // 

    protected $fillable = [
        'creationDate', 'companyName', 'companyPhone', 'email', 'imageFileName', 'showCompleteGrows', 'showClosedTasks', 'maxPlantCount', 'maxBatchCount', 'maxBatchSize', 'imageFileName', 'hits', 'operatorUserName',
    ];
}
