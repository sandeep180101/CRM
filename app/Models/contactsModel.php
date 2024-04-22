<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class contactsModel extends Model
{
    use HasFactory;
    protected $table = 'contacts';

    protected $fillable = [
        'id', 'contact_name','contact_email','contact_phone','contact_address','status','created_at', 'updated_at'
    ];

    public function getSaveData() {
        return array('id', 'contact_name','contact_email','contact_phone','contact_address','status','created_at', 'updated_at');
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

            $contact = contactsModel::create($data);
            return ['id' => $contact->id, 'status' => 'success', 'message' => 'Contacts data saved!'];
        } else {
            $contact = contactsModel::find($id);
            if ($contact) {
                $data['updated_at'] = date('Y-m-d H:i:s');
                $data['updated_by_id'] = $userId;
                $contact->update($data);
                return ['id' => $id, 'status' => 'success', 'message' => 'Contacts data updated!'];
            } else {
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

    public static function getAllContacts($params=[]){

        $query = DB::table('contacts');
        $query->select("id", "contact_name", 'contact_address','contact_email','contact_phone',DB::raw("CASE WHEN status = 0 THEN 'Active' ELSE 'Inactive' END AS status"));
        if(isset($params['id'])){
            $id = isset($params['id']) ? $params['id'] : '';
            $query->where('id',$id);
        }
        
        if (!empty($params['contact_name'])) {
                $query->where('contact_name', 'like', '%' . $params['contact_name'] . '%');
        }
        if (!empty($params['contact_email'])) {
                $query->where('contact_email', 'like', '%' . $params['contact_email'] . '%');
        }
        if (!empty($params['contact_phone'])) {
            $query->where('contact_phone', 'like', '%' . $params['contact_phone'] . '%');
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
            return ['results' => $results, 'totalCount' => $totalCount];
        } else {
            return ['results' => '', 'totalCount' => 0];
        }

    }

}
