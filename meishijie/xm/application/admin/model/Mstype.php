<?php
namespace app\admin\model;

use think\Model;

class Mstype extends Model{
    
    protected $type = [
        'sort'      =>  'integer',          // 排序
    ];

    /*
     * 1 插入分类
     * 
     * */
    public function Acreate($arr){
        $mstype["mstype_name"] = $arr["mstype_name"];
        empty($arr["mstype_img"])?"":$mstype["mstype_img"] = $arr["mstype_img"];
        $mstype["pid"] = $arr["mstype_id"];
        $sort = $this -> where("pid",$arr['mstype_id']) -> max("sort");
        if($sort == 0){
            $sort = $arr["sort"];
        }
        if($arr["mstype_id"] == 0){
            $mstype["sort"] = ($sort + 10000);
            $mstype["level"] = 1;
        }elseif($arr["level"] == 1){
            $mstype["sort"] = ($sort + 1);
            $mstype["level"] = 2;
        }
        $mstype["create_time"] = time();
        
        $res = $this -> create($mstype);
        
        return($res);
    }
}