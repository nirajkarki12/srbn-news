<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class MainRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 500));
    }


}
