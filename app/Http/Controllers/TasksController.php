<?php

namespace App\Http\Controllers;

use Auth;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index() 
    {

    //    $tasks = DB::table('tasks');  //get()->where('id', $request->id)
    //     return view('tasks.show', compact('tasks'));

        return view('tasks.index');
    }

     /**
     * Display a page to add a new user
     *
     */
    public function create() 
    {
        //$users = User::all(['id', 'name']);
        $users = User::where('systemID', app('system')->id)->get(['id', 'name']);

        return view('tasks.create', compact('users',$users));
    }

    /**
     * Display a page to add a new user
     *
     */
    public function store(Request $request) 
    {
        //dd($request->all());

        $newUser = Task::create([
            'task' => $request['task'],
            'systemID' => app('system')->id, // from appServiceprovider
            'assignedToUserId' => $request['assignedToUserId'],
            'status' => $request['status'],
            'operatorUserName' => Auth::user()->username,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect('tasks');
    }

     /**
     * Display a page to edit a  task
     *
     */
    public function edit($id) 
    {
        //$user = Task::find($id);
        
        $task = collect(DB::select('select t.id, t.task, t.assignedToUserId, concat(u.name, " (", u.username, ")") as name, DATE(t.created_at) as created_at, DATE(t.closed_at) as closed_at, t.status from tasks t, users u where u.id = t.assignedToUserId and t.id = :id', ['id' => $id]))->first();
        //$users = User::all(['id', 'name']);

        $users = User::where('systemID', app('system')->id)->get(['id', 'name']);

        
        return view('tasks.edit')->with('users', $users)->with('task', $task) ;

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


        $task = Task::find($request['id']);
        
            $task->task = $request['task'];
            $task->assignedToUserId = $request['assignedToUserId'];
            $task->created_at = $request['openDate'];

            $task->closed_at = $request['closedDate'];
            $task->status = $request['status'];

            
            $task->operatorUserName = Auth::user()->username;
            $task->updated_at = Carbon::now()->toDateTimeString();
            $task->save();

            return redirect('tasks');
        }

        /**
         * Display a page to delete a new user
         *
         */
        public function destroy($id) 
        {
            Task::destroy($id);
            
            $notes = DB::table('notes')->where([
                ['entityType', '=', 'task'],
                ['entityID', '=', $id],
                ])->delete();

            $task = DB::table('tasks');  //get()->where('id', $request->id)        

            //return view('users.index', compact('user'));    
            return Redirect::to('tasks')->with('task');
        }


}
