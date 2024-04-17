<?php
namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class contactsValidation
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'contact_name' => 'required',
            'contact_email' => 'required',
            'contact_phone'=> 'required',
            'contact_address'=> 'required',
            'status'=> 'required',
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => 'Validation Error', 'errors' => $validator->errors()];
        }

        return null; 
    }
}

?>