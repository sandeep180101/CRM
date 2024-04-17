<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    //
    public function index()
    {
        $data["title"] = "Master";
        return view("master.index",$data);
    }
}
