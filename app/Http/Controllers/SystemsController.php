<?php

namespace App\Http\Controllers;

use Auth;
use App\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



class SystemsController extends Controller
{
    public function show(Request $request) 
    {
        // dd( app('system')->id); 
        //$system = DB::table('systems')->where('id', '=', app('system')->id)->get();
        //return view('system.show', compact('system'));

        $system = System::where('id', '=', app('system')->id)->get();
        return view('system.show', ['system' => $system]);

    }

    public function update(Request $request) 
    {
        //return($request->all());
         $system = System::find($request['id']);
        
         $system->companyName = $request['companyName'];
         $system->email = $request['email'];


         if($request->hasFile('companyLogo')) {
            $file = $request->file('companyLogo');

            if($file) {
                //$destinationPath = 'uploads';
                $filename = 'system' . '_' . app('system')->id . '_' . $request['id'] . '_' . $file->getClientOriginalName();
                // $file->move($destinationPath, $filename);  
                // $filename = $destinationPath . '/' . $filename;
                
                $stored = Storage::disk('local')->put($filename, File::get($file));

                if($stored)
                    $system->imageFileName = $filename;
                else
                    $system->imageFileName = "file not stored";

            }                
        }

         $system->operatorUserName = "dfb"; // Auth::user()->username;
         $system->updated_at = Carbon::now()->toDateTimeString();
         $system->save();

         $system = DB::table('systems')->where('id', '=', $request['id'])->get();
         return view('system.show', compact('system')); 
    }

    public function getSystemImage($filename) {
       // 
           
       $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
}
