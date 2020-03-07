<?php
namespace app\index\controller;

vendor('Qiniu.autoload');
use app\index\common\Base;
use app\index\model\User;
use think\Request;
use think\wxBizDataCrypt;
use app\index\model\Usertype;
use app\index\model\Collect;
use app\index\model\Course;
use app\index\model\Scroll;
use \Qiniu\Auth;
use \Qiniu\Storage\BucketManager;
use \Qiniu\Storage\UploadManager;

class Index extends Base
{
    
    /*
     * 首页轮播图接口
     * */
    public function scroll(){
        
        $res = Scroll::where("scroll_isoff",1)->select();
        
        if($res){
            return json(['code'=>1,'msg'=>'查询成功','data'=>$res]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
    }
    /*
     * 微信用户注册接口
     * 备注：  1 think中导入wxBizDataCrypt.php文件 ，errorCode.php文件
     *      2 修改以上两个文件的 namespace think
     *      3 修改php.ini 中的;extension=php_openssl.dll，去掉;号
     * */
    public function register(){
        $info = request()->param();
        
        // 防止未接收到用户信息
        if(empty($info)){
            return json(['code'=>3,'msg'=>'未接收到用户信息']);
        }
        
//         $appid = $info["appid"];
        
//         $sessionKey = $info["sessionKey"];
        
//         $encryptedData= $info["encryptedData"];
        
//         $iv = $info["iv"];
        
//         $pc = new WXBizDataCrypt($appid, $sessionKey);
//         $errCode = $pc->decryptData($encryptedData, $iv, $data );
        
//         if ($errCode == 0) {
//             $dataJson = json_decode($data);
//             $user["user_phone"] = $dataJson->phoneNumber;
//         } else {
//             return json(['code'=>4,'msg'=>'接收用户信息错误']);
//         }       
        $user["user_nickname"] = $info["user_nickname"];
        $user["usertype_id"] = 1;
        $user["create_time"] = time();
        $res = User::create($user);

        if($res){
            return json(['code'=>1,'msg'=>'注册成功']);
        }else{
            return json(['code'=>2,'msg'=>'注册失败']);
        }
    }
    
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
        
        $res = User::update($map,["user_id"=>$info["user_id"]]);
        
        if($res){
            return json(['code'=>1,'msg'=>'认证成功，请耐心等待审核结果']);
        }else{
            return json(['code'=>2,'msg'=>'认证失败']);
        }
    }
    
    /*
     * 图片上传功能
     * */
    public function img_upload()
    {
        // 接收图片
        $file = request()->file();
        // 防止未接收到图片信息
        if(empty($file)){
            return json(['code'=>3,'msg'=>'未接收到图片信息']);
        }
        // 移动位置
        $info = $file['file']->move(ROOT_PATH . 'public/static' . DS . 'uploads'. DS . 'index');
        
        if($info){
            
            // 自动生成部分的路径->20190528/alsdkfj2l34lkdjfa.jpg
            $name_path =str_replace('\\',"/",$info->getSaveName());
            // 原图路径
            $imgpath = "/public/static/uploads/index/".$name_path;
            
            /* 生成图片缩略图 */
            // 打开原图
            $image = \think\Image::open(ROOT_PATH . $imgpath);
            
            // 制作缩略图部分名称
            $filePart = substr($name_path,0,strpos($name_path, '.')).'thumb';
            $thumb = $filePart.".".$info->getExtension();
            
            // 缩略图路径
            $thumb_path = '/public/static/uploads/index/'.$thumb;
            //将图片裁剪为100x100并保存为 thumb原名.?
            $res = $image->thumb(100,100,\think\Image::THUMB_CENTER)->save(ROOT_PATH.$thumb_path);
            
            //成功上传后 获取上传信息
            return json(['code'=>1,'msg'=>'上传成功','img_url'=>$imgpath,'thumb_url'=>$thumb_path]);
        }else{
            // 上传失败获取错误信息
            return json(['code'=>2,'msg'=>'上传失败']);
        }
    }
    
    /*
     * 视频上传
     * */
    public function video_upload()
    {
        if(request()->isPost()){
            $file = request()->file('file');
            
            // 防止未接收到图片信息
            if(empty($file)){
                return json(['code'=>3,'msg'=>'未接收到视频信息']);
            }
            $vname = $_FILES['file']['type'];

            //获取文件的名字
            $key = time().$_FILES['file']['name'];
            $filePath=$_FILES['file']['tmp_name'];
            
            //获取token值
            $accessKey = '3VFT4Dmjxo_PcPdUtEx0QCE4dU-Hl6KZwBuRu2nU';
            $secretKey = 'JejfHMNXxNQXU6rC3rnK5obFpR94qFZ0jN52zjoU';
            // 初始化签权对象
            $auth = new Auth($accessKey, $secretKey);
            $bucket = 'xm'; //存储空间
            // 生成上传Token
            $token = $auth->uploadToken($bucket);
            $uploadMgr = new UploadManager();
            
            // 调用 UploadManager 的 putFile 方法进行文件的上传。
            list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
            
            $path = "http://pwmcv4411.bkt.clouddn.com/".$key;
            
            if ($err !== null) {
                return json(["code"=>2,"msg"=>"上传失败"]);
            } else {
                return json(["code"=>0,"msg"=>"上传成功","path"=>$path]);
            }
        }
    }
    
    
    
    /*
     * 搜索
     * */
    public function search(){
        
        $keyWord = request()->param("keyWord");
        // 防止未接收到用户信息
        if(empty($keyWord)){
            return json(['code'=>3,'msg'=>'未接收到搜索关键字']);
        }
        $res = Course::where("course_name","like","%$keyWord%")->select();
        
        if($res){
            return json(['code'=>1,'msg'=>'查询成功',"data"=>$res]);
        }else{
            return json(['code'=>2,'msg'=>'暂无数据']);
        }
    }
}
