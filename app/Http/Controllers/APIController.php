<?php

namespace App\Http\Controllers;


use App\User;
use App\Note;
use App\Task;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class APIController extends Controller
{
    // USERS

    public function getUsers(Request $request) 
    {
        // cannot use app('system')->id as this request is being called from
        // ajax and not within the framework itself
        // so we use the request object  
        $systemID = $request->input('systemID');
        $query = User::select('id', 'name', 'username', 'imageFileName', 'email', 'role')->where('systemID', '=', $systemID);

        Log::info('getUsers: query.', ['query' => $query]);

        return datatables($query)->make(true);
    }

    public function getUserDetail($id) 
    {
        
        $user = DB::table('users')->get(['id', 'username', 'imageFileName', 'name', 'email', 'role'])->where('id', '=', $id);        
        return $user;
    }

    // TASKS
    public function getTasks(Request $request) 
    {        
        // cannot use app('system')->id as this request is being called from
        // ajax and not within the framework itself
        // so we use the request object  
        $systemID = $request->input('systemID');
        $closed = $request->input('closed');
        // if($closed == 1)
        //     $closed = "closed";
        // else 
        //     $closed = "";
        // $query = Task::select('id', 'task', 'assignedToUserId', 'created_at', 'status')->where('systemID', '=', $systemID);

        
        $query = DB::select('select t.id, t.task, concat(u.name, " (", u.username, ")") as name, t.created_at, t.status 
                                from tasks t, users u 
                                where 
                                u.id = t.assignedToUserId and 
                                t.status != :closed and
                                t.systemID = :systemID', ['systemID' => $systemID, 'closed' => $closed]);

        return datatables($query)->make(true);
    }

    public function updateTaskCloseDate(Request $request) {
        
        //return($request->input('operatorUserName'));
        $task = Task::find($request['id']);
        
        $task->updated_at = Carbon::now()->toDateTimeString();
        $task->operatorUserName = $request->input('operatorUserName');

        if($request->input('action') == 1 ){
            $task->closed_at = Carbon::now()->toDateTimeString();
            $task->status = 'Closed';
        } else {
            $task->closed_at = null;
            $task->status = 'Open';
        }
        
        
        $task->save();

        return "success";
    }

    public function getTaskDetail($id) 
    {
        
        // $task = DB::table('tasks')->get(['id', 'task', 'imageFileName', 'name', 'email', 'role'])->where('id', '=', $id);  
        $task = DB::select('select t.id, t.task, concat(u.name, " (", u.username, ")") as name, t.created_at, t.status, t.closed_at 
                            from tasks t, users u 
                            where u.id = t.assignedToUserId and t.id = :id', 
                            ['id' => $id]);

        return $task;
    }


    // public function storeNote($id) 
    // {
    //     User::destroy($id);
    //     
    // }

    public function storeNote(Request $request)
    {
        $note = new Note();

            $newNote =$note->create([
                'systemID' => $request['systemID'], 
                'entityID' => $request['entityID'],
                'entityType' => $request['entityType'],
                'editingUserID' => $request['editingUserID'], 
                'note' => $request['note'],
                'publish' => $request['publish'],
                'imageFileName' => $request['imageFileName'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
            
            // needs exception processing
            $file = $request->file('noteImageFileName');        
            
            if($file) {
            
                //$destinationPath = 'uploads';
                $filename = $request['entityType'] . '_' . $request['systemID'] . '_' . $newNote->id . '_' . $file->getClientOriginalName();

                //$file->move($destinationPath, $filename);  

                //$filename = $destinationPath . '/' . $filename;

                $stored = Storage::disk('local')->put($filename, File::get($file));
                    
                    if(!$stored)
                        $filename = "file not stored";
                    

                DB::table('notes')->where('id', $newNote->id)->update(['imageFileName' =>  $filename]);
                
                // need to update the plants image

                //dd(newNote);

                switch($request['entityType']) {
                    case "plant":
                        DB::table('plants')->where('id', $request['entityID'])->update(['imageFileName' =>  $filename]);
                        break;
                    default:
                        break;
                }
            }

        return "success";

    }

    public function storeNoteComment(Request $request)
    {
        $comment = new Comment();
       
        try {

            $newComment = $comment->create([
                'noteID' => $request['noteID'], 
                'userID' => $request['userID'],
                'comment' => $request['comment'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
                ]);

        } catch (\Illuminate\Database\QueryException $e) {
            // something went wrong with the transaction, rollback
            //return "failure";
        }
         
        return "success";

    } // storeNoteComment

    public function getNotes(Request $request)
    {

        $systemID = $request->input('systemID');
        $entityID = $request->input('entityID');
        $entityType = $request->input('entityType');   

        $notes = DB::table('notes')->where([
                            ['systemID', '=', $systemID],
                            ['entityID', '=', $entityID],
                            ['entityType', '=', $entityType],                                                   
        ])->orderBy('updated_at','DESC')->get();        
        
        return $notes;

    }


    public function deleteNote(Request $request) 
    {
        
        $id = $request->input('id');
        $systemID = $request->input('systemID');
        // $imageFileName = $request->input('imageFileName'); // need to delete image whe thats ready
        $notes = DB::table('notes')->where([
                                            ['id', '=', $id],
                                            ['systemID', '=', $systemID],
                                            ])->delete();        

        return "success";

    }

    public function updateNote(Request $request) 
    {

        $id = $request->input('id');
        $systemID = $request->input('systemID');
        $note = $request->input('note'); 

        DB::table('notes')->where([
                                    ['id', '=', $id],
                                    ['systemID', '=', $systemID],            
                                ])->update(['note' => $note]);


        // $notes = DB::table('notes')->where([
        //    ['id', '=', $id],
        //    ['systemID', '=', $systemID],
        // ])->delete();        

        return "success";

    }

    // ROOMS
    public function getRooms(Request $request) 
    {        
        // cannot use app('system')->id as this request is being called from
        // ajax and not within the framework itself
        // so we use the request object  
        $systemID = $request->input('systemID');
        // $query = Task::select('id', 'task', 'assignedToUserId', 'created_at', 'status')->where('systemID', '=', $systemID);
        
        $query = DB::select('select r.id, r.roomName, r.lighting, 3 as plants from rooms r where r.systemID = :systemID', ['systemID' => $systemID]);

        return datatables($query)->make(true);
    }

    public function getRoomDetail($id) 
    {
        // $task = DB::table('tasks')->get(['id', 'task', 'imageFileName', 'name', 'email', 'role'])->where('id', '=', $id);  
        $room = DB::select('select * from rooms where id = :id', ['id' => $id]);

        return $room;
    }

 // Strains
 public function getStrains(Request $request) 
 {        
     // cannot use app('system')->id as this request is being called from
     // ajax and not within the framework itself
     // so we use the request object  
     $systemID = $request->input('systemID');
     // $query = Task::select('id', 'task', 'assignedToUserId', 'created_at', 'status')->where('systemID', '=', $systemID);
     
     $query = DB::select('select id, strainName, 7 as plants, floweringTimeInDays from strains where systemID = :systemID', ['systemID' => $systemID]);

     return datatables($query)->make(true);
 }

 public function getStrainDetail($id) 
 {
     // $task = DB::table('tasks')->get(['id', 'task', 'imageFileName', 'name', 'email', 'role'])->where('id', '=', $id);  
     $room = DB::select('select * from strains where id = :id', ['id' => $id]);

     return $room;
 }

/********************************************************* */
 // PLants
 public function getPlants(Request $request) 
 {        
     // cannot use app('system')->id as this request is being called from
     // ajax and not within the framework itself
     // so we use the request object  
     $systemID = $request->input('systemID');

     $query = DB::select('select 
                p.id,
                "bn" as batchName,
                r.roomName, 
                st.strainName, 
				s.stageName, 
				3 as daysInStage 
			from 
				plants p 
				LEFT JOIN rooms r ON r.ID = p.roomID 
				LEFT JOIN stages s ON s.ID = p.stageID 
				LEFT JOIN mediums m ON m.ID = p.mediumID 
                LEFT JOIN strains st ON st.ID = p.strainID
            where 
                p.systemID = :systemID', 
            ['systemID' => $systemID]);

     return datatables($query)->make(true);
 }

 /********************************************************* */

 public function updatPlantCloseDate(Request $request) {
     
     //return($request->input('operatorUserName'));
     $task = Task::find($request['id']);
     
     $task->updated_at = Carbon::now()->toDateTimeString();
     $task->operatorUserName = $request->input('operatorUserName');

     if($request->input('action') == 1 ){
         $task->closed_at = Carbon::now()->toDateTimeString();
         $task->status = 'Closed';
     } else {
         $task->closed_at = null;
         $task->status = 'Open';
     }
     
     
     $task->save();

     return "success";
 }

 /********************************************************* */

 public function getPlantDetail($id) 
 {
     // $task = DB::table('tasks')->get(['id', 'task', 'imageFileName', 'name', 'email', 'role'])->where('id', '=', $id);  
    //  $task = DB::select('select t.id, t.task, concat(u.name, " (", u.username, ")") as name, t.created_at, t.status, t.closed_at 
    //                      from tasks t, users u 
    //                      where u.id = t.assignedToUserId and t.id = :id', 
    //                      ['id' => $id]);

    $plant = DB::select('select 
                p.id,
                "bn" as batchName,
                r.roomName, 
                st.strainName, 
				s.stageName, 
                m.mediumName,
                p.startDate, 
				p.cycleChangeDate, 
				p.harvestDate, 
				p.completeDate, 
				p.imageFileName, 
				p.yield 
			from 
				plants p 
				LEFT JOIN rooms r ON r.ID = p.roomID 
				LEFT JOIN stages s ON s.ID = p.stageID 
				LEFT JOIN mediums m ON m.ID = p.mediumID 
                LEFT JOIN strains st ON st.ID = p.strainID
            where 
                p.id = :id', 
            ['id' => $id]);

     return $plant;
 }

 public function getImage($filename) {
    // 
        
    $file = Storage::disk('local')->get($filename);
     return new Response($file, 200);
 }


} // end class
