<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        /*if(!Auth::guard('customer')->attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ],401);*/

        \Auth::guard('customer')->attempt($credentials);



        $customer = \Auth::guard('customer')->user();

        $token = $customer->createToken('sadsad')->accessToken;

        return response()->json(['token' => $token]);

        //https://laravel-guide.readthedocs.io/en/latest/passport/
    }

    public function getData()
    {
        return response()->json(['jo' => "sd"]);
    }
}
