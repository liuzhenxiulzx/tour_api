<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goodup;
use Validator;

class GoodupController extends Controller
{
    public function addgoodup(Request $req){
         // 表单验证
         $Validators = Validator::make($req->all(),[
            'article_id'=>'required',
            'upuser_id'=>'required',
            'isgoodup'=>'required',
        ]);

        // 失败返回的数据
        if($Validators->fails()){
            // 获取错误信息
            $errors = $Validators->errors();
            // 返回json对象以及状态码
            return error($errors,422);
        }

        // 把数据插入数据库
        $goodups = Goodup::create([
            'article_id'=>$req->article_id,
            'upuser_id'=>$req->upuser_id,
            'isgoodup'=>$req->isgoodup,
        ]);

        //成功返回的数据
        return success($goodups);
    }
}
