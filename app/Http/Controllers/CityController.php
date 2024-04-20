<?php

namespace App\Http\Controllers;

use App\Models\CityModel;
use App\Models\CommonModel;
use App\Models\Countries;
use App\Models\StatesModel;
use App\Validations\cityValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class CityController extends Controller
{
    //
    protected $table = 'master_cities';

    public function add(Request $request,$id=null)
    {
        try {
            $data["title"] = "Add City";
            $param = array('limit' => 10 , 'start' => 0);
        $cities = CityModel::getAllCityModel($param);
        if($cities['totalCount'] > 0){
            $data['cities'] = $cities['results'];
            $data['totalCount'] = $cities['totalCount'];
        }else{
            $data['cities']  = [];
            $data['totalCount'] = 0;
        }
            if ($id) {
                $decryptedId = Crypt::decrypt($id);
                $cities = new CityModel();
                $data['singleData'] = $cities->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
            return view("master.city.index", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $cities = new cityValidation();
            $validationResult = $cities->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }

            $objcities = new CityModel();
            $returnData = $objcities->saveData($request->all());
            if (count($returnData) <= 0) {
                $returnData = ['status' => 'error', 'message' => 'Error in data insertion'];
            }

            return json_encode($returnData);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
