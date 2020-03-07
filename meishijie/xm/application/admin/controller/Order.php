<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Order as OrderModel;

class Order extends Base {
    
    /*
     * 1 订单列表页面
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求查询根据条件完成搜索操作
     * */
    public function orderList() {  
        // 1.get请求渲染页面
        if(request()->isGet()){
            return $this->fetch("order_list");
            // 2.post(ajax)请求获取学生列表
        }else{
            //接收查询条件
            $arr = input("param.");
            $map=[];
            empty($arr['order_status'])?'':$map['o.order_status']=$arr['order_status'];
            empty($arr['user_name'])?'':$map['u.user_name']=$arr['user_name'];
            //接收分页信息
            $page = input("page");
            $limit = input("limit");
            
            $orderModel = new OrderModel();
            $orderList = $orderModel->search($map,$page,$limit);
            
            $count = OrderModel::count();
            
            if($orderList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$orderList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    
}