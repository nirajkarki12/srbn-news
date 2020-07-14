<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use App\Models\Post;
use App\Models\Poll;
use App\Models\UserPoll;
use Auth;
use DB;

/**
* @group Poll
*/
class PollController extends BaseApiController
{
   /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct()
   {
      parent::__construct();
   }

    /**
     * Polls List
     * All polls list
     * @queryParam ?page= next page - pagination
     * @queryParam ?lang=en user preffered language en for english and ne for nepali
     * @urlParam /categoryId specific category Posts
     * @response {
     *  "status": true,
     *  "data": {
     *   "current_page": 2,
     *   "data": [
     *    {
     *     "id": 1,
     *     "title": "News Title",
     *     "description": "News Long Description",
     *     "type": "Image|Video",
     *     "content": "Image URL|Video URL",
     *     "is_full_width": 0,
     *     "note": "News notes",
     *     "source": "News Source",
     *     "source_url2": null,
     *     "source_url3": null,
     *     "source_url": "Source URL",
     *     "audio_url": "URL|null",
     *     "lang":"en",
     *     "total_views": 1,
     *     "created_at": "2020-04-14 15:00",
     *     "categories": [
     *      {
     *        "id": 2,
     *        "name": "News",
     *        "name_np": "News",
     *        "position": 1,
     *        "image": null,
     *        "created_at": "2020-04-14 15:00"
     *      }
     *     ],
     *     "poll": {
     *            "id": 2,
     *            "question": "What do you think?",
     *            "post_id": 1,
     *            "options": [
     *             {
     *                "id": 3,
     *                "value": "Good",
     *                "total": 0
     *            },
     *            {
     *                "id": 4,
     *                "value": "Bad",
     *                "total": 0
     *            }
     *            ]
     *      }
     *    }
     *   ],
     *   "first_page_url": "URL/api/polls?page=1",
     *   "from": 16,
     *   "last_page": 4,
     *   "last_page_url": "URL/api/polls?page=4",
     *   "next_page_url": "URL/api/polls?page=3",
     *   "path": "URL/api/polls",
     *   "per_page": 15,
     *   "prev_page_url": "URL/api/polls?page=1",
     *   "to": 30,
     *   "total": 55
     * },
     * "message": "Poll data fetched successfully",
     * "code": 200
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "No Polls found",
     *  "code": 200
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "Invalid Request",
     *  "code": 200
     * }
     */
    public function index(int $categoryId = null)
    {
        try {

            $lang = request('lang')?:'en';

            $paginator = Post::select([
                'posts.*',
                DB::raw('
                     (
                        CASE
                        WHEN posts.type = ' .Post::TYPE_IMAGE .' THEN "' .Post::$postTypes[Post::TYPE_IMAGE] .'"'
                    .' WHEN posts.type = ' .Post::TYPE_VIDEO .' THEN "' .Post::$postTypes[Post::TYPE_VIDEO] .'"'
                    .' ELSE null
                        END
                     ) AS type
                  '),
            ])
                ->with('categories')
                ->with('poll')
                ->with('poll.options')
                ->where('lang', $lang)
                ->orderBy('created_at', 'desc')
                ->where('status', 1)
                ->where('is_poll', 1);

            if($categoryId) {
                $paginator = $paginator->whereHas('categories', function($q) use($categoryId) {
                    $q->where('categories.id', $categoryId);
                });
            }

            $paginator = $paginator->paginate(Setting::get('data_per_page', 25));

            $posts = $paginator->each(function ($post) {
                $post->makeHidden([
                    'status',
                    'category_id',
                    'updated_at',
                    'slug'
                ]);
                $post->categories->each(function($category) {
                    $category->makeHidden([
                        'image_file',
                        'status',
                        'updated_at',
                        'pivot',
                        'slug'
                    ]);
                });
                $post->poll->options->each(function($pollOption) {
                    $pollOption->makeHidden([
                        'poll_id',
                        'created_at',
                        'updated_at',
                    ]);
                });
            });

            $paginator->data = $posts;

            if (!$paginator->count()) throw new \Exception("No Polls found", Response::HTTP_OK);

            return $this->successResponse($paginator, 'Poll data fetched successfully');

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }

    }

   /**
   * Submit Poll
   * Header: X-Authorization: Bearer {token}
   * @bodyParam optionId integer required option id.
   * @response 201 {
   *  "status": true,
   *  "data": [
   *   {
   *   "id": 1,
   *   "value": "yes",
   *   "total": "33.3%"
   *   },
   *   {
   *   "id": 2,
   *   "value": "no",
   *   "total": "66.7%"
   *  }
   *  ],
   * "message": "Done successfully",
   * "code": 201
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "User not found",
   *  "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "The options id field is required.",
   *  "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "Invalid Request",
   *  "code": 200
   * }
   */
   public function postPoll(Request $request)
   {
      try {

         if(!$user = $this->guard->user()) throw new \Exception("User not found", Response::HTTP_OK);

         $data = $request->except('_token');

         $validator = Validator::make( $data, [
               'optionId' => 'required',
            ]
         );
         if($validator->fails()) throw new \Exception($validator->messages()->first(), Response::HTTP_OK);

         $optionId = $data['optionId'];

         $poll = Poll::with('options')
                    ->select('polls.*')
                    ->join('poll_options AS po', 'po.poll_id', 'polls.id')
                    ->where('po.id', $optionId)
                    ->first();

         $Ids = [];
         if($poll) {

            foreach ($poll->options as $option) {
               array_push($Ids, $option->id);
            }
         }

         $preVote = UserPoll::select('*')
                  ->where('user_id', $user->id)
                  ->whereIn('polloption_id', $Ids)
                  ->get();

         if(count($preVote) == 0) {
            $user->polls()->attach(['polloption_id' => $optionId]);

            \DB::table('poll_options')
               ->where('id', $optionId)
               ->update([
                   'total' => DB::raw('total + 1'),
               ]);

            $poll = Poll::with('options')
                ->select('polls.*')
                ->join('poll_options AS po', 'po.poll_id', 'polls.id')
                ->where('po.id', $optionId)
                ->first();
         }

         $data = $poll->options->each(function ($category) {
                     $category->makeHidden([
                        'poll_id',
                        'created_at',
                        'updated_at',
                     ]);
                  });

         $total = 0;
         $response = [];

         foreach ($data as $val) {
            $total += $val->total;
         }

         foreach ($data as $key => $value) {
            $response[$key]['id'] = $value->id;
            $response[$key]['value'] = $value->value;
            $response[$key]['total'] = $total > 0 ? round($value->total / $total * 100, 1) . '%' : '0%';
         }

         return $this->successResponse($response, 'Done successfully', Response::HTTP_CREATED);

     } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
     }
   }

}
