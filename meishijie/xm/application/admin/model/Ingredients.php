<?php
namespace app\admin\model;

use think\Model;

class Ingredients extends Model{
    /*
     * 一对一关联
     * 功能：与scType表(食材类别表)关联
     *
     * */
    public function scType()
    {
        return $this->hasOne('sctype','sctype_id','sctype_id')->bind(['sctype_name']);
    }
    /*
     * 根据查询条件查询食材信息
     *
     * */
    public function search($map,$page,$limit){
        $res = $this
        ->alias("i")
        ->join("sctype s","s.sctype_id = i.sctype_id")
        ->where($map)
        ->page($page)
        ->limit($limit)
        ->select();
        return $res;
    }
}