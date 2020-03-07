<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Cdtype as CdtypeModel;

class Cdtype extends Base {
    
    /*
     * 1 吃动平衡分类列表
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post(ajax)请求获取吃动平衡类别列表
     * */
    public function Cdtype() {  
        // 1.get请求渲染页面
        if(request()->isGet()){
            return $this->fetch("cd_type");
            // 2.post(ajax)请求获取吃动平衡类别列表
        }else{
            // 获取所有吃动平衡类别信息
            $CdtypeList = CdtypeModel::all();
            
            // 获取所有吃动平衡类别数量
            $count = CdtypeModel::count();
            
            // 判断是否返回吃动平衡类别信息
            if($CdtypeList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$CdtypeList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    /*
     * 2 吃动平衡分类添加操作
     * 2.1参数：
     * 2.2功能：
     *        2.2.1 完成分类添加功能
     * */
    public function Cdtypeadd() {
            
            // 接受分类信息
            $arr = request()->param();
            $arr["create_time"] = time();
            // 插入
            $res = CdtypeModel::create($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功']);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        
    }
    /*
     * 3 吃动平衡分类删除操作
     * 3.1参数：Cdtype_id 吃动平衡类别ID
     * 3.2功能：
     *      3.2.1 post请求删除学生信息
     * */
    public function Cdtypedel()
    {
        if(request()->isPost()){
            
            $Cdtype_id = request()->param("cdtype_id");   // 类别id
            $res = CdtypeModel::destroy($Cdtype_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 4 吃动平衡分类查看/修改操作
     * 4.1参数：Cdtype_id 吃动平衡类别ID
     * 4.2功能：
     *      4.2.1 get请求渲染页面，返回分类信息
     *      4.2.2 post请求方式修改分类信息
     * */
    public function Cdtypedetail()
    {
        if(request()->isGet()){
            // 获取Cdtype_id
            $Cdtype_id = request()->param('cdtype_id');
            // 根据Cdtype_id获取分类信息
            $Cdtype = CdtypeModel::get($Cdtype_id);
            // 渲染页面并传递分类信息
            return $this->fetch("cd_type_detail",["cdtype"=>$Cdtype]);
        }else{
            // 接受分类信息
            $arr = request()->param();
            // 更新
            $res = CdtypeModel::update($arr);
            
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    
    
    
}