<?php

namespace App\Http\Controllers\Common;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
   use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   public function __construct() {
      //
   }

   public function ajaxResponse($data, string $message = 'Successful', $status = true) {
      return response()->json([
         'status' => $status,
         'data' => $data,
         'message' => $message,
      ]);
   }

}
