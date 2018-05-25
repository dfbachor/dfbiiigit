<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function store(Request $request) { // Request $request

        $data = $request->all(); // This will get all the request data.
        return $data;
    }
}


