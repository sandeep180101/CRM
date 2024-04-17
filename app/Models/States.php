<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class States extends Model
{
    use HasFactory;
    protected $table = 'master_states';

    protected $fillable = [
        'id',
        'state_name',
        'country_id',
        'created_by',
        'status',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function getSaveData()
    {
        return array('id', 'state_name', 'country_id', 'created_by', 'status', 'updated_by', 'created_at', 'updated_at');
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

            $state = States::create($data);
            return ['id' => $state->id, 'status' => 'success', 'message' => 'State data saved!'];
        } else {
            $state = States::find($id);
            if ($state) {
                $data['updated_by'] = 1;
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

    public static function getAllStates($params = [])
    {

        $query = DB::table('master_states');
        $query->select('id', 'state_name', 'country_id', DB::raw("CASE WHEN status = 0 THEN 'Active' ELSE 'Inactive' END AS status"));
        if (isset($params['id'])) {
            $id = isset($params['id']) ? $params['id'] : '';
            $query->where('id', $id);
        }

        if (!empty($params['state_name'])) {
            $query->where('state_name', 'like', '%' . $params['state_name'] . '%');
        }
        if (!empty($params['country_id'])) {
            $query->where('country_id', 'like', '%' . $params['country_id'] . '%');
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
