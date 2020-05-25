<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use Validator;
use App\Models\Post;
use App\Models\Poll;
use App\Models\UserPoll;
use App\Models\Polloption;
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
   * All Polls list
   * @queryParam ?page= next page - pagination
   * @response {
   *  "status": true,
   *  "data": {
   *   "current_page": 2,
   *   "data": [
   *    {
   *     "id": 1,
   *     "title": "News Title",
   *     "description": "News Long Description",
   *     "question": "Poll question",
   *     "type": "Image|Video",
   *     "content": "Image URL|Video URL",
   *     "audio_url": "URL|null",
   *     "created_at": "2020-04-14 15:00",
   *     "options": [
   *      {
   *        "id": 2,
   *        "value": "Yes"
   *      },
   *      {
   *        "id": 3,
   *        "value": "No"
   *      }
   *     ]
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
   public function index()
   {
      try {

         $paginator = Poll::select([
               'polls.*',
               DB::raw('
                     (
                        CASE
                        WHEN polls.type = ' .Post::TYPE_IMAGE .' THEN "' .Post::$postTypes[Post::TYPE_IMAGE] .'"'
                        .' WHEN polls.type = ' .Post::TYPE_VIDEO .' THEN "' .Post::$postTypes[Post::TYPE_VIDEO] .'"'
                        .' ELSE null
                        END
                     ) AS type
                  '),
               ])
               ->with('options')
               ->orderBy('created_at', 'desc')
               ->where('status', 1);

         // if($categoryId) {
         //    $paginator = $paginator->whereHas('categories', function($q) use($categoryId) {
         //       $q->where('categories.id', $categoryId);
         //    });
         // }

         $paginator = $paginator->paginate(Setting::get('data_per_page', 25));

         $polls = $paginator->each(function ($post) {
                     $post->makeHidden([
                        'status',
                        'updated_at',
                        'slug'
                     ]);
                     $post->options->each(function($category) {
                        $category->makeHidden([
                           'total',
                           'poll_id',
                           'created_at',
                           'updated_at'
                        ]);
                     });
                  });

         $paginator->data = $polls;

         if (!$paginator->count()) throw new \Exception("No Polls found", Response::HTTP_OK);

         return $this->successResponse($paginator, 'Poll data fetched successfully');

      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
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
            $response[$key]['total'] = $total > 0 ? round($value->total / $total * 100, 1) . '%'; ($value->total) : 0 .'%';
         }

         return $this->successResponse($response, 'Done successfully', Response::HTTP_CREATED);

     } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
     }
   }

}
