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
  // 文章点赞
  Route::post('addagree/{id}', 'ArticleController@addagree');
  // 获取token
  Route::get('token', 'ArticleController@gettoken');
  //首页显示文章
  Route::get('showblog', 'IndexController@showblog');
  //文章详情
  Route::get('details/{id}', 'IndexController@detailshow');
  //点赞表修改
  Route::post('supports', 'GoodupController@addgoodup');