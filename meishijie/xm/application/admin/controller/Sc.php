<?php
namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use app\admin\model\Ingredients as ScModel;
use app\admin\model\Sctype as SctypeModel;


class Sc extends Base {
    
    /*
     * 1 食材文章列表页面
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求查询根据条件完成搜索操作
     * */
    public function scList() {  
        // 1.get请求渲染页面
        if(request()->isGet()){
            $sctype = SctypeModel::where("level","1")->select();
            return $this->fetch("sc_list",["sctype"=>$sctype]);
            // 2.post(ajax)请求获取食材文章列表
        }else{
            //接收查询条件
            $arr = input("param.");
            $map=[];
            empty($arr['sctype_id'])?'':$map['s.sctype_id']=$arr['sctype_id'];
            empty($arr['ingredients_name'])?'':$map["ingredients_name"] = $arr['ingredients_name'];
    
            //接收分页信息
            $page = input("page");
            $limit = input("limit");
            
            $ScModel = new ScModel();
            $scList = $ScModel->search($map,$page,$limit);
            $count = ScModel::count();
            if($scList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$scList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    
    /*
     * 2 食材文章添加页面
     * 2.1参数：
     * 2.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求完成数据的添加
     * */
    public function scAdd() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取所有食材文章类别
            $sctype = SctypeModel::where("pid","0")->select();
            return $this->fetch("sc_add",["sctype"=>$sctype]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受食材文章信息
            $arr = request()->param();
            $arr["ingredients_flag"] = implode(",",$arr["ingredients_flag"]);
            $arr["create_time"] = time();
            unset($arr["file"]);

            // 插入
            $res = ScModel::create($arr);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功']);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        }
    }
    
    
    /*
     * 3 食材文章修改页面
     * 3.1参数：sc_id 食材文章ID
     * 3.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求完成数据的修改
     * */
    public function scDetail() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取食材文章ID
            $sc_id = request() -> param();
            // 获取食材文章信息
            $scinfo = ScModel::get($sc_id);
            $scinfo["ingredients_flag"] = explode(",",$scinfo["ingredients_flag"]);
//             dump($scinfo);
//             exit();
            $one = SctypeModel::where("sctype_id",$scinfo->sctype_id)->select();
            $two = SctypeModel::where("sctype_id",$one[0]->pid)->select();
            $three = SctypeModel::where("sctype_id",$two[0]->pid)->select();
            $four = SctypeModel::where("sctype_id",$three[0]->pid)->select();
            // 获取所有食材文章类别
            $sctype = SctypeModel::where("level","1")->select();
            return $this->fetch("sc_detail",[
                "sctype"=>$sctype,
                "scinfo"=>$scinfo,
                "one"=>$one[0],
                "two"=>$two[0],
                "three"=>$three[0],
                "four"=>$four[0]
            ]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受食材文章信息
            $arr = request()->param();
            $arr["ingredients_flag"] = implode(",",$arr["ingredients_flag"]);
            unset($arr["file"]);
            // 插入
            $res = ScModel::update($arr,["ingredients_id"=>$arr["ingredients_id"]]);
            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    
    
    /*
     * 4 食材文章删除操作
     * 4.1参数：sc_id 食材文章ID
     * 4.2功能：
     *      4.2.1 post请求删除食材文章信息
     * */
    public function scDel()
    {
        if(request()->isPost()){
            
            $sc_id = request()->param("ingredients_id");   // 类别id
            $res = ScModel::destroy($sc_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    
    /*
     * 6 获取食材类型
     * 6.1 参数：sctype_id 食材类型id
     * 6.2 功能：
     *       6.2.1 获取食材类型
     * */
    public function sctype(){
        
        $sctype_id = request()->param("sctype_id");   //食材ID
        
        $sctype = SctypeModel::where("pid",$sctype_id) -> select(); //食材类型列表
        
        if($sctype){
            return json(['code'=>1,'msg'=>"查询成功",'sctype'=>$sctype]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
        
    }
    
}