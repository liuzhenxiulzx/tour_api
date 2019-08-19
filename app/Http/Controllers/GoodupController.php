<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goodup;
use Validator;

class GoodupController extends Controller
{
    // 点赞修改
    public function addgoodup(Request $req){
         // 表单验证
         $Validators = Validator::make($req->all(),[
            'article_id'=>'required',
            'upuser_id'=>'required',
            // 'isgoodup'=>'required',
        ]);

        // 失败返回的数据
        if($Validators->fails()){
            // 获取错误信息
            $errors = $Validators->errors();
            // 返回json对象以及状态码
            return error($errors,422);
        }

        // 判断是否有相同的数据
        $user = Goodup::where('article_id','=',$req->article_id)
                    ->where('upuser_id','=',$req->upuser_id)
                    ->first();
                  
        if($user){

            // 如果存在则修改数据
           $user->isgoodup = $req->isgoodup;
           $user->save();
           return success($user);

        }
        else
        {
            //不存在 把数据插入数据库
            $goodups = Goodup::create([
                'article_id'=>$req->article_id,
                'upuser_id'=>$req->upuser_id,
                'isgoodup'=>$req->isgoodup,
            ]);
            //成功返回的数据
            return success($goodups);

        }
     
        
    }



    // 获取点赞信息
    public function condition($id)
    {
          $data = Goodup::where('upuser_id','=',$id)->get();
          //成功返回的数据
          return success($data);

    }
    // 获取文章对应的点赞状态
    public function blogstate(Request $req,$id,$blogid)
    {
        $data = Goodup::where('upuser_id','=',$id)
                        ->where('article_id','=',$blogid)
                        ->first();
        return success($data);
    }
}
