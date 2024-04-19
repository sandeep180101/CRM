<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
use App\Models\contactsModel;
use App\Validations\contactsModelValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    //
    protected $table = 'contactsModel';

    public function index()
    {
        try {
            $data['title'] = 'Contact';
            $param = array();
            $param = array('limit' => 10, 'start' => 0);
            $contactsModel = contactsModel::getAllContacts($param);
            if ($contactsModel['total_count'] > 0) {
                $data['contactsModel'] = $contactsModel['results'];
                $data['total_count'] = $contactsModel['total_count'];
            } else {
                $data['contactsModel'] = '';
                $data['total_count'] = 0;
            }
            return view('contactsModel.index', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function add(Request $request, $id = null)
    {
        try {
            if ($id) {
                $objcontactsModel = new contactsModel();
                $data['singleData'] = $objcontactsModel->getSingleData($id);
            } else {
                $data['singleData'] = '';
            }
            $data['title'] = 'contact Add';
            return view('contactsModel.add', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $contactsModel = new contactsModelValidation();
            $validationResult = $contactsModel->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }

            $objCommon = new CommonModel;
            $uniqueFieldValue = array(
                'contact_email' => $request->contact_email,
            );

            $uniqueCount = $objCommon->checkMultiUnique($this->table, $uniqueFieldValue, $request['id']);
            if ($uniqueCount > 0) {
                $returnData = array('status' => 'exist', 'message' => 'Contact already exists!', 'unique_field' => $uniqueFieldValue);
                return json_encode($returnData);
            }
            $objcontactsModel = new contactsModel();
            $returnData = $objcontactsModel->saveData($request->all());
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
                DB::table('contactsModel')->where('id', $id)->delete();
            }
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function contactFilter(Request $request)
    {
        try {
            $limit = $request->limit ? $request->limit : 10;
            $start = $request->start ? $request->start : 0;

            $params = [
                'contact_name' => $request->contact_name,
                'contact_email' => $request->contact_email,
                'contact_phone' => $request->contact_phone,
                'status' => $request->status,
                'limit' => $limit,
                'start' => $start
            ];

            $contactsModel = contactsModel::getAllContacts($params);

            if ($contactsModel['total_count'] > 0) {
                $data['contactsModel'] = $contactsModel['results'];
                $data['total_count'] = $contactsModel['total_count'];
                $count = count($contactsModel['results']) + $start;
                $data['message'] = "Showing " . (++$request->start) . " to " . $count . " of " . $contactsModel['total_count'] . " records.";
                $data['status'] = 'success';
            } else {
                $data['contactsModel'] = [];
                $data['total_count'] = 0;
                $data['message'] = 'No records found.';
                $data['status'] = 'success';
            }

            return response()->json($data);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], 500);
        }
    }

}

