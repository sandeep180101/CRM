<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\CommonModel;
use App\Models\Countries;
use App\Models\LeadNote;
use App\Models\Leads;
use App\Models\LeadSourceStatus;
use App\Models\Leadstatus;
use App\Models\States;
use App\Validations\LeadsValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    //
    protected $table = 'leads';

    public function index()
    {
        try {
            $data['title'] = "Leads Detail";
            $data["leads"] = Leads::all();
            $data["lead_status"] = Leadstatus::all();
            return view("lead.index", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function view($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $data["title"] = "Lead View";
            $data["leadnotes"] = LeadNote::all();
            $data["leads"] = (new Leads())->join($decryptedId);

            return view("lead.leadview", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function add(Request $request, $id = null)
    {
        try {
                $data["title"] = "Add Lead";
                $data["cities"] = Cities::all();
                $data["countries"] = Countries::all();
                $data["states"] = States::all();
                $data["leadstatus"] = Leadstatus::all();
                $data["leadsourcestatus"] = LeadSourceStatus::all();
                if ($id) {
                    $decryptedId = Crypt::decrypt($id);
                    $leads = new Leads();
                    $data['singleData'] = $leads->getSingleData($decryptedId);
                } else {
                    $data['singleData'] = '';
                }
                return view("lead.add", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $leads = new LeadsValidation();
            $validationResult = $leads->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }
            $objleads = new Leads();
            $returnData = $objleads->saveData($request->all());
            if (count($returnData) <= 0) {
                $returnData = ['status' => 'error', 'message' => 'Error in data insertion'];
            }

            return json_encode($returnData);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function destroy(Request $request, $id)
    {
        try {
            if ($id) {
                DB::table('leads')->where('id', $id)->delete();
            }
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    function leadFilter(Request $request){
        try{
            $limit = $request->limit ? $request->limit : 10;
            $start = $request->start ? $request->start : 0;
            $param = array('name' => $request->name,'company_name' => $request->company_name,'email' => $request->email,'phone' => $request->phone,'id'=>$request->id,'lead_status'=>$request->lead_status,'limit' => $limit , 'start' => $start);
            $leads = Leads::getLeadDetails($param);
            if($leads['total_count'] > 0){
                $data['leads'] = $leads['results'];
                $data['total_count'] = $leads['total_count'];
                $count = count($leads['results'])+ $request->start;
                $data['message'] = "Showing ".++$request->start." to ". $count ." of ".$leads['total_count']." records.";
                $data['status'] = 'success';
            }
            return json_encode($data);
        } catch(\Exception $e){
            $returnData = $e;
            return json_encode($returnData);exit; 
        }
    }
}
