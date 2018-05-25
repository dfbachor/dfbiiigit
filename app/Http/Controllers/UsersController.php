<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    /**
     * Display a listing of all resources.
     *
     */
    public function index() 
    {

       $user = DB::table('users');  //get()->where('id', $request->id)
       
        return view('users.index', compact('user'));
    }

    /**
     * Display a page to add a new user
     *
     */
    public function create() 
    {

        return view('users.create');
    }

    /**
     * Display a page to edit a new user
     *
     */
    public function edit($id) 
    {
        $user = User::find($id);
        //return($user);
        return view('users.edit')->with('user', $user);

        //$user = DB::table('users')->get(['id', 'username', 'name', 'email', 'role'])->where('id', '=', $id);        
        //return view('users.edit', compact('user'));    
    }



    /**
     * Display a page to add a new user
     *
     */
    public function store(Request $request) 
    {
        //dd($request->all());

        $newUser = User::create([
            'name' => $request['name'],
            'systemID' => app('system')->id, // from appServiceprovider
            'username' => $request['username'],
            'email' => $request['email'],
            'role' => $request['role'],
            'password' => bcrypt($request['password']),
            'operatorUserName' => Auth::user()->username,
            'imageFileName' => app('system')->imageFileName,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        
        if($request->hasFile('imageFile')) {
            $file = $request->file('imageFile');

            if($file) {
                //$destinationPath = 'uploads';
                $filename = 'user' . '_' . app('system')->id . '_' . $newUser->id . '_' . $file->getClientOriginalName();
                //$file->move($destinationPath, $filename);  
                //$filename = $destinationPath . '/' . $filename;

                $stored = Storage::disk('local')->put($filename, File::get($file));

                $user = User::find($newUser->id);
                $user->imageFileName = $filename;

                if($stored)
                    $user->imageFileName = $filename;
                else
                    $user->imageFileName = "file not stored";

                $user->save();
            }                
        }
      
        return redirect('users');
    }

    /**
     * Display a page to delete a new user
     *
     */
    public function destroy($id) 
    {
        $user = User::find($id);

        
        Storage::delete();

        User::destroy($id);
        
        $notes = DB::table('notes')->where([
            ['entityType', '=', 'user'],
            ['entityID', '=', $id],
            ])->delete();

        $user = DB::table('users');  //get()->where('id', $request->id)        

        //return view('users.index', compact('user'));    
        return Redirect::to('users')->with('user');
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


        $user = User::find($request['id']);
        
            $user->name = $request['name'];
            $user->username = $request['username'];
            $user->email = $request['email'];
            $user->role = $request['role'];


            if($request->hasFile('imageFile')) {
                $file = $request->file('imageFile');

                if($file) {
                    //$destinationPath = 'uploads';
                    $filename = 'user' . '_' . app('system')->id . '_' . $request['id'] . '_' . $file->getClientOriginalName();
                    //$file->move($destinationPath, $filename);  
                    //$filename = $destinationPath . '/' . $filename;

                    $stored = Storage::disk('local')->put($filename, File::get($file));
                    
                    if($stored)
                        $user->imageFileName = $filename;
                    else
                        $user->imageFileName = "file not stored";
                    }                
            }

            $user->operatorUserName = Auth::user()->username;
            $user->updated_at = Carbon::now()->toDateTimeString();
            $user->save();

            return redirect('users');
        }

}


