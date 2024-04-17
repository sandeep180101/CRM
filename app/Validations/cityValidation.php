<?php
namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class cityValidation
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'city_name' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'state_id' => 'required',
            'country_id'=> 'required',
            'status'=> 'required',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors()];
        }

        return null; 
    }
}

?>