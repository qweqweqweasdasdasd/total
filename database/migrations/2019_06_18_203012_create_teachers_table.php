<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('teacher_id');
            $table->string('teacher_name',64)->default('')->comment('老师名称');
            $table->string('teacher_phone',64)->default('')->comment('手机号码');
            $table->string('teacher_city',125)->default('')->comment('城市');
            $table->string('teacher_address',125)->default('')->comment('地址');
            $table->string('teacher_company',125)->default('')->comment('公司');
            $table->string('teacher_email',125)->default('')->comment('老师邮箱');
            $table->string('teacher_pic',64)->default('')->comment('老师头像');
            $table->text('teacher_desc',125)->comment('老师描述');
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
        Schema::dropIfExists('teachers');
    }
}
