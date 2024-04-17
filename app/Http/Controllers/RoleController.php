<?php

namespace App\Http\Controllers;

use App\Models\CommonModel;
use App\Models\roles;
use App\Models\role;
use App\Validations\rolesValidation;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    protected $table = 'master_roles';

    public function index()
    {
        try {
            $data['title'] = 'Role';
            $param = array();
            $param = array('limit' => 10, 'start' => 0);
            $roles = role::getAllRoles($param);
            if ($roles['total_count'] > 0) {
                $data['roles'] = $roles['results'];
                $data['total_count'] = $roles['total_count'];
            } else {
                $data['roles'] = '';
                $data['total_count'] = 0;
            }
            return view('master.roles.index', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function add(Request $request, $id = null)
    {
        try {
            if ($id) {
                $objroles = new role();
                $data['singleData'] = $objroles->getSingleData($id);
            } else {
                $data['singleData'] = '';
            }
            $data['title'] = 'contact Add';
            return view('master.roles.add', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $roles = new rolesValidation();
            $validationResult = $roles->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }

            $objCommon = new CommonModel;
            $uniqueFieldValue = array(
                'role_name' => $request->role_name,
            );

            $uniqueCount = $objCommon->checkMultiUnique($this->table, $uniqueFieldValue, $request['id']);
            if ($uniqueCount > 0) {
                $returnData = array('status' => 'exist', 'message' => 'This role already exists!', 'unique_field' => $uniqueFieldValue);
                return json_encode($returnData);
            }
            $objroles = new role();
            $returnData = $objroles->saveData($request->all());
            if (count($returnData) <= 0) {
                $returnData = ['status' => 'error', 'message' => 'Error in data insertion'];
            }

            return json_encode($returnData);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
