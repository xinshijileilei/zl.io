<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\User;
use app\admin\model\Course;
use app\admin\model\Ingredients;
use app\admin\model\Cooking;
use app\admin\model\Recipes;


class Index extends Base {
    
    /*
     * 后台管理首页
     * */
    public function index() {       
        return $this -> fetch();    
    }
    
    /*
     * 后台管理欢迎页面
     * */
    public function welcome(){
        //当前时间
        $time = date("Y-m-d H:i:s",time());
        //用户总数
        $user = User::count();
        //菜品总数
        $course = Course::where("balance_flag",1)->count();
        //运动文章
        $bal = Course::where("balance_flag",2)->count();
        //食材总数
        $sc = Ingredients::count();
        //烹调方法
        $pt = Cooking::count();
        //食谱总量
        $sp = Recipes::count();
        //用户数据
        $a = User::where("usertype_id",1)->count();
        $b = User::where("usertype_id",2)->count();
        $c = User::where("usertype_id",3)->count();
        $d = User::where("usertype_id",4)->count();
        $e = User::where("usertype_id",5)->count();
        $f = User::where("usertype_id",6)->count();
        return $this -> fetch("welcome",[
            "a"=>$a,
            "b"=>$b,
            "c"=>$c,
            "d"=>$d,
            "e"=>$e,
            "f"=>$f,
            "time"=>$time,
            "user"=>$user,
            "course"=>$course,
            "bal"=>$bal,
            "sc"=>$sc,
            "pt"=>$pt,
            "sp"=>$sp
        ]);
    }
    
}