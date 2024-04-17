<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\CommonModel;
use App\Models\Countries;
use App\Models\States;
use App\Validations\cityValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class CityController extends Controller
{
    //
    protected $table = 'master_cities';

    public function index()
    {
        try {
            $data['title'] = 'Cities';
            $param = array();
            $param = array('limit' => 10, 'start' => 0);
            $data["countries"] = Countries::all();
            $data["states"] = States::all();
            $roles = Cities::getAllCity($param);
            if ($roles['total_count'] > 0) {
                $data['cities'] = $roles['results'];
                $data['total_count'] = $roles['total_count'];
            } else {
                $data['cities'] = '';
                $data['total_count'] = 0;
            }
            return view('master.city.index', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function add(Request $request, $id = null)
    {
        try {
            $data["countries"] = Countries::all();
            $data["states"] = States::all();
            if ($id) {
                $decryptedId = Crypt::decrypt($id);
                $leads = new Cities();
                $data['singleData'] = $leads->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
            $data['title'] = 'City Add';
            return view('master.city.add', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $roles = new cityValidation();
            $validationResult = $roles->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }
            
            $objroles = new Cities();
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
