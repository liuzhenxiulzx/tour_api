<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    // 对应的表名
    protected $table = 'users';
    // 是否有时间字段
    public $timestamps = true;
    // 设置允许填充的字段
    protected $fillable = ['username','password','phone', 'header'];
    // 需要隐藏的字段
    protected $hidden = ['password','updated_at','created_at'];
}
