<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
use App\Models\contacts;
use App\Validations\contactsValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    //
    protected $table = 'contacts';

    public function index()
    {
        try {
            $data['title'] = 'Contact';
            $param = array();
            $param = array('limit' => 10, 'start' => 0);
            $contacts = contacts::getAllContacts($param);
            if ($contacts['total_count'] > 0) {
                $data['contacts'] = $contacts['results'];
                $data['total_count'] = $contacts['total_count'];
            } else {
                $data['contacts'] = '';
                $data['total_count'] = 0;
            }
            return view('contacts.index', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function add(Request $request, $id = null)
    {
        try {
            if ($id) {
                $objcontacts = new contacts();
                $data['singleData'] = $objcontacts->getSingleData($id);
            } else {
                $data['singleData'] = '';
            }
            $data['title'] = 'contact Add';
            return view('contacts.add', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $contacts = new contactsValidation();
            $validationResult = $contacts->validate($request->all());

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
            $objcontacts = new contacts();
            $returnData = $objcontacts->saveData($request->all());
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
                DB::table('contacts')->where('id', $id)->delete();
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

            $contacts = contacts::getAllContacts($params);

            if ($contacts['total_count'] > 0) {
                $data['contacts'] = $contacts['results'];
                $data['total_count'] = $contacts['total_count'];
                $count = count($contacts['results']) + $start;
                $data['message'] = "Showing " . (++$request->start) . " to " . $count . " of " . $contacts['total_count'] . " records.";
                $data['status'] = 'success';
            } else {
                $data['contacts'] = [];
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

