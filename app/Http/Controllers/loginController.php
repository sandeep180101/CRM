<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class loginController extends Controller
{
    //
    public function logout(Request $request)
    {
        try {
            auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect("login");
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
