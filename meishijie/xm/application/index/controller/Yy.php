<?php 
namespace app\index\controller;
use app\index\common\Base;
use app\index\model\Yyarticle as YyModel;
use app\index\model\Yytype as YytypeModel;

class Yy extends Base
{

    /*
     * 营养知识分类接口
     * 获取营养知识分类信息
     * */
    public function Yytype(){        
        $res = YytypeModel::all();
        if($res){
            return json(["code"=>"1","msg"=>"查询成功","data"=>$res]);
        }else{
            return json(["code"=>"2","msg"=>"暂无数据"]);
        }
    }
    
    /*
     * 营养知识分类接口
     * 获取营养知识分类信息
     * 传递参数：yytype_id,page,limit
     * */
    public function index(){
        $page = input("page");//接收页码
        $limit = input("limit");//接收每页条数
        $yytype_id = input("yytype_id");//接收营养知识分类ID
        
        //验证
        $page = isset($page)?$page:1;
        $limit = isset($limit)?$limit:5;
        $yytype_id = isset($yytype_id)?$yytype_id:1;
        
        //获取数据
        $res = YyModel::where(["yytype_id"=>$yytype_id,"yyarticle_isoff"=>1])->page($page)->limit($limit)->order('create_time desc')->select();
        
        //判断获取数据是否成功
        if($res){
            return json(["code"=>"1","msg"=>"返回数据成功","data"=>$res]);
        }else{
            return json(["code"=>"2","msg"=>"暂无数据"]);
        }
    }
    
    /*
     * 营养知识详情页面接口
     * 通过营养知识ID，获取营养知识详细信息
     * 传参：yyarticle_id_id
     * */
    public function yyDetail(){
        $yyarticle_id = input("yyarticle_id");//接收营养知识
        //验证是否有参数传递
        if( !$yyarticle_id ){
            return json(['code'=>3,'msg'=>'参数传递错误']);
        }
        //根据ID获取营养知识详细信息
        $res = YyModel::get($yyarticle_id);
        
        if($res){
            return json(['code'=>1,'msg'=>'查询成功','data'=>$res]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
    }
}