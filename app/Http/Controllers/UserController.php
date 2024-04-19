<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Validations\userValidation;

class UserController extends Controller
{
    //


    public function add(Request $request,$id=null)
    {
        try {
            $data["title"] = "Add User";
            $param = array('limit' => 10 , 'start' => 0);
        $users = User::getUserViewDetails($param);
        if($users['total_count'] > 0){
            $data['users'] = $users['results'];
            $data['total_count'] = $users['total_count'];
        }else{
            $data['users']  = [];
            $data['total_count'] = 0;
        }
            if ($id) {
                $decryptedId = Crypt::decrypt($id);
                $users = new User();
                $data['singleData'] = $users->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
            return view("users.index", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $users = new userValidation();
            $validationResult = $users->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }

            $objusers = new User();
            $returnData = $objusers->saveData($request->all());
            if (count($returnData) <= 0) {
                $returnData = ['status' => 'error', 'message' => 'Error in data insertion'];
            }

            return json_encode($returnData);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
