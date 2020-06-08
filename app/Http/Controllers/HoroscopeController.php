<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use Validator;
use App\Models\Horoscope;
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

            $horoscope = $user->horoscope()->first();

            $prediction = $horoscope->prediction();

            if($timeline == 'daily') {

                $prediction->where('prediction_date', Carbon::today())->where('type', 'daily');

            } elseif($timeline == 'tomorrow') {

                $prediction->where('prediction_date', Carbon::tomorrow())->where('type','daily');

            } elseif($timeline == 'weekly') {

                $prediction->whereBetween('prediction_date',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('type', 'weekly');

            } elseif($timeline == 'monthly') {

                $prediction->whereBetween('prediction_date',[Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('type', 'monthly');

            } elseif($timeline == 'yearly') {
                $prediction->whereBetween('prediction_date',[Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('type', 'yearly');
            }

            if(!$prediction->first()) throw new \Exception('Nothing to show', Response::HTTP_OK);

            return $this->successResponse($prediction->first(), 'data fetched successfully');
        
        } catch (\Throwable $th) {

            return $this->errorResponse($th->getMessage(), $th->getCode());

        }
    }
}