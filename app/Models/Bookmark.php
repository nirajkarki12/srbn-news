<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Bookmark extends Model
{
    const POLL = 'poll';
    const POST = 'post';
    const MEME = 'meme';
    const LIFE_HACK = 'lifehack';

    public static $bookmarkTypes = [
        Self::POLL,
        Self::POST,
        Self::MEME,
        Self::LIFE_HACK,
    ];

    protected $fillable = ['user_id','type','type_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
