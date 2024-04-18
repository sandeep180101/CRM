<?php

namespace App\Http\Controllers;

use App\Models\Cities;
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
            $param = array('start' => 0, 'limit' => 10 , 'group_by' => 'group_by');
            $data["leads"] = Leads::getAllLeads($param);
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

    public static function leadFilter(Request $request)
{
    try {
        $params = array(
            'name' => $request->name,
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'fdate' => $request->fdate,
            'tdate' => $request->tdate,
            'lead_status_id' => ($request->lead_status_id == 'Choose...') ? null : $request->lead_status_id,
            'lead_source_id' => ($request->lead_source_id == 'Choose...') ? null : $request->lead_source_id,
        );

        if (count(array_filter($params)) > 0) {
            $leads = Leads::getLeadDetails($params);
        }

        $data = [];

        if ($leads['total_count'] > 0) {
            $leadSources = LeadSourceStatus::pluck('lead_source_name', 'id');
            $leadStatus = Leadstatus::pluck('lead_status_name', 'id');
            $data['leads'] = $leads['results'];
            foreach ($data['leads'] as &$lead) {
                if ($lead->lead_source_id !== null && isset($leadSources[$lead->lead_source_id])) {
                    $lead->lead_source_name = $leadSources[$lead->lead_source_id];
                } else {
                    $lead->lead_source_name = null;
                }
            
                if ($lead->lead_status_id !== null && isset($leadStatus[$lead->lead_status_id])) {
                    $lead->lead_status_name = $leadStatus[$lead->lead_status_id];
                } else {
                    $lead->lead_status_name = null;
                }
            }
            
            $data['total_count'] = $leads['total_count'];
            $count = count($leads['results']);
            $data['status'] = 'success';
        } else {
            $data['message'] = 'No records found.';
            $data['status'] = 'success';
        }

        return response()->json($data);
    } catch (\Exception $e) {
        $returnData = ['status' => 'error', 'message' => $e->getMessage()];
        return response()->json($returnData, 500);
    }
}


}
