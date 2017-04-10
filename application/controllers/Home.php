<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Common');
        $this->Common->is_login();
    }

    public function index()
    {
        $this->config->load('menu');
        $data['menu'] = $this->config->item('menu');

        $this->load->view('header',$data);
        $this->load->view('home');
        $this->load->view('footer');
    }
}
