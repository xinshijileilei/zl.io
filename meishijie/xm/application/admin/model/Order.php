<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class Order extends Model{
    public function search($map,$page,$limit){
        $res = Db::name("order")
        ->alias("o")
        ->join("user u","u.user_id = o.user_id","LEFT")
        ->join("course c","c.course_id = o.type_id AND (order_flag = 1 OR order_flag = 2)","LEFT")
        ->join("cooking k","k.cooking_id = o.type_id AND order_flag = 3","LEFT")
        ->join("yyarticle e","e.yyarticle_id = o.type_id AND order_flag = 4","LEFT")
        ->where($map)
        ->page($page) 
        ->limit($limit)
        ->field("o.order_id,u.user_name,c.course_name,k.cooking_name,e.yyarticle_title,o.order_status,o.order_flag,o.create_time")
        ->select();
       
        foreach ($res as $key => $val){
            $res[$key]["create_time"] = date('Y-m-s h:i:s',$res[$key]["create_time"]);
            if( $val['course_name'] ){
                
                unset($res[$key]['cooking_name']);
                unset($res[$key]['yyarticle_title']);
                $res[$key]['na'] = $val['course_name'];
                unset($res[$key]['course_name']);
                
            }
            if( $val['cooking_name'] ){
                
                unset($res[$key]['course_name']);
                unset($res[$key]['yyarticle_title']);
                $res[$key]['na'] = $val['cooking_name'];
                unset($res[$key]['cooking_name']);
                
            }
            if( $val['yyarticle_title']){
                
                unset($res[$key]['cooking_name']);
                unset($res[$key]['course_name']);
                $res[$key]['na'] = $val['yyarticle_title'];
                unset($res[$key]['yyarticle_title']);
            }
        }
        
        
        
        return $res;
    }
    
    
}