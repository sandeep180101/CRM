<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CityModel extends Model
{
    use HasFactory;
    protected $table = 'master_cities';

    protected $fillable = [
        'id',
        'city_name',
        'state_id',
        'country_id',
        'created_by_id',
        'status',
        'updated_by_id',
        'created_at',
        'updated_at'
    ];

    public function getSaveData()
    {
        return array('id', 'city_name', 'state_id', 'country_id', 'created_by_id', 'status', 'updated_by_id', 'created_at', 'updated_at');
    }

    public function saveData($post)
    {
        $saveFields = $this->getSaveData();
        $id = isset($post['id']) ? (int) $post['id'] : 0;
        unset($post['id']);
        $userId = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

        $data = array_intersect_key($post, array_flip($saveFields));

        if ($id == 0) {
            $data['created_by_id'] = 1;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_by_id'] = null;
            $data['updated_at'] = null;
            $city = CityModel::create($data);
            return ['id' => $city->id, 'status' => 'success', 'message' => 'City data saved!'];
        } else {
            $city = CityModel::find($id);
            if ($city) {
                $data['updated_at'] = date('Y-m-d H:i:s');
                $data['updated_by_id'] = $userId;
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

    public static function getAllCityModel($params = []){
        $query = DB::table('master_cities as c');
          $query->leftjoin('master_states as s','c.state_id','=','s.id');
          $query->leftJoin('master_countries as co', 's.country_id', '=', 'co.id');
          
          $query->select("c.id", "s.state_name","c.city_name","co.country_name", DB::raw("CASE WHEN c.status = 0 THEN 'Active' ELSE 'Inactive' END AS status"));
          
          if(isset($params['state_id'])){
              $state_id = isset($params['state_id']) ? $params['state_id'] : '';
              if($state_id){
                  $query->where('c.state_id',$state_id);
              }
          }
          if(isset($params['country_id'])){
            $country_id = isset($params['country_id']) ? $params['country_id'] : '';
            if($country_id){
                $query->where('c.country_id',$country_id);
            }
        }
          if(isset($params['id'])){
              $id = isset($params['id']) ? $params['id'] : '';
              if($id){
                  $query->where('c.id',$id);
              }
          }
          if(isset($params['state_id'])){
              $state_id = isset($params['state_id']) ? $params['state_id'] : '';
              if($state_id){
                  $query->where('c.state_id',$state_id);
              }
          }
          if(isset($params['city_id'])){
              $city_id = isset($params['city_id']) ? $params['city_id'] : '';
              if($city_id){
                  $query->where('c.id',$city_id);
              }
          }
         if (isset($params['status']) && in_array($params['status'], [0, 1])) {
              $query->where('c.status', $params['status']);
          }
            $totalCount = $query->count();
            if (isset($params['start']) && isset($params['limit']) && !empty($params['limit'])) {
                $query->offset($params['start'])->limit($params['limit']);
            }
          $query->orderBy('city_name', 'ASC');
          
          $results = $query->get();
          if ($totalCount) {
            return ['results' => $results, 'totalCount' => $totalCount];
        } else {
            return ['results' => '', 'totalCount' => 0];
        }
      }

}
