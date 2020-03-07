<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\Recipes as RecipesModel;
use app\index\model\Fytype as FytypeModel;
use app\admin\model\Food;
use app\index\model\Fruits;
use app\index\model\Staple;
use app\index\model\Nuts;

class Recipes extends Base
{
    /*
     * 妇幼平衡分类接口
     * 获取妇幼平衡分类信息
     * */
    public function fytype(){
        $fytype_flag = input("fytype_flag");
        //验证是否有参数传递
        if( !$fytype_flag ){
            return json(['code'=>3,'msg'=>'参数传递错误']);
        }
        
        $map = [];
        if($fytype_flag == 1){
            //国内食材
            $map["pid"] = "1";
        }else{
            //国外食材
            $map["pid"] = "2";
        }
        $map["level"] = "2";
        
        $fytypeModel = FytypeModel::with(['two'=>function($query){
            
        }])->where($map)->select();
        
        if($fytypeModel){
            return json(["code"=>"1","msg"=>"查询成功","data"=>$fytypeModel]);
        }else{
            return json(["code"=>"2","msg"=>"暂无数据"]);
        }
    }
    
    /*
     * 妇幼营养列表接口
     * 获取妇幼营养详细信息
     * 传参：  page
     limit
     fytype_id,类别ID
     * */
    public function index(){
        $page = input("page");//接收页码
        $limit = input("limit");//接收每页条数
        $fytype_id = input("fytype_id");
        
        //验证
        $page = isset($page)?$page:1;
        $limit = isset($limit)?$limit:5;
        
        $map = [];
        
        empty($fytype_id)?"":$map["fytype_id"] = $fytype_id;
        $map["recipes_isoff"] = 1; //默认只显示上架内容
        
        //获取数据
        $Recipes = RecipesModel::where($map)->page($page)->limit($limit)->order('create_time desc')->select();
               
        //判断获取数据是否成功
        if($Recipes){
            return json(["code"=>"1","msg"=>"返回数据成功","data"=>$Recipes]);
        }else{
            return json(["code"=>"2","msg"=>"暂无数据"]);
        }
    }
    
    /*
     * 妇幼营养食谱详情页面接口
     * 通过妇幼营养食谱ID，获取妇幼营养食谱详细信息
     * 传参：recipes_id
     * */
    public function recipesDetail(){
        $recipes_id = input("recipes_id");//接收妇幼营养食谱
        //验证是否有参数传递
        if( !$recipes_id ){
            return json(['code'=>3,'msg'=>'参数传递错误']);
        }
        //根据ID获取妇幼营养食谱详细信息
        $res = RecipesModel::get($recipes_id);
        $fruits = Fruits::where("recipes_id",$recipes_id)->select();
        $food = Food::where("recipes_id",$recipes_id)->select();
        $staple = Staple::where("recipes_id",$recipes_id)->select();
        $nuts = Nuts::where("recipes_id",$recipes_id)->select();
        
        
        
        if($res){
            return json(['code'=>1,'msg'=>'查询成功','data'=>$res,"fruits"=>$fruits,"food"=>$food,"staple"=>$staple,"nuts"=>$nuts]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
    }
}