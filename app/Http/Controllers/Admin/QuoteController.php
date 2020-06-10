<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use Validator;
use anlutro\LaravelSettings\Facade as Setting;
use App\Models\Quote;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuotesImport;

class QuoteController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Quote::selectRaw('quotes.*, count(distinct ql.id) as totalLike')
            ->leftJoin('quote_likes as ql', 'ql.quote_id', 'quotes.id')
            ->orderBy('created_at', 'desc')
            ->groupBy('quotes.id')
            ->paginate(Setting::get('data_per_page', 25));

        if($data->count() == 0 && $data->currentPage() !== 1) {
            return redirect()->route('admin.quote');
        }
        return view('admin.quote.list', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {



            $data = $request->except('_token');

            $validator = Validator::make( $data, array(
                    'quote' => 'required|max:255',
                    'status' => 'required',
                )
            );

            // return $request;

            if($request->file('quote_excel')) {
                if(!Excel::import(new QuotesImport, $request->file('quote_excel'))) throw new \Exception('Problem in excel import, Try again!');
                return back()->with('flash_success','Excel import successful');
            }

            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!$quote = Quote::create($data)) throw new \Exception("Something Went Wrong, Try Again!", 1);

            if($request->quote_nepali) {
                $quote->translation()->create([
                    'quote' => $request->quote_nepali?:'',
                    'author'    => $request->author_nepali?:''
                ]);
            }

            return back()->with('flash_success', 'Quote added Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        try {

            if(!$id) throw new \Exception("Error Processing Request", 1);

            $data = Quote::paginate(Setting::get('data_per_page', 25));

            if($data->count() == 0 && $data->currentPage() !== 1) {
                return redirect()->route('admin.quote.edit', ['id', $id]);
            }

            if(!$quoteEdit = Quote::where('id', $id)->first()) throw new \Exception("Quote not Found", 1);

            return view('admin.quote.list', compact('data', 'quoteEdit'));

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id, int $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id, int $page = null)
    {

        try {

            $data = $request->except('_token');

            $validator = Validator::make( $data, array(
                    'quote' => 'required|max:255',
                    'status' => 'required',
                )
            );

            if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

            if(!$quote = Quote::where('id', $id)->first()) throw new \Exception("Error Processing Request", 1);

            if(!$quote->update($data)) throw new \Exception("Error Processing Request", 1);

            if($request->quote_nepali) {

                if($quote->translation) {
                    $quote->translation()->update([
                        'quote' => $request->quote_nepali?:$quote->translation->quote,
                        'author'    => $request->author_nepali?:$quote->translation->author
                    ]);
                } else {
                    $quote->translation()->create([
                        'quote' => $request->quote_nepali,
                        'author'    => $request->author_nepali
                    ]);
                }

            }


            return redirect()->route('admin.quote', ['page' => $page])->with('flash_success', 'Quote updated Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id, int $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, int $page = null)
    {
        try {
            if(!$id) throw new \Exception("Error Processing Request", 1);

            if(!$quote = Quote::where('id', $id)->first()) throw new \Exception("Error Processing Request", 1);

            if(!$quote->delete()) throw new \Exception("Error Processing Request", 1);

            return redirect()->route('admin.quote', ['page' => $page])->with('flash_success', 'Quote removed Successfully');

        } catch (\Exception $e) {
            return back()->with('flash_error', $e->getMessage());
        }
    }
}
