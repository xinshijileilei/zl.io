<?php
namespace app\index\model;

use think\Model;

class Fytype extends Model{
    /*
     * 与表fytype一对多关联
     * */
    public function two(){
        return $this -> hasMany("Fytype",'pid','fytype_id');
    }
    public function three(){
        return $this -> hasMany("Fytype",'pid','fytype_id');
    }
}