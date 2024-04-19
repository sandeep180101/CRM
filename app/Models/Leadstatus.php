<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Leadstatus extends Model
{
    use HasFactory;
    protected $table = 'master_lead_status';

    public static function getAllLeadStatus($params = []){
        $query = DB::table('master_lead_status as c');          
          $query->select("c.id", "lead_status_name");
          
          $totalCount = $query->count();
          $query->orderBy('lead_status_name', 'ASC');
          
          $results = $query->get();
          if ($totalCount) {
              return ['results' => $results, 'total_count' => $totalCount];
          } else {
              return ['results' => '', 'total_count' => 0];
          }
      }


}
