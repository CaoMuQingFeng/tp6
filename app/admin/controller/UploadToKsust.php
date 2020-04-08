<?php

namespace app\admin\controller;

class UploadToKsust
{
    // public function index(){
    //     $url = 'https://kstore.ksust.com/api/v1/file/create';
    //     $timeout = 5;
    //     $data = [
    //         'access_token'  => '1003-df62803a14644db895bdde7515d36633',
    //         'fileId'        => '3027',
    //         'name'          => '1'
    //     ];
    //     return $this->curlUpload($url,$timeout,$data);
    // }
    // public function uploadFile($data)
    // {
    //     $ksustDir = $data['ksustDir'];
    //     $file = 123;
    //     return $file;

    // }
    //测试 请求接口
    public function curlUpload($info)
    {  
        // 构造post提交
        // 创建ID文件夹
        // 接收data
        $url = $info['createDirUrl'];
        $timeout = $info['createDirTimeout'];
        $data = $info['createDirData'];
        $dir = curl_init();
        $option = array(
            CURLOPT_URL                 => $url,
            CURLOPT_CONNECTTIMEOUT      => $timeout,
            CURLOPT_SSL_VERIFYPEER      => false,
            CURLOPT_SSL_VERIFYHOST      => false,
            CURLOPT_HEADER              => false,
            CURLOPT_POST                => true,
            CURLOPT_POSTFIELDS          => http_build_query($data),
            CURLOPT_RETURNTRANSFER      => true,      
        );
        curl_setopt_array($dir, $option);
        // 提交post
        $dirResult = curl_exec($dir);
        if (false == $dirResult) {
            echo curl_error($dir);
        }
        curl_close($dir);

        // 上传图片

        $arrData = json_decode($dirResult,true);
        $resultData = $arrData['data'];
        $dirId = $resultData['id'];

        // 接收data
        $url = 'https://upload.kstore.ksust.com/upload/'.$dirId;
        $timeout = $info['uploadImgTimeout'];
        $data = $info['uploadImgData'];
        $img = curl_init();
        // $data = array('file' => new \CURLFile(realpath($path)));
        // url_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_POST, 1 );
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl, CURLOPT_USERAGENT,"TEST");
        $option = array(
            CURLOPT_URL                 => $url,
            CURLOPT_CONNECTTIMEOUT      => $timeout,
            CURLOPT_SSL_VERIFYPEER      => false,
            CURLOPT_SSL_VERIFYHOST      => false,
            CURLOPT_HEADER              => false,
            CURLOPT_POST                => true,
            CURLOPT_POSTFIELDS          => http_build_query($data),
            CURLOPT_RETURNTRANSFER      => true,      
        );
        curl_setopt_array($img, $option);

        // 提交post
        $imgResult = curl_exec($img);
        if (false == $imgResult) {
            echo curl_error($img);
        }
        curl_close($img);

    }
}
