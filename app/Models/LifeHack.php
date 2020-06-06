<?php

namespace App\Models;

class LifeHack extends MainModel
{
    protected $fillable = ['content','image'];

    protected $appends = ['is_liked'];


    public function getIsLikedAttribute() {

        if(!$this->user()) return false;
        
        return (bool) $this->likes()->where('user_id', $this->user()->id)->first();
    }

    public function translation() {
        return $this->hasOne(LifeHackTranslation::class)->select('life_hack_id','content');
    }

    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function setImageAttribute($image) {
        $this->attributes['image'] = \URL::to('storage/lifehacks/'.$image);
    }

    public static function boot() {
        parent::boot();
        
        static::deleting(function($lifehack){
            $lifehack->likes()->delete();
        });
    }


}
