<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use Validator;
use App\Models\Horoscope;
use App\Models\Prediction;
use Carbon\Carbon;

/**
*@group Horoscope Api
**/
class HoroscopeController extends BaseApiController
{

    /**
    *List Horoscope
    *@queryParam ?lang= language parameter en for english ne for nepali
    *@response {
    * "status": true,
    * "data": [
    *     {
    *         "id": 2,
    *         "created_at": "2020-06-06T14:20:08.000000Z",
    *         "updated_at": "2020-06-06T14:25:47.000000Z",
    *         "is_selected": false,
    *         "total_users": 0,
    *         "name": "Ariesw",
    *         "info": "english info",
    *         "image": "http://127.0.0.1:8000/storage/horoscopes/a53fb48246b0b5d36c5e4400b3e17d73cc3a042f.png",
    *         "users": []
    *     }
    * ],
    * "message": "Horoscopes fetched successfully",
    * "code": 200
    *}
    */

    public function listHoroscopes() {
        try {
            $horoscopes = Horoscope::withCount('users')->orderBy('order','asc')->get();
            return $this->successResponse($horoscopes->makeHidden('users'), 'Horoscopes fetched successfully');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
    *Select Unselect Horoscope
    *Header: X-Authorization: Bearer {token}
    *@urlParam horoscope required horoscope id
    *@queryParam ?lang= preferred language en for english, ne for nepali
    *@response {
    *    "status": true,
    *    "data": {
    *        "id": 2,
    *        "created_at": "2020-06-06T14:20:08.000000Z",
    *        "updated_at": "2020-06-06T14:25:47.000000Z",
    *        "users_count": 1,
    *        "is_selected": true,
    *        "name": "Meshw",
    *        "info": "nepali info",
    *        "image": "http://127.0.0.1:8000/storage/horoscopes/619c82bbd8e7fd5798b1137f5150a13f4346f4a8.jpg"
    *    },
    *    "message": "Request successfull",
    *    "code": 200
    *}
    *
    **/
    public function choose(Horoscope $horoscope) {
        try {

            $user = $this->guard->user();

            $is_any = $user->horoscope()->first();


            if(!$is_any) {

                // if none present it build
                $user->horoscope()->attach($horoscope);

            } else {

                if($is_any != $horoscope) {
                    $user->horoscope()->detach($is_any->id);
                    $user->horoscope()->attach($horoscope->id);
                }


            }

            return $this->successResponse($user->horoscope()->withCount('users')->first()->makeHidden('users'), 'Request successfull');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
    *Fetch Prediction
    *Header: X-Authorization: Bearer {token}
    *@queryParam timeline required timeline period to show daily, tomorrow, weekly, monthly, yearly
    *@queryParam id required timeline horoscope id
    *@queryParam lang=en  language of the user en for english, ne for nepali
    * @response {
    *    "status": true,
    *    "data": {
    *        "id": 2,
    *        "horoscope_id": 2,
    *        "type": "daily",
    *        "rating": 3.2,
    *        "text": "sdjfkj"
    *    },
    *    "message": "data fetched successfully",
    *    "code": 200
    *}
    *@response 200{
    *   "status": false,
    *   "message": "Nothing to show",
    *   "code": 200
    *}
    **/
    public function getPredictions() {
        try {

            $user = auth('api')->user();

            $timeline = request('timeline');

            if(!$timeline) throw new \Exception('No timeline present', Response::HTTP_OK);

            if(request('id')) {

                if(!$horoscope = Horoscope::where('id', request('id') )->first()) throw new \Exception('No horoscope found', 200);

            } else {

                if(!$horoscope = $user->horoscope()->first()) throw new \Exception('User has not selected horoscope', 200);
            }



            // $prediction = Prediction::query();
            // $prediction = $horoscope->prediction();

            // $prediction = $prediction->where('horoscope_id', $horoscope->id);

            if($timeline == 'daily') {

                $prediction = Prediction::where('horoscope_id', $horoscope->id)->where('prediction_date', Carbon::today())->where('type', 'daily')->first();

            } else if($timeline == 'tomorrow') {

                $prediction = Prediction::where('horoscope_id', $horoscope->id)->where('prediction_date', Carbon::tomorrow())->where('type','daily')->first();

            } else if($timeline == 'weekly') {

                $prediction = Prediction::where('horoscope_id', $horoscope->id)->whereBetween('prediction_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('type', 'weekly')->first();

            } else if($timeline == 'monthly') {

                $prediction = Prediction::where('horoscope_id', $horoscope->id)->whereBetween('prediction_date',[Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('type', 'monthly')->first();

            } else if($timeline == 'yearly') {

                $prediction = Prediction::where('horoscope_id', $horoscope->id)->whereBetween('prediction_date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('type', 'yearly')->first();

            }

            if(!$prediction) throw new \Exception('Nothing to show', Response::HTTP_OK);

            return $this->successResponse($prediction, 'data fetched successfully');

        } catch (\Throwable $th) {

            return $this->errorResponse($th->getMessage(), 200);

        }
    }
}
