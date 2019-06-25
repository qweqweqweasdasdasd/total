<?php
namespace App\Repositories;

use DB;
use Storage;
use App\Lesson;

class BaseRepository 
{
    //更新图片视频判断  $type = 'img' || 'video'
    public function UpdateImageVideoDeleteResourse($path,$id,$type)
    {
        $field = $type == 'img' ? $field = 'cover_img' : $field = 'video_address';
        $first = Lesson::find($id);
        // dd($path);
        // dd($first->$field);
        //数据库存在该资源
        if($first->$field !== $path){
            if(file_exists('./'.$first->$field)){
                $p = str_replace('/storage/','',$first->$field);
                $first->$field = '';
                $first->save();
                return Storage::disk('public')->delete($p);
            }
        }
        return true;
    }

    //删除图片视频资源
    public function DeleteImageVideo($path,$type)
    {
        $field = $type == 'img' ? $field = 'cover_img' : $field = 'video_address';
        if(file_exists('./'.$path)){
            $p = str_replace('/storage/','',$path);
            
            return  Storage::disk('public')->delete($p);
        }
    }

    //公共更新方法
    public function CommonUpdate($id,$data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s',time());
        
        return !!(DB::table($this->table)->where($this->id,$id)->update($data));
    }

    //公共创建方法
    public function CommonSave($d)
    {
        $d['created_at'] = date('Y-m-d H:i:s',time());
        
        return !!(DB::table($this->table)->insert($d));
    }

    //公共方法获取一条数据
    public function CommonFirst($id)
    {
        return DB::table($this->table)->where($this->id,$id)->first();
    }

    //公共方法删除指定数据
    public function CommonDelete($id)
    {
        return DB::table($this->table)->where($this->id,$id)->delete();
    }

    //获取当前的模型
    public function getCurrentPathInfo()
    {
        $class = strtolower($this->getCurrentAction()['class']);
        $method = $this->getCurrentAction()['method'];
        $list = str_replace('controller','',explode('\\',$class));
        
        return ['model'=>$list[3],'controller'=>$list[4],'method'=>$method];
    }
    //获取到当前控制器和方法
    public function getCurrentAction()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);
        
        return ['class'=>$class,'method'=>$method];
    }
}
