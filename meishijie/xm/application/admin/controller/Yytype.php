<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Yytype as YytypeModel;

class Yytype extends Base {
    
    /*
     * 1 营养知识分类列表
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post(ajax)请求获取营养知识类别列表
     * */
    public function yyType() {  
        // 1.get请求渲染页面
        if(request()->isGet()){
            return $this->fetch("yy_type");
            // 2.post(ajax)请求获取营养知识类别列表
        }else{
            // 获取所有营养知识类别信息
            $yytypeList = YytypeModel::all();
            
            // 获取所有营养知识类别数量
            $count = YytypeModel::count();
            
            // 判断是否返回营养知识类别信息
            if($yytypeList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$yytypeList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    /*
     * 2 营养知识分类添加操作
     * 2.1参数：
     * 2.2功能：
     *        2.2.1 完成分类添加功能
     * */
    public function yyTypeadd() {
            
            // 接受分类信息
            $arr = request()->param();
            $arr["create_time"] = time();
            // 插入
            $res = YytypeModel::create($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功']);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        
    }
    /*
     * 3 营养知识分类删除操作
     * 3.1参数：yytype_id 营养知识类别ID
     * 3.2功能：
     *      3.2.1 post请求删除学生信息
     * */
    public function yyTypedel()
    {
        if(request()->isPost()){
            
            $yytype_id = request()->param("yytype_id");   // 类别id
            $res = YytypeModel::destroy($yytype_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 4 营养知识分类查看/修改操作
     * 4.1参数：yytype_id 营养知识类别ID
     * 4.2功能：
     *      4.2.1 get请求渲染页面，返回分类信息
     *      4.2.2 post请求方式修改分类信息
     * */
    public function yyTypedetail()
    {
        if(request()->isGet()){
            // 获取yytype_id
            $yytype_id = request()->param('yytype_id');
            // 根据yytype_id获取分类信息
            $yytype = YytypeModel::get($yytype_id);
            // 渲染页面并传递分类信息
            return $this->fetch("yy_type_detail",["yytype"=>$yytype]);
        }else{
            // 接受分类信息
            $arr = request()->param();
            // 更新
            $res = YytypeModel::update($arr);
            
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    
    
    
}