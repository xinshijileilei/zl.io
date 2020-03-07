<?php
namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use app\admin\model\Recipes as FyModel;
use app\admin\model\Fytype as FytypeModel;
use app\admin\model\Fruits;
use app\admin\model\Food;
use app\admin\model\Staple;
use app\admin\model\Nuts;


class Fy extends Base {
    
    /*
     * 1 妇幼营养文章列表页面
     * 1.1参数：
     * 1.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求查询根据条件完成搜索操作
     * */
    public function FyList() {  
        // 1.get请求渲染页面
        if(request()->isGet()){
            $Fytype = FytypeModel::where("level","1")->select();
            return $this->fetch("Fy_list",["fytype"=>$Fytype]);
            // 2.post(ajax)请求获取妇幼营养文章列表
        }else{
            $arr = input("param.");
            $map=[];
            empty($arr['fytype_id'])?'':$map['fytype_id']=$arr['fytype_id'];
            empty($arr['recipes_name'])?'':$map["recipes_name"] = $arr['recipes_name'];
            empty($arr['recipes_isoff'])?'':$map["recipes_isoff"] = $arr['recipes_isoff'];
            //接收分页信息
            $page = input("page");
            $limit = input("limit");
            
            $FyList = FyModel::with("fyType")->where($map)->page($page)->limit($limit)->select();
            $count = FyModel::count();
            if($FyList){
                return json(['code'=>0,'msg'=>'查询成功','count'=>$count,'data'=>$FyList]);
            }else{
                return json(['code'=>1,'msg'=>'暂无数据']);
            }
        }
    }
    
    /*
     * 2 妇幼营养文章添加页面
     * 2.1参数：
     * 2.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求完成数据的添加
     * */
    public function FyAdd() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取所有妇幼营养文章类别
            $Fytype = FytypeModel::where("level","1")->select();
            return $this->fetch("fy_add",["fytype"=>$Fytype]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受妇幼营养文章信息
            $arr = request()->param();
            $arr["create_time"] = time();
            unset($arr["file"]);
            // 插入
            $res = FyModel::create($arr);
            $recipes_id = $res -> recipes_id;

            // 判断插入是否成功
            if($res){
                return json(['code'=>1,'msg'=>'新增成功','recipes_id'=>$recipes_id]);
            }else{
                return json(['code'=>2,'msg'=>'新增失败']);
            }
        }
    }
    /*
     * 3 妇幼营养文章修改页面
     * 3.1参数：Fy_id 妇幼营养文章ID
     * 3.2功能：
     *        1.2.1 默认get请求渲染页面
     *        1.2.2 post请求完成数据的修改
     * */
    public function fyDetail() {
        // 1.get请求渲染页面
        if(request()->isGet()){
            // 获取妇幼营养食谱ID
            $Fy_id = request() -> param("recipes_id");
            // 获取妇幼营养文章信息
            $Fyinfo = FyModel::where("recipes_id",$Fy_id)->select();
            $one = FytypeModel::get($Fyinfo[0]->fytype_id);
            $two = FytypeModel::where("fytype_id",$one->pid)->select();
            $three = FytypeModel::where("fytype_id",$two[0]->pid)->select();
            // 获取所有妇幼营养文章类别
            $Fytype = FytypeModel::where("level",1)->select();
            //食谱中水果
            $fruits = Fruits::where("recipes_id",$Fy_id)->select();
            //食谱中菜品
            $food = Food::where("recipes_id",$Fy_id)->select();
            //食谱中主食
            $staple = Staple::where("recipes_id",$Fy_id)->select();
            //食谱中坚果
            $nuts = Nuts::where("recipes_id",$Fy_id)->select();
            
            return $this->fetch("fy_detail",[
                "one"=>$one, //联动三级
                "two"=>$two[0], //联动二级
                "three"=>$three[0], //联动一级
                "fytype"=>$Fytype,
                "fyinfo"=>$Fyinfo[0],
                "fruits"=>$fruits,
                "food"=>$food,
                "staple"=>$staple,
                "nuts"=>$nuts]);
            // 2.post(ajax)请求获取学生列表
        }else{
            // 接受妇幼营养文章信息
            $arr = request()->param();
            unset($arr["file"]);

            // 修改
            $res = FyModel::update($arr,["recipes_id"=>$arr["recipes_id"]]);

            // 判断修改是否成功
            if($res){
                return json(['code'=>1,'msg'=>'基本信息修改成功，请继续修改菜品']);
            }else{
                return json(['code'=>2,'msg'=>'修改失败']);
            }
        }
    }
    /*
     * 4 妇幼营养文章删除操作
     * 4.1参数：Fy_id 妇幼营养文章ID
     * 4.2功能：
     *      4.2.1 post请求删除妇幼营养文章信息
     * */
    public function fyDel()
    {
        if(request()->isPost()){
            
            $Fy_id = request()->param("recipes_id");   // 类别id
            $res = FyModel::destroy($Fy_id);          // 删除
            
            if($res){
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>2,'msg'=>'删除失败']);
            }
        }
    }
    
    /*
     * 5 描述：修改是否下架
     * 5.1 参数：recipes_id  recipes_isoff:1->上架   2->下架
     * 5.2 功能：1.列表页面修改状态
     *
     * */
    public function changeStatus()
    {
        // 接收数据
        $arr = request()->param();
        // 修改状态
        $res = FyModel::update($arr);
        if( $res ){
            return json(['code'=>1,'msg'=>'修改成功']);
        }else{
            return json(['code'=>2,'msg'=>'修改失败']);
        }
        
    }
    
    /*
     * 6 获取妇幼营养类型
     * 6.1 参数：Fytype_id 妇幼营养类型id
     * 6.2 功能：
     *       6.2.1 获取妇幼营养类型
     * */
    public function fytype(){
        
        $Fytype_id = request()->param("fytype_id");   //妇幼营养ID
        
        $Fytype = FytypeModel::where("pid",$Fytype_id) -> select(); //妇幼营养类型列表
        
        if($Fytype){
            return json(['code'=>1,'msg'=>"查询成功",'fytype'=>$Fytype]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
        
    }
    
    /*
     * 7 添加食谱中的菜品
     * */
    public function repAdd(){
        $info = request() -> param();
        
        $fruits = [];
        empty($info["recipes_fruits"])?$info["recipes_fruits"]=[]:$info["recipes_fruits"] = $info["recipes_fruits"];
        empty($info["recipes_fruits_num"])?$info["recipes_fruits_num"]=[]:$info["recipes_fruits_num"] = $info["recipes_fruits_num"];
        foreach($info["recipes_fruits"] as $key => $value){
            foreach($info["recipes_fruits_num"] as $k => $v){
                if($key == $k){
                    $fruits[$key] = ["recipes_id"=>$info["recipes_id"],"recipes_fruits"=>$value,"recipes_fruits_num"=>$v];
                }
            }
        }
        
        $FruitsModel = new Fruits();
        $fruitsres = $FruitsModel->saveAll($fruits);
        
        $food = [];
        empty($info["recipes_food"])?$info["recipes_food"]=[]:$info["recipes_food"] = $info["recipes_food"];
        empty($info["recipes_food_num"])?$info["recipes_food_num"]=[]:$info["recipes_food_num"] = $info["recipes_food_num"];
        foreach($info["recipes_food"] as $key => $value){
            foreach($info["recipes_food_num"] as $k => $v){
                if($key == $k){
                    $food[$key] = ["recipes_id"=>$info["recipes_id"],"recipes_food"=>$value,"recipes_food_num"=>$v];
                }
            }
        }
        $FoodModel = new Food();
        $foodres = $FoodModel->saveAll($food);
        
        $staple = [];
        empty($info["recipes_staple"])?$info["recipes_staple"]=[]:$info["recipes_staple"] = $info["recipes_staple"];
        empty($info["recipes_staple_num"])?$info["recipes_staple_num"]=[]:$info["recipes_staple_num"] = $info["recipes_staple_num"];
        foreach($info["recipes_staple"] as $key => $value){
            foreach($info["recipes_staple_num"] as $k => $v){
                if($key == $k){
                    $staple[$key] = ["recipes_id"=>$info["recipes_id"],"recipes_staple"=>$value,"recipes_staple_num"=>$v];
                }
            }
        }
        $StapleModel = new Staple();
        $stapleres = $StapleModel->saveAll($staple);
        
        $nuts = [];
        empty($info["recipes_nuts"])?$info["recipes_nuts"]=[]:$info["recipes_nuts"] = $info["recipes_nuts"];
        empty($info["recipes_nuts_num"])?$info["recipes_nuts_num"]=[]:$info["recipes_nuts_num"] = $info["recipes_nuts_num"];
        foreach($info["recipes_nuts"] as $key => $value){
            foreach($info["recipes_nuts_num"] as $k => $v){
                if($key == $k){
                    $nuts[$key] = ["recipes_id"=>$info["recipes_id"],"recipes_nuts"=>$value,"recipes_nuts_num"=>$v];
                }
            }
        }
        $NutsModel = new Nuts();
        $nutsres = $NutsModel->saveAll($nuts);
        
        
        
        if($fruitsres || $foodres || $stapleres || $nutsres){
            return json(['code'=>1,'msg'=>"食谱添加成功"]);
        }else{
            return json(['code'=>2,'msg'=>"食谱添加失败"]);
        }
        
    }
    
    /*
     * 8 删除食谱中的菜品
     * */
    public function repDel(){
        if(request()->isPost()){
            
            $rep = request()->param();
            
            $recipes_id = $rep["recipes_id"];
            switch ($rep["rep_flag"])
            {
                case "fruits":
                    $res = Fruits::destroy($recipes_id);          // 删除             
                    break;
                case "food":
                    $res = Food::destroy($recipes_id);          // 删除
                    break;
                case "staple":
                    $res = Staple::destroy($recipes_id);          // 删除
                    break;
                case "nuts":
                    $res = Nuts::destroy($recipes_id);          // 删除
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
         * 9 更新食谱中的菜品
         * */
        public function repUpd(){
            if(request()->isPost()){
                $rep = request()->param();
                switch ($rep["rep_flag"])
                {
                    case "fruits":
                        $res = Fruits::update(["recipes_fruits"=>$rep["val"]],["fruit_id"=>$rep["id"]]);       
                        break;
                    case "fruits_num":
                        $res = Fruits::update(["recipes_fruits_num"=>$rep["val"]],["fruit_id"=>$rep["id"]]);  
                        break;
                    case "food":
                        $res = Food::update(["recipes_food"=>$rep["val"]],["food_id"=>$rep["id"]]);       
                        break;
                    case "food_num":
                        $res = Food::update(["recipes_food_num"=>$rep["val"]],["food_id"=>$rep["id"]]);
                        break;
                    case "staple":
                        $res = Staple::update(["recipes_staple"=>$rep["val"]],["staple_id"=>$rep["id"]]);
                        break;
                    case "staple_num":
                        $res = Staple::update(["recipes_staple_num"=>$rep["val"]],["staple_id"=>$rep["id"]]);
                        break;
                    case "nuts":
                        $res = Nuts::update(["recipes_nuts"=>$rep["val"]],["nuts_id"=>$rep["id"]]);
                        break;
                    case "nuts_num":
                        $res = Nuts::update(["recipes_nuts_num"=>$rep["val"]],["nuts_id"=>$rep["id"]]);
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