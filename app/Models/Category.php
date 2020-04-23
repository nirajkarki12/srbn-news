<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Post;

class Category extends Model
{
	use Notifiable;
	use Sluggable;

	/**
	 * The categories that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'name', 'parent_id', 'description', 'image_file', 'image', 'status',
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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function parent()
	{
	    return $this->belongsTo(self::class, 'parent_id');
	}

	public function childs()
   {
      return $this->hasMany(self::class,  'parent_id');
   }

   /**
   * The posts that belong to the category.
   */
   public function posts()
   {
      return $this->belongsToMany(Post::class, 'category_posts');
   }

   public function setImageFileAttribute($image) {
      if($image) {
      	$this->attributes['image_file'] = $image;
      	$this->attributes['image'] = env('APP_URL') .'/storage/category/' .$image;
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

