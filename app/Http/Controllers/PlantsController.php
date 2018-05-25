<?php

namespace App\Http\Controllers;

use Auth;
use App\Room;
use App\Stage;
use App\Plant;
use App\Strain;
use App\Medium;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index() 
    {

    //    $tasks = DB::table('tasks');  //get()->where('id', $request->id)
    //     return view('tasks.show', compact('tasks'));

        return view('plants.index');

    }

    /**
     * Display a page to add a new user
     *
     */
    public function create() 
    {

        $rooms = Room::where('systemID', app('system')->id)->get(['id', 'roomName']);
        $strains = Strain::where('systemID', app('system')->id)->get(['id', 'strainName']);
        $stages = Stage::get(['id', 'stageName']);
        // $mediums = Medium::get(['id', 'mediumName']);
        $mediums = Medium::get(['id', 'mediumName']);
        //dd($mediums);

        return \View::Make('plants.create')
            ->with(compact('rooms', $rooms))
            ->with(compact('strains', $strains)) 
            ->with(compact('mediums', $mediums)) 
            ->with(compact('stages', $stages));
       //  return view('plants.create');
    }

    /**
     * Display a page to add a new user
     *
     */
    public function store(Request $request) 
    {
        // dd($request->all());
        $startDate = date("Y-m-d H:i:s",strtotime($request['startDate']));
        $newPlant = Plant::create([
            'type' => $request['type'],
            'systemID' => app('system')->id, // from appServiceprovider
            'independentFromBatch' => 1,
            'batchID' => 0,
            'strainID' => $request['strain'],
            'stageID' => $request['stage'],
            'mediumID' => $request['medium'],
            'roomID' => $request['room'],
            'startDate' => $startDate,
            'operatorUserName' => Auth::user()->username,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect('plants');
    }


    /**
     * Display a page to edit a new user
     *
     */
    public function edit($id) 
    {
        $plant = Plant::find($id);

        $rooms = Room::where('systemID', app('system')->id)->get(['id', 'roomName']);
        $strains = Strain::where('systemID', app('system')->id)->get(['id', 'strainName']);
        $stages = Stage::get(['id', 'stageName']);
        $mediums = Medium::get(['id', 'mediumName']);

        //return($user);
        return view('plants.edit')->with('plant', $plant)    
                ->with(compact('rooms', $rooms))
                ->with(compact('strains', $strains)) 
                ->with(compact('mediums', $mediums)) 
                ->with(compact('stages', $stages));

    }

    /**
     * Display a page to edit a plant
     *
     */
    public function update(Request $request) 
    {
       //print_r($_POST); 
       //dd($request->all()); 
       //dd($request->hasFile('imageFile'));
       // dd($request['imageFile']);

       $startDate = date("Y-m-d H:i:s",strtotime($request['startDate']));
       $cycleChangeDate = date("Y-m-d H:i:s",strtotime($request['cycleChangeDate']));
       $harvestDate = date("Y-m-d H:i:s",strtotime($request['harvestDate']));
       $completeDate = date("Y-m-d H:i:s",strtotime($request['completeDate']));



        $plant = Plant::find($request['id']);
        
            $plant->type = $request['type'];
            $plant->strainID = $request['strain'];
            $plant->stageID = $request['stage'];
            $plant->roomID = $request['room'];
            $plant->mediumID = $request['medium'];
            $plant->startDate = $startDate;
            $plant->cycleChangeDate = $cycleChangeDate;
            $plant->harvestDate = $harvestDate;
            $plant->completeDate = $completeDate;

            $plant->operatorUserName = Auth::user()->username;
            $plant->updated_at = Carbon::now()->toDateTimeString();
            $plant->save();

            return redirect('plants');
        }


}
