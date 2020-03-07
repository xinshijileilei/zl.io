<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\Ingredients as IngredientsModel;
use app\index\model\Sctype as SctypeModel;

class Ingredients extends Base
{
    /*
     * 食材分类接口
     * 获取食材分类信息
     * */
    public function sctype(){
        $sctype_flag = input("sctype_flag");
        //验证是否有参数传递
        if( !$sctype_flag ){
            return json(['code'=>3,'msg'=>'参数传递错误']);
        }
        
        $map = [];
        if($sctype_flag == 1){
            //国内食材
            $map["pid"] = "1";     
        }else{
            //国外食材
            $map["pid"] = "2";
        }
        
        $map["level"] = "2";
        $SctypeModel = SctypeModel::with(['two'=>function($query){
            $query->with(['three'=>function($qu){
                
            }]);
        }])->where($map)->select();
        
        if($SctypeModel){
            return json(["code"=>"1","msg"=>"查询成功","data"=>$SctypeModel]);
        }else{
            return json(["code"=>"2","msg"=>"暂无数据"]);
        }
    }
    
    /*
     * 食材列表接口
     * 获取食材详细信息
     * 传参：  page
     limit
     Sctype_id,类别ID
     * */
    public function index(){
        $page = input("page");//接收页码
        $limit = input("limit");//接收每页条数
        $sctype_id = input("sctype_id");
        
        //验证
        $page = isset($page)?$page:1;
        $limit = isset($limit)?$limit:5;
        
        $map = [];
        
        empty($sctype_id)?"":$map["sctype_id"] = $sctype_id;

        //获取数据
        $Ingredients = IngredientsModel::where($map)->page($page)->limit($limit)->order('create_time desc')->select();
        
        
        //判断获取数据是否成功
        if($Ingredients){
            return json(["code"=>"1","msg"=>"返回数据成功","data"=>$Ingredients]);
        }else{
            return json(["code"=>"2","msg"=>"暂无数据"]);
        }
    }
    
    /*
     * 食材详情页面接口
     * 通过食材ID，获取食材详细信息
     * 传参：Ingredients_id
     * */
    public function IngredientsDetail(){
        $Ingredients_id = input("ingredients_id");//接收食材
        //验证是否有参数传递
        if( !$Ingredients_id ){
            return json(['code'=>3,'msg'=>'参数传递错误']);
        }
        //根据ID获取食材详细信息
        $res = IngredientsModel::get($Ingredients_id);
        
        if($res){
            return json(['code'=>1,'msg'=>'查询成功','data'=>$res]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
    }
    
}