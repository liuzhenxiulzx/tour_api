<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     // 对应的表名
     protected $table = 'comments';
     // 是否有时间字段
     public $timestamps = true;
     // 设置允许填充的字段
     protected $fillable = ['article_id','comuser_id','comment'];

     public function comentuser(){
          return $this->belongsTo(Users::class,'comuser_id');
       }
}
