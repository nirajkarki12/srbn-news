<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Category;
use App\Models\PostView;

class Post extends Model
{
	use Notifiable;
	use Sluggable;

	/**
	 * The categories that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'title', 'description', 'image_file', 'image', 'source', 'source_url', 'audio_url', 'status', 
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

	public function postViews()
   {
      return $this->hasMany(PostView::class);
   }

   public function setImageFileAttribute($image) {
      if($image) {
      	$this->attributes['image_file'] = $image;
      	$this->attributes['image'] = env('APP_URL') .'/storage/post/' .$image;
      }
   }

	public function sluggable()
   {
      return [
          'slug' => [
              'source' => 'title'
          ]
      ];
   }
}

