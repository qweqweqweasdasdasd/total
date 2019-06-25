<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveCourse extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'live_course';
    protected $fillable = [
    	'name','stream_id','cover_img','start_at','end_at','desc'
    ];

    //与直播流建立一对一的关系
    public function stream()
    {
        return $this->hasOne('App\Stream','stream_id','stream_id');
    }
}
