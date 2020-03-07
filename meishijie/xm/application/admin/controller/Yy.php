<?php
namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use app\admin\model\Yyarticle as YyarticleModel;
use app\admin\model\Yytype as YytypeModel;
use app\admin\model\Usertype;
use app\admin\model\User;


class Yy extends Base {
    
    /*
     * 1 营养知识文章列表页面
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求查询根据条件完成搜索操作
     * */
    public function yyList() {  
        // 1.get请求渲染页面
        if(request()->isGet()){
            $yytype = YytypeModel::all();
            return $this->fetch("yy_list",["yytype"=>$yytype]);
            // 2.post(ajax)请求获取营养知识文章列表
        }else{
            //接收查询条件
            $arr = input("param.");
            $map=[];
            empty($arr['yytype_id'])?'':$map['y.yytype_id']=$arr['yytype_id'];
            empty($arr['yyarticle_title'])?'':$map["a.yyarticle_title"] = $arr['yyarticle_title'];
            empty($arr['yyarticle_ischarge'])?'':$map['yyarticle_ischarge']=$arr['yyarticle_ischarge'];
            empty($arr['yyarticle_isoff'])?'':$map["a.yyarticle_isoff"] = $arr['yyarticle_isoff'];
            //接收分页信息
            $page = input("page");
            $limit = input("limit");
            
            $yyArticle = new YyarticleModel();
            $yyList = $yyArticle->search($map,$page,$limit);

            $count = YyarticleModel::count();
            if($yyList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$yyList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    /*
     * 2 营养知识文章添加页面
     * 2.1参数：
     * 2.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求完成数据的添加
     * */
    public function yyAdd() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取所有营养知识文章类别
            $yytype = yytypeModel::all();
            // 获取所有用户类别
            $usertype = Usertype::all();
            
            return $this->fetch("yy_add",["yytype"=>$yytype,"usertype"=>$usertype]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受营养知识文章信息
            $arr = request()->param();
            $arr["create_time"] = time();
            $user = User::get($arr["user_id"]);
            $arr["user_name"] = $user -> user_name;
           
            unset($arr["file"]);
            // 插入
            $res = YyarticleModel::create($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功']);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        }
    }
    /*
     * 3 营养知识文章修改页面
     * 3.1参数：yy_id 营养知识文章ID
     * 3.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求完成数据的修改
     * */
    public function yyDetail() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取营养知识文章ID
            $yy_id = request() -> param();
            // 获取营养知识文章信息
            $yyinfo = YyarticleModel::get($yy_id);
            // 获取所有营养知识文章类别
            $yytype = yytypeModel::all();
            // 获取所有用户类别
            $usertype = Usertype::all();
            return $this->fetch("yy_detail",["yytype"=>$yytype,"yyinfo"=>$yyinfo,"usertype"=>$usertype]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受营养知识文章信息
            $arr = request()->param();
            $user = User::get($arr["user_id"]);
            $arr["user_name"] = $user -> user_name;
            unset($arr["file"]);
            // 插入
            $res = YyarticleModel::update($arr,["yyarticle_id"=>$arr["yyarticle_id"]]);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    /*
     * 4 营养知识文章删除操作
     * 4.1参数：yy_id 营养知识文章ID
     * 4.2功能：
     *      4.2.1 post请求删除营养知识文章信息
     * */
    public function yyDel()
    {
        if(request()->isPost()){
            
            $yy_id = request()->param("yyarticle_id");   // 类别id
            $res = YyarticleModel::destroy($yy_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    
    /*
     * 6 描述：修改是否下架
     * 6.1 参数：yyarticle_id  yyarticle_isoff:1->上架   2->下架
     * 6.2 功能：1.列表页面修改状态
     *
     * */
    public function changeStatus()
    {
        // 接收数据
        $arr = request()->param();
        // 修改状态
        $res = YyarticleModel::update($arr);
        if( $res ){
            return json(['code'=>1,'msg'=>'修改成功']);
        }else{
            return json(['code'=>2,'msg'=>'修改失败']);
        }
        
    }
    
    
}