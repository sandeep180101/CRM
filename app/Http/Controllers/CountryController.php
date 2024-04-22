<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
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
            $data["title"] = "Add Country";
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
            $objCommon = new CommonModel;
        $uniqueFieldValue = array(
            'country_name' => $request->country_name,
        );
        $uniqueCount = $objCommon->checkMultiUnique($this->table, $uniqueFieldValue, $request['id']);       
        if ($uniqueCount > 0) {
            $returnData = array('status' => 'exist', 'message' => 'Customer already exists!', 'unique_field' => $uniqueFieldValue);
            return json_encode($returnData);
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

    public function delete(Request $request, $id){
        try {
            $objcountries = Countries::find($id);
    
            if (!$objcountries) {
                return response()->json(['status' => 'error', 'message' => 'Country data not found'], 404);
            }
    
            $objcountries->status = 1;
            $objcountries->save();
    
            return redirect()->back()->with('success', 'Country deleted successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }
}
