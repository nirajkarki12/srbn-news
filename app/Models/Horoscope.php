<?php

namespace App\Models;


class Horoscope extends MainModel
{
    protected $fillable = ['name_nepali', 'name_english', 'image_nepali', 'image_english', 'order', 'info_nepali','info_english'];

    protected $appends = ['is_selected','name', 'info', 'image'];

    protected $hidden = ['name_nepali','name_english','image_nepali','image_english','info_nepali','info_english','order'];

    public function getIsSelectedAttribute(){
        if(!$this->user()) return false;
        return $this->users->contains($this->user()->id);
    }

    public function getNameAttribute() {
        if($this->lang() == 'ne') return $this->name_nepali;

        return $this->name_english;
    }

    public function getImageAttribute() {
        if($this->lang() == 'ne') return $this->image_nepali;
        return $this->image_english;
    }

    public function getInfoAttribute() {
        if($this->lang() == 'ne') return $this->info_nepali;
        return $this->info_english;
    }
    
    public function setImageNepaliAttribute($image) {
        $this->attributes['image_nepali'] = \URL::to('storage/horoscopes/'.$image);
    }

    public function setImageEnglishAttribute($image) {
        $this->attributes['image_english'] = \URL::to('storage/horoscopes/'.$image);
    }

    public function prediction() {
        return $this->hasMany(Prediction::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
