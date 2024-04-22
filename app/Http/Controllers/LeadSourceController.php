<?php

namespace App\Http\Controllers;

use App\Models\LeadSourceStatus;
use App\Validations\LeadSourceValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class LeadSourceController extends Controller
{
    //
    protected $table = 'master_lead_source';

    public function add(Request $request,$id=null)
    {
        try {
            $data["title"] = "Add Lead Source";
            $param = array('limit' => 20 , 'start' => 0);
        $leadsource = LeadSourceStatus::getAllLeadSource($param);
        if($leadsource['totalCount'] > 0){
            $data['leadsource'] = $leadsource['results'];
            $data['totalCount'] = $leadsource['totalCount'];
        }else{
            $data['leadsource']  = [];
            $data['totalCount'] = 0;
        }
            if ($id) {
                $decryptedId = crypt::decrypt($id);
                $leadsource = new LeadSourceStatus();
                $data['singleData'] = $leadsource->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
            return view("master.leadsource.index", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $leadsource = new LeadSourceValidation();
            $validationResult = $leadsource->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }

            $objleadsource = new LeadSourceStatus();
            $returnData = $objleadsource->saveData($request->all());
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
            $objleadsource = LeadSourceStatus::find($id);
    
            if (!$objleadsource) {
                return response()->json(['status' => 'error', 'message' => 'Country data not found'], 404);
            }
    
            $objleadsource->status = 1;
            $objleadsource->save();
    
            return redirect()->back()->with('success', 'Country deleted successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }
}
