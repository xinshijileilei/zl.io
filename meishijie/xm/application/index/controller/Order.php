<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\User;
use app\index\model\Usertype;
use app\index\model\Order as OrderModel;

class Order extends Base
{
    
    /*
     * 订单
     * */
    public function order(){
        
        $info = request()->param();
        // 防止未接收到用户信息
        if(empty($info)){
            return json(['code'=>3,'msg'=>'未接收到订单信息']);
        }
        $info["create_time"] = time();
        $res = OrderModel::create($info);
        
        if($res){
            return json(['code'=>1,'msg'=>'订单成功']);
        }else{
            return json(['code'=>2,'msg'=>'订单失败']);
        }
        
    }
    
    /*
     * 我的订单
     * */
    public function myorder(){        
        $page = input("page");//页码
        $limit = input("limit");//每页条数
        $user_id = input("user_id");//用户ID
        $order_flag = input("order_flag");//模块标识
        
        // 防止未接收到用户信息
        if(empty($user_id) || empty($order_flag)){
            return json(['code'=>3,'msg'=>'未接收到订单信息']);
        }
        
        //验证
        $page = isset($page)?$page:1;
        $limit = isset($limit)?$limit:5;
        
        $map = [];
        $map["c.user_id"] = $user_id;
        $map["c.order_flag"] = $order_flag;
        $order = new OrderModel();
        switch ($order_flag)
        {
            case "1":
                $map["o.course_flag"] = 2;
                $res = $order->courseInfo($map,$page,$limit);          // 名师制作
                break;
            case "2":
                $map["o.course_flag"] = 1;
                $res = $order->courseInfo($map,$page,$limit);          // 吃动平衡
                break;
            case "3":
                $res = $order->cookingInfo($map,$page,$limit);        // 烹调方法
                break;
            case "4":
                $res = $order->fyInfo($map,$page,$limit);          // 妇幼营养
                break;
            case "6":
                $res = $order->yyInfo($map,$page,$limit);          // 营养知识
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
}
