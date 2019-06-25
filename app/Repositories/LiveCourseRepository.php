<?php

namespace App\Repositories;

use App\Stream;
use App\LiveCourse;

class LiveCourseRepository extends BaseRepository
{
    //构造函数
    public function __construct()
    {
        $this->table = 'live_course';
        $this->id = 'id';
    }

    //获取到直播课程
    public function getLiveCourse()
    {
        return LiveCourse::with('stream')->get();
    }

    //获取到直播课程名称和id
    public function getLiveCoursePluck()
    {
        return Stream::orderBy('stream_id','desc')->get(['p_name','stream_id']);
    }
}
