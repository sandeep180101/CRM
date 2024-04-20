<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Countries extends Model
{
    use HasFactory;
    protected $table = 'master_countries';

    protected $fillable = [
        'id', 'country_name','created_by_id','status','updated_by_id','created_at', 'updated_at'
    ];

    public function getSaveData() {
        return array('id', 'country_name','created_by_id','status','updated_by_id','created_at', 'updated_at');
    }

    public function saveData($post) {
        $saveFields = $this->getSaveData();
        $id = isset($post['id']) ? (int) $post['id'] :0;
        unset($post['id']);

        $data = array_intersect_key($post, array_flip($saveFields));
        $data['updated_at'] = date('Y-m-d H:i:s');

        if($id == 0){
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['created_by_id'] = 1;
            $data['updated_by_id'] = null;

            $country = Countries::create($data);
            return ['id' => $country->id, 'status' => 'success', 'message' => 'Country data saved!'];
        }
        else{
            $country = Countries::find($id);
            if($country){
                $country->update($data);
                return ['id'=> $country->id,'status'=> 'success','message'=> 'Country data updated'];
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

    public static function getAllCountry($params=[]){

        $query = DB::table('master_countries');
        $query->select('id', 'country_name',DB::raw("CASE WHEN status = 0 THEN 'Active' ELSE 'Inactive' END AS status"));
        if(isset($params['id'])){
            $id = isset($params['id']) ? $params['id'] : '';
            $query->where('id',$id);
        }
        
        if (!empty($params['country_name'])) {
                $query->where('country_name', 'like', '%' . $params['country_name'] . '%');
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
