<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Validator;
class CommentController extends Controller
{
    // 写评论
    public function addcomment(Request $req){
       // 表单验证
       $Validators = Validator::make($req->all(),[
            'article_id'=>'required',
            'comuser_id'=>'required',
            'comment'=>'required',
        ]);

        // 失败返回的数据
        if($Validators->fails()){
            // 获取错误信息
            $errors = $Validators->errors();
            // 返回json对象以及状态码
            return error($errors,422);
        }

        $data = Comment::create([
            'article_id'=>$req->article_id,
            'comuser_id'=>$req->comuser_id,
            'comment'=>$req->comment,
        ]);

        //成功返回的数据
        return success($data);
    }

    // 查看评论
    public function viewcomment(Request $req,$id){
        $data = Comment::where('article_id',$id)->get();
        return success($data);
    }
    
}
