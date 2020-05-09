<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Polloption;

class Poll extends Model
{
   use Notifiable;
   use Sluggable;

	/**
	 * The polls that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
       'title', 'description', 'question', 'type', 'content', 'audio_url', 'status', 
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

   public function sluggable()
   {
      return [
          'slug' => [
              'method' => function($string, $sep) {
                  return (date('Y-m-d-') .time());
              }
          ]
      ];
   }

}

