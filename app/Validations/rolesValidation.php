<?php
namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class rolesValidation

{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'role_name' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors()];
        }

        return null;
    }
}

