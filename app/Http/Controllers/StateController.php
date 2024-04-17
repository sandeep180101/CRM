<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\CommonModel;
use App\Models\Countries;
use App\Models\role;
use App\Models\States;
use App\Validations\stateValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Response;

class StateController extends Controller
{
    //
    protected $table = 'master_states';

    public function index()
    {
        try {
            $data['title'] = 'States';
            $param = array();
            $param = array('limit' => 10, 'start' => 0);
            $data["countries"] = Countries::all();
            $roles = States::getAllStates($param);
            if ($roles['total_count'] > 0) {
                $data['states'] = $roles['results'];
                $data['total_count'] = $roles['total_count'];
            } else {
                $data['states'] = '';
                $data['total_count'] = 0;
            }
            return view('master.state.index', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function add(Request $request, $id = null)
    {
        try {
            $data["countries"] = Countries::all();
            if ($id) {
                $decryptedId = Crypt::decrypt($id);
                $leads = new States();
                $data['singleData'] = $leads->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
            $data['title'] = 'State Add';
            return view('master.state.add', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $roles = new stateValidation();
            $validationResult = $roles->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }

            $objroles = new States();
            $returnData = $objroles->saveData($request->all());
            if (count($returnData) <= 0) {
                $returnData = ['status' => 'error', 'message' => 'Error in data insertion'];
            }

            return json_encode($returnData);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
