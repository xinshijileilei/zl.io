<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Usertype as UsertypeModel;

class Usertype extends Base {
    
    /*
     * 1 用户分类列表
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post(ajax)请求获取用户类别列表
     * */
    public function userType() {  
        // 1.get请求渲染页面
        if(request()->isGet()){
            return $this->fetch("user_type");
            // 2.post(ajax)请求获取用户类别列表
        }else{
            // 获取所有用户类别信息
            $usertypeList = UsertypeModel::all();
            
            // 获取所有用户类别数量
            $count = UsertypeModel::count();
            
            // 判断是否返回用户类别信息
            if($usertypeList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$usertypeList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    /*
     * 2 用户分类添加操作
     * 2.1参数：
     * 2.2功能：
     *        2.2.1 完成分类添加功能
     * */
    public function userTypeadd() {
            
            // 接受分类信息
            $arr = request()->param();
            $arr["create_time"] = time();
            // 插入
            $res = UsertypeModel::create($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功']);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        
    }
    /*
     * 3 用户分类删除操作
     * 3.1参数：usertype_id 用户类别ID
     * 3.2功能：
     *      3.2.1 post请求删除学生信息
     * */
    public function userTypedel()
    {
        if(request()->isPost()){
            
            $usertype_id = request()->param("usertype_id");   // 类别id
            $res = UsertypeModel::destroy($usertype_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 4 用户分类查看/修改操作
     * 4.1参数：usertype_id 用户类别ID
     * 4.2功能：
     *      4.2.1 get请求渲染页面，返回分类信息
     *      4.2.2 post请求方式修改分类信息
     * */
    public function userTypedetail()
    {
        if(request()->isGet()){
            // 获取usertype_id
            $usertype_id = request()->param('usertype_id');
            // 根据usertype_id获取分类信息
            $usertype = UsertypeModel::get($usertype_id);
            // 渲染页面并传递分类信息
            return $this->fetch("user_type_detail",["usertype"=>$usertype]);
        }else{
            // 接受分类信息
            $arr = request()->param();
            // 更新
            $res = UsertypeModel::update($arr);
            
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    
    
    
}