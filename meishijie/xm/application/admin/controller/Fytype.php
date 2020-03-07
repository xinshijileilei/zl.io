<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Fytype as FytypeModel;

class Fytype extends Base {
    
    /*
     * 1 妇幼营养分类列表
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post(ajax)请求获取妇幼营养类别列表
     * */
    public function Fytype() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取所有妇幼营养类别信息
            $FytypeList = FytypeModel::order('sort')->select();
            
            // 获取所有妇幼营养类别数量
            $count = FytypeModel::count();
            return $this->fetch("fy_type",["FytypeList"=>$FytypeList]);
        }
    }
    
    /*
     * 2 妇幼营养分类添加操作
     * 2.1参数：
     * 2.2功能：
     *        2.2.1 完成分类添加功能
     * */
    public function Fytypeadd() {
        if(request()->isGet()){
            $Fytype_id = request()->param();
            $Fytype = FytypeModel::get($Fytype_id);
            return $this -> fetch("Fy_type_add",["fytype"=>$Fytype]);
        }else{
            // 接受分类信息
            $arr = request()->param();
            $Fytype = new FytypeModel();
            // 插入
            $res = $Fytype -> Acreate($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功']);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        }
        
    }
    /*
     * 3 妇幼营养分类删除操作
     * 3.1参数：Fytype_id 妇幼营养类别ID
     * 3.2功能：
     *      3.2.1 post请求删除学生信息
     * */
    public function Fytypedel()
    {
        if(request()->isPost()){
            
            $Fytype_id = request()->param("fytype_id");   // 类别id
            $res = FytypeModel::destroy($Fytype_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 4 妇幼营养分类查看/修改操作
     * 4.1参数：Fytype_id 妇幼营养类别ID
     * 4.2功能：
     *      4.2.1 get请求渲染页面，返回分类信息
     *      4.2.2 post请求方式修改分类信息
     * */
    public function Fytypedetail()
    {
        if(request()->isGet()){
            // 获取Fytype_id
            $Fytype_id = request()->param('fytype_id');
            // 根据Fytype_id获取分类信息
            $Fytype = FytypeModel::get($Fytype_id);
            // 渲染页面并传递分类信息
            return $this->fetch("fy_type_detail",["fytype"=>$Fytype]);
        }else{
            // 接受分类信息
            $arr = request()->param();
            unset($arr["file"]);
            // 更新
            $res = FytypeModel::update($arr);
            
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    
    
    
}