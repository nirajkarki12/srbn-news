<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use Validator;
use App\Models\Quote;

/**
 * @group Quotes
 *
 */
class QuoteController extends BaseApiController
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
     * Quote Lists
     * Active Quotes
     * @queryParam ?page= next page - pagination
     * @response {
     *  "status": true,
     *  "data": {
     *   "current_page": 2,
     *   "data": [
     *    {
     *     "id": 1,
     *     "quote": "quote goes here",
     *     "author": "quote author",
     *     "totalLikes": 5,
     *     "isLiked": true,
     *     "created_at": "2020-04-14 15:00"
     *    }
     *   ],
     *   "first_page_url": "URL/api/quotes?page=1",
     *   "from": 16,
     *   "last_page": 4,
     *   "last_page_url": "URL/api/quotes?page=4",
     *   "next_page_url": "URL/api/quotes?page=3",
     *   "path": "URL/api/quotes",
     *   "per_page": 15,
     *   "prev_page_url": "URL/api/quotes?page=1",
     *   "to": 30,
     *   "total": 55
     * },
     * "message": "Quotes data fetched successfully",
     * "code": 200
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "Quotes not found",
     *  "code": 200
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "User not found",
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
            if(!$user = $this->guard->user()) throw new \Exception("User not found", Response::HTTP_OK);

            $quotes = Quote::selectRaw(
                'quotes.id,
                quotes.quote,
                quotes.author,
                count(distinct ql.id) as totalLikes,
                (CASE WHEN "' .$user->id .'" IN (ql.user_id) THEN true ELSE false END ) AS isLiked,
                quotes.created_at'
                )
                ->leftJoin('quote_likes as ql', 'ql.quote_id', 'quotes.id')
                ->orderBy('created_at', 'desc')
                ->groupBy('quotes.id')
                ->where('quotes.status', true)
                ;

            $quotes = $quotes->paginate(Setting::get('data_per_page', 25));

            if(!$quotes->count()) throw new \Exception("Quotes not found", Response::HTTP_OK);

            return $this->successResponse($quotes, 'Quotes data fetched successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }

    }

    /**
     * Like Quote
     * Header: X-Authorization: Bearer {token}
     * @bodyParam quote int required quote ID.
     * @response 201 {
     *  "status": true,
     *  "data": [],
     * "message": "Quote Liked successfully",
     * "code": 201
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "User not found",
     *  "code": 200
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "The quote field is required.",
     *  "code": 200
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "Invalid Request",
     *  "code": 200
     * }
     */
    public function setLike(Request $request)
    {
        try {

            if(!$user = $this->guard->user()) throw new \Exception("User not found", Response::HTTP_OK);

            $data = $request->except('_token');

            $validator = Validator::make( $data, [
                    'quote' => 'required',
                ]
            );
            if($validator->fails()) throw new \Exception($validator->messages()->first(), Response::HTTP_OK);

            if(!$quote = Quote::where(['id' => $request->quote, 'status' => true])->first()) throw new \Exception("Quote not found", Response::HTTP_OK);

            $quote->likes()->attach($user->id);

            return $this->successResponse([], 'Quote Liked successfully', Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
