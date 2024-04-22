<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StatesModel extends Model
{
    use HasFactory;
    protected $table = 'master_states';

    protected $fillable = [
        'id',
        'state_name',
        'country_id',
        'created_by_id',
        'status',
        'updated_by_id',
        'created_at',
        'updated_at'
    ];

    public function getSaveData()
    {
        return array('id', 'state_name', 'country_id', 'created_by_id', 'status', 'updated_by_id', 'created_at', 'updated_at');
    }

    public function saveData($post)
    {
        $saveFields = $this->getSaveData();
        $id = isset($post['id']) ? (int) $post['id'] : 0;
        unset($post['id']);

        $data = array_intersect_key($post, array_flip($saveFields));
        $userId = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

        if ($id == 0) {
            $data['created_by_id'] = 1;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_by_id'] = null;

            $state = StatesModel::create($data);
            return ['id' => $state->id, 'status' => 'success', 'message' => 'State data saved!'];
        } else {
            $state = StatesModel::find($id);
            if ($state) {
                $data['updated_at'] = date('Y-m-d H:i:s');
                $data['updated_by_id'] = $userId;
                $state->update($data);
                return ['id' => $id, 'status' => 'success', 'message' => 'State data updated!'];
            } else {
                return false;
            }
        }
    }
    public function getSingleData($id)
    {
        $id = (int) $id;
        $result = DB::select("SELECT * FROM " . $this->table . " as c WHERE id=$id");
        foreach ($result as $data) {
            return json_decode(json_encode($data), True);
        }
        return false;
    }

    public static function getAllStates($params=[]){
        $query = DB::table('master_states as s');
        $query->leftjoin('master_countries as co','s.country_id','=','co.id');
        $query->select("s.id", "s.state_name","co.country_name",DB::raw("CASE WHEN s.status = 0 THEN 'Active' ELSE 'Inactive' END AS status"));
        if(isset($params['state_id'])){
            $state_id = isset($param['state_id']) ? $params['state_id'] : '';
            if($state_id){
                $query->where('s.id',$state_id);
            }
        }
        if (!empty($params['state_name'])) {
            $query->where('state_name', 'like', '%' . $params['state_name'] . '%');
    }
        if(isset($params['country_id'])){
            $country_id = isset($params['co.country_id']) ? $params['country_id'] : '';
            if($country_id){
                $query->where('co.id',$country_id);
            }
        }
        if (isset($params['status']) && in_array($params['status'], [0, 1])) {
            $query->where('s.status', $params['status']);
        }
        $totalCount = $query->count();
        if (isset($params['start']) && isset($params['limit']) && !empty($params['limit'])) {
            $query->offset($params['start'])->limit($params['limit']);
        }   
        $query->orderBy('s.state_name', 'ASC');
    //    $lastQuery = $query->toSql();
    //     echo $lastQuery; exit;
        $results = $query->get();
        if ($totalCount) {
            return ['results' => $results, 'totalCount' => $totalCount];
        } else {
            return ['results' => '', 'totalCount' => 0];
        }

    }

}
