<?php
/**
 * HexPang
 */
namespace hexpang\APIHelper;

class Helper{
    var $baseUrl;
    var $error;
    private static $_instance = null;
    public function __construct($baseurl)
    {
        $this->baseUrl = $baseurl;
    }
    public static function SharedDefaults($url){
        if(!Helper::$_instance){
            Helper::$_instance = new Helper($url);
        }
        return Helper::$_instance;
    }
    public function Post($path,$post_data){
        $ch = curl_init();
        //This might throw error
        //if(is_array($post_data)){
        //    $post_data = http_build_query($post_data);
        //}
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        $output = curl_exec($ch);
        if($output === false){
            $this->error = curl_error($ch);
        }
        curl_close($ch);
        $output = json_decode($output,true);
        return $output;
    }

    public function Get($path){
        //初始化
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        if($output === false){
            $this->error = curl_error($ch);
        }
        //释放curl句柄
        curl_close($ch);
        //打印获得的数据
        $output = json_decode($output,true);
        return $output;
    }
}
?>
