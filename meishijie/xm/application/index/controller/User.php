<?php
namespace app\index\controller;

vendor('Qiniu.autoload');
use app\index\common\Base;
use app\index\model\User as UserModel;
use app\index\model\Usertype;

class User extends Base
{
    
    /*
     * 用户类别接口
     * */
    public function usertype(){
        
        $res = Usertype::where("usertype_id != 1 OR usertype_id !=2")->select();
        
        if($res){
            return json(['code'=>1,'msg'=>'查询成功','data'=>$res]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
    }
    
    /*
     * 用户列表接口
     * */
    public function user(){
        $usertype_id = request()->param("usertype_id");
        $cdtype_id = request()->param("cdtype_id");
        // 防止未接收到用户信息
        if(empty($usertype_id)){
            return json(['code'=>3,'msg'=>'未接收到用户类别信息']);
        }
        
        $map = [];
        $map["usertype_id"] = $usertype_id;
        empty($cdtype_id)?"":$map["cdtype_id"] = $cdtype_id;
        $res = UserModel::where($map)->select();
        
        if($res){
            return json(['code'=>1,'msg'=>'查询成功','data'=>$res]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
    }
    
    /*
     * 用户认证接口
     * */
    public function authentication(){
        $info = request()->param();
        
        // 防止未接收到用户信息
        if(empty($info)){
            return json(['code'=>3,'msg'=>'未接收到用户信息']);
        }
        
        $map = [];
        
        empty($info['user_name'])?'':$map['user_name']=$info['user_name'];
        empty($info['usertype_id'])?$map['usertype_id']=1:$map['usertype_id']=$info['usertype_id'];
        empty($info['user_cardid'])?'':$map['user_cardid']=$info['user_cardid'];
        empty($info['user_cardpica'])?'':$map['user_cardpica']=$info['user_cardpica'];
        empty($info['user_cardpicb'])?'':$map['user_cardpicb']=$info['user_cardpicb'];
        empty($info['user_certificate'])?'':$map['user_certificate']=$info['user_certificate'];
        empty($info['user_pic'])?'':$map['user_pic']=$info['user_pic'];
        empty($info['user_address'])?'':$map['user_address']=$info['user_address'];
        empty($info['user_years'])?'':$map['user_years']=$info['user_years'];
        $map["user_audit"] = "2";
        
        $res = UserModel::update($map,["user_id"=>$info["user_id"]]);
        
        if($res){
            return json(['code'=>1,'msg'=>'认证成功，请耐心等待审核结果']);
        }else{
            return json(['code'=>2,'msg'=>'认证失败']);
        }
    }
    
}
