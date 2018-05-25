<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'userID', 'noteID', 'comment', 'created_at', 'updated_at'
    ];


    /**
     * Get the post that owns the comment.
     */
    public function note()
    {
        return $this->belongsTo('App\Post');
    }

}
