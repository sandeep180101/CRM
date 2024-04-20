<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use App\Validations\countryValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CountryController extends Controller
{
    //
    protected $table = 'master_countries';

    public function add(Request $request,$id=null)
    {
        try {
            $data["title"] = "Add User";
            $param = array('limit' => 10 , 'start' => 0);
        $countries = Countries::getAllCountry($param);
        if($countries['totalCount'] > 0){
            $data['countries'] = $countries['results'];
            $data['totalCount'] = $countries['totalCount'];
        }else{
            $data['countries']  = [];
            $data['totalCount'] = 0;
        }
            if ($id) {
                $decryptedId = Crypt::decrypt($id);
                $countries = new Countries();
                $data['singleData'] = $countries->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
            return view("master.country.index", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $countries = new countryValidation();
            $validationResult = $countries->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }

            $objcountries = new Countries();
            $returnData = $objcountries->saveData($request->all());
            if (count($returnData) <= 0) {
                $returnData = ['status' => 'error', 'message' => 'Error in data insertion'];
            }

            return json_encode($returnData);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
