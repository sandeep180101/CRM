<?php

namespace App\Http\Controllers;

use App\Models\BusinessModel;
use App\Models\CityModel;
use App\Models\Countries;
use App\Models\IndustryModel;
use App\Models\PartyModel;
use App\Models\StatesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Validations\PartyValidation;



class PartyController extends Controller
{
    //
    protected $table = 'leads';

    public function index()
    {
        try {
            $data['title'] = "Leads Detail";
            $param = array('start' => 0);
            return view("party.index", $data);
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

            return view("party.partyview", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function add(Request $request, $id = null)
    {
        try {
            $data["title"] = "Add Party";
            $param = array('start' => 0);
            $data["cities"] = CityModel::getAllCityModel();
            $data["countries"] = Countries::getAllCountry();
            $data["states"] = StatesModel::getAllStates();
            $data['industries'] = IndustryModel::getAllIndustry( $param );
            $data['businesses'] = BusinessModel::getAllBusiness( $param );
            if ($id) {
                $decryptedId = Crypt::decrypt($id);
                $party = new PartyModel();
                $data['singleData'] = $party->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
            return view("party.add", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function save(Request $request)
    {
        try {
            $returnData = [];

            $leads = new PartyValidation();
            $validationResult = $leads->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }
            $objleads = new PartyModel();
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

            if ($leads['totalCount'] > 0) {
                $param = array('start' => 0);
                $leadSources = LeadSourceStatus::getAllLeadSource($param);
                $leadStatus = Leadstatus::getAllLeadStatus($param);
                $data['leads'] = $leads['results'];
                $data['totalCount'] = $leads['totalCount'];
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
