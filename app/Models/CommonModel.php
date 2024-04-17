<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CommonModel extends Model
{
    use HasFactory;

    public static function getSingle($table,$data){
		$result = DB::table($table)
		->where($data)
		->get();
		if($result){
			return $result;
		}else{
			return false;
		}	
	}
	Public function checkUnique($table, $uniqueField, $uniqueFieldValue, $id = 0) {
        $query = "SELECT COUNT(*) as total FROM " . $table . " WHERE $uniqueField = '" . $uniqueFieldValue . "'";
        $id = (int) $id;
        if ($id > 0) {
            $query .= " AND id != " . $id . "";
        }
        $resultSet = DB::select(DB::raw($query));
        if (!$resultSet) {
            return false;
        }
        $count = 0;
        foreach ($resultSet as $data) {
            $row = json_decode(json_encode($data), True);
            $count = $row['total'];
        }
        return $count;
    }
    public function checkMultiUnique($table, $uniqueFieldValue, $id = 0) {
        $query = "SELECT COUNT(*) as total FROM $table WHERE 1=1 ";
        $bindings = [];
        
        foreach ($uniqueFieldValue as $key => $value) {
            $query .= " AND $key = ?";
            $bindings[] = $value;
        }
        
        $id = (int) $id;
        if ($id > 0) {
            $query .= " AND id != ?";
            $bindings[] = $id;
        }
    
        try {
            $resultSet = DB::select($query, $bindings);
            return $resultSet[0]->total ?? 0;
        } catch (\Exception $e) {
            // Handle the exception (e.g., log the error, return false, etc.)
            return false;
        }
    }
    

    public static function simpleUpdate($table,$condition,$data){
        $result = DB::table($table)
        ->where($condition)
        ->update($data);
        if($result){
            return $result;
        }else{
            return false;
        }   
    }
    
    static function getDateDiffernce($date1,$date2){
        $result = DB::select("select DATEDIFF('$date1', '$date2') as getDate");
        foreach ($result as $data) {
            return json_decode(json_encode($data), True);
        }
        return false;
    }
    
    // public function validateCountryStateCity($post){

    //     $validationResult = [
    //         'status' => 'success',
    //         'message' => 'The data is valid and can be inserted.'
    //     ];
    
    //     if (!empty($post['country_id'])) {
    //         $countryExists = DB::table('master_countries')->where('id', $post['country_id'])->exists();
    //         if (!$countryExists) {
    //             $validationResult = [
    //                 'status' => 'error',
    //                 'message' => 'The selected country id does not exist.'
    //             ];
    //             return $validationResult;
    //         }
    //     }
    
    //     if (!empty($post['state_id'])) {
    //         $stateExists = DB::table('master_states')->where('id', $post['state_id'])->exists();
    //         if (!$stateExists) {
    //             $validationResult = [
    //                 'status' => 'error',
    //                 'message' => 'The selected state id does not exist.'
    //             ];
    //             return $validationResult;
    //         }
    //     }
    
    //     if (!empty($post['city_id'])) {
    //         $cityExists = DB::table('cities')->where('id', $post['city_id'])->exists();
    //         if (!$cityExists) {
    //             $validationResult = [
    //                 'status' => 'error',
    //                 'message' => 'The selected city id does not exist.'
    //             ];
    //             return $validationResult;
    //         }
    //     }
    
    //     return $validationResult;
    // }
}