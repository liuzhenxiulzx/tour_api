<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Goodup;

class IndexController extends Controller
{
    //首页显示
    public function showblog(Request $req){
       $blog = Article::orderBy('id', 'DESC')->get();
       foreach($blog as $v){
           $v->goodups;
       }
       return success($blog);
    }

    // 文章详情
    public function detailshow($id){
        
        $details = Article::where('id',$id)->first();
        return success($details);
        
    }



}
