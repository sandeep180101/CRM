<?php
namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class stateValidation
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'state_name' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'country_id' => 'required',
            'status'=> 'required',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors()];
        }

        return null; 
    }
}

?>