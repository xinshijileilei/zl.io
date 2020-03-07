<?php
namespace app\admin\controller;

vendor('Qiniu.autoload');
use app\admin\common\Base;
use \Qiniu\Auth;
use \Qiniu\Storage\BucketManager;
use \Qiniu\Storage\UploadManager;

class Upload extends Base {
    
    /*
     * 描述：图片上传功能
     * 1 参数：
     * 2 功能：1.图片上传
     *
     * */
    public function img_upload()
    {
        // 接收图片
        $file = request()->file();
        // 移动位置
        $info = $file['file']->move(ROOT_PATH . 'public/static' . DS . 'uploads'. DS . 'admin');
        
        if($info){
            
            // 自动生成部分的路径->20190528/alsdkfj2l34lkdjfa.jpg
            $name_path =str_replace('\\',"/",$info->getSaveName());
            // 原图路径
            $imgpath = "/public/static/uploads/admin/".$name_path;
            
            /* 生成图片缩略图 */
            // 打开原图
            $image = \think\Image::open(ROOT_PATH . $imgpath);
            
            // 制作缩略图部分名称
            $filePart = substr($name_path,0,strpos($name_path, '.')).'thumb';
            $thumb = $filePart.".".$info->getExtension();
            
            // 缩略图路径
            $thumb_path = '/public/static/uploads/admin/'.$thumb;
            //将图片裁剪为100x100并保存为 thumb原名.?
            $res = $image->thumb(100,100,\think\Image::THUMB_CENTER)->save(ROOT_PATH.$thumb_path);
            
            //成功上传后 获取上传信息
            $result["code"] = '0';
            $result["msg"] = "上传成功";
            $result['data']["src"] = "/xm".$imgpath;
            $result["img_url"] = $imgpath;
            $result["thumb_url"] = $thumb_path;
        }else{
            // 上传失败获取错误信息
            $result["code"] = '2';
            $result["msg"] = "上传失败";
        }
        return json($result);
    }
    
    /*
     * 视频上传
     * */
    public function video_upload()
    {
        if(request()->isPost()){
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
}
        
            
                      
            
            
            
            
            
            
            
      
    
