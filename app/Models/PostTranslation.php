<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    protected $fillable = ['post_id', 'description', 'title', 'source', 'note'];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
