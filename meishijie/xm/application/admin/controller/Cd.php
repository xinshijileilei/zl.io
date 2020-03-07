<?php
namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use app\admin\model\Course as CdModel;
use app\admin\model\Cdtype as CdtypeModel;
use app\admin\model\User as UserModel;
use app\admin\model\Main;
use app\admin\model\Assist;
use app\admin\model\Condiment;


class Cd extends Base {
    
    /*
     * 1 吃动平衡文章列表页面
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求查询根据条件完成搜索操作
     * */
    public function CdList() {  
        // 1.get请求渲染页面
        if(request()->isGet()){
            $cdtype = CdtypeModel::all();
            return $this->fetch("Cd_list",["cdtype"=>$cdtype]);
            // 2.post(ajax)请求获取吃动平衡文章列表
        }else{
            //接收查询条件
            $arr = input("param.");
            $map=[];
            empty($arr['cdtype_id'])?'':$map['c.cdtype_id']=$arr['cdtype_id'];
            empty($arr['course_name'])?'':$map["course_name"] = $arr['course_name'];
            empty($arr['course_ischarge'])?'':$map['course_ischarge']=$arr['course_ischarge'];
            empty($arr['course_isoff'])?'':$map["course_isoff"] = $arr['course_isoff'];
            empty($arr['balance_flag'])?'':$map["balance_flag"] = $arr['balance_flag'];
            $map["course_flag"] = 1;
            //接收分页信息
            $page = input("page");
            $limit = input("limit");
            
            $CdModel = new CdModel();
            $CdList = $CdModel->search($map,$page,$limit);
            $count = CdModel::count();
            if($CdList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$CdList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    /*
     * 2 吃动平衡文章添加页面
     * 2.1参数：
     * 2.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求完成数据的添加
     * */
    public function CdAdd() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取所有吃动平衡文章类别
            $Cdtype = CdtypeModel::all();
            // 获取所有用户姓名
            $users = UserModel::where("usertype_id","2")->select();
            
            return $this->fetch("cd_add",["cdtype"=>$Cdtype,"users"=>$users]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受吃动平衡文章信息
            $arr = request()->param();
            $arr["create_time"] = time();
            $user = UserModel::get($arr["user_id"]);
            $arr["user_name"] = $user -> user_name;
            unset($arr["file"]);
            // 插入
            $res = CdModel::create($arr);
            $course_id = $res -> course_id;
            $balance_flag = $res -> balance_flag;
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功','course_id'=>$course_id,"balance_flag"=>$balance_flag]);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        }
    }
    /*
     * 3 吃动平衡文章修改页面
     * 3.1参数：Cd_id 吃动平衡文章ID
     * 3.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求完成数据的修改
     * */
    public function CdDetail() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取吃动平衡文章ID
            $Cd_id = request() -> param("course_id");
            // 获取吃动平衡文章信息
            $Cdinfo = CdModel::get($Cd_id);
            // 获取所有吃动平衡文章类别
            $Cdtype = CdtypeModel::all();
            // 获取所有用户姓名
            $users = UserModel::where("usertype_id","2")->select();
            // 获取所有主料，辅料，调味品 

            $main = Main::where("course_id",$Cd_id) -> select();
            $assist = Assist::where("course_id",$Cd_id) -> select();
            $condiment = Condiment::where("course_id",$Cd_id) -> select();
            
            return $this->fetch("cd_detail",[
                "cdtype"=>$Cdtype,
                "users"=>$users,
                "cdinfo"=>$Cdinfo,
                "main" => $main,
                "assist" => $assist,
                "condiment" => $condiment
            ]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受吃动平衡文章信息
            $arr = request()->param();
            $user = UserModel::get($arr["user_id"]);
            $arr["user_name"] = $user -> user_name;
            unset($arr["file"]);
            // 插入
            $res = CdModel::update($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    /*
     * 4 吃动平衡文章删除操作
     * 4.1参数：Cd_id 吃动平衡文章ID
     * 4.2功能：
     *      4.2.1 post请求删除吃动平衡文章信息
     * */
    public function CdDel()
    {
        if(request()->isPost()){
            
            $Cd_id = request()->param("course_id");   // 类别id
            $res = CdModel::destroy($Cd_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 6 描述：修改是否下架
     * 6.1 参数：Cd_id  Cd_isoff:1->上架   2->下架
     * 6.2 功能：1.列表页面修改状态
     *
     * */
    public function changeStatus()
    {
        // 接收数据
        $arr = request()->param();
        // 修改状态
        $res = CdModel::update($arr);
        if( $res ){
            return json(['code'=>1,'msg'=>'修改成功']);
        }else{
            return json(['code'=>2,'msg'=>'修改失败']);
        }
        
    }
    
    
    
}