<?php
namespace App\Http\Middleware;

use App\User;
use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use http\Env\Response;

class JwtMiddleware
{

    public function handle($request, Closure $next, $guard = null)
    {

       // dd($request);

$token = $request->get('token');



if (!$token) {
            return response()->json(['error'=>'Token missing'],401);
}

try {
            $credentials = JWT::decode($token,env('JWT_SECRET'),array('HS256'));

                   // dd($credentials);
} catch (ExpiredException $e) {
            return response()->json([
                'error'=>'token expired'
            ],201);
} catch (Exception $e) {
            return response()->json([
                'error'=>'Invalid Token , please login to get your token',
               // 'error'=>$e->getMessage()
            ],400);
}


return $next($request);
    }
}
