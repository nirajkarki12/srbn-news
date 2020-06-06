<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use Validator;
use App\Models\Horoscope;
use Carbon;

/** 
*@group Horoscope Api
**/
class HoroscopeController extends BaseApiController
{

    /**
    *Select Unselect Horoscope
    *Header: X-Authorization: Bearer {token}
    *@urlParam id required horoscope id
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

            if($horoscope->users->contains($user->id)) {

                $user->horoscope()->detach($horoscope->id);
            
            } else {

                $user->horoscope()->attach($horoscope->id);
            
            }

            return $this->successResponse($horoscope->withCount('users')->first()->makeHidden('users'), 'Request successfull');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

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


    public function getPredictions() {
        try {

            $user = auth('api')->user();
            
            $timeline = request('timeline');

            $horoscope = $user->horoscope()->first();

            $prediction = $horoscope->prediction();

            if($timeline == 'daily') {

                return $prediction->where('prediction_date', Carbon::today())->where('type', 'daily')->get();

            } elseif($timeline == 'tomorrow') {

                $prediction->where('prediction_date',arbon\Carbon::tomorrow())->where('type','daily');

            } elseif($timeline == 'weekly') {

                $prediction->whereBetween('prediction_date',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('type', 'weekly');

            } elseif($timeline == 'monthly') {

                $prediction->whereBetween('prediction_date',[Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);

            }

            return $prediction->get();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
