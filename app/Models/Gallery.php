<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $timestamps = false;
    protected $table = 'gallery';

    protected $fillable = ['url', 'post_id'];

    public function post() {
        return $this->belongsTo(Post::class);
    }

}
