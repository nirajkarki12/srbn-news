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
    * List Horoscope
    * @queryParam ?lang= language parameter en for english ne for nepali
    * @response {
    * "status": true,
    * "data": [
    *     {
    *         "id": 1,
    *         "name": "Aeries",
    *         "info": "english info",
    *         "image": "http://127.0.0.1:8000/storage/horoscopes/a53fb48246b0b5d36c5e4400b3e17d73cc3a042f.png",
    *         "order": 1,
    *         "lang": "en/ne",
    *         "is_selected": "true/false",
    *         "created_at": "2020-06-06T14:20:08.000000Z",
    *         "updated_at": "2020-06-06T14:25:47.000000Z"
    *     }
    * ],
    * "message": "Horoscopes fetched successfully",
    * "code": 200
    *}
    */

    public function listHoroscopes() {
        try {
            $lang = request('lang') ?: 'ne';

            $horoscopes = Horoscope::where('lang', $lang)->orderBy('order','asc')->get();
            return $this->successResponse($horoscopes->makeHidden('users'), 'Horoscopes fetched successfully');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
    *Select Unselect Horoscope
    *Header: X-Authorization: Bearer {token}
    *@urlParam horoscope required horoscope id
    *@response {
    *    "status": true,
    *    "data": {
    *         "id": 1,
    *         "name": "Aeries",
    *         "info": "english info",
    *         "image": "http://127.0.0.1:8000/storage/horoscopes/a53fb48246b0b5d36c5e4400b3e17d73cc3a042f.png",
    *         "order": 1,
    *         "lang": "en/ne",
    *         "is_selected": true,
    *         "users_count": 4,
    *         "created_at": "2020-06-06T14:20:08.000000Z",
    *         "updated_at": "2020-06-06T14:25:47.000000Z"
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
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
    * Fetch Prediction
    * @queryParam timeline required timeline period to show daily, weekly, monthly, yearly
    * @queryParam lang=en  language of the user en for english, ne for nepali
    * @queryParam user  user id of logged in user
    * @response {
    *    "status": true,
    *    "data": [
    *   {
    *       "name": "Aries",
    *       "data": "The energy is lively today, giving your spirits a lift and bringing out your inner artist. You'll feel your zeal return, which can propel you forward if you've felt stuck in a rut for an extended period of time. You may feel more appreciated at home and at work, too. Take advantage of this special time.",
    *       "rating": 3.8,
    *       "start_date": "2020-07-18",
    *       "end_date": "2020-07-18",
    *       "is_selected": null
    *   },
    *   {
    *       "name": "Taurus",
    *       "data": "The advice you give to friends today might not be warmly received, but it will sink in nevertheless. Don't think that just because they don't thank you for what you said that they didn't listen to it. Passing on what you have learned from past mistakes is something undeniably valuable, and they know that. They're glad you care enough to open up about what you know but not necessarily eager to do as you say.",
    *       "rating": 3.8,
    *       "start_date": "2020-07-18",
    *       "end_date": "2020-07-18",
    *       "is_selected": null
    *   }
    *    ],
    *    "message": "data fetched successfully",
    *    "code": 200
    *}
    *@response 200{
    *   "status": false,
    *   "message": "Data not found",
    *   "code": 200
    *}
    **/
    public function getPredictions() {
        try {
            $timeline = request('timeline');
            $lang = request('lang') ?: 'ne';
            $userId = request('user') ?: false;

            $data = Prediction::select(['name', 'data', 'rating', 'start_date', 'end_date'])
                ->join('horoscopes', 'horoscopes.id', 'horoscope_id')
                ->where('horoscopes.lang', $lang)
                ->groupBy('name')
                ->orderBy('horoscopes.order', 'asc')
                ;
            if($userId) {
                $data->addSelect(\DB::raw('CASE WHEN horoscope_user.id THEN TRUE ELSE FALSE END as is_selected2'))
                    ->leftJoin('horoscope_user', function($join) use ($userId) {
                        $join->on('horoscope_user.horoscope_id', 'horoscopes.id');
                        $join->on('horoscope_user.user_id', \DB::raw("'".$userId."'"));
                    });
            }else {
                $data->addSelect(\DB::raw('null as is_selected'));
            }

            switch ($timeline) {
                case 'daily':
                    $data->where('start_date', Carbon::today())
                        ->where('type','daily');
                    break;
                case 'weekly':
                    $data->where(function ($q) {
                            $q->where('start_date', '<=', Carbon::today());
                            $q->where('end_date', '>=', Carbon::today());
                        })
                        ->where('type','weekly');

                    break;
                case 'monthly':
                    $data->where(function ($q) {
                            $q->where('start_date', '<=', Carbon::today());
                            $q->where('end_date', '>=', Carbon::today());
                        })
                        ->where('type','monthly');
                    break;
                case 'yearly':
                    $data->where(function ($q) {
                            $q->where('start_date', '<=', Carbon::today());
                            $q->where('end_date', '>=', Carbon::today());
                        })
                        ->where('type','yearly');
                    break;
                default:
                    throw new \Exception('Invalid timeline');
            }
            if(!$data = $data->get()) throw new \Exception('Data not found');

            return $this->successResponse($data, 'data fetched successfully');

        } catch (\Throwable $th) {

            return $this->errorResponse($th->getMessage(), 200);

        }
    }
}
