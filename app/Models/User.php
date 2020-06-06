<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Notifications\Auth\VerifyEmailQueued;
use App\Notifications\Auth\ResetPasswordQueued;
use App\Models\Category;
use App\Models\Polloption;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use Sluggable;

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
      'name', 'email', 'image_file', 'image', 'address', 'password', 'social_id', 'provider', 'phone'
   ];

   /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
   protected $hidden = [
      'password', 'remember_token','social_id','provider'
   ];

   /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
   protected $casts = [
      'email_verified_at' => 'datetime:Y-m-d H:i',
      'created_at' => 'datetime:Y-m-d H:i',
      'updated_at' => 'datetime:Y-m-d H:i',
   ];

   /**
   * The categories that belong to the user.
   */
   public function userCategories()
   {
      return $this->belongsToMany(Category::class, 'user_categories');
   }

   public function horoscope() {
      return $this->hasOne(Horoscope::class);
   }

   /**
   * The polls that belong to the user.
   */
   public function polls()
   {
      return $this->belongsToMany(Polloption::class, 'user_polls');
   }

   public function setImageFileAttribute($image) {
      if($image) {
         $this->attributes['image_file'] = $image;
         $this->attributes['image'] = env('APP_URL') .'/storage/user/' .$image;
      }
   }

   /**
   * jwt implemented methods
   */
   public function getJWTIdentifier()
   {
      return $this->getKey();
   }

   public function getJWTCustomClaims()
   {
      return [
         'id' => $this->id,
         'email' => $this->email,
         'image' => $this->image,
         'address' => $this->address,
      ];
   }

   /**
   * Send the password reset notification.
   *
   * @param  string  $token
   * @return void
   */
   public function sendPasswordResetNotification($token)
   {
      $this->notify(new ResetPasswordQueued($token));
   }

   public function sluggable()
   {
      return [
         'slug' => [
            'source' => 'name'
         ]
      ];
   }

   public function setEmailAttribute($value) {
      if ( empty($value) ) { // will check for empty string
      $this->attributes['email'] = NULL;
      } else {
          $this->attributes['email'] = $value;
      }
  }
}
