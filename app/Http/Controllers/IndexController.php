<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Goodup;
use App\Models\Users;
use App\Models\Collections;

class IndexController extends Controller
{
    //首页显示
    public function showblog(Request $req,$id){
       $blog = Article::orderBy('id', 'DESC')->get();
       $goodup = Goodup::where('upuser_id',$id)->get();
 
       foreach($blog as $key=>$v)
       {
            foreach($goodup as $key2=>$b)
            {
                if($v->id == $b->article_id)
                {
                    $blog[$key]['goodup'] = $b;
                }
            }
       } 
       foreach($blog as $k)
       {
           $k->blogauthor;
       }
       
       return success($blog);
    }

    // 文章详情
    public function detailshow($id){
        
        $details = Article::where('id',$id)->first();
        $goodup = Goodup::where('article_id',$id)->get();
        $collections = Collections::where('article_id',$id)->get();
        // dd($collections);
        // 将对应的点赞表数据放入details中并返回
        foreach($goodup as $key2=>$b)
        {
            if($details->id == $b->article_id)
            {
                $details['goodup'] = $b;
            }
        }
        // 将对应的收藏表数据放入details中并返回
        foreach($collections as $key=>$v)
        {
            if($details->id == $v->article_id)
            {
                $details['collections'] = $v;
            }
        }
        
        return success($details);
        
    }

    // 获取文章作者信息
    public function author($id)
    {
        $data = Users::where("id",$id)->first();
        return success($data); 
    }

    // 点赞
    public function addcommentnum(Request $req)
    {
        $Validators = Article::make($req->all(),[
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
