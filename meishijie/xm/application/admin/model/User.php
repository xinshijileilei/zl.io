<?php
namespace app\admin\model;

use think\Model;

class User extends Model{
    /*
     * 一对一关联
     * 功能：与userType表(用户类别表)关联
     *
     * */
    public function userType()
    {
        return $this->hasOne('usertype','usertype_id','usertype_id')->bind(['usertype_name']);
    }
    
    /*
     * 根据查询条件查询用户信息
     *
     * */
    public function search($map,$page,$limit){
        $res = $this
        ->alias("u")
        ->join("usertype us","us.usertype_id = u.usertype_id")
        ->where($map)
        ->page($page)
        ->limit($limit)
        ->order("u.create_time desc")
        ->select();
        return $res;
    }
    
    /*
     * 根据查询条件查询用户信息
     *
     * */
    public function csearch($map,$page,$limit){
        $res = $this
        ->alias("u")
        ->join("usertype us","us.usertype_id = u.usertype_id")
        ->where($map)
        ->where("user_audit != 1")
        ->page($page)
        ->limit($limit)
        ->order("user_audit asc")
        ->select();
        return $res;
    }
    
    
    
    
    
}