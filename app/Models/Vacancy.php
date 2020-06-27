<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'title',
        'title_nepali',
        'level',
        'level_nepali',
        'number',
        'employment_type',
        'employment_type_nepali',
        'location',
        'location_nepali',
        'salary',
        'salary_nepali',
        'image',
        'lang',
        'apply_date',
        'apply_link',
        'company_id'
    ];

    public function jobCategories() {
        return $this->belongsToMany(JobCategory::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function setImageAttribute($image){
        $this->attributes['image'] = \URL::to('storage/vacancies/'.$image);
    }
}
