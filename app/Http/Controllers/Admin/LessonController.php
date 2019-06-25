<?php

namespace App\Http\Controllers\Admin;

use app\Libs\ResponseJson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LessonRepository;
use App\Repositories\CourseRepository;
use App\Repositories\TeacherRepository;

class LessonController extends Controller
{
    //仓库
    protected $lessonRepository;
    protected $courseRepository;
    protected $teacherRepository;

    //构造函数
    public function __construct(LessonRepository $lessonRepository,CourseRepository $courseRepository,TeacherRepository $teacherRepository)
    {
        $this->lessonRepository = $lessonRepository;
        $this->courseRepository = $courseRepository;
        $this->teacherRepository = $teacherRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $whereData = [
            'course_id' => !empty($request->get('course_id')) ? $request->get('course_id') : '',
            'lesson_name' => !empty($request->get('lesson_name')) ? $request->get('lesson_name') : ''
        ];

        //dump($whereData);
        $pathInfo = $this->lessonRepository->getCurrentPathInfo();
        $lesson = $this->lessonRepository->getLesson($whereData);
        $tree = $this->courseRepository->getCourseWithProfession();
        $count = $this->lessonRepository->count($whereData);
        //遍历数据添加老师信息
        $lessons = $this->lessonRepository->addTeacherInfo($lesson);

        //dump($lessons);
        return view('admin.lesson.index',compact('pathInfo','lessons','count','tree','whereData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = $this->courseRepository->getCourseNameId();
        $tree = $this->courseRepository->getCourseWithProfession();
        $teachers = $this->teacherRepository->GetTeacherWithProfession();
        $lesson = '';
        return view('admin.lesson.create',compact('tree','teachers','lesson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'course_id' => $request->get('course_id'),
            'cover_img' => $request->get('cover_img'),
            'lesson_duration' => $request->get('lesson_duration'),
            'lesson_name' => $request->get('lesson_name'),
            'teacher_ids' => json_encode($request->get('teacher_ids')),
            'video_address' => $request->get('video_address'),
            'lesson_desc' => $request->get('lesson_desc')
        ];
        
        //课时资料保存到数据库内
        if($this->lessonRepository->CommonSave($data)){
            return ResponseJson::JsonData(config('code.success'),config('code.msg.6000')); 
        };
        return ResponseJson::JsonData(config('code.error'),config('code.msg.6001'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tree = $this->courseRepository->getCourseWithProfession();
        $teachers = $this->teacherRepository->GetTeacherWithProfession();
        $lesson = $this->lessonRepository->CommonFirst($id);
        //dump($lesson);
        return view('admin.lesson.edit',compact('tree','teachers','lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'course_id' => $request->get('course_id'),
            'teacher_ids' => json_encode($request->get('teacher_ids')),
            'lesson_name' => $request->get('lesson_name'),
            'lesson_duration' => $request->get('lesson_duration'),
            'cover_img' => $request->get('cover_img'),
            'video_address' => $request->get('video_address'),
            'lesson_desc' => $request->get('lesson_desc')
        ];
        
        //图片是否修改 && 视频是否修改
        $i = $this->lessonRepository->UpdateImageVideoDeleteResourse($request->cover_img,$id,'img');
        $v = $this->lessonRepository->UpdateImageVideoDeleteResourse($request->video_address,$id,'video');
        
        return $this->lessonRepository->CommonUpdate($id,$data) ?
                ResponseJson::JsonData(config('code.success'),config('code.msg.6002')):
                ResponseJson::JsonData(config('code.error'),config('code.msg.6003'));
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = $this->lessonRepository->CommonFirst($id);
        // dump($lesson->cover_img);
        //删除图片视频资源
        $i = $this->lessonRepository->DeleteImageVideo($lesson->cover_img,'img');
        $v = $this->lessonRepository->DeleteImageVideo($lesson->video_address,'video');
       
        return $this->lessonRepository->CommonDelete($id) ?
                ResponseJson::JsonData(config('code.success'),config('code.msg.6004')):
                ResponseJson::JsonData(config('code.error'),config('code.msg.6005'));
    }

}
