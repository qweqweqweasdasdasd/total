<?php
/**
 * 后台管理路由
 */
Route::get('/login','Admin\LoginController@index');                         //后台管理--登录显示
Route::post('/login','Admin\LoginController@login')->name('login');         //后台管理--登录逻辑
Route::get('/logout','Admin\LoginController@logout');                       //后台管理--退出登录
Route::match(['get','post'],'/sendsmsTo','Admin\LoginController@sendsmsTo')->name('admin.sendsmsTo');       //后台管理--忘记密码
Route::get('/confirmation','Admin\LoginController@confirmation')->name('confirmation');                     //后台管理--实现密码修改
Route::match(['get','post'],'/findPassword','Admin\LoginController@findpassword')->name('findpassword');    //提交表单修改密码

//RBAC 权限鉴定(当前管理员是否)
Route::group(['middleware' => ['auth:admin','RBAC']],function(){
    
    Route::get('/index','Admin\IndexController@index');             //后台管理--后台主页
    Route::get('/welcome','Admin\IndexController@welcome');         //后台管理--欢迎页面

    Route::resource('/manager','Admin\ManagerController');          //后台管理--管理员路由
    Route::post('/reset','Admin\ManagerController@reset');          //后台管理--管理员状态
    Route::match(['get','post'],'/allocation/{manager?}','Admin\ManagerController@allocation'); //后台管理--角色分配
    
    Route::get('/password','Admin\ManagerController@password');      //后台管理--管理员统一密码
    Route::post('/password','Admin\ManagerController@dopassword');   //后台管理--重置密码
    
    Route::resource('/role','Admin\RoleController');                 //后台管理--角色路由
    Route::match(['get','post'],'/role/permission/{role?}','Admin\RoleController@allocation');   //后台管理--权限分配
    
    Route::resource('/permission','Admin\PermissionController');    //后台管理--权限路由

    Route::resource('/outflow','Admin\OutflowController');          //后台管理--出款订单(流出)

    Route::resource('/lesson','Admin\LessonController');            //后台管理--课时管理
    
    Route::get('/video/play/{lesson}','Server\VideoController@play');     //后台管理--播放视频
    Route::post('/upload/video','Server\UploadController@video');         //后台管理--短视频上传
    Route::post('/upload/image','Server\UploadController@image');         //后台管理--封面图上传
    
    Route::resource('/stream','Admin\StreamController');             //后台管理--直播流
    Route::resource('/live/course','Admin\LiveCourseController');    //后台管理--直播课程

    //直播逻辑
    Route::get('/live/course/getpush/{livesourse}/{stream}','Admin\LiveCourseController@getpush');      //后台管理--获取push地址(推流)
    Route::get('/live/course/publishDone/','Admin\LiveCourseController@publishDone');                   //后台管理--推流结束(推流)
    Route::get('/live/course/play/{stream}','Admin\LiveCourseController@play');                         //后台管理--播放
    Route::get('/live/course/playDone','Admin\LiveCourseController@playDone');                          //后台管理--客户端播放结束
    Route::get('/live/course/ffmpegPhoto','Admin\LiveCourseController@ffmpegPhoto');                    //后台管理--截取视频流截图
});


