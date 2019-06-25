<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('lesson_id');
            $table->integer('course_id')->comment('(归属)课程id');
            $table->string('lesson_name',125)->comment('课时名称');
            $table->string('cover_img',125)->nullable()->default('')->comment('课时封面图');
            $table->string('video_address',128)->comment('播放视频地址');
            $table->text('lesson_desc')->nullable()->comment('视频描述');
            $table->integer('lesson_duration')->nullable()->default(0)->comment('视频分钟数');
            $table->string('teacher_ids',128)->comment('视频讲解老师ids--json');
            $table->engine = 'InnoDB';
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
        Schema::dropIfExists('lessons');
    }
}
