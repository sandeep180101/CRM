<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class leadnoteValidation
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'lead_id' => 'nullable',
            'user_id' => 'nullable',
            'notes' => 'required',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors()->all()];
        }

        return null;
    }
}
