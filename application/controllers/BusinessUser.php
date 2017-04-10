<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BusinessUser extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BusinessUser_model');
        $this->load->model('Api_model');
        $this->load->helper('url');
        $this->config->load('custom');
        
        $this->load->library('session');
        $this->load->model('Common');
        $this->Common->is_login();
    }
    //随机生成密码
    private function getPwd($length = 6){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = "";
        for ( $i = 0; $i < $length; $i++ ){ 
            // 这里提供两种字符获取方式 
            // 第一种是使用 substr 截取$chars中的任意一位字符； 
            // 第二种是取字符数组 $chars 的任意元素 
            // $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1); 
            $password .= $chars[ mt_rand(0, strlen($chars) - 1) ]; 
        } 
        return $password; 
    }

    //添加商户页面
    public function add()
    {
        //$this->BusinessUser_model->getUserInfo();
        
        $this->config->load('menu');
        $data['menu'] = $this->config->item('menu');
        $data['menu_title'] = "用户管理";
        $data['menu_child_title'] = "增加商户";
        $channel = $this->Api_model->getChannel();
        $channelrate = $this->Api_model->getChannelRate();
        
        $channel_id = array();
        if(!empty($channel)){
            foreach($channel as $v){
                $channel_id[] = $v['id'];
            }

        }
        $channel_id = json_encode($channel_id);
        $result['channel'] = $channel;
        $result['channelrate'] = $channelrate;
        $result['channel_id'] = $channel_id;
        $this->load->view('header',$data);
        $this->load->view('businessuser/add',$result);
        $this->load->view('footer');
    
    }
   //添加商户ajax
    public function updateUser(){
        $channel = $this->input->post('channel',true);
        $str1 = explode("&",$channel);
        $channel_str = array();
        foreach($str1 as $val){
            $str2 = explode("=",$val);
            $r = array();
            $r['set'] = 1;
            $r['charge'] = $str2[1];
            $channel_str[$str2[0]] = $r;
        }
      
        $recharge = json_encode($channel_str);
       
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Username', 'required|trim');
        $this->form_validation->set_rules('account', 'Account', 'required|trim');
        $pwd = $this->getPwd();
        if($this->form_validation->run() == false){
            $message = array('status'=>10001,'msg'=>'请完整填写信息！');
            echo json_encode($message);
            exit;
        }
        
        $url = $this->config->item("api_url");
        $key = $this->config->item("api_key");
        $time = time();
        $email    = $this->session->email;      //代理商邮箱
        $cpname = $this->input->post('name',true);           //添加商户的 商户名
        $username = $this->input->post('account',true); //添加商户的 登录账号
        $password =md5($pwd);       //添加商户的 登录密码
    
        $sign = md5($email . urlencode($cpname).$username .$password . $recharge.$time . $key);

        $data = array(
             'email'=>$email,
             'cpname'=>$cpname,
             'username'=>$username,
             'password'=>$password,
             'recharge'=>$recharge,
             'time'=>$time,
             'sign'=>$sign,
             'act'=>'add_firm',
         );
        $data = $this->Api_model->curl($url,$data);
        
        $info = json_decode($data,true);
       
        if($info['status'] == 1){
            $this->BusinessUser_model->setmail($username,$pwd);
        }
        echo $data;
        
    }

    //查看商户信息页面
    public function userList(){
        $this->config->load('menu');
        $res['menu'] = $this->config->item('menu');
        $res['menu_title'] = "用户管理";
        $res['menu_child_title'] = "查看商户信息";
        $this->load->view('header',$res);
        $this->load->view('businessuser/userList');
        $this->load->view('footer');
    }
    public function getUserList(){
        $url = $this->config->item("api_url");
        $key = $this->config->item("api_key");
        $email = $this->session->email;      //代理商邮箱
        $time = time();
        $sign = md5($email . $time . $key);
        $data = array(
        'email'=>$email,
        'time'=>$time,
        'sign'=>$sign,
        'act'=>'list_firm',
        );
        $data = $this->Api_model->curl($url,$data);
        $data = json_decode($data,true);
        $result['draw'] = $this->input->post('draw',true);
        
        $result['recordsTotal'] = $data['data']['num'];
        $result['recordsFiltered'] = $data['data']['num'];
        $info = array();
        if(empty($data) || $data['status'] != 1){
            echo json_encode($result);
        }else{
            foreach($data['data']['list'] as $k => $v){
                $res = array();
                //$str = "<a href='".base_url()."index.php/BusinessUser/userDetail?id=".$k."'>查看</a>";
                $str = "<div style='cursor:pointer' onclick=javascript:window.location.href='".base_url()."index.php/BusinessUser/userDetail?id=".$v['id']."'>详情</div>";
                $id = $v['id'];
                $cpname = $v['cpname'];
                $open = 0;
                if($v['open'] == 0){
                    $open = '关闭';
                }else{
                    $open = '开启';
                }
                $status = $v['status'];
                $res = array($id,$cpname,$open,$status,$str);
                $info[] = $res;
            }
        }
        
        $start = $this->input->post('start',true);
        $length = $this->input->post('length',true);
        $info = array_slice($info,$start,$length);
        $result['data'] = $info;
       
        echo json_encode($result);
    }
    //商户详情
    public function userDetail(){
        $url = $this->config->item("api_url");
        $key = $this->config->item("api_key");
        $email = $this->session->email;
        $time = time();
        $id = $_GET['id'];
        $sign     = md5($email.$id . $time . $key);
        $data = array(
            'email'=>$email,
            'id'=>$id,
            'time'=>$time,
            'sign'=>$sign,
            'act'=>'view_firm',
        );
        $data = $this->Api_model->curl($url,$data);
        $data = json_decode($data,true);
        $result = array();
        if(!empty($data) && $data['status'] == 1){
           $result['data'] = $data['data'];
        }
        $this->config->load('menu');
        $res['menu'] = $this->config->item('menu');
        $res['menu_title'] = "用户管理";
        $res['menu_child_title'] = "查看商户信息";

        $this->load->view('header',$res);
        $this->load->view('businessuser/userDetail',$result);
        $this->load->view('footer');
    }

    public function userdata(){
     
       $data['draw'] = $this->input->post('draw',true);
       $data['recordsTotal'] = 0;
       $data['recordsFiltered'] = 0;
       $data['data'] = array();
       $email = $this->session->email;
       $game_id = $this->input->post('game',true);           // 游戏id
       $date = $this->input->post('datepicker',true);   // 查询日期 date('Y-m-d') 格式
       $p = floor($this->input->post('start',true)/$this->input->post('length',true))+1; // 当前页码  分页10条1页
       $order_id = $this->input->post('orderid',true);  //订单码
       $channel_id = $this->input->post('channel',true);
       $info = $this->BusinessUser_model->getOrderList($game_id,$date,$order_id,$channel_id,$p);
       if($info['status'] == 1 && !empty($info['data']['num'])){
           $data['recordsTotal'] = $info['data']['num'];
           $data['recordsFiltered'] = $info['data']['num'];
           $data['data'] = $info['data']['list'];
       }
      
       //$data['data'] = array(
       // array("ferf1","rgerg","ger","gdrg","gergh","sds","2017-01-03 10:22:20"),
       // array("ferf2","rgerg","ger","gdrg","gergh","sds","2017-01-03 10:22:20")
        //);
      
       //$data['recordsTotal'] = count($data['data']);
       //$data['recordsFiltered'] = count($data['data']);
       //$data['data'] = array_slice($data['data'],$_POST['start'],$_POST['length']);
       echo json_encode($data);
    }
    //订单列表页面
    public function orderList(){
        $result['times'] = date('Y-m-d',time());
        $result['cpname'] = $this->Api_model->getCpName();
        $result['channel'] = $this->Api_model->getChannel();
        $result['times'] = date('Y-m-d',time());
        $this->config->load('menu');
        $res['menu'] = $this->config->item('menu');
        $res['menu_title'] = "订单管理";
        $res['menu_child_title'] = "订单列表";
        $this->load->view('header',$res);
        $this->load->view('businessuser/orderList',$result);
        $this->load->view('footer');
    }
    //订单详情页
    public function orderDetail(){
        if(empty($_GET['id'])){
            redirect("/businessUser/orderList","auto");
            exit;
        }
        
        $order_id = $_GET['id'];
        $info = $this->BusinessUser_model->getOrderDetail($order_id);
        if($info['status'] == 1){
            $result['data'] = $info['data'];
        }else{
            $result['data'] = array();
        }
        
        $this->config->load('menu');
        $res['menu'] = $this->config->item('menu');
        $res['menu_title'] = "订单管理";
        $res['menu_child_title'] = "订单列表";
        $this->load->view('header',$res);
        $this->load->view('businessuser/orderDetail',$result);
        $this->load->view('footer');
    }

    //根据cp_id查游戏  ajax
    public function getGame(){
        $id = $this->input->post('id',true);
        $game = $this->Api_model->getAllGame($id);
        //$game = array(array('id'=>18,'name'=>'魔兽世家'),array('id'=>14,'name'=>'口袋妖怪'),array('id'=>78,'name'=>'愚公遇上'));
        echo json_encode($game);
    }

    public function test(){
         $url = $this->config->item("api_url");
         $key = $this->config->item("api_key");
         $time = time();
         $email    = 'lisongrong@youxigu.com';   //代理商邮箱
         $password = md5('DtdH76');   // 登录密码
         $sign     = md5($email . $password . $time . $key);

         $data = array(
             'email'=>$email,
             'password'=>$password,
             'time'=>$time,
             'sign'=>$sign,
             'act'=>'login',
         );
         $data = $this->Api_model->curl($url,$data);
        $data = json_decode($data,true);
        print_r($data);

    }

    public function test2(){
        $url = $this->config->item("api_url");
        $key = $this->config->item("api_key");
        $time = time();
        $email    = 'test@tg.com';      //代理商邮箱
        $game_id = 19;           // 游戏id
        $date = '2017-03-23';   // 查询日期 date('Y-m-d') 格式
        $p = 1; // 当前页码  分页10条1页
        $order_id=''; //订单码
        $channel_id =1;
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
        $data = $this->Api_model->curl($url,$data);
        $data = json_decode($data,true);
        print_r($data);
        //$this->load->view('businessuser/test2');
    }
}
