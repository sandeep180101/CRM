<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
use App\Models\IndustryModel;
use App\Validations\IndustryTypeValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class IndustryTypeController extends Controller
{
    //
    protected $table = 'master_industry_type';

    public function add(Request $request,$id=null)
    {
        try {
            $data["title"] = "Add Industry";
            $param = array('limit' => 10 , 'start' => 0);
        $industries = IndustryModel::getAllIndustry($param);
        if($industries['totalCount'] > 0){
            $data['industries'] = $industries['results'];
            $data['totalCount'] = $industries['totalCount'];
        }else{
            $data['industries']  = [];
            $data['totalCount'] = 0;
        }
            if ($id) {
                $decryptedId = Crypt::decrypt($id);
                $industries = new IndustryModel();
                $data['singleData'] = $industries->getSingleData($decryptedId);
            } else {
                $data['singleData'] = '';
            }
            return view("master.industrytype.index", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $industries = new IndustryTypeValidation();
            $validationResult = $industries->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }
            $objCommon = new CommonModel;
            $uniqueFieldValue = array(
                'industry_name' => $request->industry_name,
            );
            $uniqueCount = $objCommon->checkMultiUnique($this->table, $uniqueFieldValue, $request['id']);       
            if ($uniqueCount > 0) {
                $returnData = array('status' => 'exist', 'message' => 'Industry name already exists!', 'unique_field' => $uniqueFieldValue);
                return json_encode($returnData);
            }
            $objindustries = new IndustryModel();
            $returnData = $objindustries->saveData($request->all());
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
            $objindustries = IndustryModel::find($id);
    
            if (!$objindustries) {
                return response()->json(['status' => 'error', 'message' => 'Industry data not found'], 404);
            }
    
            $objindustries->status = 1;
            $objindustries->save();
    
            return redirect()->back()->with('success', 'Industry deleted successfully');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }
}
