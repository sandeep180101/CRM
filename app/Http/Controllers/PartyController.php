<?php

namespace App\Http\Controllers;

use App\Models\BusinessModel;
use App\Models\CityModel;
use App\Models\CommonModel;
use App\Models\Countries;
use App\Models\IndustryModel;
use App\Models\Leads;
use App\Models\LeadSourceStatus;
use App\Models\Leadstatus;
use App\Models\PartyModel;
use App\Models\StatesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Validations\PartyValidation;



class PartyController extends Controller
{
    protected $table = 'party';

    public function index()
    {
        try {
            $data['title'] = "Party Detail";
            $param = array('start' => 0);
            $data["parties"] = PartyModel::getAllparty($param);
            // dd($data);
            // dd($lead_source);
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
            $data["title"] = "Party View";
            // $data["leadnotes"] = LeadNote::getLeadNote($param);
            $parties = PartyModel::getAllparty($param);
            $data["parties"] = $parties['results'];

            return view("party.partyview", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function add(Request $request, $id = null)
    {
        try {
            $data["title"] = "Add Party";
            $data["cities"] = CityModel::getAllCityModel();
            $data["countries"] = Countries::getAllCountry();
            $data["states"] = StatesModel::getAllStates();
            $data["industries"] = IndustryModel::getAllIndustry();
            $data["businesses"] = BusinessModel::getAllBusiness();
            if ($id) {
                $decryptedId = Crypt::decrypt($id);
                $parties = new PartyModel();
                $data['singleData'] = $parties->getSingleData($decryptedId);
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
            $objCommon = new CommonModel;
        $uniqueFieldValue = array(
            'name' => $request->name,
            'code'=> $request->code,
        );
        $uniqueCount = $objCommon->checkMultiUnique($this->table, $uniqueFieldValue, $request['id']);       
        if ($uniqueCount > 0) {
            $returnData = array('status' => 'exist', 'message' => 'Party name and code already exists!', 'unique_field' => $uniqueFieldValue);
            return json_encode($returnData);
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

    public static function PartyFilter(Request $request)
    {
        try {
            $limit = $request->limit ? $request->limit : 10;
            $start = $request->start ? $request->start : 0;
            $params = array(
                'name' => $request->name,
                'code' => $request->code,
                'phone' => $request->phone,
                'email' => $request->email,
                'status' => $request->status,
                'start' => $start,
                'limit' => $limit,
            );

            if (count(array_filter($params)) > 0) {
                $parties = PartyModel::getAllparty($params);
            }
            $data = [];

            if ($parties['totalCount'] > 0) {
                $param = array('start' => 0);
                $data['parties'] = $parties['results'];
                $data['totalCount'] = $parties['totalCount'];
                $count = count($parties['results']);
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
