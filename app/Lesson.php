<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $primaryKey = 'lesson_id';
	protected $table = 'lessons';
    protected $fillable = [
    	'course_id','lesson_name','cover_img','video_address','lesson_desc','lesson_duration'
    ];

    //课时与课程一对一关系
    public function course()
    {
        return $this->hasOne('App\Course','course_id','course_id');
    }
    
}
