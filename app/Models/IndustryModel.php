<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IndustryModel extends Model
{
    use HasFactory;
    
    public static function getAllIndustry($params = []){
        $query = DB::table('master_industry_type as i');          
          $query->select("i.id", "industry_name","status");
          
          $totalCount = $query->count();
          if (isset($params['start']) && isset($params['limit']) && !empty($params['limit'])) {
              $query->offset($params['start'])->limit($params['limit']);
          }
          $query->orderBy('industry_name', 'ASC');
          
          $results = $query->get();
          if ($totalCount) {
              return ['results' => $results, 'totalCount' => $totalCount];
          } else {
              return ['results' => '', 'totalCount' => 0];
          }
      }
}
