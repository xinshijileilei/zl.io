<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Admin;
use think\Session;

class Login extends Controller {
    
    /*
     * 登录页面
     * */
    public function Login() {       
        return $this -> fetch();    
    }
    
    /*
     * 验证登录是否成功
     * */
    public function checkLogin()
    {
        //设置status
        $status = 0;//先默认登录不成功的状态
        
        //获取一下表单数据，并保存到变量中
        $data = input("param.");//返回数组
        
        $username = $data['admin_username'];
        $password = MD5($data['admin_password']);
        
        //在admin表中进行查询：以用户名为条件
        $map = ['admin_username'=>$username];
        //select * from admin where name=‘$username’
        $admin = Admin::get($map);
        
        //验证用户名和密码
        if(is_null($admin)){
            $message = '用户名不正确！';
        }else if($admin->admin_password != $password){
            $message = '用户密码不正确';
        }else{
            $status = 1;
            $message = '登录成功';
            
            //改变登录次数
            $admin -> setInc('login_count');
            //最后一次登录时间
            $admin ->save(['last_time'=>time()]);
            
            //将用户登录信息保存到session中，供其他控制器，进行登录判断
            Session::set("user_id",$username,"Admin");
            Session::set("user_info",$admin->toArray(),"Admin");
        }
        return ["status"=>$status,"message"=>$message];
    }
    
    /*
     * 退出登录
     * */
    public function logout(){
        //清除session中保存的数据
        session::delete("user_id","Admin");
        session::delete("user_info","Admin");
        
        //完成页面跳转
        $this->success("注销成功",'login/login');
    }
    
}