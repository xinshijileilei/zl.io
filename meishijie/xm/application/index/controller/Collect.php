<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\User;
use app\index\model\Usertype;
use app\index\model\Collect as CollectModel;
use app\index\model\Course;

class Collect extends Base
{
    
    /*
     * 收藏
     * */
    public function collect(){
        
        $info = request()->param();
        // 防止未接收到用户信息
        if(empty($info)){
            return json(['code'=>3,'msg'=>'未接收到收藏信息']);
        }
        $info["create_time"] = time();
        $res = CollectModel::create($info);
        $collect_id = $res -> collect_id;
        
        if($res){
            return json(['code'=>1,'msg'=>'收藏成功','collect_id'=>$collect_id]);
        }else{
            return json(['code'=>2,'msg'=>'收藏失败']);
        }
        
    }
    
    /*
     * 我的收藏
     * */
    public function myCollect(){        
        $page = input("page");//页码
        $limit = input("limit");//每页条数
        $user_id = input("user_id");//用户ID
        $collect_flag = input("collect_flag");//模块标识
        
        // 防止未接收到用户信息
        if(empty($user_id) || empty($collect_flag)){
            return json(['code'=>3,'msg'=>'未接收到收藏信息']);
        }
        
        //验证
        $page = isset($page)?$page:1;
        $limit = isset($limit)?$limit:5;
        
        $map = [];
        $map["c.user_id"] = $user_id;
        $map["c.collect_flag"] = $collect_flag;
        $collect = new CollectModel();
        switch ($collect_flag)
        {
            case "1":
                $map["o.course_flag"] = 2;
                $res = $collect->courseInfo($map,$page,$limit);          // 名师制作
                break;
            case "2":
                $map["o.course_flag"] = 1;
                $res = $collect->courseInfo($map,$page,$limit);          // 吃动平衡
                break;
            case "3":
                $res = $collect->cookingInfo($map,$page,$limit);        // 烹调方法
                break;
            case "4":
                $res = $collect->fyInfo($map,$page,$limit);          // 妇幼营养
                break;
            case "5":
                $res = $collect->scInfo($map,$page,$limit);          // 食材
                break;
            case "6":
                $res = $collect->yyInfo($map,$page,$limit);          // 营养知识
                break;
            default:
                return json(["code"=>4,"msg"=>"提交数据有误，暂无数据"]);
        }
        
        if($res){
            return json(['code'=>1,'msg'=>'查询成功',"data"=>$res]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
    }
        
        /*
         * 取消收藏
         * */
        public function collectDel(){
            
            $collect_id = input("collect_id");
            
            // 防止未接收到用户信息
            if(empty($collect_id)){
                return json(['code'=>3,'msg'=>'未接收到收藏信息']);
            }
            
            $res = CollectModel::destroy($collect_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'取消收藏']);
            }else{
                return json(['code'=>2,'msg'=>'取消失败']);
            }
        }
}
