<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BusinessModel extends Model
{
    use HasFactory;

    public static function getAllBusiness($params = []){
        $query = DB::table('master_business_type as b');          
          $query->select("b.id", "business_name","status");
          
          $totalCount = $query->count();
          if (isset($params['start']) && isset($params['limit']) && !empty($params['limit'])) {
              $query->offset($params['start'])->limit($params['limit']);
          }
          $query->orderBy('business_name', 'ASC');
          
          $results = $query->get();
          if ($totalCount) {
              return ['results' => $results, 'total_count' => $totalCount];
          } else {
              return ['results' => '', 'total_count' => 0];
          }
      }
}
