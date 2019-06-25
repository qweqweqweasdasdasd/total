<?php

namespace App\Repositories;

use App\Course;
use App\Profession;

class CourseRepository extends BaseRepository
{
    //构造函数
    public function __construct()
    {
        $this->table = 'courses';
        $this->id = 'course_id';
    }

    //获取到课程的名称和id
    public function getCourseNameId()
    {
        return Course::orderBy('course_id','desc')->get(['course_name','course_id']);
    }

    //专业和课程的tree
    public function getCourseWithProfession()
    {
        return Profession::with(['course'=>function($query){
                        $query->select('course_id','course_name','pro_id');
                    }])->get(['pro_id','pro_name']);
    }

}
