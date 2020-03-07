<?php
namespace app\admin\model;

use think\Model;

class Sctype extends Model{
    
    protected $type = [
        'sort'      =>  'integer',          // 排序
    ];

    /*
     * 1 插入分类
     * 
     * */
    public function Acreate($arr){
        $sctype["sctype_name"] = $arr["sctype_name"];
        empty($arr["sctype_img"])?"":$sctype["sctype_img"] = $arr["sctype_img"];
        $sctype["pid"] = $arr["sctype_id"];
        $sort = $this -> where("pid",$arr['sctype_id']) -> max("sort");
        if($sort == 0){
            $sort = $arr["sort"];
        }
        if($arr["sctype_id"] == 0){
            $sctype["sort"] = ($sort + 1000000);
            $sctype["level"] = 1;
        }elseif($arr["level"] == 1){
            $sctype["sort"] = ($sort + 10000);
            $sctype["level"] = 2;
        }elseif($arr["level"] == 2){
            $sctype["sort"] = ($sort + 100);
            $sctype["level"] = 3;
        }elseif($arr["level"] == 3){
            $sctype["sort"] = ($sort + 1);
            $sctype["level"] = 4;
        }
        $sctype["create_time"] = time();
        
        $res = $this -> create($sctype);
        
        return($res);
    }
}