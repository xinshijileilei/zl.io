<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Mstype as MstypeModel;

class Mstype extends Base {
    
    /*
     * 1 名师制作分类列表
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post(ajax)请求获取名师制作类别列表
     * */
    public function Mstype() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取所有名师制作类别信息
            $MstypeList = MstypeModel::order('sort')->select();
            
            return $this->fetch("ms_type",["MstypeList"=>$MstypeList]);
        }
    }
    
    /*
     * 2 名师制作分类添加操作
     * 2.1参数：
     * 2.2功能：
     *        2.2.1 完成分类添加功能
     * */
    public function Mstypeadd() {
        if(request()->isGet()){
            $Mstype_id = request()->param();
            $Mstype = MstypeModel::get($Mstype_id);
            return $this -> fetch("ms_type_add",["mstype"=>$Mstype]);
        }else{
            // 接受分类信息
            $arr = request()->param();
            
            $Mstype = new MstypeModel();
            // 插入
            $res = $Mstype -> Acreate($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功']);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        }
        
    }
    /*
     * 3 名师制作分类删除操作
     * 3.1参数：Mstype_id 名师制作类别ID
     * 3.2功能：
     *      3.2.1 post请求删除学生信息
     * */
    public function Mstypedel()
    {
        if(request()->isPost()){
            
            $Mstype_id = request()->param("Mstype_id");   // 类别id
            $res = MstypeModel::destroy($Mstype_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 4 名师制作分类查看/修改操作
     * 4.1参数：Mstype_id 名师制作类别ID
     * 4.2功能：
     *      4.2.1 get请求渲染页面，返回分类信息
     *      4.2.2 post请求方式修改分类信息
     * */
    public function Mstypedetail()
    {
        if(request()->isGet()){
            // 获取Mstype_id
            $Mstype_id = request()->param('mstype_id');
            // 根据Mstype_id获取分类信息
            $Mstype = MstypeModel::get($Mstype_id);
            // 渲染页面并传递分类信息
            return $this->fetch("ms_type_detail",["mstype"=>$Mstype]);
        }else{
            // 接受分类信息
            $arr = request()->param();
            unset($arr["file"]);
            // 更新
            $res = MstypeModel::update($arr);
            
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    
}