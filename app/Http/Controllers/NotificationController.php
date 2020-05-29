<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class NotificationController
{
    private static $firebase_key, $url, $site_name;

    /* set the firebase details in env(FIREBASE_KEY, FIREBASE_URL) file and reflects from config */
    /* call this method before sending notification */
    public static function setValues() {
        self::$firebase_key = config('services.firebase.key');
        self::$url = config('services.firebase.url');
        self::$site_name = env('APP_NAME');
    }

    public static function newPost(User $user, Post $post){
        $fields = array(

            'to' => $user->device_token,

            'notification'=>[

                'title'=> $post->title,

                'text'=> $post->note
            ],

            // 'data'=>array(
            //     'image'=>'url' //extra data payload if needed
            // )
        );
        return self::curlInit($fields, self::$firebase_key);
    }




    protected static function curlInit($fields, $firebase_key){
        $headers = array(
            'Authorization:key='. $firebase_key,
            'Content-type: Application/json'
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::$url);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $res = curl_exec($ch);

        curl_close($ch);

        return $res;
    }
}
