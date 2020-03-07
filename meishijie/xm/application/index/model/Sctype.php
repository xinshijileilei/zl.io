<?php
namespace app\index\model;

use think\Model;

class Sctype extends Model{
    /*
     * 与表sctype一对多关联
     * */
    public function two(){
        return $this -> hasMany("Sctype",'pid','sctype_id');
    }
    public function three(){
        return $this -> hasMany("Sctype",'pid','sctype_id');
    }
    public function four(){
        return $this -> hasMany("Sctype",'pid','sctype_id');
    }
}