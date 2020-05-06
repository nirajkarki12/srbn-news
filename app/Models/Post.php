<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Category;

class Post extends Model
{
	use Notifiable;
	use Sluggable;

   const TYPE_IMAGE = 1;
   const TYPE_VIDEO = 2;
   const TYPE_AD = 3;

   public static $postTypes = [
      self::TYPE_IMAGE => 'Image',
      self::TYPE_VIDEO => 'Video',
      self::TYPE_AD => 'Advertisement',
   ];

	/**
	 * The categories that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'title', 'description', 'type', 'content', 'note', 'source', 'source_url', 'audio_url', 'status', 
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

   /**
   * The categories that belong to the post.
   */
   public function categories()
   {
      return $this->belongsToMany(Category::class, 'post_categories');
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

