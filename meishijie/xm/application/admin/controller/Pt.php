<?php
namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use app\admin\model\Cooking as PtModel;
use app\admin\model\Pttype as PttypeModel;
use app\admin\model\User;
use app\admin\model\Usertype;


class pt extends Base {
    
    /*
     * 1 烹调方法文章列表页面
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求查询根据条件完成搜索操作
     * */
    public function ptList() {  
        // 1.get请求渲染页面
        if(request()->isGet()){
            $pttype = PttypeModel::where("level","1")->select();
            return $this->fetch("pt_list",["pttype"=>$pttype]);
            // 2.post(ajax)请求获取烹调方法文章列表
        }else{
            //接收查询条件
            $arr = input("param.");
            $map=[];
            empty($arr['pttype_id'])?'':$map['p.pttype_id']=$arr['pttype_id'];
            empty($arr['cooking_name'])?'':$map["cooking_name"] = $arr['cooking_name'];
            empty($arr['cooking_ischarge'])?'':$map['cooking_ischarge']=$arr['cooking_ischarge'];
            empty($arr['cooking_isoff'])?'':$map["cooking_isoff"] = $arr['cooking_isoff'];
            //接收分页信息
            $page = input("page");
            $limit = input("limit");
            
            $PtModel = new PtModel();
            $ptList = $PtModel->search($map,$page,$limit);
            $count = PtModel::count();
            if($ptList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$ptList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    /*
     * 2 烹调方法文章添加页面
     * 2.1参数：
     * 2.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求完成数据的添加
     * */
    public function ptAdd() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取所有烹调方法文章类别
            $pttype = pttypeModel::where("level","1")->select();
            $usertype = Usertype::all();
            return $this->fetch("pt_add",["pttype"=>$pttype,"usertype"=>$usertype]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受烹调方法文章信息
            $arr = request()->param();
            $arr["create_time"] = time();
            $user = User::get($arr["user_id"]);
            $arr["user_name"] = $user -> user_name;
            unset($arr["file"]);
            // 插入
            $res = PtModel::create($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功']);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        }
    }
    /*
     * 3 烹调方法文章修改页面
     * 3.1参数：pt_id 烹调方法文章ID
     * 3.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求完成数据的修改
     * */
    public function ptDetail() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取烹调方法文章ID
            $pt_id = request() -> param("cooking_id");
            // 获取烹调方法文章信息
            $PtModel = new PtModel();
            $ptinfo = $PtModel->getinfo($pt_id);
            // 获取所有烹调方法文章类别
            $pttype = pttypeModel::where("pid",0)->select();
            $usertype = Usertype::all();
            return $this->fetch("pt_detail",["usertype"=>$usertype,"pttype"=>$pttype,"ptinfo"=>$ptinfo[0]]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受烹调方法文章信息
            $arr = request()->param();
            $user = User::get($arr["user_id"]);
            $arr["user_name"] = $user -> user_name;
            unset($arr["file"]);
            // 插入
            $res = PtModel::update($arr,["cooking_id"=>$arr["cooking_id"]]);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    /*
     * 4 烹调方法文章删除操作
     * 4.1参数：pt_id 烹调方法文章ID
     * 4.2功能：
     *      4.2.1 post请求删除烹调方法文章信息
     * */
    public function ptDel()
    {
        if(request()->isPost()){
            
            $pt_id = request()->param("cooking_id");   // 类别id
            $res = PtModel::destroy($pt_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 6 获取烹调方法类型
     * 6.1 参数：pttype_id 烹调方法类型id
     * 6.2 功能：
     *       6.2.1 获取烹调方法类型
     * */
    public function pttype(){
        
        $pttype_id = request()->param("pttype_id");   //烹调方法ID
        
        $pttype = PttypeModel::where("pid",$pttype_id) -> select(); //烹调方法类型列表
        
        if($pttype){
            return json(['code'=>1,'msg'=>"查询成功",'pttype'=>$pttype]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
        
    }
    
    /*
     * 7 描述：修改是否下架
     * 7.1 参数：cooking_id  cooking_isoff:1->上架   2->下架
     * 7.2 功能：1.列表页面修改状态
     * 
     * */
    public function changeStatus()
    {
        // 接收数据
        $arr = request()->param();
        // 修改状态
        $res = PtModel::update($arr);
        if( $res ){
            return json(['code'=>1,'msg'=>'修改成功']);
        }else{
            return json(['code'=>2,'msg'=>'修改失败']);
        }
            
    }
    
    
}