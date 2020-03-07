<?php
namespace app\admin\model;

use think\Model;

class Pttype extends Model{
    
    protected $type = [
        'sort'      =>  'integer',          // 排序
    ];

    /*
     * 1 插入分类
     * 
     * */
    public function Acreate($arr){
        $pttype["pttype_name"] = $arr["pttype_name"];
        empty($arr["pttype_img"])?"":$pttype["pttype_img"] = $arr["pttype_img"];
        $pttype["pid"] = $arr["pttype_id"];
        $sort = $this -> where("pid",$arr['pttype_id']) -> max("sort");
        if($sort == 0){
            $sort = $arr["sort"];
        }
        if($arr["pttype_id"] == 0){
            $pttype["sort"] = ($sort + 10000);
            $pttype["level"] = 1;
        }elseif($arr["level"] == 1){
            $pttype["sort"] = ($sort + 1);
            $pttype["level"] = 2;
        }
        $pttype["create_time"] = time();
        
        $res = $this -> create($pttype);
        
        return($res);
    }
}