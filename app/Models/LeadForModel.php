<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LeadForModel extends Model
{
    use HasFactory;

    public static function getAllLeadFor($params = []){
        $query = DB::table('master_lead_for as c');          
          $query->select("c.id", "lead_for_name");
          
          $totalCount = $query->count();
          $query->orderBy('lead_for_name', 'ASC');
          
          $results = $query->get();
          if ($totalCount) {
              return ['results' => $results, 'totalCount' => $totalCount];
          } else {
              return ['results' => '', 'totalCount' => 0];
          }
      }
}
