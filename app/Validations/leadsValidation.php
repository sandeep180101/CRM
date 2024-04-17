<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class LeadsValidation
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'date' => 'required|date',
            'name' => 'required|string||max:100',
            'email' => 'nullable|email|max:50',
            'phone' => 'nullable|max:15',
            'address' => 'nullable',
            'country_id' => 'nullable',
            'state_id' => 'nullable',
            'city_id' => 'nullable',
            'pincode' => 'nullable',
            'product_details' => 'required|string',
            'approximate_amount'=> 'required|numeric|min:5000|max:9999999',
            'lead_source'=> 'nullable',
            'lead_status'=> 'nullable',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors()->all()];
        }

        return null;
    }
}
