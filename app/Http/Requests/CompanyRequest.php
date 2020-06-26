<?php
namespace App\Http\Requests;

class CompanyRequest extends MainRequest
{
    public function rules()
    {
        return [
            'name'  =>'required',
            'name_nepali'   => 'required',
            'address'   => 'required',
            'address_nepali'    => 'required',
            'description'   => 'required',
            'description_nepali'    => 'required',
            'phone' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ];
    }
}
