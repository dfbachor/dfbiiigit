<?php

namespace App\Http\Controllers;

use Auth;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RoomsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     */
    public function index() 
    {

    //    $tasks = DB::table('tasks');  //get()->where('id', $request->id)
    //     return view('tasks.show', compact('tasks'));

        return view('rooms.index');
    }

    /**
     * Display a page to add a new user
     *
     */
    public function create() 
    {

        return view('rooms.create');
    }

     /**
     * Display a page to add a new user
     *
     */
    public function store(Request $request) 
    {
        //dd($request->all());

        $newRoom = Room::create([
            'roomName' => $request['roomName'],
            'systemID' => app('system')->id, // from appServiceprovider
            'lighting' => $request['lighting'],
            'humidifier' => $request['humidifier'],
            'comment' => $request['roomInformation'],
            'operatorUserName' => Auth::user()->username,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect('rooms');
    }

    /**
         * Display a page to delete a new user
         *
         */
        public function destroy($id) 
        {
            Room::destroy($id);
            
            $notes = DB::table('notes')->where([
                ['entityType', '=', 'room'],
                ['entityID', '=', $id],
                ])->delete();

            $rooms = DB::table('rooms');  //get()->where('id', $request->id)        

            //return view('users.index', compact('user'));    
            return Redirect::to('rooms')->with('rooms');
        }


        /**
     * Display a page to edit a  task
     *
     */
    public function edit($id) 
    {
        $room = Room::find($id);
        //return($user);
        return view('rooms.edit')->with('room', $room);

        //$user = DB::table('users')->get(['id', 'username', 'name', 'email', 'role'])->where('id', '=', $id);        
        //return view('users.edit', compact('user'));    
    }


    /**
     * Display a page to add a new user
     *
     */
    public function update(Request $request) 
    {
       //print_r($_POST); 
       //dd($request->all()); 
       //dd($request->hasFile('imageFile'));
       // dd($request['imageFile']);


        $room = Room::find($request['id']);
        
        $room->roomName = $request['roomName'];
        $room->lighting = $request['lighting'];
        $room->hoursOfOperation = $request['hoursOfOperation'];
        $room->exhaustType = $request['exhaustType'];
        $room->humidifier = $request['humidifier'];
        $room->comment = $request['roomInformation'];
        $room->operatorUserName = Auth::user()->username;
        $room->updated_at = Carbon::now()->toDateTimeString();
        $room->save();

        return redirect('rooms');
    }


}
