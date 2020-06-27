<?php

namespace App\Models;

class JobCategory extends MainModel
{
    protected $fillable = ['name','name_nepali','image','position'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['text'];

    public function getTextAttribute() {
        if($this->lang() == 'ne') return $this->name_nepali;
        return $this->name;
    }

    public function setImageAttribute($image) {
        $this->attributes['image'] = \URL::to('storage/jobs/'.$image);
    }

    public function vacancies() {
        return $this->belongsToMany(Vacancy::class);
    }

}
