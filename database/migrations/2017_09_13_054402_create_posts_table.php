<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('caption')->nullable();
            $table->string('caption_bg')->nullable();
            $table->string('username');
            $table->integer('user_id');
            $table->integer('photo_id')->default(0);
            $table->integer('avatar_id')->default(0);
            $table->integer('cover_id')->default(0);
            $table->integer('audio_id')->default(0);
            $table->integer('video_id')->default(0);
            $table->integer('comment_hide')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
