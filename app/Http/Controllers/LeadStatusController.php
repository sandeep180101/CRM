<?php

namespace App\Http\Controllers;

use App\Models\Leadstatus;
use App\Validations\LeadStatusValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class LeadStatusController extends Controller
{
    //
    protected $table = 'master_lead_status';

    public function add(Request $request,$id=null)
    {
        try {
            $data["title"] = "Add lead Status";
            $param = array('limit' => 10 , 'start' => 0);
        $leadstatus = Leadstatus::getAllLeadStatus($param);
        if($leadstatus['totalCount'] > 0){
            $data['leadstatus'] = $leadstatus['results'];
            $data['totalCount'] = $leadstatus['totalCount'];
        }else{
            $data['leadstatus']  = [];
            $data['totalCount'] = 0;
        }
            if ($id) {
                $decryptedId = Crypt::decrypt($id);
                $leadstatus = new Leadstatus();
                $data['singleData'] = $leadstatus->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
            return view("master.leadstatus.index", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $leadstatus = new LeadStatusValidation();
            $validationResult = $leadstatus->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }

            $objleadstatus = new Leadstatus();
            $returnData = $objleadstatus->saveData($request->all());
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
            $objleadstatus = Leadstatus::find($id);
    
            if (!$objleadstatus) {
                return response()->json(['status' => 'error', 'message' => 'Lead status data not found'], 404);
            }
    
            $objleadstatus->status = 1;
            $objleadstatus->save();
    
            return redirect()->back()->with('success', 'Lead status deleted successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }
}
