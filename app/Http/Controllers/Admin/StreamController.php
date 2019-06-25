<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\StreamRepository;

class StreamController extends Controller
{
    //仓库
    protected $streamRepository;

    //构造函数
    public function __construct(StreamRepository $streamRepository)
    {
        $this->streamRepository = $streamRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $streams = $this->streamRepository->getStream();
        $pathInfo = $this->streamRepository->getCurrentPathInfo();
        
        return view('admin.stream.index',compact('pathInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stream.create');
    }

    /**
     * 创建一个直播流
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StreamRequest $request)
    {
        $shuju = [
            'stream_name' => $request->input('stream_name','')
        ];

        $space = 'itcast009';                           //直播空间的名称
        $method = 'POST';                               //请求方式
        $path = "/v2/hubs/{$space}/streams";            //请求的地址
        $host = 'pili.qiniuapi.com';                    //请求的域名
        $contentType = 'application/json';              //请求体数据类型

        $body = json_encode([
            'key' => $shuju['stream_name'],             //直播流的名称,json字符串体现
        ]);
        
        //鉴权
        $sign = "$method $path\nHost: $host\nContent-Type $contentType\n\n$body";
        $ak = config('filesystems.disks.qiniu.access_key');
        $sk = config('filesystems.disks.qiniu.secret_key');
        $auth = new \Qiniu\Auth($ak,$sk);
        $token = 'Qiniu '.$auth->sign($sign);
        
        //guzzle请求
        $guzzle = new \GuzzleHttp\Client();
        $res = $guzzle->request($method,$host.$path,[
            'headers' => [
                'User-Agent' => 'pili-sdk-go/v2 go1.6 darwin/amd64',
                'Content-Length' => strlen($body),
                'Authorization' => $token,
                'Content-Type' => $contentType,
                'Accept-Encoding' => 'gzip'
            ],
            'body' => $body
        ]);
        
        //请求返回体
        $code = $res->getStatusCode();  //返回的信息
        if($code == 200){
            //保存直播流信息
            return $this->streamRepository->CommonSave($request->all()) ? 
                    ResponseJson::JsonData(config('code.success'),config('code.msg.7000')):
                    ResponseJson::JsonData(config('code.error'),config('code.msg.7001'));
        }elseif($code == 614){
            //返回错误信息
            return ResponseJson::JsonData(config('code.error'),config('code.msg.7002'));
        }
        return ResponseJson::JsonData(config('code.error'),config('code.msg.7001'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
