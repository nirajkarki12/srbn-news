<?php

namespace App\Http\Requests;


class VacancyRequest extends MainRequest
{

    public function rules()
    {
        return [
            'title' =>'required',
            'title_nepali'  => 'required',
            'image' => 'mimes:jpg,jpeg,png',
            'company_id'    => 'required',
            'job_category_id'   => 'required',
            'location'  => 'required',
            'location_nepali'   => 'required',
            'apply_date'    => 'required',
            'apply_link'    => 'required',

        ];
    }
}
