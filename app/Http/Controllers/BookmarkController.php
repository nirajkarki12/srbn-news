<?php

namespace App\Http\Controllers;

use App\Models\LifeHack;
use App\Models\Meme;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use Validator;
use App\Models\Bookmark;
use App\Models\Post;
use App\Models\User;

/**
* @group Bookmark
**/
class BookmarkController extends BaseApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get All Bookmarks
     * Header: X-Authorization: Bearer {token}
     * @response {
     *  "status": true,
     *  "data": [
     *   {
     *   "id": 1,
     *   "title": "जुन दिल्लीले सोचेको थिएन",
     *   "description": "<p>नेपालको तल्लो सदन प्रतिनिधिसभाले लिम्पियाधुरासम्मको भूभाग समावेश गरिएको नयाँ नक्सालाई निसान छापमा समेट्न संविधान संशोधन विधेयक शनिबार पारित गरिसकेको छ । यो विधेयक आइतबार माथिल्लो सदन राष्ट्रिय सभामा पनि टेबल भइसकेको छ ।</p>",
     *   "type": "post",
     *  "content": "https://assets-cdn-npc.kantipurdaily.com/uploads/source/news/kantipur/2020/miscellaneous/nepalese-flag-hosting-1562020042029-600x0.jpg",
     *   "note": "नेपालको तल्लो सदन प्रतिनिधिसभाले लिम्पियाधुरासम्मको भूभाग समावेश गरिएको नयाँ नक्सालाई निसान छापमा समेट्न संविधान संशोधन विधेयक शनिबार पारित गरिसकेको छ । यो विधेयक आइतबार माथिल्लो सदन राष्ट्रिय सभामा पनि टेबल भइसकेको छ ।",
     *   "source": "ekantipur.com",
     *   "source_url": "https://ekantipur.com/news/2020/06/15/15921809009546503.html",
     *   "audio_url": "http://localhost/srbn-news/public/userfiles/files/%5BDDR%5D%20Ajab%20Prem%20Ki%20Ghazab%20Kahani%20-%2001%20-%20Main%20Tera%20Dhadkan%20Teri.mp3",
     *   "is_poll": 1,
     *   "status": 1,
     *   "category_id": null,
     *   "lang": "en",
     *   "slug": "2020-06-15-1592198949",
     *   "created_at": "2020-06-15 05:29",
     *   "updated_at": "2020-06-19 10:22",
     *   "source_url2": null,
     *   "source_url3": null,
     *   "is_full_width": 0,
     *   "total_views": 2
     *   },
     *   {
     *   "id": 2,
     *   "quote": "Be yourself; everyone else is already taken.",
     *   "author": "Oscar Wilde",
     *   "status": 1,
     *   "created_at": "2020-05-31 06:00",
     *   "updated_at": "2020-05-31 06:00",
     *   "type": "quote"
     *   }
     *  ],
     * "message": "Bookmarks data fetched successfully",
     * "code": 200
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "Bookmarks not found",
     *  "code": 200
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "No user found",
     *  "code": 200
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "Invalid Request",
     *  "code": 200
     * }
     */
    public function index()
    {
        try {
            if(!$user = $this->guard->user()) throw new \Exception('No user found', Response::HTTP_OK);

            $bookmarks = $user->bookmarks;
            $response = [];
            foreach ($bookmarks as $data) {
                $arr = $data->bookmarkable;
                $explode = (explode('\\', $data->bookmarkable_type));
                $arr['type'] = is_array($explode) ? strtolower(array_pop($explode)) : null;
                array_push($response, $arr);
            }

            if(count($bookmarks) === 0) throw new \Exception("Bookmarks not found", Response::HTTP_OK);

            return $this->successResponse($response, 'Bookmarks data fetched successfully');

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }

    }

    /**
    * Add a Bookmark
    * Header: X-Authorization: Bearer {token}
    * @bodyParam type string required post/meme/lifehack/quote.
    * @bodyParam typeId integer required id of post/meme/lifehack/quote.
    * @response {
    *  "status": true,
    *   "data": [],
    *  "message": "Bookmark added successfully",
    *  "code": 200
    *  }
    *
    * @response 200 {
    *  "status": false,
    *  "message": "This has been already added",
    *  "code": 200
    * }
    * @response 200 {
    *  "status": false,
    *  "message": "No user found",
    *  "code": 200
    * }
    * @response 200 {
    *  "status": false,
    *  "message": "The selected Bookmark Type is invalid.",
    *  "code": 200
    * }
    * @response 200 {
    *  "status": false,
    *  "message": "Request not found",
    *  "code": 200
    * }
    *
    * @response 200 {
    *  "status": false,
    *  "message": "Invalid Request",
    *  "code": 200
    * }
    **/
    public function addBookmark(Request $request) {
        try {
            if(!$user = $this->guard->user()) throw new \Exception('No user found', Response::HTTP_OK);

            $data = $request->except('_token');

            $bookmarkTypes = implode(',', Bookmark::$bookmarkTypes);

            $validator = Validator::make( $data, [
                    'type' => "required|in:$bookmarkTypes",
                    'typeId' => 'required',
                ],
                [],
                [
                    'type' => 'Bookmark Type',
                    'typeId' => 'Bookmark Type ID',
                ]
            );
            if($validator->fails()) throw new \Exception($validator->messages()->first(), Response::HTTP_OK);

            switch ($request->type){
                case Bookmark::POST:
                    if(!$bookmarkData = Post::where('id', $request->typeId)->first()) throw new \Exception('Request not found', Response::HTTP_OK);
                break;
                case Bookmark::MEME:
                    if(!$bookmarkData = Meme::where('id', $request->typeId)->first()) throw new \Exception('Request not found', Response::HTTP_OK);
                break;
                case Bookmark::LIFE_HACK:
                    if(!$bookmarkData = LifeHack::where('id', $request->typeId)->first()) throw new \Exception('Request not found', Response::HTTP_OK);
                break;
                case Bookmark::QUOTE:
                    if(!$bookmarkData = Quote::where('id', $request->typeId)->first()) throw new \Exception('Request not found', Response::HTTP_OK);
                break;
                default:
                    throw new \Exception('Request not found', Response::HTTP_OK);
                break;
            }
            $bookmark = $bookmarkData->bookmarks()->where('user_id', $user->id)->first();
            if($bookmark) throw new \Exception('This has been already added', Response::HTTP_OK);
            $bookmarkData->bookmarks()->create(['user_id' => $user->id]);

            return $this->successResponse([],'Bookmark added successfully');
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

}
