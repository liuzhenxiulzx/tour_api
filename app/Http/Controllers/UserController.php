<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Users;
use App\Models\Follows;
use Illuminate\Support\Facades\Hash; 
use Firebase\JWT\JWT;

class UserController extends Controller
{
    // 注册
    public function regist(Request $req){
        // 表单验证
        $Validators = Validator::make($req->all(),[
            'username'=>'required|min:3|max:8|unique:users',
            'password'=>'required|min:3|max:12|confirmed',
            'phone'=>'required|regex:/^1[34578]\d{9}$/',
        ]);

        // 失败返回的数据
        if($Validators->fails()){
            // 获取错误信息
            $errors = $Validators->errors();
            // 返回json对象以及状态码
            return error($errors,422);
        }

        // 把数据插入数据库
        $userdata = Users::create([
            'username'=>$req->username,
            'header'=>$req->header,
            // bcrypt 使用hase把密码加密
            'password'=>bcrypt($req->password),
            'phone'=>$req->phone,
        ]);

        //成功返回的数据
        return success($userdata);
    }

    // 登录
    public function login(Request $req){
         // 表单验证
         $Validators = Validator::make($req->all(),[
            'username'=>'required|min:3|max:8',
            'password'=>'required|min:3|max:12',
        ]);

         // 失败返回的数据
         if($Validators->fails()){
            // 获取错误信息
            $errors = $Validators->errors();
            // 返回json对象以及状态码
            return error($errors,422);
        }


        // 查询数据库
        $user = Users::select('id','password')->where('username',$req->username)->first();

        if($user)
        {
            if(hash::check($req->password,$user->password))
            {
                // 包用户信息保存到令牌中，并把令牌发给前端
                // 读取密钥
                $key = env('JWT_KEY');
                // 过期时间
                $time = time();
                $expire = $time + env('JWT_EXPIRE');
                // 定义令牌中的数据
                $data = [
                    'iat'=>$time,//当前时间k
                    'exp'=>$expire,//过期时间
                    'id'=>$user->id //用户id
                ];
                //生成令牌
                $jwt = JWT::encode($data,$key);
                //发给前端
                return success([
                    'ACCESS_TOKEN'=>$jwt,
                    'USER_ID'=>$user->id,
                ]);
            }
            else
            {
                return error('密码错误',404);
            }
        }
        else
        {
            return error('用户不存在',403);
        }
    }

    // 修改信息
    public function editPersonalnews(Request $req){
        $user = Users::where('id',$req->id)->first();
        if($req->oldpassword) {            
            if(hash::check($req->oldpassword,$user->password)){
                // 修改数据
                $user->username = $req->username;
                $user->header = $req->header;
                $user->password = bcrypt($req->password);
                $user->phone = $req->phone;
                $user->save();
                return success($user);
             } else {
                  return error('原密码错误',404);
             }
        } else {
            $user->username = $req->username;
            $user->header = $req->header;
            $user->password = bcrypt($req->password);
            $user->phone = $req->phone;
            $user->save();
            return success($user);
        }
    }
    public function personalName(Request $req, $id){
        $data = Users::where('id',$id)->first();
        $mefollow = Follows::where('my_id',$id)->count(); //我关注的
        $followme = Follows::where('other_id',$id)->count(); //关注我的
        $data['mefoolow'] = $mefollow;
        $data['followme'] = $followme;
        return success($data);
    }
    public function backgroundimg(Request $req){
        $user = Users::where('id',$req->id)->first();
        $user->backgroundimg = $req->backgroundimg;
        $user->save();
        return success($user);
    }
}
