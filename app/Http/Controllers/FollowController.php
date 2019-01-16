<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follows;
use Validator;
class FollowController extends Controller
{
    // 添加关注
    public function addfollow(Request $req){
        // 表单验证
       $Validators = Validator::make($req->all(),[
            'my_id'=>'required',
            'other_id'=>'required',
        ]);

        // 失败返回的数据
        if($Validators->fails()){
            // 获取错误信息
            $errors = $Validators->errors();
            // 返回json对象以及状态码
            return error($errors,422);
        }

        // 判断是否关注过
        $follow = Follows::where('my_id',$req->my_id)
                            ->where('other_id',$req->other_id)
                            ->first();
            
        if($follow){

            return error('existence',422);

        }else{

            $data = Follows::create([
                'my_id'=>$req->my_id,
                'other_id'=>$req->other_id,
            ]);
            //成功返回的数据
             return success($data);

        }

       

        
    }


    public function cancelfollow(Request $req){
        $follow = Follows::where('my_id',$req->my_id)
                            ->where('other_id',$req->other_id)
                            ->first();
        if($follow){
            $data = $follow->delete();
            return success(1);
        }
      
    }


}