<?php
namespace app\index\controller;
use app\index\common\Base;
use app\index\model\Course as CourseModel;
use app\index\model\Cooking;
use app\index\model\Yyarticle;
use app\index\model\Dosag as DosagModel;
use app\index\model\Usertype as UsertypeModel;

class Release extends Base
{
    
    /*
     * 发布：1吃动平衡  2名师制作  3烹调方法  4营养知识
     * */
    public function release(){
        
        $info = request() -> param();
        //验证是否有参数传递
        if( empty($info) ){
            return json(['code'=>3,'msg'=>'参数传递错误']);
        }
        $info["create_time"] = time();
        
        switch ($info["release_flag"])
        {
            case "1":
                $res = CourseModel::create($info);
                $id = $res -> course_id;
                break;
            case "2":
                $res = CourseModel::create($info);
                $id = $res -> course_id;
                break;
            case "3":
                $res = Cooking::create($info);
                $id = $res -> cooking_id;
                break;
            case "4":
                $res = Yyarticle::create($info);
                $id = $res -> yyarticle_id;
                break;
            default:
                return json(["code"=>4,"msg"=>"提交数据有误，暂无数据"]);
        }
        // 判断插入是否成功
        if($res){
            return json(['code'=>1,'msg'=>'发布成功',"id"=>$id]);
        }else{
            return json(['code'=>2,'msg'=>'发布失败']);
        }
    }
    
    /*菜品用量*/
    public function dosag(){
        // 接受分类信息
        $info = request()->param();
        
        //验证是否有参数传递
        if( empty($info) ){
            return json(['code'=>3,'msg'=>'未接收到用料信息']);
        }
        
        $main = [];
        empty($info["main_name"])?$info["main_name"]=[]:$info["main_name"] = $info["main_name"];
        empty($info["main_num"])?$info["main_num"]=[]:$info["main_num"] = $info["main_num"];
        foreach($info["main_name"] as $key => $value){
            foreach($info["main_num"] as $k => $v){
                if($key == $k){
                    $main[$key] = ["course_id"=>$info["course_id"],"main_name"=>$value,"main_num"=>$v,"create_time"=>time()];
                }
            }
        }
        
        $mainModel = new MainModel();
        $mainres = $mainModel->saveAll($main);
        
        $assist = [];
        empty($info["assist_name"])?$info["assist_name"]=[]:$info["assist_name"] = $info["assist_name"];
        empty($info["assist_num"])?$info["assist_num"]=[]:$info["assist_num"] = $info["assist_num"];
        foreach($info["assist_name"] as $key => $value){
            foreach($info["assist_num"] as $k => $v){
                if($key == $k){
                    $assist[$key] = ["course_id"=>$info["course_id"],"assist_name"=>$value,"assist_num"=>$v,"create_time"=>time()];
                }
            }
        }
        $assistModel = new Assist();
        $assistres = $assistModel->saveAll($assist);
        
        $condiment = [];
        empty($info["condiment_name"])?$info["condiment_name"]=[]:$info["condiment_name"] = $info["condiment_name"];
        empty($info["condiment_num"])?$info["condiment_num"]=[]:$info["condiment_num"] = $info["condiment_num"];
        foreach($info["condiment_name"] as $key => $value){
            foreach($info["condiment_num"] as $k => $v){
                if($key == $k){
                    $condiment[$key] = ["course_id"=>$info["course_id"],"condiment_name"=>$value,"condiment_num"=>$v,"create_time"=>time()];
                }
            }
        }
        $condimentModel = new Condiment();
        $condimentres = $condimentModel->saveAll($condiment);
        
        // 判断插入是否成功
        if($mainres || $assistres || $condimentres){
            return json(['code'=>1,'msg'=>"用料添加成功"]);
        }else{
            return json(['code'=>2,'msg'=>"用料添加失败"]);
        }
    }
    
    /*
     * 修改发布的作品：1吃动平衡  2名师制作  3烹调方法  4营养知识
     * */
    public function releaseUpd(){
        
        $info = request() -> param();
        //验证是否有参数传递
        if( empty($info) ){
            return json(['code'=>3,'msg'=>'参数传递错误']);
        }
        
        switch ($info["release_flag"])
        {
            case "1":
                $res = CourseModel::update($info);
                break;
            case "2":
                $res = CourseModel::update($info);
                break;
            case "3":
                $res = Cooking::update($info);
                break;
            case "4":
                $res = Yyarticle::update($info);
                break;
            default:
                return json(["code"=>4,"msg"=>"提交数据有误，暂无数据"]);
        }
        // 判断插入是否成功
        if($res){
            return json(['code'=>1,'msg'=>'修改成功']);
        }else{
            return json(['code'=>2,'msg'=>'修改失败']);
        }
    }
    
    /*我的发布 1吃动平衡  2名师制作  3烹调方法  4营养知识*/
    public function myRelease(){
        $page = input("page");//页码
        $limit = input("limit");//每页条数
        $user_id = input("user_id");//用户ID
        $release_flag = input("release_flag");//模块标识
        
        // 防止未接收到用户信息
        if(empty($user_id) || empty($release_flag)){
            return json(['code'=>3,'msg'=>'未接收到发布信息']);
        }
        
        //验证
        $page = isset($page)?$page:1;
        $limit = isset($limit)?$limit:5;
        
        $map = [];
        $map["user_id"] = $user_id;

        switch ($release_flag)
        {
            case "1":
                $map["course_flag"] = 1;
                $res = CourseModel::where($map)->page($page)->limit($limit)->select();          // 吃动平衡
                break;
            case "2":
                $map["course_flag"] = 2;
                $res = CourseModel::where($map)->page($page)->limit($limit)->select();           // 名师制作
                break;
            case "3":
                $res = Cooking::where($map)->page($page)->limit($limit)->select();        // 烹调方法
                break;
            case "4":
                $res = Yyarticle::where($map)->page($page)->limit($limit)->select();          // 营养知识
                break;
            default:
                return json(["code"=>4,"msg"=>"提交数据有误，暂无数据"]);
        }
        
        if($res){
            return json(['code'=>1,'msg'=>'查询成功',"data"=>$res]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
    }
    
    /*
     * 删除我发布的作品： 1吃动平衡  2名师制作  3烹调方法  4营养知识
     * */
    public function releaseDel(){
        $id = input("id");//ID
        $release_flag = input("release_flag");//模块标识
        
        // 防止未接收到用户信息
        if(empty($id) || empty($release_flag)){
            return json(['code'=>3,'msg'=>'未接收到发布信息']);
        }
        
        switch ($release_flag)
        {
            case "1":
                $res = CourseModel::destroy($id);          // 吃动平衡
                break;
            case "2":
                $res = CourseModel::destroy($id);           // 名师制作
                break;
            case "3":
                $res = Cooking::destroy($id);        // 烹调方法
                break;
            case "4":
                $res = Yyarticle::destroy($id);          // 营养知识
                break;
            default:
                return json(["code"=>4,"msg"=>"提交数据有误，暂无数据"]);
        }
        
        if($res){
            return json(['code'=>1,'msg'=>'删除成功']);
        }else{
            return json(['code'=>2,'msg'=>'删除失败']);
        }
    }
    
}







