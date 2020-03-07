<?php
namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Main as MainModel;
use app\admin\model\Assist;
use app\admin\model\Condiment;
use app\admin\model\Course as CourseModel;

class Dosag extends Base {
    /*
     * 1 添加菜品食材用量
     * 1.1参数：菜品ID course_id
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post(ajax)请求添加数据
     * */
    public function DosagAdd(){
            // 接受分类信息  
            $info = request()->param();
            

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
     * 3 菜品用料删除操作
     * 3.1参数：Ms_id 名师制作文章ID
     * 3.2功能：
     *      3.2.1 post请求删除名师制作文章信息
     * */
    public function DosagDel()
    {
        if(request()->isPost()){
            
            $rep = request()->param();
            
            $course_id = $rep["course_id"];
            switch ($rep["flag"])
            {
                case "main":
                    $res = MainModel::destroy($course_id);          // 删除
                    break;
                case "assist":
                    $res = Assist::destroy($course_id);          // 删除
                    break;
                case "condiment":
                    $res = Condiment::destroy($course_id);          // 删除
                    break;
                default:
                    return json(["code"=>3,"msg"=>"提交数据有误，暂无数据"]);
            }
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 4 食材用量修改操作
     * 4.1参数：dosag_id 营养知识类别ID
     * 4.2功能：
     *      4.2.1 get请求渲染页面，返回分类信息
     *      4.2.2 post请求方式修改分类信息
     * */
    public function dosagdetail()
    {
        if(request()->isPost()){
            $rep = request()->param();
            switch ($rep["flag"])
            {
                case "main_name":
                    $res = MainModel::update(["main_name"=>$rep["val"]],["main_id"=>$rep["id"]]);
                    break;
                case "main_num":
                    $res = MainModel::update(["main_num"=>$rep["val"]],["main_id"=>$rep["id"]]);
                    break;
                case "assist_name":
                    $res = Assist::update(["assist_name"=>$rep["val"]],["assist_id"=>$rep["id"]]);
                    break;
                case "assist_num":
                    $res = Assist::update(["assist_num"=>$rep["val"]],["assist_id"=>$rep["id"]]);
                    break;
                case "condiment_name":
                    $res = Condiment::update(["condiment_name"=>$rep["val"]],["condiment_id"=>$rep["id"]]);
                    break;
                case "condiment_num":
                    $res = Condiment::update(["condiment_num"=>$rep["val"]],["condiment_id"=>$rep["id"]]);
                    break;
                default:
                    return json(["code"=>3,"msg"=>"提交数据有误，暂无数据"]);
            }
            
            if($res){
                return json(['code'=>1,'msg'=>'更新成功']);
            }else{
                return json(['code'=>2,'msg'=>'更新失败']);
            }
        }
    }
    
}