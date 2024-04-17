<?php
namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class loginValidation

{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'email'=> 'required|unique:users,email',
            'password'=> 'required',
            'password_confirmation'=>'required|same:users,password'
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors()];
        }

        return null;
    }
}

