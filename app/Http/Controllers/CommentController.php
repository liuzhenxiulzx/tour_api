<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;
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
        foreach($data as $v)
        {
            $v->comentuser;
        }
        return success($data);
    }

    // 添加文章评论数
    public function addcommentnum(Request $req)
    {
        $Validators = Validator::make($req->all(),[
            'id'=>'required',
            'comment_number'=>'required',
            ]);
    
            // 失败返回的数据
            if($Validators->fails()){
                // 获取错误信息
                $errors = $Validators->errors();
                // 返回json对象以及状态码
                return error($errors,422);
            }

        $data = Article::where('id',$req->id)->first();
        $data->comment_number = $req->comment_number;
        $data->save();

        return success($data);
    }
    
}
