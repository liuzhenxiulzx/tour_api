<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
         // 对应的表名
         protected $table = 'follows';
         // 是否有时间字段
         public $timestamps = true;
         // 设置允许填充的字段
         protected $fillable = ['my_id','other_id'];
}
