<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Common\BaseApiController;
use Validator;
use Carbon\Carbon;
use App\Models\Adgroup;


/**
* @group Adgroup
**/
class AdgroupController extends BaseApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get All Adgroup
     * @response {
     *  "status": true,
     *  "data": [
    *   {
    *       "id": 1,
    *       "title": "1st Group",
    *       "show_after": 10,
    *       "ads": [
    *       {
    *           "id": 4,
    *           "image": "IMAGE PATH",
    *           "adgroup_id": 2
    *       },
    *       {
    *           "id": 5,
    *           "image": "IMAGE PATH",
    *           "adgroup_id": 2
    *       }
    *       ]
    *   }
     *  ],
     * "message": "Adgroup data fetched successfully",
     * "code": 200
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "No data found",
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
            $response = Adgroup::with('ads')
                ->where(function ($q) {
                    $q->where('publish_date', '<=', Carbon::today());
                    $q->where('expiry_date', '>=', Carbon::today());
                })
                ->orderBy('show_after', 'asc')
                ->get();

            $response = $response->makeHidden([
                'publish_date',
                'expiry_date',
                'created_at',
                'updated_at'
            ]);

            if(!$response) throw new \Exception("No data found", Response::HTTP_OK);

            return $this->successResponse($response, 'Adgroup data fetched successfully');

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }

    }

}
