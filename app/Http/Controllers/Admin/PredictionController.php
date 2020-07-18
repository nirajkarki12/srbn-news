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
                        'lang'  => 'required',
                        'zodiac1' => 'required_without:zodiac2',
                        'zodiac2' => 'required_without:zodiac1',
                        'data'   => 'required',
                        'start_date'   => 'required',
                        'end_date'   => 'required_unless:type,daily',
                        'rating' => 'required',
                    ),
                    [],
                    [
                        'lang' => 'Type',
                        'zodiac1' => 'Zodiac',
                        'zodiac2' => 'रशिफल',
                    ]
                );

                if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);
            }
            $horoscopeId = $request->lang == 'en' ? $request->zodiac1 : $request->zodiac2;
            $data['horoscope_id'] = $horoscopeId;
            $data['end_date'] = $request->type == 'daily' ? $request->start_date : $request->end_date;

            if(!$prediction) {
                if(Prediction::where('start_date', $request->start_date)
                    ->where('end_date', $request->end_date)
                    ->where('horoscope_id', $horoscopeId)
                    ->where('type', $request->type)
                    ->first()) throw new \Exception('Date already inserted');
            }

            if($prediction) {

                if(!$prediction->update($data)) throw new \Exception("Something Went Wrong, Try Again!", 1);

            } else {
                Prediction::create($data);
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
