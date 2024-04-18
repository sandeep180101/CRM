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
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'user_type',
        'status',
        'created_by',
        'updated_by',
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
                        'created_by',
                        'updated_by',
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

    public function getSingleData($id)
    {
        $id = (int) $id;
        $result = DB::select("SELECT * FROM " . $this->table . " as c WHERE id=$id");
        foreach ($result as $data) {
            return json_decode(json_encode($data), True);
        }
        return false;
    }
}
