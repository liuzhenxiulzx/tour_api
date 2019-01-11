<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // 对应的表名
    protected $table = 'articles';
    // 是否有时间字段
    public $timestamps = true;
    // 设置允许填充的字段
    protected $fillable = ['user_id','content','article_img','comment_number','goods_number','is_collect'];

    public function goodups(){
        return $this->hasMany(goodup::class,'article_id');
     }

}
