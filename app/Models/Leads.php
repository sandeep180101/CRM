<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class Leads extends Model
{
    use HasFactory;

    protected $table = 'leads';

    protected $fillable = ['date','name','email', 'phone', 'address', 'country_id', 'state_id', 'city_id', 'pincode', 'product_details', 'approximate_amount', 'lead_source_id','lead_status_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];



    public function getSaveData()
    {
        return array('date','name','email', 'phone', 'address', 'country_id', 'state_id', 'city_id', 'pincode', 'product_details', 'approximate_amount', 'lead_source_id','lead_status_id', 'created_by', 'updated_by', 'created_at', 'updated_at');
    }

    public function saveData($post)
    {
        $saveFields = $this->getSaveData();
        $id = isset($post['id']) ? (int) $post['id'] : 0;
        unset($post['id']);
        $userId =session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $data = array_intersect_key($post, array_flip($saveFields));
        $data['updated_at'] = date("Y-m-d H:i:s");

        if ($id == 0) {
            $data['created_by'] = $userId;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_by'] = null;

            $lead = Leads::create($data);
            return ['id' => $lead->id, 'encryptid' => Crypt::encrypt($lead->id), 'status' => 'success', 'message' => 'lead data saved!'];
        } else {
            $lead = Leads::find($id);
            if ($lead) {
                $data['updated_by'] = $userId;
                $lead->update($data);
                return ['id' => $lead->id, 'encryptid' => Crypt::encrypt($lead->id), 'status' => 'success', 'message' => 'lead data updated!'];
            } else {
                return false;
            }
        }
    }

    public function join($id){
        $lead = Leads::select(
            'leads.*',
            'master_countries.country_name',
            'master_states.state_name',
            'master_cities.city_name',
            'master_lead_status.lead_status_name',
            'master_lead_source.lead_source_name'
        )
        ->leftJoin('master_countries', 'leads.country_id', '=', 'master_countries.id')
        ->leftJoin('master_states', 'leads.state_id', '=', 'master_states.id')
        ->leftJoin('master_cities', 'leads.city_id', '=', 'master_cities.id')
        ->leftJoin('master_lead_status', 'leads.lead_status_id', '=', 'master_lead_status.id')
        ->leftJoin('master_lead_source', 'leads.lead_source_id', '=', 'master_lead_source.id')
        ->where('leads.id', $id)
        ->first();
    
        return $lead;
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

    public static function getLeadDetails($params = [])
    {
        $query = DB::table('leads');
        $query->select("id", 'name', "company_name", 'phone', 'email', 'lead_status');
        if (isset($params['id'])) {
            $id = isset($params['id']) ? $params['id'] : '';
            $query->where('id', $id);
        }

        if (!empty($params['company_name'])) {
            $query->where('company_name', 'like', '%' . $params['company_name'] . '%');
        }
        if (!empty($params['phone'])) {
            $query->where('phone', 'like', '%' . $params['phone'] . '%');
        }

        if (!empty($params['email'])) {
            $query->where('email', 'like', '%' . $params['email'] . '%');
        }
        if (!empty($params['lead_status'])) {
            $query->where('lead_status', 'like', '%' . $params['lead_status'] . '%');
        }


        if (isset($params['status']) && in_array($params['status'], [0, 1])) {
            $query->where('c.status', $params['status']);
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