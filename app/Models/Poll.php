<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Poll extends Model
{
   use Notifiable;

	/**
	 * The polls that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
       'question', 'post_id',
	];

   /**
     * The polls that should be cast to native types.
     *
     * @var array
     */
   protected $casts = [
     'created_at' => 'datetime:Y-m-d H:i',
     'updated_at' => 'datetime:Y-m-d H:i',
   ];

    /**
     * The options that belong to the polls.
     */
    public function options()
    {
        return $this->hasMany(Polloption::class);
    }

    /**
     * The option that belong to the polls.
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }


}

