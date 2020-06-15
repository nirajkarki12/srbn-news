<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use Validator;
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
