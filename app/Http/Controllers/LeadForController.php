<?php

namespace App\Http\Controllers;

use App\Models\LeadForModel;
use App\Validations\LeadForValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class LeadForController extends Controller
{
    //
    protected $table = 'master_lead_source';

    public function add(Request $request,$id=null)
    {
        try {
            $data["title"] = "Add Lead Source";
            $param = array('limit' => 20 , 'start' => 0);
        $leadfor = LeadForModel::getAllleadfor($param);
        if($leadfor['totalCount'] > 0){
            $data['leadfor'] = $leadfor['results'];
            $data['totalCount'] = $leadfor['totalCount'];
        }else{
            $data['leadfor']  = [];
            $data['totalCount'] = 0;
        }
            if ($id) {
                $decryptedId = crypt::decrypt($id);
                $leadfor = new LeadForModel();
                $data['singleData'] = $leadfor->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
            return view("master.leadfor.index", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $leadfor = new LeadForValidation();
            $validationResult = $leadfor->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }

            $objleadfor = new LeadForModel();
            $returnData = $objleadfor->saveData($request->all());
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
            $objleadfor = LeadForModel::find($id);
    
            if (!$objleadfor) {
                return response()->json(['status' => 'error', 'message' => 'Lead for data not found'], 404);
            }
    
            $objleadfor->status = 1;
            $objleadfor->save();
    
            return redirect()->back()->with('success', 'Lead for deleted successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }
}
