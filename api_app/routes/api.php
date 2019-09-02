<?php

use Illuminate\Http\Request;
use Firebase\JWT\JWT;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* */
Route::middleware('auth:api')->get(/**
 * @param \Illuminate\Http\Request $request
 * @return mixed
 */ '/user', function (Request $request) {
    return $request->user();
});

/** Retrieve all vehicles from  different Data sources
 * @return string
 *
 * @api API Documentation - https://documenter.getpostman.com/view/8059329/SVfJVBYT?version=latest
 * Method : GET
 * EX : http://localhost:8000/api/getallVehicles?token=eyJ0eXAiOiJKV1
 */

Route::get('getallVehicles', 'VehicleControllers@getAllVehicles', function () {
})->middleware('jwt.auth');





/** Get Vehicles By source and identifier
 * @return string
 *
 * @api API Documentation - https://documenter.getpostman.com/view/8059329/SVfJVBhF

  @param
  source : String (database , csv , 3drpartyapi )
 *
 * @param
  identifier : String -
 *
 * EX : CSV - http://localhost:8000/api/getvehicles/csv/86XLB4?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3
 *      source      : csv
 *      identifier :  86XLB4
 *
 * EX : CSV - http://localhost:8000/api/getvehicles/csv/86XLB4?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3
 *      source      : database
 *      identifier :  KKs3307
 *
 * EX : CSV - http://localhost:8000/api/getvehicles/3drpartyapi/01GBB1?token=eyJ0eXAiOiJK
 *      source      : 3drpartyapi
 *      identifier :  01GBB1
*/

Route::get(
    'getvehicles/{source}/{identifier}', 'VehicleControllers@getVehicles', function () {
})->middleware('jwt.auth');




/** Update Vehicles in Database
 * @api API Documentation - https://documenter.getpostman.com/view/8059329/SVfKwA1d
 @param : identifier String
 @param : make  String
 @param : model  String
 @param : year  String
 *
 */

Route::put('updateVehicle', 'VehicleControllers@updateVehicle', function () {
    //
})->middleware('jwt.auth');





/*  404 Respond handle */

Route::fallback(/**
 * @return \Illuminate\Http\JsonResponse
 */ function () {
    return response()->json([
        'message' => 'Page Not Found. Something went wrong in API URL '
    ], 404);
});
