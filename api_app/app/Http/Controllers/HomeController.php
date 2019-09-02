<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {

        $user = auth()->user();


        $token = array(
            "iss" => "http://fixico.com",
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60*60 // Expiration time
        );



        $jwt = JWT::encode($token,env('JWT_SECRET'));
      //  dd($request->get('jwt'));

        //$credentials = JWT::decode($jwt,env('JWT_SECRET'),array('HS256'));


        return view('home',['jwt' => $jwt]);
    }
}
