<?php
namespace app\index\model;

use think\Model;

class Pttype extends Model{
    /*
     * 与表pttype一对多关联
     * */
    public function search(){
        return $this -> hasMany("Pttype",'pid','pttype_id');
    }
}