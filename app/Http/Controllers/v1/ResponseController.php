<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ResponseController extends Controller
{
    public function index($status, $msg, $statusCode)
    {
    	return Response([
	        'status' => $status,
	        'msg' => $msg,
	    ], $statusCode);
    }
    public function arrays($status, $msg, $data, $statusCode)
    {
    	return Response([
	        'status' => $status,
	        'msg' => $msg,
	        'data' => $data
	    ], $statusCode);
    }
    public function fetchToken(Request $request)
    {
        $fetchHeader = $request->header('Authorization');
        $header = str_replace('Render-App ', '', $fetchHeader);
        $user = User::where('token_auth',$header)->first();
        return $user;
    }
}
