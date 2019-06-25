<?php

namespace App\Http\Controllers\Admin;

use App\Stream;
use App\LiveCourse;
use app\Libs\ResponseJson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LiveCourseRepository;

class LiveCourseController extends Controller
{
    //仓库
    protected $liveCourseRepository;

    //构造函数
    public function __construct(LiveCourseRepository $liveCourseRepository)
    {
        $this->liveCourseRepository = $liveCourseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pathInfo = $this->liveCourseRepository->getCurrentPathInfo();
        $liveCourse = $this->liveCourseRepository->getLiveCourse();
        //dump($liveCourse);
        return view('admin.livecourse.index',compact('pathInfo','liveCourse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $liveCourse = $this->liveCourseRepository->getLiveCoursePluck();
        //dump($liveCourse);
        return view('admin.livecourse.create',compact('liveCourse'));
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
            'name' => $request->get('name'),
            'stream_id' => $request->get('stream_id'),
            'cover_img' => $request->get('cover_img'),
            'start_at' => strtotime($request->get('start_at')),
            'end_at' => strtotime($request->get('end_at')),
            'desc' => $request->get('desc')
        ];

        if($this->liveCourseRepository->CommonSave($data)){
            return ResponseJson::JsonData(config('code.success'),config('code.msg.8000')); 
        };
        return ResponseJson::JsonData(config('code.error'),config('code.msg.8001'));
    }

    /**
     * 获取到推流的地址--用户推流事件
     * get
     * rtmp://publish-rtmp.test.com/PiliSDKTest/streamkey?e=1463023142&token=7O7hf7Ld1RrC_fpZdFvU8aCgOPuhw2K4eapYOdII:-5IVlpFNNGJHwv-2qKwVIakC0ME=
     *   - 用户推流触发 getpush
     *   - 匹配数据库：房间名是否匹配/用户密码是否匹配/用户的推流密码是md5(房间号+登录密码)
     *   - 匹配成功修改房间status为1，标注正在直播，如果已经在推流，则不允许再次推流
     */
    public function getpush(Request $request,$liveCourse,$stream)
    {
        $liveCourse = LiveCourse::find($liveCourse);
        $stream     = Stream::find($stream);
        
        //组装发送数据
        $d = [
            'host' => 'publish-rtmp.test.com',
            'space' => 'itcast009',
            'liuname' => $stream->p_name,
            'e' => $liveCourse->end_at
        ];
        
        //制作鉴权  path = "/<Hub>/<StreamKey>?e=<ExpireAt>"
        $path = "/{$d['space']}/{$d['liuname']}?e={$d['e']}";
        $ak = config('filesystems.disks.qiniu.access_key');
        $sk = config('filesystems.disks.qiniu.secret_key');
        $auth = new \Qiniu\Auth($ak,$sk);
        $token = $auth->sign($path);
        
        //拼接推流地址
        return "rtmp://{$d['host']}/{$d['space']}/{$d['liuname']}?e={$d['e']}&token={$token}";
    }

    /**
     * 用户直播结束的回调事件
     *   - 用户直播结束后，将status设置成0，标注该房间未在推流
     * @param Request $request
     */
    function publishDone(Request $request)
    {
        
    }

    /**
     * 直播播放
     * rtmp://live-rtmp.test.com/PiliSDKTest/streamkey
     * ckplay
     */
    public function play(Request $request)
    {
        $space = 'itcast009';
        $pullurl = "rtmp://live-rtmp.test.com/{$space}/{$stream->stream_name}";

        return $pullurl;
    }

    /**
     * 用户结束观看直播的回调事件
     * @param Request $request
     */
    function playDone(Request $request)
    {
        
    }

    /**
     * 对正在直播的直播间进行视频流截图
     * - 运行system linux命令
     * - 保存的名称就是直播间的guid的名称
     * - 覆盖掉之前的文件
     */
    function ffmpegPhoto()
    {
       
    }
}
