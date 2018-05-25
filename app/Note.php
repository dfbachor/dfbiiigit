<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'systemID', 'entityType', 'entityID', 'editingUserID', 'note', 
        'maxPlantCount', 'imageFileName', 'created_at', 'updated_at', 'publish'
    ];

     public function comment()
    {
        return $this->hasMany('App\Comment');
    }
}
