<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LeadForModel extends Model
{
    use HasFactory;

    protected $table = 'master_lead_for';

    protected $fillable = ['id', 'lead_for_name', 'status', 'created_by_id', 'updated_by_id', 'created_at', 'updated_at'];


    public function getSaveData()
    {
        return array('id', 'lead_for_name', 'created_by_id', 'status', 'updated_by_id', 'created_at', 'updated_at');
    }

    public function saveData($post)
    {
        $saveFields = $this->getSaveData();
        $id = isset($post['id']) ? (int) $post['id'] : 0;
        unset($post['id']);

        $userId = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $data = array_intersect_key($post, array_flip($saveFields));

        if ($id == 0) {
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['created_by_id'] = 1;
            $data['updated_by_id'] = null;

            $leadfor = LeadForModel::create($data);
            return ['id' => $leadfor->id, 'status' => 'success', 'message' => 'Lead for data saved!'];
        } else {
            $leadfor = LeadForModel::find($id);
            if ($leadfor) {
                $data['updated_at'] = date('Y-m-d H:i:s');
                $data['updated_by_id'] = $userId;
                $leadfor->update($data);
                return ['id' => $leadfor->id, 'status' => 'success', 'message' => 'Lead for data updated'];
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
    public static function getAllLeadFor($params = []){
        $query = DB::table('master_lead_for as c');          
          $query->select("c.id", "lead_for_name",DB::raw("CASE WHEN status = 0 THEN 'Active' ELSE 'Inactive' END AS status"));
          
        
          if (!empty($params['lead_for_name'])) {
            $query->where('lead_for_name', 'like', '%' . $params['lead_for_name'] . '%');
        }

        if (isset($params['status']) && in_array($params['status'], [0, 1])) {
            $query->where('status', $params['status']);
        }

          $totalCount = $query->count();
          $query->orderBy('lead_for_name', 'ASC');
          
          $results = $query->get();
          if ($totalCount) {
              return ['results' => $results, 'totalCount' => $totalCount];
          } else {
              return ['results' => '', 'totalCount' => 0];
          }
      }
}
