<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collections;
use App\Models\Article;
use Validator;

class CollectController extends Controller
{
    public function addcollect(Request $req){
       // 表单验证
       $Validators = Validator::make($req->all(),[
        'article_id'=>'required',
        'user_id'=>'required',
        // 'iscollection'=>'iscollection',
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

            $iscollect->iscollection = $req->iscollection;
            $iscollect->save();
            return success($iscollect);
        }
        else
        {
            $data = Collections::create([
                'article_id'=>$req->article_id,
                'user_id'=>$req->user_id,
                'iscollection'=>$req->iscollection,
            ]);
    
            //成功返回的数据
            return success($data);
        }
    }


    // //添加收藏数量
    // public function addcollenumber(Request $req)
    // {   
    //     $data = Article::where('id',$req->id)->first();
    //     $data->collect_number = $req->collect_number;
    //     $data->save();
    //     return success($data);
    // }

    // 个人收藏
    public function personalcolle(Request $req,$id)
    {
        $data = Collections::where('user_id',$id)->orderBy('created_at', 'DESC')->get();
        foreach($data as $v)
        {
            $v->collet;
        }
        return success($data);
    }


}
