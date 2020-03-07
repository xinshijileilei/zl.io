<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Scroll as ScrollModel;

class Scroll extends Base {
    
    /*
     * 1 轮播图列表
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post(ajax)请求获取吃动平衡类别列表
     * */
    public function Scroll() {  
        // 1.get请求渲染页面
        if(request()->isGet()){
            return $this->fetch("scroll_list");
            // 2.post(ajax)请求获取吃动平衡类别列表
        }else{
            //接收分页信息
            $page = input("page");
            $limit = input("limit");
            // 获取所有吃动平衡类别信息
            $ScrollList = ScrollModel::order("create_time desc")->page($page)->limit($limit)->select();
            
            // 获取所有吃动平衡类别数量
            $count = ScrollModel::count();
            
            // 判断是否返回吃动平衡类别信息
            if($ScrollList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$ScrollList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    /*
     * 2 轮播图添加操作
     * 2.1参数：
     * 2.2功能：
     *        2.2.1 完成分类添加功能
     * */
    public function Scrolladd() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            return $this->fetch("scroll_add");
            // 2.post(ajax)请求获取吃动平衡类别列表
        }else{
            // 接受分类信息
            $arr = request()->param();
            $arr["create_time"] = time();
            unset($arr["file"]);
            // 插入
            $res = ScrollModel::create($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功']);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        }
        
    }
    /*
     * 3 轮播图删除操作
     * 3.1参数：Scroll_id 吃动平衡类别ID
     * 3.2功能：
     *      3.2.1 post请求删除学生信息
     * */
    public function Scrolldel()
    {
        if(request()->isPost()){
            
            $Scroll_id = request()->param("scroll_id");   // 类别id
            $res = ScrollModel::destroy($Scroll_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 4 轮播图查看/修改操作
     * 4.1参数：Scroll_id 吃动平衡类别ID
     * 4.2功能：
     *      4.2.1 get请求渲染页面，返回分类信息
     *      4.2.2 post请求方式修改分类信息
     * */
    public function Scrolldetail()
    {
        if(request()->isGet()){
            // 获取Scroll_id
            $Scroll_id = request()->param('scroll_id');
            // 根据Scroll_id获取分类信息
            $Scroll = ScrollModel::get($Scroll_id);
            // 渲染页面并传递分类信息
            return $this->fetch("scroll_detail",["scroll"=>$Scroll]);
        }else{
            // 接受分类信息
            $arr = request()->param();
            unset($arr["file"]);
            // 更新
            $res = ScrollModel::update($arr,["scroll_id"=>$arr["scroll_id"]]);
            
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    
    /*
     * 6 描述：修改是否显示
     * 6.1 参数：scroll_id  scroll_isoff:1->显示   2->不显示
     * 6.2 功能：1.列表页面修改状态
     *
     * */
    public function changeStatus()
    {
        // 接收数据
        $arr = request()->param();
        // 修改状态
        $res = ScrollModel::update($arr);
        if( $res ){
            return json(['code'=>1,'msg'=>'修改成功']);
        }else{
            return json(['code'=>2,'msg'=>'修改失败']);
        }
        
    }
    
    
    
    
}