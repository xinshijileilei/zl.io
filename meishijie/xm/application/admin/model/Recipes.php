<?php
namespace app\admin\model;

use think\Model;

class Recipes extends Model{
    /*
     * 一对一关联
     * 功能：与fyType表(妇幼类别表)关联
     *
     * */
    public function fyType()
    {
        return $this->hasOne('fytype','fytype_id','fytype_id')->bind(['fytype_name']);
    }
}