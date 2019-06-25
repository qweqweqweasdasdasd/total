<?php

namespace App\Repositories;

use App\Teacher;


class TeacherRepository extends BaseRepository
{
    //构造函数
    public function __construct()
    {
        $this->table = 'teachers';
        $this->id = 'teacher_id';
    }

    //获取老师的id和名称包含专业
    public function GetTeacherWithProfession()
    {
        return Teacher::get(['teacher_id','teacher_name']);
    }

}
