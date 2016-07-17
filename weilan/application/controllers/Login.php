<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/11
 * Time: 19:44
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

    public function index(){



        $this->load->view('admin/index.html');
    }

    public function add(){
     $name=$this->input->post('name');
        echo $name;



    }
}