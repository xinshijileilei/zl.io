<?php
namespace app\admin\controller;
use app\admin\common\Base;
use think\Request;
use app\admin\model\Admin as AdminModel;

class Admin extends Base
{
    /*
     * 1 管理员列表页面
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求查询根据条件完成修改
     * */
    public function admin()
    {
        if(request()->isGet()){
            $admin = AdminModel::all();
            return $this -> fetch("admin-list",["admin"=>$admin]);
        }
    }
    
    //管理员编辑页面
    public function edit($id){
        $admin = AdminModel::get($id);
        $this -> assign("admin",$admin);
        return $this -> fetch("admin-edit");
    }
    
    //管理员修改密码
    public function update(){
        
        $data = input('param.');
        $admin = AdminModel::get($data["admin_id"]);
        $password = md5($data["password"]);
        if($admin["admin_password"] != $password){
            return ["code"=>3,"msg"=>"旧密码输入不正确"];
        }else{
            $res = AdminModel::update([
                    "admin_password"=>md5($data["admin_password"])
                ],["admin_id"=>$data["admin_id"]]);
             if($res){
                 return ["code"=>1,"msg"=>"更新成功"];
             }else{
                 return ["code"=>2,"msg"=>"更新失败"];
             }
        }
        
        
    }
    
}







