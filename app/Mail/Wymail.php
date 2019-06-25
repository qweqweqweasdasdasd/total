<?php
namespace App\Mail;

use Illuminate\Support\Facades\Mail;

class Wymail
{
    protected $ii = '0';
    /**
     * 发送邮件
     */
    public function sendMailTo($manager)
    {
        $name = $manager['mg_name'];
        $token = $manager->confirmation_token;
        // Mail::send()的返回值为空，所以可以其他方法进行判断
        Mail::send('emails.confirmation',['name'=>$name,'route'=>route('confirmation',['token'=>$token])],function($message){
            $to = '2356596937@qq.com';
            $message ->to($to)->subject('管理员密码修改');
        });
        // 返回的一个错误数组，利用此可以判断是否发送成功
        App('log')->info('发送邮件时间'.date('Y-m-d H:i:s',time()).' 状态: '. json_encode(Mail::failures()) );

    }
}