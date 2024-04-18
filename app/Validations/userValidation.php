<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class userValidation
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string||max:100',
            'email' => 'required|email|max:50',
            'phone' => 'required|max:15',
            'status'=> 'required',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors()->all()];
        }

        return null;
    }
}
