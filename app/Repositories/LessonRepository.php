<?php

namespace App\Repositories;

use App\Lesson;
use App\Teacher;


class LessonRepository extends BaseRepository
{
    //构造函数
    public function __construct()
    {
        $this->table = 'lessons';
        $this->id = 'lesson_id';
    }

    //获取到课时数据
    public function getLesson($whereData)
    {
        return Lesson::where(function($query) use($whereData){
                    if( !empty($whereData['course_id']) ){
                        $query->where('course_id',$whereData['course_id']);
                    }

                    if( !empty($whereData['lesson_name']) ){
                        $query->where('lesson_name',$whereData['lesson_name']);
                    }
                })
                ->orderBy('lesson_id','desc')
                ->with('course')
                ->paginate(7);
    }

    //获取到课时总数
    public function count($whereData)
    {
        return Lesson::where(function($query) use($whereData){
                    if( !empty($whereData['course_id']) ){
                        $query->where('course_id',$whereData['course_id']);
                    }
                })->count();
    }

    //添加老师信息属性
    public function addTeacherInfo($lesson)
    {   
        //遍历老师信息添加到数据内
        foreach ($lesson as $k => $v) {
            $lesson[$k]->teacherInfo = Teacher::whereIn('teacher_id',json_decode( $v->teacher_ids))->get(['teacher_id','teacher_name']);
        }
        return $lesson;
    }
}
