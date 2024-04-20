<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class PartyValidation
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:100',
            'party_type' => 'nullable|string|max:100',
            'industry_id' => 'nullable',
            'business_id' => 'nullable',
            'email' => 'nullable|email|max:50',
            'phone' => 'nullable|max:15',
            'address' => 'nullable',
            'country_id' => 'nullable',
            'state_id' => 'nullable',
            'city_id' => 'nullable',
            'pincode' => 'nullable',
            'whatsapp' => 'nullable',
            'skype' => 'nullable',
            'gst' => 'nullable',
            'website' => 'nullable',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors()->all()];
        }

        return null;
    }
}
