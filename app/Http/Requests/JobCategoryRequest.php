<?php
namespace App\Http\Requests;

class JobCategoryRequest extends MainRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'name_nepali' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ];
    }
}
