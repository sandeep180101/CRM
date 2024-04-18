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

    protected $fillable = ['date','name','company_name','email', 'phone', 'address', 'country_id', 'state_id', 'city_id', 'pincode', 'product_details', 'approximate_amount', 'lead_source_id','lead_status_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];



    public function getSaveData()
    {
        return array('date','name','company_name','email', 'phone', 'address', 'country_id', 'state_id', 'city_id', 'pincode', 'product_details', 'approximate_amount', 'lead_source_id','lead_status_id', 'created_by', 'updated_by', 'created_at', 'updated_at');
    }

    public function saveData($post)
    {
        $saveFields = $this->getSaveData();
        $id = isset($post['id']) ? (int) $post['id'] : 0;
        unset($post['id']);

        $userId =session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $data = array_intersect_key($post, array_flip($saveFields));

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
                $data['updated_at'] = date("Y-m-d H:i:s");
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
            'master_lead_source.lead_source_name',
            'created_users.name as created_by_name',
            'updated_users.name as updated_by_name'
        )
        ->leftJoin('master_countries', 'leads.country_id', '=', 'master_countries.id')
        ->leftJoin('master_states', 'leads.state_id', '=', 'master_states.id')
        ->leftJoin('master_cities', 'leads.city_id', '=', 'master_cities.id')
        ->leftJoin('master_lead_status', 'leads.lead_status_id', '=', 'master_lead_status.id')
        ->leftJoin('master_lead_source', 'leads.lead_source_id', '=', 'master_lead_source.id')
        ->leftJoin('users as created_users', 'leads.created_by', '=', 'created_users.id')
        ->leftJoin('users as updated_users', 'leads.updated_by', '=', 'updated_users.id')
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

    public static function getAllLeads($params = [])
    {
        $query = DB::table('leads as l');
        $query->select(
                        "l.id", 
                        'l.date',
                        'l.name',
                        'l.company_name',
                        'l.phone',
                        'l.email',
                        'l.lead_status_id',
                        'l.lead_source_id',
                        DB::raw('date_format(l.created_at,"%d-%m-%Y") as lead_timestamp_created'),
                        DB::raw('date_format(l.updated_at,"%d-%m-%Y") as lead_timestamp_updated'),
                        DB::raw('date_format(l.date,"%d-%m-%Y") as lead_created'),
                        'co.country_name',
                        's.state_name',
                        'c.city_name',
                        'lsource.lead_source_name',
                        'lstatus.lead_status_name',
                        'l.created_by',
                        'l.updated_by',
                    );
        $query->leftJoin('master_countries as co', 'l.country_id', '=', 'co.id');
        $query->leftJoin('master_states as s', 'l.state_id', '=', 's.id');
        $query->leftJoin('master_cities as c', 'l.city_id', '=', 'c.id');
        $query->leftJoin('master_lead_status as lstatus', 'l.lead_status_id', '=', 'lstatus.id');
        $query->leftJoin('master_lead_source as lsource', 'l.lead_source_id', '=', 'lsource.id');
        $query->leftJoin('users as created_by_user', 'l.created_by', '=', 'created_by_user.id')
        ->leftJoin('users as updated_by_user', 'l.updated_by', '=', 'updated_by_user.id');
        if (!empty($params['name'])) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }
        if (!empty($params['phone'])) {
            $query->where('phone', 'like', '%' . $params['phone'] . '%');
        }
        if (!empty($params['email'])) {
            $query->where('email', 'like', '%' . $params['email'] . '%');
        }
        if (!empty($params['company_name'])) {
            $query->where('company_name', 'like', '%' . $params['company_name'] . '%');
        }
        if (!empty($params['fdate'])) {
            $query->where('date', '>=', $params['fdate']);
            if (empty($params['tdate'])) {
                $query->where('date', '<=', now()->toDateString());
            } else {
                $query->where('date', '<=', $params['tdate']);
            }
        }
        if (!empty($params['lead_status_id'])) {
            $query->where('lead_status_id', 'like', '%' . $params['lead_status_id'] . '%');
        }
        if (!empty($params['lead_source_id'])) {
            $query->where('lead_source_id', 'like', '%' . $params['lead_source_id'] . '%');
        }

        if (!empty($params['city_id'])) {
            $query->where('c.city_id', $params['city_id']);
        }

        if (!empty($params['state_id'])) {
            $query->where('s.state_id', $params['state_id']);
        }
        if (!empty($params['country_id'])) {
            $query->where('co.country_id', $params['country_id']);
        }
        if (!empty($params['lead_status_name'])) {
            $query->where('lstatus.lead_status_name', $params['lead_status_name']);
        }
        if (!empty($params['lead_source_name'])) {
            $query->where('lsource.lead_source_name', $params['lead_source_name']);
        }
        $totalCount = $query->count();
    
        if (isset($params['start']) && isset($params['limit']) && !empty($params['limit'])) {
            $query->offset($params['start'])->limit($params['limit']);
        }
                
        $query->orderBy('id', 'ASC');
        $results = $query->get();
    
        return ['results' => $results, 'total_count' => $totalCount];
    }

}