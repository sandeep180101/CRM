<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Validations\userValidation;

class UserController extends Controller
{
    //

    public $table = "users";
    public function add(Request $request,$id=null)
    {
        try {
            $data["title"] = "Add User";
            $param = array('limit' => 10 , 'start' => 0);
        $users = User::getUserViewDetails($param);
        if($users['totalCount'] > 0){
            $data['users'] = $users['results'];
            $data['totalCount'] = $users['totalCount'];
        }else{
            $data['users']  = [];
            $data['totalCount'] = 0;
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
            $objCommon = new CommonModel;
            $uniqueFieldValue = array(
                'phone' => $request->phone,
                'email'=> $request->email,
            );
            $uniqueCount = $objCommon->checkMultiUnique($this->table, $uniqueFieldValue, $request['id']);       
            if ($uniqueCount > 0) {
                $returnData = array('status' => 'exist', 'message' => 'Customer already exists!', 'unique_field' => $uniqueFieldValue);
                return json_encode($returnData);
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
    public function delete(Request $request, $id){
        try {
            $objusers = User::find($id);
    
            if (!$objusers) {
                return response()->json(['status' => 'error', 'message' => 'Country data not found'], 404);
            }
    
            $objusers->status = 1;
            $objusers->save();
    
            return redirect()->back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }
}
