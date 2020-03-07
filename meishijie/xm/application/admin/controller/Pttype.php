<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Pttype as PttypeModel;

class Pttype extends Base {
    
    /*
     * 1 烹调方法分类列表
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post(ajax)请求获取烹调方法类别列表
     * */
    public function Pttype() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取所有烹调方法类别信息
            $pttypeList = PttypeModel::order('sort')->select();
            
            return $this->fetch("pt_type",["pttypeList"=>$pttypeList]);
        }
    }
    
    /*
     * 2 烹调方法分类添加操作
     * 2.1参数：
     * 2.2功能：
     *        2.2.1 完成分类添加功能
     * */
    public function pttypeadd() {
        if(request()->isGet()){
            $pttype_id = request()->param();
            $pttype = PttypeModel::get($pttype_id);
            return $this -> fetch("pt_type_add",["pttype"=>$pttype]);
        }else{
            // 接受分类信息
            $arr = request()->param();
            
            $pttype = new PttypeModel();
            // 插入
            $res = $pttype -> Acreate($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功']);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        }
        
    }
    /*
     * 3 烹调方法分类删除操作
     * 3.1参数：pttype_id 烹调方法类别ID
     * 3.2功能：
     *      3.2.1 post请求删除学生信息
     * */
    public function pttypedel()
    {
        if(request()->isPost()){
            
            $pttype_id = request()->param("pttype_id");   // 类别id
            $res = PttypeModel::destroy($pttype_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 4 烹调方法分类查看/修改操作
     * 4.1参数：pttype_id 烹调方法类别ID
     * 4.2功能：
     *      4.2.1 get请求渲染页面，返回分类信息
     *      4.2.2 post请求方式修改分类信息
     * */
    public function pttypedetail()
    {
        if(request()->isGet()){
            // 获取pttype_id
            $pttype_id = request()->param('pttype_id');
            // 根据pttype_id获取分类信息
            $pttype = PttypeModel::get($pttype_id);
            // 渲染页面并传递分类信息
            return $this->fetch("pt_type_detail",["pttype"=>$pttype]);
        }else{
            // 接受分类信息
            $arr = request()->param();
            unset($arr["file"]);
            // 更新
            $res = PttypeModel::update($arr);
            
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    
    
    
}