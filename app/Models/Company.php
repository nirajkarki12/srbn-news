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

    protected $appends = ['name_text','address_text','description_text'];

    public function getNameTextAttribute() {
        if($this->lang()=='ne') return $this->name_nepali;
        return $this->name;
    }

    public function getAddressTextAttribute(){
        if($this->lang()=='ne') return $this->address_nepali;
        return $this->address;
    }

    public function getDescriptionTextAttribute(){
        if($this->lang()=='ne') return $this->description_nepali;
        return $this->description;
    }


    public function setImageAttribute($image) {
        $this->attributes['image'] = \URL::to('storage/companies/'.$image);
    }
}
