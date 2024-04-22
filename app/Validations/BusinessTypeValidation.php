<?php
namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class BusinessTypeValidation
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'business_name' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors()];
        }

        return null; 
    }
}

?>