<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Sctype as SctypeModel;

class Sctype extends Base {
    
    /*
     * 1 食材分类列表
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post(ajax)请求获取食材类别列表
     * */
    public function Sctype() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取所有食材类别信息
            $SctypeList = SctypeModel::order('sort')->select();
            
            // 获取所有食材类别数量
            $count = SctypeModel::count();
            return $this->fetch("sc_type",["SctypeList"=>$SctypeList]);
        }
    }
    
    /*
     * 2 食材分类添加操作
     * 2.1参数：
     * 2.2功能：
     *        2.2.1 完成分类添加功能
     * */
    public function Sctypeadd() {
        if(request()->isGet()){
            $sctype_id = request()->param();
            $sctype = SctypeModel::get($sctype_id);
            return $this -> fetch("sc_type_add",["sctype"=>$sctype]);
        }else{
            // 接受分类信息
            $arr = request()->param();
            
            $Sctype = new SctypeModel();
            // 插入
            $res = $Sctype -> Acreate($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功']);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        }
        
    }
    /*
     * 3 食材分类删除操作
     * 3.1参数：Sctype_id 食材类别ID
     * 3.2功能：
     *      3.2.1 post请求删除学生信息
     * */
    public function Sctypedel()
    {
        if(request()->isPost()){
            
            $Sctype_id = request()->param("sctype_id");   // 类别id
            $res = SctypeModel::destroy($Sctype_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 4 食材分类查看/修改操作
     * 4.1参数：Sctype_id 食材类别ID
     * 4.2功能：
     *      4.2.1 get请求渲染页面，返回分类信息
     *      4.2.2 post请求方式修改分类信息
     * */
    public function Sctypedetail()
    {
        if(request()->isGet()){
            // 获取Sctype_id
            $Sctype_id = request()->param('sctype_id');
            // 根据Sctype_id获取分类信息
            $Sctype = SctypeModel::get($Sctype_id);
            // 渲染页面并传递分类信息
            return $this->fetch("sc_type_detail",["sctype"=>$Sctype]);
        }else{
            // 接受分类信息
            $arr = request()->param();
            unset($arr["file"]);
            // 更新
            $res = SctypeModel::update($arr);
            
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    
    
    
}