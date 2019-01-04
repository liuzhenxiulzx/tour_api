<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// 注册
Route::post('members', 'UserController@regist');
// 登录
Route::post('authorizations', 'UserController@login');

// 需要token的路由组
Route::middleware(['jwt'])->group(function () {

  
});
  // 发表文章
  Route::post('article', 'ArticleController@pushblog');