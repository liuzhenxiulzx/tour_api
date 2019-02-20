<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collections;
use Validator;

class CollectController extends Controller
{
    public function addcollect(Request $req){
               // 表单验证
       $Validators = Validator::make($req->all(),[
        'article_id'=>'required',
        'user_id'=>'required',
        ]);

        // 失败返回的数据
        if($Validators->fails()){
            // 获取错误信息
            $errors = $Validators->errors();
            // 返回json对象以及状态码
            return error($errors,422);
        }

        // 判断是否收藏过
        $iscollect = Collections::where('article_id',$req->article_id)
                                    ->where('user_id',$req->user_id)
                                    ->first();
        if($iscollect){
            return error('existence',400);
        }
        else
        {
            $data = Collections::create([
                'article_id'=>$req->article_id,
                'user_id'=>$req->user_id,
            ]);
    
            //成功返回的数据
            return success($data);
        }

   
    }
}
