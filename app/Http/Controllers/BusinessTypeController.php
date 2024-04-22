<?php

namespace App\Http\Controllers;

use App\Models\BusinessModel;
use App\Validations\BusinessTypeValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class BusinessTypeController extends Controller
{
    //
    protected $table = 'master_business_type';

    public function add(Request $request,$id=null)
    {
        try {
            $data["title"] = "Add Business";
            $param = array('limit' => 10 , 'start' => 0);
        $businesses = BusinessModel::getAllbusiness($param);
        if($businesses['totalCount'] > 0){
            $data['businesses'] = $businesses['results'];
            $data['totalCount'] = $businesses['totalCount'];
        }else{
            $data['businesses']  = [];
            $data['totalCount'] = 0;
        }
            if ($id) {
                $decryptedId = Crypt::decrypt($id);
                $businesses = new BusinessModel();
                $data['singleData'] = $businesses->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
            return view("master.businesstype.index", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $businesses = new BusinessTypeValidation();
            $validationResult = $businesses->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }

            $objbusinesses = new BusinessModel();
            $returnData = $objbusinesses->saveData($request->all());
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
            $objbusinesses = BusinessModel::find($id);
    
            if (!$objbusinesses) {
                return response()->json(['status' => 'error', 'message' => 'Business data not found'], 404);
            }
    
            $objbusinesses->status = 1;
            $objbusinesses->save();
    
            return redirect()->back()->with('success', 'Business deleted successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }
}
