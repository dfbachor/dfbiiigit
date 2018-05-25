<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommunityController extends Controller

{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {

        $notes = DB::select('select 
                                notes.*,
                                notes.entityType, 
                                users.imageFileName as userImageFileName,
                                note_likes.likeUserID as \'liked\'
                            from 
                                notes
                                inner join users on notes.editingUserID = users.id
                                left join note_likes on notes.id = note_likes.noteID
                            where
                                notes.publish = \'All\'
                            order by 
                                notes.updated_at DESC');

        //$posts = DB::table('notes')->where('publish', '=', 'All')->latest('updated_at')->get();
        return view('community.index', compact('notes'));
    }


}

/*

select 
    notes.*,
    notes.entityType, 
    users.imageFileName as userImageFileName,
    note_likes.likeUserID as 'liked'
from 
    notes
    inner join users on notes.editingUserID = users.id
    left join note_likes on notes.id = note_likes.noteID
where
    notes.publish = 'All'
order by 
    notes.updated_at DESC
*/