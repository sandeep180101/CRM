<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'user_type',
        'status',
        'created_by_id',
        'updated_by_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function setPasswordAttribute($value=1234578)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getSaveData()
    {
        return array(        
                        'name',
                        'email',
                        'phone',
                        'password',
                        'user_type',
                        'status',
                        'created_by_id',
                        'updated_by_id',
                        'created_at',
                        'updated_at',
                    );
    }

    public function saveData($post)
    {
        $saveFields = $this->getSaveData();
        $id = isset($post['id']) ? (int) $post['id'] : 0;
        unset($post['id']);
        $userId =session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $data = array_intersect_key($post, array_flip($saveFields));

        if ($id == 0) {
            $data['created_by_id'] = $userId;
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_by_id'] = null;

            $lead = User::create($data);
            return ['id' => $lead->id, 'encryptid' => Crypt::encrypt($lead->id), 'status' => 'success', 'message' => 'lead data saved!'];
        } else {
            $lead = User::find($id);
            if ($lead) {
                $data['updated_by_id'] = $userId;
                $data['updated_at'] = date("Y-m-d H:i:s");
                $lead->update($data);
                return ['id' => $lead->id, 'encryptid' => Crypt::encrypt($lead->id), 'status' => 'success', 'message' => 'lead data updated!'];
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
    
    
    public static function getUserViewDetails($params = []){
        $query = DB::table('users as u');
        $query->select("u.id", "u.name","u.email","u.phone",DB::raw("CASE WHEN u.status = 0 THEN 'Active' ELSE 'Inactive' END AS status"));
        if(!empty($params['name'])){
            $name = isset($params['name']) ? $params['name'] : '';
            $query->where('u.name','LIKE','%'.$name .'%');
        }
        if(!empty($params['email'])){
            $email = isset($params['email']) ? $params['email'] : '';
            $query->where('u.email','LIKE','%'.$email .'%');
        }
        if(!empty($params['phone'])){
            $phone = isset($params['phone']) ? $params['phone'] : '';
            $query->where('u.phone','LIKE','%'.$phone .'%');
        }
        
        if(!empty($params['id'])){
            $id = isset($params['id']) ? $params['id'] : '';
            $query->where('u.id',$id);
        }
        $totalCount = $query->count();
        if(isset($params['start']) && isset($params['limit']) && !empty($params['limit'])){
            $query->offset($params['start'])->limit($params['limit']);
        }
        $results = $query->get();
        if($totalCount){
            return array('results' => $results , 'total_count' => $totalCount);
        }else{
            return array('results' => '' , 'total_count' => 0);
        }
}
}
