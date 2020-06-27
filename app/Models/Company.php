<?php
namespace App\Models;

class Company extends MainModel
{
    protected $fillable = [
        'name',
        'name_nepali',
        'description',
        'description_nepali',
        'address',
        'address_nepali',
        'name_nepali',
        'image',
        'phone',
    ];

    protected $hidden = ['created_at','updated_at'];

    public function setImageAttribute($image) {
        $this->attributes['image'] = \URL::to('storage/companies/'.$image);
    }
}
