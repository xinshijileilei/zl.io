<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\User as UserModel;
use app\admin\model\Usertype as UsertypeModel;
use app\admin\model\Cdtype;

class User extends Base {
    
    /*
     * 1 用户列表页面
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求查询根据条件完成搜索操作
     * */
    public function userList() {  
        // 1.get请求渲染页面
        if(request()->isGet()){
            $usertype = UsertypeModel::all();
            return $this->fetch("user_list",["usertype"=>$usertype]);
            // 2.post(ajax)请求获取学生列表
        }else{
            //接收查询条件
            $arr = input("param.");
            $map=[];
            empty($arr['usertype_id'])?'':$map['us.usertype_id']=$arr['usertype_id'];
            empty($arr['user_name'])?'':$map['u.user_name']=$arr['user_name'];
            //接收分页信息
            $page = input("page");
            $limit = input("limit");
            
            $UserModel = new UserModel();
            $userList = $UserModel->search($map,$page,$limit);
            
            $count = UserModel::count();
            
            if($userList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$userList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    /*
     * 2 用户添加页面
     * 2.1参数：
     * 2.2功能：
     *        2.2.1 默认get请求渲染页面
     * */
    public function userAdd() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取所有用户类别
            $usertype = UsertypeModel::all();
            $cdtype = Cdtype::all();
            return $this->fetch("user_add",["usertype"=>$usertype,"cdtype"=>$cdtype]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受用户信息
            $arr = request()->param();
            $arr["create_time"] = time();
            unset($arr["file"]);
            // 插入
            $res = UserModel::create($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功']);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        }
    }
    /*
     * 3 用户查看详情页面
     * 3.1参数：user_id 用户ID
     * 3.2功能：
     *        3.2.1 默认get请求渲染页面
     *        3.2.2 post请求完成数据的修改
     * */
    public function userDetail() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取用户ID
            $user_id = request() -> param();
            // 获取用户信息
            $userinfo = UserModel::get($user_id);
            // 获取所有用户类别
            $usertype = UsertypeModel::all();
            return $this->fetch("user_detail",["usertype"=>$usertype,"userinfo"=>$userinfo]);
        }
    }
    /*
     * 4 用户删除操作
     * 4.1参数：user_id 用户ID
     * 4.2功能：
     *      4.2.1 post请求删除用户信息
     * */
    public function userDel()
    {
        if(request()->isPost()){
            
            $user_id = request()->param("user_id");   // 类别id
            $res = UserModel::destroy($user_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 6 审核页面
     * 6.1参数：user_id 用户ID
     * 6.2功能：
     *        6.2.1 默认get请求渲染页面
     *        6.2.2 post请求完成数据的修改
     * */
    public function userCheck() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取用户ID
            $user_id = request() -> param();
            // 获取用户信息
            $userinfo = UserModel::get($user_id);
            // 获取所有用户类别
            $usertype = UsertypeModel::all();
            return $this->fetch("user_check",["usertype"=>$usertype,"userinfo"=>$userinfo]);
        }else{
            // 接受信息
            $arr = request()->param();
            
            $res = UserModel::update($arr);
            
            if($res){
                return json(['code'=>1,'msg'=>'审核成功']);
            }else{
                return json(['code'=>2,'msg'=>'审核失败']);
            }
        }
    }
    
    /*
     * 7 用户审核列表页面
     * 7.1参数：
     * 7.2功能：
     *        7.2.1 默认get请求渲染页面
     *        7.2.2 post请求查询根据条件完成搜索操作
     * */
    public function usercheckList() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            $usertype = UsertypeModel::where("usertype_id != 1")->select();
            return $this->fetch("user_check_list",["usertype"=>$usertype]);
            // 2.post(ajax)请求获取学生列表
        }else{
            //接收查询条件
            $arr = input("param.");
            $map=[];
            empty($arr['usertype_id'])?'':$map['us.usertype_id']=$arr['usertype_id'];
            empty($arr['user_name'])?'':$map['u.user_name']=$arr['user_name'];
            empty($arr['user_audit'])?'':$map['user_audit']=$arr['user_audit'];
            //接收分页信息
            $page = input("page");
            $limit = input("limit");
            
            $UserModel = new UserModel();
            $userList = $UserModel->csearch($map,$page,$limit);
            
            $count = UserModel::where("user_audit != 1")->count();
            
            if($userList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$userList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    
}