<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Collections extends Model
{
         // 对应的表名
         protected $table = 'collections';
         // 是否有时间字段
         public $timestamps = true;
         // 设置允许填充的字段
         protected $fillable = ['article_id','user_id'];
}

