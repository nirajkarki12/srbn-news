<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use Validator;
use App\Models\LifeHack;
use App\Models\Meme;
use App\Models\Like;

/**
* @group Life Hack & Meme
**/
class LifeHackController extends BaseApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Life Hacks List
     * Active Life Hacs
     * @queryParam lang=en preferred language en for english, ne for nepali
     * @queryParam ?page= next page - pagination
     * @response {
     *  "status": true,
     *  "data": {
     *   "current_page": 2,
     *   "data": [
     *    {
     *     "id": 1,
     *     "image": "image url",
     *     "content" :"Content in english",
     *     "translation": {
     *      "content": "Content in nepali"
     *     },
     *     "likes_count": 10,
     *     "is_liked": true,
     *     "created_at": "2020-04-14 15:00",
     *     "updated_at": "2020-04-14 15:00"
     *     }
     *    ],
     *   "first_page_url": "URL//api/life-hacks?page=2",
     *   "from": 16,
     *   "last_page": 4,
     *   "last_page_url": "URL//api/life-hacks?page=4",
     *   "next_page_url": "URL//api/life-hacks?page=3",
     *   "path": "URL/api/life-hacks",
     *   "per_page": 15,
     *   "prev_page_url": "URL//api/life-hacks?page=1",
     *   "to": 30,
     *   "total": 55
     *  },
     * "message": "Life Hacks data fetched successfully",
     * "code": 200
     * }
     *
     * @response 200 {
     *  "status": false,
     *  "message": "Life Hacks not found",
     *  "code": 200
     * }
     *
     * @response 200 {
     *  "status": false,
     *  "message": "Invalid Request",
     *  "code": 200
     * }
     **/
    public function lifeHackListing() {
        try {
            $lifehacks = LifeHack::with('translation')->withCount('likes')->orderBy('created_at', 'desc')->paginate(Setting::get('data_per_page', 25));

            if(!$lifehacks->count()) throw new \Exception("Life Hacks not found", Response::HTTP_OK);

            return $this->successResponse($lifehacks, 'Life Hacks data fetched successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }

    }


    /**
     * Memes List
     * Active Memes
     * @queryParam ?page= next page - pagination
     * @response {
     *  "status": true,
     *  "data": {
     *   "current_page": 2,
     *   "data": [
     *    {
     *     "id": 1,
     *     "image": "image url",
     *     "source":"Nepal Magazine",
     *     "likes_count": 10,
     *     "is_liked": true,
     *     "created_at": "2020-04-14 15:00",
     *     "updated_at": "2020-04-14 15:00"
     *     }
     *    ],
     *   "first_page_url": "URL//api/memes?page=2",
     *   "from": 16,
     *   "last_page": 4,
     *   "last_page_url": "URL//api/memes?page=4",
     *   "next_page_url": "URL//api/memes?page=3",
     *   "path": "URL/api/memes",
     *   "per_page": 15,
     *   "prev_page_url": "URL//api/memes?page=1",
     *   "to": 30,
     *   "total": 55
     *  },
     * "message": "Memes data fetched successfully",
     * "code": 200
     * }
     *
     * @response 200 {
     *  "status": false,
     *  "message": "Memes not found",
     *  "code": 200
     * }
     *
     * @response 200 {
     *  "status": false,
     *  "message": "Invalid Request",
     *  "code": 200
     * }
     **/
    public function memesListing() {
        try {
            $memes = Meme::withCount('likes')->orderBy('created_at', 'desc')->paginate(Setting::get('data_per_page', 25));

            if(!$memes->count()) throw new \Exception("Memes not found", Response::HTTP_OK);

            return $this->successResponse($memes, 'memes data fetched successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }

    }




    /**
    *Like Unlike Life Hack
    * Header: X-Authorization: Bearer {token}
    *@urlParam lifehack required life hack id
    *@response {
    *"status": true,
    *   "data": {
    *     "id": 4,
    *     "content": "content in english",
    *     "image": "http://127.0.0.1:8000/storage/memes/cd67f39562fc5dd7a693d5390a7785d9fc52dc4f.png",
    *     "created_at": "2020-06-06T10:31:16.000000Z",
    *     "updated_at": "2020-06-06T10:31:16.000000Z",
    *     "likes_count": 0,
    *     "is_liked": false,
    *     "translation": {"content":"content in nepali"}
    *   },
    *  "message": "request successful",
    *  "code": 200
    *}
    *
    * @response 200 {
    *  "status": false,
    *  "message": "Life hack not found",
    *  "code": 200
    * }
    *
    * @response 200 {
    *  "status": false,
    *  "message": "Invalid Request",
    *  "code": 200
    * }
    **/
    public function handleLifeHackLike(LifeHack $lifehack) {
        try {

            if(!$lifehack) throw new \Exception('Life Hack is not found', Response::HTTP_OK);

            if(!$user = $this->guard->user()) throw new \Exception('User not found', Response::HTTP_OK);

            $like = $lifehack->likes()->where('user_id', $user->id)->first();

            if(!$like) {
                $lifehack->likes()->create(['user_id' => $user->id]);
            } else {
                $like->delete();
            }

            return $this->successResponse($lifehack->withCount('likes')->with('translation')->first(), 'request successful');
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }



    /**
    *Like Unlike Memes
    *Header: X-Authorization: Bearer {token},
    *@urlParam meme required meme id
    *@response {
    *"status": true,
    *   "data": {
    *    "id": 4,
    *    "image": "http://127.0.0.1:8000/storage/memes/cd67f39562fc5dd7a693d5390a7785d9fc52dc4f.png",
    *    "created_at": "2020-06-06T10:31:16.000000Z",
    *    "updated_at": "2020-06-06T10:31:16.000000Z",
    *    "likes_count": 0,
    *    "is_liked": false
    *   },
    *  "message": "request successful",
    *  "code": 200
    *}
    *
    * @response 200 {
    *  "status": false,
    *  "message": "Meme not found",
    *  "code": 200
    * }
    *
    * @response 200 {
    *  "status": false,
    *  "message": "Invalid Request",
    *  "code": 200
    * }
    **/
    public function handleMemeLike(Meme $meme) {
        try {

            if(!$meme) throw new \Exception('Meme not found', Response::HTTP_OK);

            if(!$user = $this->guard->user()) throw new \Exception('No user found', Response::HTTP_OK);

            $like = $meme->likes()->where('user_id', $user->id)->first();

            if(!$like) {
                $meme->likes()->create(['user_id' => $user->id]);
            } else {
                $like->delete();
            }
            return $this->successResponse($meme->withCount('likes')->first(), 'request successful');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 500);
        }
    }

}
