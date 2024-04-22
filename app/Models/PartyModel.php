<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PartyModel extends Model
{
    use HasFactory;

    protected $table ="party";

    protected $fillable = ['name', 'party_type', 'code', 'industry_id', 'business_id', 'phone', 'email', 'whatsapp', 'skype', 'GST', 'website', 'address', 'country_id', 'state_id', 'city_id', 'pincode', 'status', 'created_by_id', 'updated_by_id','created_by','updated_by'];

    public function getSaveData()
{
    return array('name', 'party_type', 'code', 'industry_id', 'business_id', 'phone', 'email', 'whatsapp', 'skype', 'GST', 'website', 'address', 'country_id', 'state_id', 'city_id', 'pincode', 'status', 'created_by_id', 'updated_by_id','created_by','updated_by');
}
    
    public function saveData($post)
    {
        $saveFields = $this->getSaveData();
        $id = isset($post['id']) ? (int) $post['id'] : 0;
        unset($post['id']);

        $userId = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $data = array_intersect_key($post, array_flip($saveFields));
        $data['updated_at'] = null;

        if ($id == 0) {
            $data['created_by_id'] = $userId;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_by_id'] = null;
            $data['updated_at'] = null;

            $party = PartyModel::create($data);
            return ['id' => $party->id, 'encryptid' => Crypt::encrypt($party->id), 'status' => 'success', 'message' => 'party data saved!'];
        } else {
            $party = PartyModel::find($id);
            if ($party) {
                $data['updated_by_id'] = $userId;
                $data['updated_at'] = date("Y-m-d H:i:s");
                $party->update($data);
                return ['id' => $party->id, 'encryptid' => Crypt::encrypt($party->id), 'status' => 'success', 'message' => 'party data updated!'];
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

    public static function getAllparty($params = [])
    {
        $query = DB::table('party as p');
        $query->select(
            "p.id",
            'p.name',
            'p.code',
            'p.phone',
            'p.email',
            DB::raw("CASE WHEN p.party_type = 1 THEN 'Customer' ELSE 'Other' END AS party_type"),
            'p.address',
            'p.pincode',
            'p.whatsapp',
            'p.skype',
            'p.gst',
            'p.website',
            DB::raw('date_format(p.created_at,"%d-%m-%Y %H:%i:%s") as party_timestamp_created'),
            DB::raw('date_format(p.updated_at,"%d-%m-%Y %H:%i:%s") as party_timestamp_updated'),
            'co.country_name',
            's.state_name',
            'c.city_name',
            'industry.industry_name',
            'business.business_name',
            DB::raw("CASE WHEN p.status = 0 THEN 'Active' ELSE 'Inactive' END AS status"),
            'p.created_by_id',
            'p.updated_by_id',
            'created_by_id_user.name as uname',
        );
        $query->leftJoin('master_countries as co', 'p.country_id', '=', 'co.id');
        $query->leftJoin('master_states as s', 'p.state_id', '=', 's.id');
        $query->leftJoin('master_cities as c', 'p.city_id', '=', 'c.id');
        $query->leftJoin('master_industry_type as industry', 'p.industry_id', '=', 'industry.id');
        $query->leftJoin('master_business_type as business', 'p.business_id', '=', 'business.id');
        $query->leftJoin('users as created_by_id_user', 'p.created_by_id', '=', 'created_by_id_user.id');


        if (!empty($params['id'])) {
            $query->where('p.id', $params['id']);
        }
        if (!empty($params['name'])) {
            $query->where('p.name', 'like', '%' . $params['name'] . '%');
        }
        if (!empty($params['party_type'])) {
            $query->where('p.party_type', 'like', '%' . $params['party_type'] . '%');
        }
        if (!empty($params['phone'])) {
            $query->where('p.phone', 'like', '%' . $params['phone'] . '%');
        }
        if (!empty($params['email'])) {
            $query->where('p.email', 'like', '%' . $params['email'] . '%');
        }
        if (!empty($params['code'])) {
            $query->where('p.code', 'like', '%' . $params['code'] . '%');
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
        if (!empty($params['business_name'])) {
            $query->where('business.business_name', $params['business_name']);
        }
        if (!empty($params['industry_name'])) {
            $query->where('industry.industry_name', $params['industry_name']);
        }
        $totalCount = $query->count();

        if (isset($params['start']) && isset($params['limit']) && !empty($params['limit'])) {
            $query->offset($params['start'])->limit($params['limit']);
        }

        $query->orderBy('p.id', 'DESC');
        $results = $query->get();

        foreach ($results as $result) {
            $result->encrypted_id = Crypt::encrypt($result->id);
        }

        
    if ($totalCount) {
        return ['results' => $results, 'totalCount' => $totalCount];
    } else {
        return ['results' => '', 'totalCount' => 0];
    }
    }
}
