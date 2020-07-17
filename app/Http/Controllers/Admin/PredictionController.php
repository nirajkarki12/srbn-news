<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Helpers\Helper;
use App\Models\Prediction;
use App\Models\Horoscope;

class PredictionController extends BaseController
{
    public function index() {
        $predictions = Prediction::orderBy('created_at', 'desc')->paginate(Setting::get('data_per_page', 25));
        return view('admin.prediction.index', compact('predictions'));
    }

    public function create(Prediction $prediction = null) {
        $horoscopes1 = Horoscope::where('lang', 'en')->orderBy('order', 'asc')->get();
        $horoscopes2 = Horoscope::where('lang', 'ne')->orderBy('order', 'asc')->get();
        return view('admin.prediction.create', compact('prediction','horoscopes1', 'horoscopes2'));
    }

    public function store(Request $request, Prediction $prediction = null) {

        try {

            $edit = (bool) $prediction;

            $data = $request->except('_token');
            if(!$prediction) {

                $validator = Validator::make( $data, array(
                        'type'  => 'required',
                        'zodiac1' => 'required_without:zodiac2',
                        'zodiac2' => 'required_without:zodiac1',
                        'data'   => 'required',
                        'rating' => 'required',
                    ),
                    [],
                    [
                        'zodiac1' => 'zodiac',
                        'zodiac2' => 'रशिफल',
                    ]
                );

                if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);
            }
            $horoscopeId = $request->type == 'en' ? $request->zodiac1 : $request->zodiac2;
            $data['horoscope_id'] = $horoscopeId;

            if(!$prediction) {
                if(Prediction::where('prediction_date', $request->prediction_date)
                    ->where('horoscope_id', $horoscopeId)
                    ->where('type', $request->type)
                    ->first()) throw new \Exception('Date already inserted');
            }

            if($prediction) {

                if(!$prediction->update($data)) throw new \Exception("Something Went Wrong, Try Again!", 1);

            } else {

                $prediction = Prediction::create($data);

            }

            if($edit) return redirect()->route('admin.prediction')->with('flash_success', 'Prediction edited successfully');
            return back()->with('flash_success', 'Prediction added Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput($data);
        }
    }

    public function destroy(Prediction $prediction) {
        try {
            if(!$prediction->delete()) throw new \Exception('Something went wrong try again');
            return back()->with('flash_success', 'Prediction Removed');
        } catch (\Throwable $th) {
            return back()->with('flash_error', $th->getMessage());
        }
    }
}
