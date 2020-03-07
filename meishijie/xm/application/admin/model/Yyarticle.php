<?php
namespace app\admin\model;

use think\Model;

class Yyarticle extends Model{
    /*
     * 一对一关联
     * 功能：与yyType表(营养知识类别表)关联
     *
     * */
    public function yyType()
    {
        return $this->hasOne('yytype','yytype_id','yytype_id')->bind(['yytype_name']);
    }
    /*
     * 根据查询条件查询文章信息
     *
     * */
    public function search($map,$page,$limit){
        $res = $this
        ->alias("a")
        ->join("yytype y","y.yytype_id = a.yytype_id")
        ->where($map)
        ->page($page)
        ->limit($limit)
        ->order("a.create_time desc")
        ->select();
        return $res;
    }
}