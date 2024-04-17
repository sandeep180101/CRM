<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        try {
            $data['title'] = "Home";
            return view("dashboard.index", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
