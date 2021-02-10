<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::middleware('auth:api')->get('/user', 'UserController@AuthRouteAPI');

Route::match(['get','post'], '/', function() {
    $api_name = request()->header('Api-Name');
    //$api_auth = request()->header('Authorization');
    //echo $api_auth; exit;
    if($api_name=='registration')
	{
		//print_r("expressionyruyeruw");exit();
		return app()->call('App\Http\Controllers\api\UserController@create');
	}
	else if($api_name=='login')
	{
		return app()->call('App\Http\Controllers\api\LoginController@login');
	}
    else
	{
		return response()->json(["statusCode"=>417,"status"=>false,"message"=>"Requested Header Mismatch"],417);
	}

});

Route::middleware('auth:api')->get('/alluser', 'api\UserController@index');
/* Route::prefix('/user')->group( function() {

    Route::post('/login', 'api\LoginController@login');
    Route::middleware('auth:api')->get('/alluser', 'api\UserController@index');
    Route::post('/registration', 'api\UserController@create');

}); */
