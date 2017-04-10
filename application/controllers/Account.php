<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Api_model');
        $this->config->load('menu');
        $this->config->load('custom');
        $this->load->model('Common');
        $this->Common->is_login();
    }
    
    public function index()
    {
        $data['menu'] = $this->config->item('menu');
        $data['menu_title'] = "订单管理";
        $data['menu_child_title'] = "对账单";
        $data['agents'] =$this->Api_model->getCpName(); //厂商下拉列表
        $data['channels'] = $this->Api_model->getChannel(); //渠道下拉列表
        
        if(isset ($_POST ['search'] ))
        {
            $url =  $this->config->item('api_url');
            $key =  $this->config->item('api_key');
            $email = $this->session->email;
            $agent = $this->input->post('agent', TRUE);
            $game = $this->input->post('game', TRUE);
            $channel = $this->input->post('channel', TRUE);
            $date_start_end =$this->input->post('date_time', TRUE);
            $date_time = explode('/', $date_start_end);
            $time = time();

           $datalist=array(
               'email' => $email,
               'channel_id' => $channel,
               'firm_id' => $agent,
               'game_id' => $game,
               'start' => trim($date_time[0]),
               'end' => trim($date_time[1]),
               'time' => $time,
               'sign' => md5($email . trim($date_time[0]) . trim($date_time[1]) . $channel . $agent . $game . $time . $key),
               'act' => 'view_statement',
               'debug'=>'13852'
           );

            $ret = $this->Api_model->curl($url, $datalist);
            $ret = json_decode($ret,true);

            if($ret['status'] != 1)
            {
                echo "<script>window.alert('数据获取失败！');</script>";  
            }
        }
       
        $this->load->view('header',$data);
        $this->load->view('order/account', isset($ret)?$ret:'');
        $this->load->view('footer');
    }
    

    //根据厂商ID获得游戏列表  ajax
    public function getGame()
    {
        $id = $this->input->post('id',true);
        $game = $this->Api_model->getAllGame($id);
        //$game = array(array('id'=>18,'name'=>'魔兽世家'),array('id'=>14,'name'=>'口袋妖怪'),array('id'=>78,'name'=>'愚公遇上')); //测试数据
        echo json_encode($game);
    }

    
}
