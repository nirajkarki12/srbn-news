<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    protected $fillable = ['image'];

    public function setImageAttribute($image) {
        $this->attributes['image'] = \URL::to('storage/memes/'.$image);
    }

    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }

    public static function boot() {
        parent::boot();
        
        static::deleting(function($meme){
            $meme->likes()->delete();
        });
    }
}
