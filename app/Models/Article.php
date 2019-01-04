<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // 对应的表名
    protected $table = 'articles';
     // 是否有时间字段
     public $timestamps = true;
    // 设置允许填充的字段
    protected $fillable = ['user_id','content'];
}
