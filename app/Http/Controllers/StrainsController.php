<?php

namespace App\Http\Controllers;

use Auth;
use App\Strain;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class StrainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index() 
    {

    //    $tasks = DB::table('tasks');  //get()->where('id', $request->id)
    //     return view('tasks.show', compact('tasks'));

        return view('strains.index');
    }

    /**
     * Display a page to add a new user
     *
     */
    public function create() 
    {

        return view('strains.create');
    }

    /**
     * Display a page to add a new user
     *
     */
    public function store(Request $request) 
    {
        //dd($request->all());

        $Strain = Strain::create([
            'strainName' => $request['strainName'],
            'systemID' => app('system')->id, // from appServiceprovider
            'testingStatus' => $request['testingStatus'],
            'floweringTimeInDays' => $request['floweringTimeInDays'],
            'genetics' => $request['genetics'],
            'operatorUserName' => Auth::user()->username,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect('strains');
    }


    /**
     * Display a page to edit a  task
     *
     */
    public function edit($id) 
    {
        $strain = Strain::find($id);
        //return($user);
        return view('strains.edit')->with('strain', $strain);

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

        $strain = strain::find($request['id']);
        
        $strain->systemID = $request['strainName'];
        $strain->strainName = $request['strainName'];
        $strain->systemID = app('system')->id;
        $strain->testingStatus = $request['testingStatus'];
        $strain->floweringTimeInDays = $request['floweringTimeInDays'];
        $strain->genetics = $request['genetics'];
        $strain->operatorUserName = Auth::user()->username;
        $strain->updated_at = Carbon::now()->toDateTimeString();
        $strain->save();

        return redirect('strains');
    }

    /**
     * Display a page to delete a new user
     *
     */
    public function destroy($id) 
    {
        Strain::destroy($id);
        
        $notes = DB::table('notes')->where([
            ['entityType', '=', 'strain'],
            ['entityID', '=', $id],
            ])->delete();

        $strains = DB::table('strains');  //get()->where('id', $request->id)        

        //return view('users.index', compact('user'));    
        return Redirect::to('strains')->with('strains');
    }

}
