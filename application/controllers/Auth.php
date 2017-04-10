<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
    private $password = '';
    
    public function __construct() 
    {
        parent::__construct ();
        $this->load->model('Api_model');
        $this->load->helper ( array ( 'form','url') );
        $this->load->library('session');
        $this->config->load('custom');
    }
    
    public function index() 
    {
        $this->load->view ( 'login' );
    }
    
    public function login() 
    {
        $this->load->library ( 'form_validation' );

        $this->form_validation->set_rules ( 'email', 'Email', 'required' );
        $this->form_validation->set_rules ( 'password', 'Password', 'required' );
        if ($this->form_validation->run () == FALSE) 
        {
            $this->load->view ( 'login' ); 
        } 
        else 
        {
            if (isset ( $_POST ['login'] ) && ! empty ( $_POST ['login'] )) 
            {
                $url =  $this->config->item('api_url');
                $key =  $this->config->item('api_key');
                $email = $this->input->post('email',true);
                $password = md5($this->input->post('password',true));
                $time     = time();
                $sign     = md5($email . $password . $time . $key);
                $data = array(
                            'email'=>$email,
                            'password'=>$password,
                            'time'=>$time,
                            'sign'=>$sign,
                            'act'=>'login',
                             );
                 $session_data = array( 'email'  =>  $email );
                 
                if ($_POST ['login'] == 'login') 
                {
                    $ret = $this->Api_model->curl($url, $data);
                    $ret = json_decode($ret,true);
                    if ($ret['status'] === 1) 
                    {
                        $this->session->set_userdata($session_data);
                        redirect('/home' , 'auto', '');
                    }
                    else
                    {
                         echo "<script>window.alert('用户名或密码错误，请重新输入！');</script>";
                         $this->load->view ( 'login' );
                    }
                }
                else 
                {
                    $this->session->sess_destroy();
                    $this->load->view ( 'login' );
                }
            }
        }
    }
    
    function logout()
    {
        $array_items = array('email' => '', 'last_ip' => '', 'last_login' => '');
        $this->session->unset_userdata($array_items);
        $this->session->sess_destroy();
        redirect('/auth' , 'auto', '');
    }
       
    
}


