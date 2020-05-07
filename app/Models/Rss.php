<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Rss extends Model
{
	use Notifiable;
	use Sluggable;

   protected $table = 'rss';

	/**
	 * The categories that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'name', 'tagline', 'url', 'logo_file', 'logo', 'status',
	];

   /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
   protected $casts = [
     'created_at' => 'datetime:Y-m-d H:i',
     'updated_at' => 'datetime:Y-m-d H:i',
   ];

   public function setLogoFileAttribute($logo) {
      if($logo) {
      	$this->attributes['logo_file'] = $logo;
      	$this->attributes['logo'] = env('APP_URL') .'/storage/rss/' .$logo;
      }
   }

	public function sluggable()
   {
      return [
          'slug' => [
              'source' => 'name'
          ]
      ];
   }
}

