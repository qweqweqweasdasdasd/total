<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Mail\Wymail;
use app\Libs\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Repositories\ManagerRepository;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CheckManagerRequest;

class LoginController extends Controller
{
    
    //仓库
    protected $managerRepository;
    
    //构造函数
    public function __construct(ManagerRepository $managerRepository)
    {
        $this->managerRepository = $managerRepository;
    }

    //后台管理--登录显示
    public function index()
    {
        if(Auth::guard('admin')->check()){
            return redirect('/admin/index');
        }
        return view('admin.login.index');
    }

    //后台管理--登录逻辑
    public function login(CheckManagerRequest $request)
    {
        //auth认证是否存在
        $credentials = $request->only(['mg_name','password']);
        if(!(Auth::guard('admin')->attempt($credentials))){
            return ResponseJson::JsonData(config('code.error'),config('code.msg.1000'));
        }
        $manager = Auth::guard('admin')->user();
        
        //判定当前用户状态为
        if(!$this->CheckManagerStatus($manager)){
            return ResponseJson::SuccessJsonResponse(['href' => '/admin/login']);
        }
        //sso中间件
        
        //记录用户ip地址和最后一次登录时间和记录登录次数
        $this->CreateIpAndLastLoginTimeAndCounts($manager);
        return ResponseJson::SuccessJsonResponse(['href' => '/admin/index']);
    }

    //后台管理--退出登录
    public function logout()
    {
        Auth::guard('admin')->logout();  
        return redirect('/admin/login');
    }
    
    //后台管理--忘记密码
    public function sendsmsTo(Request $request)
    {
        if($request->isMethod('post')){
            //接受数据
            $form_data = $request->all();
            
            //数据校验
            $rules = [
                'mg_name' => 'required|min:2,max:16',
                'email' => 'required|email'
            ];

            //自定义错误信息
            $notices = [
                'mg_name.required' => '管理员必须存在',
                'mg_name.min' => '管理员不得小于2个字符',
                'mg_name.max' => '管理员不得超出16个字符',
                'email.required' => '邮箱必须存在',
                'email.email' => '邮箱的格式不对'
            ];

            $validator = Validator::make($form_data,$rules,$notices);
            if(!$validator->passes()){
                $errorinfo = collect($validator->messages())->implode('0','|');
                return ResponseJson::JsonData(config('code.error'),$errorinfo);
            }

            //获取到当前管理员信息
            $manager = $this->managerRepository->ManagerByMgAddConfirmationToken($form_data['mg_name']);
            if(is_null($manager)){
                return ResponseJson::JsonData(config('code.error'),config('code.msg.1001'));
            }
            //给管理员发送邮件
            (new Wymail)->sendMailTo($manager);
            
            return ResponseJson::JsonData(config('code.error'),config('code.msg.1003'));
        }
        return view('admin.login.sendsmsTo');
    }

    //提交表单修改密码
    public function findPassword(Request $request)
    {
        if($request->isMethod('post')){
            $confirmation_token = $request->get('confirmation_token');
            $password = $request->get('password');
            if(empty($password)){
                return ResponseJson::JsonData(config('code.error'),config('code.msg.1006'));
            }
            $mg = $this->managerRepository->confirmationTokenByMg($confirmation_token);
            
            $mg->password = Hash::make($password);
            $mg->confirmation_token = str_random(40);
            $mg->save();

            return ResponseJson::SuccessJsonResponse(['href' => '/admin/login']);
        }
        $confirmation_token = $request->get("confirmation_token");
        return view('admin.login.findpassword',compact('confirmation_token'));
    }

    //通过邮箱找回密码
    public function confirmation(Request $request)
    {
        $confirmation_token = !empty($request->get('token'))?$request->get('token'):'';
        
        //携带参数不全
        if(empty($confirmation_token)){
            return ResponseJson::JsonData(config('code.error'),config('code.msg.1004'));
        }
        
        $confirmationTokenExist = $this->managerRepository->confirmationTokenExist($confirmation_token);
        //token 不存在
        if(!$confirmationTokenExist){
            return ResponseJson::JsonData(config('code.error'),config('code.msg.1005'));
        }

        return redirect()->route('findpassword',['confirmation_token'=>$confirmation_token]);
    }

    //判定当前用户状态
    protected function CheckManagerStatus($manager)
    {
        if($manager->status == 1){
            return true;
        }elseif($manager->status == 2){
            return false;
        }

    }

    //记录用户ip地址和最后一次登录时间和记录登录次数
    protected function CreateIpAndLastLoginTimeAndCounts($manager)
    {
        $manager->ip = request()->ip();
        $manager->last_login_time = date('Y-m-d H:i:s',time());

        return $manager->increment('login_counts',1) && $manager->save();
    }

}
