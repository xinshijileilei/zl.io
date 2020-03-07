<?php
namespace app\index\model;

use think\Model;

class Order extends Model{
    
    /*购买菜品：吃动平衡，名师制作*/
    public function courseInfo($map,$page,$limit){
        $res = $this
        ->alias("c")
        ->join("course o","c.type_id = o.course_id")
        ->where($map)
        ->page($page)
        ->limit($limit)
        ->order("c.create_time desc")
        ->select();
        return $res;
    }
    
    /*购买烹调方法*/
    public function cookingInfo($map,$page,$limit){
        $res = $this
        ->alias("c")
        ->join("cooking o","o.cooking_id = c.type_id")
        ->where($map)
        ->page($page)
        ->limit($limit)
        ->order("c.create_time desc")
        ->select();
        return $res;
    }
    
    /*购买妇幼食谱*/
    public function fyInfo($map,$page,$limit){
        $res = $this
        ->alias("c")
        ->join("recipes o","o.recipes_id = c.type_id")
        ->where($map)
        ->page($page)
        ->limit($limit)
        ->order("c.create_time desc")
        ->select();
        return $res;
    }
    
    /*购买营养知识*/
    public function yyInfo($map,$page,$limit){
        $res = $this
        ->alias("c")
        ->join("yyarticle o","o.yyarticle_id = c.type_id")
        ->where($map)
        ->page($page)
        ->limit($limit)
        ->order("c.create_time desc")
        ->select();
        return $res;
    }
    
    
    
    
    
    
    
}