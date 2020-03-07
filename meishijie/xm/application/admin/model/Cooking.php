<?php
namespace app\admin\model;

use think\Model;

class Cooking extends Model{
    /*
     * 一对一关联
     * 功能：与ptType表(食材类别表)关联
     *
     * */
    public function ptType()
    {
        return $this->hasOne('pttype','pttype_id','pttype_id')->bind(['pttype_name']);
    }
    /*
     *
     * 获取烹调信息
     * */
    public function getinfo($id){
        $info = $this
        ->alias("c")
        ->join("pttype p","p.pttype_id = c.pttype_id")
        ->where("cooking_id",$id)
        ->select();
        return $info;
    }
    /*
     * 根据查询条件查询烹调方法信息
     *
     * */
    public function search($map,$page,$limit){
        $res = $this
        ->alias("c")
        ->join("pttype p","p.pttype_id = c.pttype_id")
        ->where($map)
        ->page($page)
        ->limit($limit)
        ->select();
        return $res;
    }
}