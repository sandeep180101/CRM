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

    public function index(){
        try{
        $data['title'] = 'Countries';
        $param = array();
        $param = array('limit' => 10 , 'start' => 0);
        $roles = Countries::getAllCountry($param);
        if($roles['total_count']>0){
            $data['countries'] = $roles['results'];
            $data['total_count'] = $roles['total_count'];
        }else{
            $data['countries'] = '';
            $data['total_count'] = 0;
        }
        return view('master.country.index',$data);
    } catch (\Exception $e) {
        return $e->getMessage();
    }

    }

    public function add(Request $request,$id = null){
        try{
        if ($id) {
                $decryptedId = Crypt::decrypt($id);
                $leads = new Countries();
                $data['singleData'] = $leads->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
        $data['title'] = 'Country Add';
        return view('master.country.add',$data);
    } catch (\Exception $e) {
        return $e->getMessage();
    }

    }
    public function save(Request $request){
        try{
        $country = new countryValidation();
        $validationResult = $country->validate($request->all());

        if ($validationResult !== null) {
            return json_encode($validationResult);
        }

        $objCommon = new CommonModel;
        $uniqueFieldValue = array(
            'country_name' => $request->country_name,
        );
        
        $uniqueCount = $objCommon->checkMultiUnique($this->table, $uniqueFieldValue, $request['id']);       
            if ($uniqueCount > 0) {
                $returnData = array('status' => 'exist', 'message' => 'This country already exists!', 'unique_field' => $uniqueFieldValue);
                return json_encode($returnData);
        	}
        $objroles = new Countries(); 
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
