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

  // 获取token
  Route::get('token', 'ArticleController@gettoken');
  //首页显示文章
  Route::get('showblog/{id}', 'IndexController@showblog');
  //文章详情
  Route::get('details/{id}', 'IndexController@detailshow');
  // 获取文章作者信息
  Route::get('author/{id}', 'IndexController@author');

  // //点赞表修改
  Route::post('supports', 'GoodupController@addgoodup');
  // 文章点赞数的添加
  Route::post('addagree', 'ArticleController@addagree');
  // 差评数
  Route::post('addnegative', 'ArticleController@addnegative');
  // // 获取点赞信息
  // Route::get('condition/{id}', 'GoodupController@condition');
  // // 获取对应的文章状态
  // Route::get('blogstate/{id}/{blogid}', 'GoodupController@blogstate');


// 文章评论
Route::post('comment', 'CommentController@addcomment');
// 获取文章评论
Route::get('getcomment/{id}','CommentController@viewcomment');
// 添加文章评论数
Route::post('addcommentnum','CommentController@addcommentnum');

// 关注
Route::post('follows', 'FollowController@addfollow');
// 取消关注
Route::post('cancel', 'FollowController@cancelfollow');
// 判断是否关注
Route::get('isfollow/{myid}/{bloguserid}', 'FollowController@isfollow');

// 收藏
Route::post('collection', 'CollectController@addcollect');
// 增加收藏数量
Route::post('addcollenumber', 'CollectController@addcollenumber');
// 个人收藏
Route::get('personalcolle/{id}', 'CollectController@personalcolle');


// 修改个人信息
Route::get('Personalnews/{id}', 'UserController@editPersonalnews');