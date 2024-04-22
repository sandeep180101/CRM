<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Leadstatus extends Model
{
    use HasFactory;
    protected $table = 'master_lead_status';

    protected $fillable = [
        'id', 'lead_status_name','created_by_id','status','updated_by_id','created_at', 'updated_at'
    ];

    public function getSaveData() {
        return array('id', 'lead_status_name','created_by_id','status','updated_by_id','created_at', 'updated_at');
    }

    public function saveData($post) {
        $saveFields = $this->getSaveData();
        $id = isset($post['id']) ? (int) $post['id'] :0;
        unset($post['id']);

        $userId = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $data = array_intersect_key($post, array_flip($saveFields));

        if($id == 0){
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['created_by_id'] = 1;
            $data['updated_by_id'] = null;
            $data['updated_at'] = null;

            $leadstatus = Leadstatus::create($data);
            return ['id' => $leadstatus->id, 'status' => 'success', 'message' => 'Lead status data saved!'];
        }
        else{
            $leadstatus = Leadstatus::find($id);
            if($leadstatus){
                $data['updated_at'] = date('Y-m-d H:i:s');
                $data['updated_by_id'] = $userId;
                $leadstatus->update($data);
                return ['id'=> $leadstatus->id,'status'=> 'success','message'=> 'Lead status data updated'];
            }
            else{
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
    public static function getAllLeadStatus($params = []){
        $query = DB::table('master_lead_status as c');          
          $query->select("c.id", "lead_status_name",DB::raw("CASE WHEN status = 0 THEN 'Active' ELSE 'Inactive' END AS status"));

          if (!empty($params['lead_status_name'])) {
            $query->where('lead_status_name', 'like', '%' . $params['lead_status_name'] . '%');
        }

        if (isset($params['status']) && in_array($params['status'], [0, 1])) {
            $query->where('status', $params['status']);
        }

          $totalCount = $query->count();
          $query->orderBy('lead_status_name', 'ASC');
          
          $results = $query->get();
          if ($totalCount) {
              return ['results' => $results, 'totalCount' => $totalCount];
          } else {
              return ['results' => '', 'totalCount' => 0];
          }
      }


}
