<?php
namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class ForgotPasswordValidation

{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'contact_email' => 'required',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors()];
        }

        return null;
    }
}

