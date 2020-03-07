<?php
namespace app\admin\model;

use think\Model;

class Fytype extends Model{
    
    protected $type = [
        'sort'      =>  'integer',          // 排序
    ];

    /*
     * 1 插入分类
     * 
     * */
    public function Acreate($arr){
        $fytype["fytype_name"] = $arr["fytype_name"];
        empty($arr['fytype_img'])?"":$fytype["fytype_img"] = $arr["fytype_img"];
        $fytype["pid"] = $arr["fytype_id"];
        $sort = $this -> where("pid",$arr['fytype_id']) -> max("sort");
        if($sort == 0){
            $sort = $arr["sort"];
        }
        if($arr["fytype_id"] == 0){
            $fytype["sort"] = ($sort + 1000000);
            $fytype["level"] = 1;
        }elseif($arr["level"] == 1){
            $fytype["sort"] = ($sort + 1000);
            $fytype["level"] = 2;
        }elseif($arr["level"] == 2){
            $fytype["sort"] = ($sort + 1);
            $fytype["level"] = 3;
        }
        $fytype["create_time"] = time();
        
        $res = $this -> create($fytype);
        
        return($res);
    }
}