<?php

namespace App\Http\Controllers\Server;

use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    /**
     * 视频播放
     */
    public function play($lesson_id)
    {
        $lesson = Lesson::find($lesson_id);
        //dump($lesson);
        return view('admin.lesson.video',compact('lesson'));
    }
}
