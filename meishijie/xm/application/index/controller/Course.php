<?php
namespace app\index\controller;

use think\Db;
use app\index\common\Base;
use app\index\model\Course as CourseModel;
use app\index\model\Cooking;
use app\index\model\Yyarticle;
use app\index\model\Cdtype as CdtypeModel;
use app\index\model\Mstype as MstypeModel;
use app\index\model\Usertype as UsertypeModel;
use app\index\model\Main;
use app\index\model\Assist;
use app\index\model\Condiment;

class Course extends Base
{
    
    /*
     * 吃动平衡分类接口
     * 获取吃动平衡分类信息
     * */
    public function Cdtype(){
        $res = CdtypeModel::all();
        if($res){
            return json(["code"=>"1","msg"=>"查询成功","data"=>$res]);
        }else{
            return json(["code"=>"2","msg"=>"暂无数据"]);
        }
    }
    
    /*
     * 名师制作分类接口
     * 获取名师制作分类信息
     * */
    public function mstype(){
        // $user_id = request()->param("user_id");
        
        // if(empty($user_id)){
        //     return json(['code'=>3,'msg'=>'未接收到用户信息']);
        // }
          
        // $one = Db::table('xm_mstype')->where("mstype_id",'IN',function($qu)use($user_id){
        //     $qu->table('xm_mstype')->where('mstype_id','IN',function($query)use($user_id){
        //         $query->table('xm_course')->where("user_id",$user_id)->field('type_id');
        //     })->field("pid");
        // })
        // ->select();
        
        // $two = Db::table('xm_mstype')->where('mstype_id','IN',function($query)use($user_id){
        //     $query->table('xm_course')->where("user_id",$user_id)->field('type_id');
        // })
        // ->select();
        
        // foreach ($one as $key=>$value){
        //     foreach($two as $k => $v){
        //         if($v['pid'] == $value["mstype_id"]){
        //             $one[$key]['child'][] = $v;
        //         }
        //     }
        // }
        
        $one = MstypeModel::with(['search'=>function($q){
            
        }])->where('level',1)->select();

        if($one){
            return json(["code"=>"1","msg"=>"查询成功","data"=>$one]);
        }else{
            return json(["code"=>"2","msg"=>"暂无数据"]);
        }
    }
    
    /*
     * 菜品列表接口
     * 获取菜品详细信息
     * 传参：  page
        limit
        course_flag:1吃动平衡，2名师制作
        type_id,类别ID
        usertype_id 用户类别ID
     * */
    public function index(){
        $page = input("page");//接收页码
        $limit = input("limit");//接收每页条数
//         $course_flag = input("course_flag");
        $type_id = input("type_id");
//         $usertype_id = input("usertype_id");
//         $balance_flag = input("balance_flag");

        //验证
        $page = isset($page)?$page:1;
        $limit = isset($limit)?$limit:5;
        
        $map = [];
        
//         empty($course_flag)?"":$map["course_flag"] = $course_flag;
        empty($type_id)?"":$map["type_id"] = $type_id;
//         empty($usertype_id)?"":$map["usertype_id"] = $usertype_id;
//         empty($balance_flag)?"":$map["balance_flag"] = $balance_flag;
        $map["course_isoff"] = "1";

        //获取数据
//         $course = CourseModel::where($map)->page($page)->limit($limit)->order('create_time desc')->select();
        $course = CourseModel::where($map)->page($page)->limit($limit)->order('create_time desc')->select();
//         $course = CourseModel::all();
        

        //判断获取数据是否成功
        if($course){
            return json(["code"=>"1","msg"=>"返回数据成功","data"=>$course]);
        }else{
            return json(["code"=>"2","msg"=>"暂无数据"]);
        }
    }
    
    /*
     * 菜品详情页面接口
     * 通过菜品ID，获取菜品详细信息
     * 传参：course_id
     * */
    public function courseDetail(){
        $course_id = input("course_id");//接收菜品
        //验证是否有参数传递
        if( !$course_id ){
            return json(['code'=>3,'msg'=>'参数传递错误']);
        }
        //根据ID获取菜品详细信息
        $res = CourseModel::get($course_id);
        //菜品主料
        $main = Main::where("course_id",$course_id)->select();
        //菜品辅料
        $assist = Assist::where("course_id",$course_id)->select();
        //菜品调味品
        $condiment = Condiment::where("course_id",$course_id)->select();
        
        if($res){
            return json([
                'code'=>1,
                'msg'=>'查询成功',
                'data'=>$res,
                "main"=>$main,
                "assist"=>$assist,
                "condiment"=>$condiment
            ]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
    }
    
}







