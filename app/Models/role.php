<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class role extends Model
{
    use HasFactory;
    protected $table = 'master_roles';

    protected $fillable = [
        'id', 'role_name','status','created_at', 'updated_at'
    ];

    public function getSaveData() {
        return array('id', 'role_name','status','created_at', 'updated_at');
    }

    public function saveData($post)
    {
        $saveFields = $this->getSaveData();
        $id = isset($post['id']) ? (int) $post['id'] : 0;
        unset($post['id']);

        $data = array_intersect_key($post, array_flip($saveFields));
        $data['updated_at'] = date("Y-m-d H:i:s");

        if ($id == 0) {
            $data['created_by_id'] = 1;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_by_id'] = null;

            $role = role::create($data);
            return ['id' => $role->id, 'status' => 'success', 'message' => 'Role data saved!'];
        } else {
            $role = role::find($id);
            if ($role) {
                $data['updated_by_id'] = 1;
                $role->update($data);
                return ['id' => $id, 'status' => 'success', 'message' => 'Role data updated!'];
            } else {
                return false;
            }
        }
    }
    public function getSingleData($id) {
        $id = (int) $id;
        $result = DB::select("SELECT * FROM " . $this->table . " as c WHERE id=$id");
        foreach ($result as $data) {
            return json_decode(json_encode($data), True);
        }
        return false;
    }

    public static function getAllRoles($params=[]){

        $query = DB::table('master_roles');
        $query->select("id", "role_name",DB::raw("CASE WHEN status = 0 THEN 'Active' ELSE 'Inactive' END AS status"));
        if(isset($params['id'])){
            $id = isset($params['id']) ? $params['id'] : '';
            $query->where('id',$id);
        }
        
        if (!empty($params['role_name'])) {
                $query->where('role_name', 'like', '%' . $params['role_name'] . '%');
        }
        if (!empty($params['role_name'])) {
            $query->where('role_name' ,$params['role_name'] );
    }
        if (isset($params['status']) && in_array($params['status'], [0, 1])) {
            $query->where('status', $params['status']);
        }
        
        $totalCount = $query->count();
        if (isset($params['start']) && isset($params['limit']) && !empty($params['limit'])) {
            $query->offset($params['start'])->limit($params['limit']);
        }
        
        $query->orderBy('id', 'ASC');
        $results = $query->get();
        if ($totalCount) {
            return ['results' => $results, 'total_count' => $totalCount];
        } else {
            return ['results' => '', 'total_count' => 0];
        }

    }
}
