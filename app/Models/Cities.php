<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cities extends Model
{
    use HasFactory;
    protected $table = 'master_cities';

    protected $fillable = [
        'id',
        'city_name',
        'state_id',
        'country_id',
        'created_by',
        'status',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function getSaveData()
    {
        return array('id', 'city_name', 'state_id', 'country_id', 'created_by', 'status', 'updated_by', 'created_at', 'updated_at');
    }

    public function saveData($post)
    {
        $saveFields = $this->getSaveData();
        $id = isset($post['id']) ? (int) $post['id'] : 0;
        unset($post['id']);

        $countryStateCityResult = new CommonModel();
        $validationResult = $countryStateCityResult->validateCountryStateCity($post);

        if ($validationResult['status'] === 'error') {
            return $validationResult;
        }
        $data = array_intersect_key($post, array_flip($saveFields));
        $data['updated_at'] = date("Y-m-d H:i:s");

        if ($id == 0) {
            $data['created_by'] = 1;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_by'] = null;

            $city = Cities::create($data);
            return ['id' => $city->id, 'status' => 'success', 'message' => 'City data saved!'];
        } else {
            $city = Cities::find($id);
            if ($city) {
                $data['updated_by'] = 1;
                $city->update($data);
                return ['id' => $id, 'status' => 'success', 'message' => 'City data updated!'];
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

    public static function getAllCity($params = [])
    {

        $query = DB::table('master_cities');
        $query->select('id', 'city_name', 'state_id', 'country_id', DB::raw("CASE WHEN status = 0 THEN 'Active' ELSE 'Inactive' END AS status"));
        if (isset($params['id'])) {
            $id = isset($params['id']) ? $params['id'] : '';
            $query->where('id', $id);
        }

        if (!empty($params['city_name'])) {
            $query->where('city_name', 'like', '%' . $params['city_name'] . '%');
        }
        if (!empty($params['state_id'])) {
            $query->where('state_id', 'like', '%' . $params['city_email'] . '%');
        }
        if (!empty($params['country_id'])) {
            $query->where('country_id', 'like', '%' . $params['city_phone'] . '%');
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
