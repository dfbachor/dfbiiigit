<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\NoteLike;
use Illuminate\Http\Request;

class APICommunityController extends Controller
{

    public function likeNote(Request $request) {

        $noteLike = new NoteLike();
        // return "likeNote noteid " . $request['noteID'];
        try {

            $newNoteLike = $noteLike->create([
                'noteID' => $request['noteID'], 
                'likeUserID' => $request['userID'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return "failure: " . $e->getMessage() ;
        }
            return "success";
    }

    public function unlikeNote(Request $request) {
        
        //return "unlikeNote noteid " . $request['noteID'];        

        $noteLike = NoteLike::where([
                                    'noteID', '=', $request['noteID'],
                                    'likeUserID', '=', $request['userID'],
                                    ])->delete();
        return "success";
    }

}
