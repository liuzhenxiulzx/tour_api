<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Validator;
use App\Models\Article;

class ArticleController extends Controller
{
    public function pushblog(Request $req){
         // 表单验证
         $Validators = Validator::make($req->all(),[
            'user_id'=>'required',
            'content'=>'required|max:10000',
        ]);

        // 失败返回的数据
        if($Validators->fails()){
            // 获取错误信息
            $errors = $Validators->errors();
            // 返回json对象以及状态码
            return error($errors,422);
        }

        // 把数据插入数据库
        $userdata = Article::create([
            'user_id'=>$req->user_id,
            'content'=>$req->content,
        ]);

        //成功返回的数据
        return success($userdata);

    }
}
