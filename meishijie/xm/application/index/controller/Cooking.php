<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\Cooking as CookingModel;
use app\index\model\Pttype as PttypeModel;

class Cooking extends Base
{
    /*
     * 烹调方法分类接口
     * 获取烹调方法分类信息
     * */
    public function pttype(){
        $PttypeModel = PttypeModel::with(['search'=>function($q){
            
        }])->where('level',1)->select();
        
        if($PttypeModel){
            return json(["code"=>"1","msg"=>"查询成功","data"=>$PttypeModel]);
        }else{
            return json(["code"=>"2","msg"=>"暂无数据"]);
        }
    }
    
    /*
     * 烹调方法列表接口
     * 获取烹调方法详细信息
     * 传参：  page
     limit
     pttype_id,类别ID
     * */
    public function index(){
        $page = input("page");//接收页码
        $limit = input("limit");//接收每页条数
        $pttype_id = input("pttype_id");
        
        //验证
        $page = isset($page)?$page:1;
        $limit = isset($limit)?$limit:5;
        
        $map = [];
        
        empty($pttype_id)?"":$map["pttype_id"] = $pttype_id;
        $map["cooking_isoff"] = "1";
        
        //获取数据
        $cooking = CookingModel::where($map)->page($page)->limit($limit)->order('create_time desc')->select();
        
        
        //判断获取数据是否成功
        if($cooking){
            return json(["code"=>"1","msg"=>"返回数据成功","data"=>$cooking]);
        }else{
            return json(["code"=>"2","msg"=>"暂无数据"]);
        }
    }
    
    /*
     * 烹调方法详情页面接口
     * 通过烹调方法ID，获取烹调方法详细信息
     * 传参：cooking_id
     * */
    public function cookingDetail(){
        $cooking_id = input("cooking_id");//接收烹调方法
        //验证是否有参数传递
        if( !$cooking_id ){
            return json(['code'=>3,'msg'=>'参数传递错误']);
        }
        //根据ID获取烹调方法详细信息
        $res = CookingModel::get($cooking_id);
        
        if($res){
            return json(['code'=>1,'msg'=>'查询成功','data'=>$res]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
    }
    
}