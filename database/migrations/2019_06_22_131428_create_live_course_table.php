<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_course', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',64)->index()->comment('直播课程名称');
            $table->integer('stream_id')->comment('归属直播流');
            $table->char('cover_img',100)->comment('直播课程名称');
            $table->integer('start_at')->comment('开播时间');
            $table->integer('end_at')->comment('结束时间');
            $table->string('desc',255)->default('')->comment('描述');
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
        Schema::dropIfExists('live_course');
    }
}
