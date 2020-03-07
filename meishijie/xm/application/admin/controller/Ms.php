<?php
namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use app\admin\model\Course as MsModel;
use app\admin\model\Mstype as MstypeModel;
use app\admin\model\User as UserModel;
use app\admin\model\Usertype as UsertypeModel;
use app\admin\model\Main;
use app\admin\model\Assist;
use app\admin\model\Condiment;



class Ms extends Base {
    
    /*
     * 1 名师制作文章列表页面
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求查询根据条件完成搜索操作
     * */
    public function MsList() {  
        // 1.get请求渲染页面
        if(request()->isGet()){
            $Mstype = MstypeModel::where("level","1")->select();
            return $this->fetch("ms_list",["mstype"=>$Mstype]);
            // 2.post(ajax)请求获取名师制作文章列表
        }else{
            //接收查询条件
            $arr = input("param.");
            $map=[];
            empty($arr['type_id'])?'':$map['m.mstype_id']=$arr['type_id'];
            empty($arr['course_name'])?'':$map["course_name"] = $arr['course_name'];
            empty($arr['course_ischarge'])?'':$map['course_ischarge']=$arr['course_ischarge'];
            empty($arr['course_isoff'])?'':$map["course_isoff"] = $arr['course_isoff'];
            $map["course_flag"] = 2;
            //接收分页信息
            $page = input("page");
            $limit = input("limit");
            
//             dump($map);
//             exit;
            $MsModel = new MsModel();
            $MsList = $MsModel->msearch($map,$page,$limit);
            
            $count = MsModel::count();
            if($MsList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$MsList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    /*
     * 2 名师制作文章添加页面
     * 2.1参数：
     * 2.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求完成数据的添加
     * */
    public function MsAdd() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取所有名师制作文章类别
            $Mstype = MstypeModel::where("level","1")->select();
            // 获取用户类型
            $usertype = UsertypeModel::where("usertype_id!=1 AND usertype_id!=2")->select();
            
            return $this->fetch("Ms_add",["mstype"=>$Mstype,"usertype"=>$usertype]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受名师制作文章信息
            $arr = request()->param();
            $arr["create_time"] = time();
            $user = UserModel::get($arr["user_id"]);
            $arr["user_name"] = $user -> user_name;
            unset($arr["file"]);
            // 插入
            $res = MsModel::create($arr);
            $course_id = $res -> course_id;
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'添加菜品成功，请继续添加用料','course_id'=>$course_id]);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        }
    }
    /*
     * 3 名师制作文章修改页面
     * 3.1参数：Ms_id 名师制作文章ID
     * 3.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求完成数据的修改
     * */
    public function MsDetail() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取名师制作文章ID
            $Ms_id = request() -> param("course_id");
            // 获取名师制作文章信息
            $msModel = new MsModel();
            $Msinfo = $msModel -> getinfo($Ms_id);

            // 获取所有名师制作文章类别
            $Mstype = MstypeModel::where("level","1")->select();
            // 获取所有用户姓名
            $usertype = UsertypeModel::where("usertype_id!=1 AND usertype_id!=2")->select();
            // 获取所有主料，辅料，调味品   
            $main = Main::where("course_id",$Ms_id) -> select();
            $assist = Assist::where("course_id",$Ms_id) -> select();
            $condiment = Condiment::where("course_id",$Ms_id) -> select();
            return $this->fetch("Ms_detail",[
                "mstype"=>$Mstype,
                "usertype"=>$usertype,
                "msinfo"=>$Msinfo[0],
                "main" => $main,
                "assist" => $assist,
                "condiment" => $condiment
            ]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受名师制作文章信息
            $arr = request()->param();
            $user = UserModel::get($arr["user_id"]);
            $arr["user_name"] = $user -> user_name;
            unset($arr["file"]);
            // 插入
            $res = MsModel::update($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    /*
     * 4 名师制作文章删除操作
     * 4.1参数：Ms_id 名师制作文章ID
     * 4.2功能：
     *      4.2.1 post请求删除名师制作文章信息
     * */
    public function MsDel()
    {
        if(request()->isPost()){
            
            $Ms_id = request()->param("course_id");   // 类别id
            $res = MsModel::destroy($Ms_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 6 描述：修改是否下架
     * 6.1 参数：Ms_id  Ms_isoff:1->上架   2->下架
     * 6.2 功能：1.列表页面修改状态
     *
     * */
    public function changeStatus()
    {
        // 接收数据
        $arr = request()->param();
        // 修改状态
        $res = MsModel::update($arr);
        if( $res ){
            return json(['code'=>1,'msg'=>'修改成功']);
        }else{
            return json(['code'=>2,'msg'=>'修改失败']);
        }
        
    }
    /*
     * 7 获取用户
     * 7.1 参数：mstype_id 用户id
     * 7.2 功能：
     *       7.2.1 获取用户
     * */
    public function mstype(){
        
        $mstype_id = request()->param("mstype_id");   //名师制作ID
        
        $mstype = MstypeModel::where("pid",$mstype_id) -> select(); //用户列表
        
        if($mstype){
            return json(['code'=>1,'msg'=>"查询成功",'mstype'=>$mstype]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
        
    }
    /*
     * 8 获取用户
     * 8.1 参数：usertype_id 用户id
     * 8.2 功能：
     *       8.2.1 获取用户
     * */
    public function user(){
        
        $usertype_id = request()->param("usertype_id");   //用户类别ID
        
        $user = UserModel::where("usertype_id",$usertype_id) -> select(); //用户列表
        
        if($user){
            return json(['code'=>1,'msg'=>"查询成功",'user'=>$user]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
        
    }
    
    
}