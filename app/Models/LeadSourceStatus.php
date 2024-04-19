<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LeadSourceStatus extends Model
{
    use HasFactory;
    protected $table = 'master_lead_source';

    protected $fillable = ['id','lead_source_name', 'created_by', 'updated_by', 'created_at', 'updated_at'];


    public static function getAllLeadSource($params = []){
        $query = DB::table('master_lead_source as c');          
          $query->select("c.id", "lead_source_name");
          
          $totalCount = $query->count();
          if (isset($params['start']) && isset($params['limit']) && !empty($params['limit'])) {
              $query->offset($params['start'])->limit($params['limit']);
          }
          $query->orderBy('lead_source_name', 'ASC');
          
          $results = $query->get();
          if ($totalCount) {
              return ['results' => $results, 'total_count' => $totalCount];
          } else {
              return ['results' => '', 'total_count' => 0];
          }
      }

}
