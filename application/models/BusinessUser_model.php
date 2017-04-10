<?php
class BusinessUser_model extends CI_Model {

    public function __construct(){
       // $this->load->database();
        $this->load->helper('url');
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

    public function setmail($user,$pwd){
        $this->load->library('email');            //加载CI的email类  
         
        //以下设置Email参数  
        $config['protocol'] = 'smtp';  
        $config['smtp_host'] = 'smtp.163.com';  
        $config['smtp_user'] = '13533882785@163.com';  
        $config['smtp_pass'] = '19891226asdlee';  
        $config['smtp_port'] = '25';  
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;  
        $config['mailtype'] = 'html';  
        $this->email->initialize($config);              
          
        //以下设置Email内容  
        $this->email->from('13533882785@163.com', '代理商系统');  
        $this->email->to($user);  
        $this->email->subject('代理商信息');  
        $this->email->message('你的代理商帐号是：'.$user.",密码是：".$pwd);  
       // $this->email->attach('application\controllers\1.jpeg');           //相对于index.php的路径  
  
        $this->email->send(); 
        $str = $this->email->print_debugger(); 
       
    }
    //订单列表
    public function getOrderList($game_id,$date,$order_id,$channel_id,$p){
       $url = $this->config->item("api_url");
       $key = $this->config->item("api_key");
       $channel_id = $channel_id;
       $email = $this->session->email;
       $time = time();
       $sign = md5($email. $game_id. $date.$order_id.$channel_id. $p . $time . $key);
       $data = array(
          'email'=>$email,
          'game_id'=>$game_id,
          'date'=>$date,
          'order_id'=>$order_id,
          'channel_id'=>$channel_id,
          'p'=>$p,
          'time'=>$time,
          'sign'=>$sign,
          'act'=>'list_order',
          'debug'=>'13852',
        );
       $result = $this->curl($url,$data);
       $result = json_decode($result,true);
       $info = array();
       if($result['status'] ==1 && !empty($result['data']['num'])){
            foreach($result['data']['list'] as $v){
                $str = "<div style='cursor:pointer' onclick=javascript:window.location.href='".base_url()."index.php/BusinessUser/orderDetail?id=".$v['transactionNo']."'>详情</div>";
                $res = array_values($v);

                $res[] = $str;
                $info[] = $res;
            }
            $result['data']['list'] = $info;
       }
       return $result;
    }

    //订单详情
    public function getOrderDetail($order_id){
         $url = $this->config->item("api_url");
         $key = $this->config->item("api_key");
         $email = $this->session->email;
         $time = time();
         $sign = md5($email.$order_id . $time . $key);
         $data = array(
             'email'=>$email,
             'order_id'=>$order_id,
             'time'=>$time,
             'sign'=>$sign,
             'act'=>'view_order',
         );
         $result = $this->curl($url,$data);
         $result = json_decode($result,true);
         return $result;
    }
   
}