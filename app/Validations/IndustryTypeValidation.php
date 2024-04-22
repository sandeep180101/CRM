<?php
namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class IndustryTypeValidation
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'industry_name' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors()];
        }

        return null; 
    }
}

?>