<?php

namespace App\Http\Controllers;

use App\Models\CityModel;
use App\Models\Countries;
use App\Models\LeadNote;
use App\Models\Leads;
use App\Models\LeadSourceStatus;
use App\Models\Leadstatus;
use App\Models\StatesModel;
use App\Validations\LeadsValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LeadController extends Controller
{
    //
    protected $table = 'leads';

    public function index()
    {
        try {
            $data['title'] = "Leads Detail";
            $param = array('start' => 0);
            $data["lead_source"] = LeadSourceStatus::getAllLeadSource($param);
            $param = array('start' => 0, 'limit' => 10);
            $data["leads"] = Leads::getAllLeads($param);
            $data["lead_status"] = Leadstatus::getAllLeadStatus($param);
            return view("lead.index", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function view($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $param = array('id' => $decryptedId);
            $data["title"] = "Lead View";
            $data["leadnotes"] = LeadNote::getLeadNote($param);
            $leads = Leads::getAllLeads($param);
            $data["leads"] = $leads['results'];

            return view("lead.leadview", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function add(Request $request, $id = null)
    {
        try {
            $data["title"] = "Add Lead";
            $data["cities"] = CityModel::getAllCityModel();
            $data["countries"] = Countries::getAllCountry();
            $data["states"] = StatesModel::getAllStates();

            $data["leadstatus"] = Leadstatus::getAllLeadStatus();
            $data["leadsourcestatus"] = LeadSourceStatus::getAllLeadSource();
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

    public static function leadFilter(Request $request)
    {
        try {
            $limit = $request->limit ? $request->limit : 10;
            $start = $request->start ? $request->start : 0;
            $params = array(
                'name' => $request->name,
                'company_name' => $request->company_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'fdate' => $request->fdate,
                'tdate' => $request->tdate,
                'lead_status_id' => $request->lead_status_id,
                'lead_source_id' => $request->lead_source_id,
                'start' => $start,
                'limit' => $limit,
            );

            if (count(array_filter($params)) > 0) {
                $leads = Leads::getAllLeads($params);
            }
            $data = [];

            if ($leads['total_count'] > 0) {
                $param = array('start' => 0);
                $leadSources = LeadSourceStatus::getAllLeadSource($param);
                $leadStatus = Leadstatus::getAllLeadStatus($param);
                $data['leads'] = $leads['results'];
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
