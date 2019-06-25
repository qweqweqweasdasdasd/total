<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'course_id';
	protected $table = 'courses';
    protected $fillable = [
    	'pro_id','course_name','course_price','course_desc','cover_img'
    ];

    //课程对专业 (一对一)
    public function profession()
    {
        return $this->hasOne('App\Profession','pro_id','pro_id')->orderBy('pro_id','desc');
    }

    
}
