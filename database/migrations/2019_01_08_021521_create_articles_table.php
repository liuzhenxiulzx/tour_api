<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->string('content')->comment('文章内容');
            $table->string('article_img')->comment('文章图片');
            $table->unsignedInteger('comment_number')->default(0)->comment('文章评论数');
            $table->unsignedInteger('goods_number')->default(0)->comment('点赞数');
            $table->enum('is_collect',['0','1'])->default(0)->comment('是否收藏');
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
        Schema::dropIfExists('articles');
    }
}
