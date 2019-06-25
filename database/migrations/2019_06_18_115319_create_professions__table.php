<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professions', function (Blueprint $table) {
            $table->increments('pro_id');
            $table->string('pro_name',64)->index()->default('')->comment('专业的名称');
            $table->string('teacher_ids',60)->nullable()->default('')->comment('任课老师的ids');
            $table->text('pro_desc')->nullable()->comment('专业简介');
            $table->string('cover_img',100)->nullable()->default('')->comment('封面图');
            $table->string('carousel_imgs',100)->nullable()->default('')->comment('轮播图片');
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
        Schema::dropIfExists('professions_');
    }
}
