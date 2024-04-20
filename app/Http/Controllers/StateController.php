<?php

namespace App\Http\Controllers;

use App\Models\StatesModel;
use App\Validations\stateValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StateController extends Controller
{
    //
    protected $table = 'master_states';

    public function add(Request $request,$id=null)
    {
        try {
            $data["title"] = "Add User";
            $param = array('limit' => 10 , 'start' => 0);
        $states = StatesModel::getAllStates($param);
        if($states['totalCount'] > 0){
            $data['states'] = $states['results'];
            $data['totalCount'] = $states['totalCount'];
        }else{
            $data['states']  = [];
            $data['totalCount'] = 0;
        }
            if ($id) {
                $decryptedId = Crypt::decrypt($id);
                $states = new StatesModel();
                $data['singleData'] = $states->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
            return view("master.state.index", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $states = new stateValidation();
            $validationResult = $states->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }

            $objstates = new StatesModel();
            $returnData = $objstates->saveData($request->all());
            if (count($returnData) <= 0) {
                $returnData = ['status' => 'error', 'message' => 'Error in data insertion'];
            }

            return json_encode($returnData);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
