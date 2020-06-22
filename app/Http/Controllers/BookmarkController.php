<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use Validator;
use App\Models\Bookmark;
use App\Models\User;

/**
* @group Bookmark
**/
class BookmarkController extends BaseApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Add a Bookmark
    * Header: X-Authorization: Bearer {token},
    * @bodyParam type string required poll/post/meme/lifehack.
    * @bodyParam typeId integer required id of poll/post/meme/lifehack.
    * @response {
    *  "status": true,
    *   "data": [],
    *  "message": "Bookmark added successfully",
    *  "code": 200
    *  }
    *
    * @response 200 {
    *  "status": false,
    *  "message": "This has been already added",
    *  "code": 200
    * }
    * @response 200 {
    *  "status": false,
    *  "message": "No user found",
    *  "code": 200
    * }
    * @response 200 {
    *  "status": false,
    *  "message": "The selected Bookmark Type is invalid.",
    *  "code": 200
    * }
    *
    * @response 200 {
    *  "status": false,
    *  "message": "Invalid Request",
    *  "code": 200
    * }
    **/
    public function addBookmark(Request $request) {
        try {
            if(!$user = $this->guard->user()) throw new \Exception('No user found', Response::HTTP_OK);

            $data = $request->except('_token');

            $bookmarkTypes = implode(',', Bookmark::$bookmarkTypes);

            $validator = Validator::make( $data, [
                    'type' => "required|in:$bookmarkTypes",
                    'typeId' => 'required',
                ],
                [],
                [
                    'type' => 'Bookmark Type',
                    'typeId' => 'Bookmark Type ID',
                ]
            );
            if($validator->fails()) throw new \Exception($validator->messages()->first(), Response::HTTP_OK);

            if($bookmark = Bookmark::where(['user_id' => $user->id, 'type' => $request->type, 'type_id' => $request->typeId])->first()) {
                throw new \Exception('This has been already added', Response::HTTP_OK);
            }
            Bookmark::create([
                'user_id' => $user->id,
                'type' => $request->type,
                'type_id' => $request->typeId,
            ]);
            return $this->successResponse([],'Bookmark added successfully');
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

}
