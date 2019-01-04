<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->comment('用户名称');
            $table->string('header')->comment('用户头像');
            $table->string('password')->comment('密码');
            $table->string('phone',11)->comment('用户手机号');   
            $table->string('email',11)->comment('邮箱');   
            $table->enum('sex',['0','1'])->comment('性别  0:男;1:女'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
