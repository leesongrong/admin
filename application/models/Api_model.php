<?php
class Api_model extends CI_Model 
{

    public function __construct()
    {
      
    }

    public function curl($url, $data)
    {
        $ch      = curl_init();
        $timeout = 30;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // 从证书中检查SSL加密算法是否存在

        $html     = curl_exec($ch);
        $curlinfo = curl_getinfo($ch);
        curl_close($ch);
        // var_dump($curlinfo);
        return $html;
    }

    //取得所有厂商
    public function getCpName(){
        $url = $this->config->item("api_url");
        $key = $this->config->item("api_key");
        $email = $this->session->email;
        $time = time();
        $sign = md5($email . $time . $key);
        $data = array(
             'email'=>$email,
             'time'=>$time,
             'sign'=>$sign,
             'act'=>'list_firm',
        );
        $result = $this->curl($url,$data);
        $result = json_decode($result,true);
        $info = array();
        if($result['status'] == 1 && !empty($result['data']['num'])){
            $info = $result['data']['list'];
        }
        return $info;

    }

    //取得所有游戏
    public function getAllGame($cp_id){    //$cp_id为厂商id
        $url = $this->config->item("api_url");
        $key = $this->config->item("api_key");
        $email = $this->session->email;
        $time = time();
        $sign = md5($email. $cp_id . $time . $key);
        $data = array(
            'email'=>$email,
            'firm_id'=>$cp_id,
            'time'=>$time,
            'sign'=>$sign,
            'act'=>'list_game',
            'debug'=>'13852',
         );
        $result = $this->curl($url,$data);
        $result = json_decode($result,true);
        $info = array();
        if($result['status'] == 1 && !empty($result['data']['num'])){
            $info = $result['data']['list'];
        }
        return $info;
    }

    //取得所有渠道
    public function getChannel(){
        $url = $this->config->item("api_url");
        $key = $this->config->item("api_key");
        $email = $this->session->email;
        $time = time();
        $sign = md5($email . $time . $key);
        $data = array(
            'email'=>$email,
            'time'=>$time,
            'sign'=>$sign,
            'act'=>'list_channel',
        );
        $result = $this->curl($url,$data);
        $result = json_decode($result,true);
        $info = array();
        if($result['status'] == 1 && !empty($result['data']['num'])){
            $info = $result['data']['list'];
        }
        return $info;
    }
    //取得所有渠道税率
    public function getChannelRate(){
        $url = $this->config->item("api_url");
        $key = $this->config->item("api_key");
        $email = $this->session->email;
        $time = time();
        $sign     = md5($email . $time . $key);
        $data = array(
        'email'=>$email,
        'time'=>$time,
        'sign'=>$sign,
        'act'=>'view_recharge',
        );
        $result = $this->curl($url,$data);
        $result = json_decode($result,true);
        $info = array();
        if($result['status'] == 1){
            $info = $result['data'];
        } 
        return $info; 
    }

   
   
}