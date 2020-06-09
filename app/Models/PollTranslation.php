<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Poll;

class PollTranslation extends Model
{
    protected $fillable = ['poll_id', 'description', 'title', 'question', 'audio_url'];

    public function post() {
        return $this->belongsTo(Poll::class);
    }
}
