<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Updatepwd extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api_model'); //请求接口模型
        $this->load->helper(array('form', 'url')); 
        $this->load->library('form_validation'); 
        $this->load->library('session');
        $this->config->load('menu');//左侧目录
        $this->config->load('custom'); //API全局配置
       
        $this->load->model('Common'); //登录验证全局文件
        $this->Common->is_login();

    }

    public function index()
    {
        $data['menu'] = $this->config->item('menu');
        $data['menu_title'] = "用户管理";
        $data['menu_child_title'] = "修改密码";  
        
        $this->load->view('header',$data);
        $this->load->view('users/updatepwd');
        $this->load->view('footer');
    }
    
    
    public function update_password()
    {
        $data['menu'] = $this->config->item('menu');
        $data['menu_title'] = "用户管理";
        $data['menu_child_title'] = "修改密码";
        
        $this->form_validation->set_rules('oldpwd', 'Password', 'required');
        $this->form_validation->set_rules('newpwd', 'Password', 'required',array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('newpwdconf', 'Password Confirmation', 'required');  

        if ($this->form_validation->run() == TRUE)
        {
            if(isset ($_POST ['submit'] ))
            {
                $url =  $this->config->item('api_url');
                $key =  $this->config->item('api_key');
                $email = $this->session->email;
                $oldpwd = md5($this->input->post('oldpwd', TRUE));
                $newpwd = md5($this->input->post('newpwd', TRUE));
                $newpwdconf = md5($this->input->post('newpwdconf', TRUE));
                $time = time();
                if($newpwd !== $newpwdconf)
                {
                    echo "<script>window.alert('两次输入的新密码不一致！');</script>";  
                }
                else
                {
                   $datalist=array(
                       'email' => $email,
                       'password' => $oldpwd,
                       'new_password' => $newpwd,
                       'time' => $time,
                       'sign' => md5($email . $oldpwd . $newpwd . $time . $key),
                       'act' => 'edit_password'
                   );
                   
                    $ret = $this->Api_model->curl($url, $datalist);
                    $ret = json_decode($ret,true);
                    if ($ret['status'] === 1) 
                    {
                        echo "<script>window.alert('修改成功！');</script>";  
                    }
                    else
                    {
                         echo "<script>window.alert('修改失败，可能是原密码输入错误！');</script>";
                    }
                }
            }
        }
  
        $this->load->view('header',$data);
        $this->load->view('users/updatepwd');
        $this->load->view('footer');

    }

        
}
