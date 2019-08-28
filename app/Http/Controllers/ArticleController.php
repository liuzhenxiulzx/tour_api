<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Validator;
use App\Models\Article;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Image;
use Storage;

class ArticleController extends Controller
{
    // 图片上传token
    public function gettoken(){
        $accessKey = 'MTdzBcP66AhXwzrKzf2nDT2gOjrft0wYZc9FwXYW';   // 访问KEY
        $secretKey = '_PZctlny0U_TfoAWar-av-a8L3ma03W9gMZmgkxz';   // 密钥KEY
        $domain = 'qiniuyun.liuzhenxiu.cn';       // 访问域名
        // 配置参数
        $bucketName = 'tour-app';   // 创建的 bucket(新建的存储空间的名字)

        $upManager = new UploadManager();

        // 登录获取令牌
        $auth = new Auth($accessKey, $secretKey);
        $token = $auth->uploadToken($bucketName);

        return success($token);
    }

    // 文章发表
    public function pushblog(Request $req){
         // 表单验证
         $Validators = Validator::make($req->all(),[
            'user_id'=>'required',
            'content'=>'required|max:10000',
            'article_img'=>'required'
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
            'article_img'=>$req->article_img
        ]);
        //成功返回的数据
        return success($req->userdata);
        

    }

    //文章点赞数量的添加
    public function addagree(Request $req){
        $article = Article::where('id',$req->id)->first();
        $article->goods_number = $req->goods_number;
        $article->save();
        return success($article);
    }
    //文章差评数量的添加
    public function addnegative(Request $req){
        $article = Article::where('id',$req->id)->first();
        $article->negative_comment = $req->negative_comment;
        $article->save();
        return success($article);
    }

    //添加收藏数量
    public function addcollenumber(Request $req)
    {   
        $data = Article::where('id',$req->id)->first();
        $data->collect_number = $req->collect_number;
        $data->save();
        return success($data);
    }

    //获取我的文章
    public function myarticle(Request $req, $id)
    {   
        $data = Article::where('user_id',$id)->orderBy('created_at', 'DESC')->get();
        return success($data);
    }

}
