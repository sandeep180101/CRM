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
            $data["leads"] = Leads::select(
                'leads.*',
                'master_lead_status.lead_status_name as lead_status_name',
                'master_lead_source.lead_source_name as lead_source_name'
            )
            ->leftJoin('master_lead_status', 'leads.lead_status_id', '=', 'master_lead_status.id')
            ->leftJoin('master_lead_source', 'leads.lead_source_id', '=', 'master_lead_source.id')
            ->paginate(10);
            $data["lead_status"] = Leadstatus::all();
            $data["lead_source"] = LeadSourceStatus::all();

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
        try {
                $params =array(
                    'name' => $request->leadname,
                    'company_name' => $request->company_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'fdate' => $request->fdate,
                    'tdate' => $request->tdate,
                    'lead_status_id' => $request->leadstatus,
                    'lead_source_id' => $request->lead_source,
                );
            dd($params);
            if (count(array_filter($params)) > 0) {
                $leads = Leads::getLeadDetails($params);
            }
            $data = [];
            if ($leads['total_count'] > 0) {
                $data['leads'] = $leads['results'];
                $data['total_count'] = $leads['total_count'];
                $count = count($leads['results']) ;
                $data['status'] = 'success';
            } else {
                $data['message'] = 'No records found.';
                $data['status'] = 'success';
            }
    
            return response()->json($data);
        } catch(\Exception $e){
            $returnData = ['status' => 'error', 'message' => $e->getMessage()];
            return response()->json($returnData, 500);
        }
    }

}
