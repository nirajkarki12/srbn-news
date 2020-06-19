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

   public static $postTypes = [
      self::TYPE_IMAGE => 'Image',
      self::TYPE_VIDEO => 'Video',
   ];

	/**
	 * The categories that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'title', 'description', 'type', 'content', 'is_full_width', 'note', 'source', 'source_url', 'source_url2', 'source_url3', 'audio_url', 'is_poll', 'status',
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

   public function poll() {
      return $this->hasOne(Poll::class)->select('id', 'question','post_id');
   }

    public function translation() {
        return $this->hasOne(PostTranslation::class)->select('post_id','title','description','source','note', 'audio_url');
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

