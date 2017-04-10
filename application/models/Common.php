<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 公共模型
 * 对SESSION的操作
 * 全局权限验证
 * 2017-03-21
 */
class Common extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this -> load -> library('session');
        $this -> load -> helper('url');
    }

    //判断用户是否已经登录
    public function is_login() 
    {
        $email = $this->session->email; 
        if(!$email)
        {
            redirect('/auth', 'auto', '');
       }
    }


}
