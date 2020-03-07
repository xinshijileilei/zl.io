<?php
namespace app\admin\model;

use think\Model;

class Course extends Model{
    /*
     * 一对一关联
     * 功能：与cdType表(食材类别表)关联
     *
     * */
    public function cdType()
    {
        return $this->hasOne('cdtype','cdtype_id','type_id')->bind(['cdtype_name']);
    }
    /*
     * 
     *
     * */
    public function msType()
    {
        return $this->hasOne('mstype','mstype_id','type_id')->bind(['mstype_name']);
    }
    /*
     * 根据菜品ID查询菜品信息
     *
     * */
    public function getinfo($id){
        $info = $this
        ->alias("c")
        ->join("mstype m","m.mstype_id = c.type_id")
        ->where("course_id",$id)
        ->select();
        return $info;
    }
    
    /*
     * 根据查询条件查询吃动平衡菜品信息
     *
     * */
    public function search($map,$page,$limit){
        $res = $this
        ->alias("c")
        ->join("cdtype d","d.cdtype_id = c.type_id")
        ->where($map)
        ->page($page)
        ->limit($limit)
        ->order("c.create_time desc")
        ->select();
        return $res;
    }
    /*
     * 根据查询条件查询名师制作菜品信息
     *
     * */
    public function msearch($map,$page,$limit){
        $res = $this
        ->alias("c")
        ->join("mstype m","m.mstype_id = c.type_id")
        ->where($map)
        ->page($page)
        ->limit($limit)
        ->order("c.create_time desc")
        ->select();
        return $res;
    }
        
    
    
    
    
}