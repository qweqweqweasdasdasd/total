<?php

namespace App\Http\Controllers\Server;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{  
    protected $file = '';           //文件对象
    protected $ext  = '';           //扩展名称
    protected $path = '';           //绝对路径
    protected $filename = '';       //文件名称

    /**
     * 短视频上传   Filedata
     */
    public function video(Request $request)
    {
        $this->file = $request->file('video');

        //调用公共上传的方法
        if($this->commonUpload()){
            return json_encode(['success'=>true,'filename'=>"/storage".$this->filename]);
        }else{
            return json_encode(['success'=>false]);
        }
    }

    /**
     * 封面图片上传
     */
    public function image(Request $request)
    {
        $this->file = $request->file('cover');

        //调用公共上传的方法
        if($this->commonUpload()){
            return json_encode(['success'=>true,'filename'=>"/storage".$this->filename]);
        }else{
            return json_encode(['success'=>false]);
        }
    }

    /**
     * 公用的上传方法
     */
    public function commonUpload()
    {
        if($this->file->isValid()){
            //$rst = $file->store('video','public');
            $this->ext = $this->getExt();         //.mp4
            //获取到图片的绝对路径
            $this->path = $this->RealPath();      //C:\Windows\php6176.tmp
            //定义文件名称
            $this->filename = $this->getFileName();

            //写入public
            return  !!(Storage::disk('public')->put($this->filename, file_get_contents($this->path)));   
        }
        return false;
    }

    /**
     * 定义文件名称
     */
    public function getFileName()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);

        return '/' . $method . date('m') .'/'. date('YmdHis',time()) . '.' .$this->ext;
    }

    /**
     * 获取到上传文件的扩展名称
     */
    public function getExt()
    {
        return $this->file->getClientOriginalExtension();
    }

    /**
     * 获取到图片的绝对路径
     */
    public function RealPath()
    {
        return $this->file->getRealPath();
    }
}
