<?php
namespace app\index\model;

use think\Model;

class Mstype extends Model{
    /*
     * 与表mstype一对多关联
     * */
    public function search(){
        return $this -> hasMany("Mstype",'pid','mstype_id');       
    }
    
    public function course(){
        return $this -> hasOne("Course",'type_id','mstype_id');
    }
}