<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class LeadNote extends Model
{
    use HasFactory;

    protected $table = 'lead_note';

    protected $fillable = ['lead_id','user_id','notes', 'status', 'created_by_id', 'updated_by_id', 'created_at', 'updated_at'];



    public function getSaveData()
    {
        return array('lead_id','user_id','notes', 'status', 'created_by_id', 'updated_by_id', 'created_at', 'updated_at');
    }

    public function saveData($post)
    {
        $saveFields = $this->getSaveData();
        unset($post['id']);

        $userId =session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

        $data = array_intersect_key($post, array_flip($saveFields));
        $data['updated_at'] = date("Y-m-d H:i:s");
            $data['user_id'] = $userId;
            $data['created_by_id'] = $userId;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_by_id'] = null;
            $leadnote = LeadNote::create($data);
            return ['id' => $leadnote->id, 'encryptid' => Crypt::encrypt($leadnote->id), 'status' => 'success', 'message' => 'leadnote data saved!'];

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

    public static function getLeadNote($params = [])
    {
        $query = DB::table('lead_note as ln');
        $query->select("ln.id","ln.lead_id",'ln.status', 'ln.user_id','u.name',"ln.created_at", "notes");
        $query->join('leads as l','ln.lead_id','=','l.id');
        $query->join('users as u','ln.user_id','=','u.id');
        if (isset($params['ln.id'])) {
            $id = isset($params['ln.id']) ? $params['ln.id'] : '';
            $query->where('ln.id', $id);
        }

        if (!empty($params['lead_id'])) {
            $query->where('ln.lead_id', 'like', '%' . $params['lead_id'] . '%');
        }
        if (!empty($params['user_id'])) {
            $query->where('u.user_id', 'like', '%' . $params['user_id'] . '%');
        }

        if (isset($params['status']) && in_array($params['status'], [0, 1])) {
            $query->where('ln.status', $params['status']);
        }

        $totalCount = $query->count();
        if (isset($params['start']) && isset($params['limit']) && !empty($params['limit'])) {
            $query->offset($params['start'])->limit($params['limit']);
        }

        $query->orderBy('company_name', 'ASC');
        // $lastQuery = $query->toSql();
        // echo $lastQuery; exit;
        $results = $query->get();
        if ($totalCount) {
            return ['results' => $results, 'total_count' => $totalCount];
        } else {
            return ['results' => '', 'total_count' => 0];
        }

    }
}
