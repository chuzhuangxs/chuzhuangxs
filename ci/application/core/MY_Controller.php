<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/1
 * Time: 14:31
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 自定义公共类
 */
class MY_Controller extends CI_Controller{
/*
 * 状态检验
 */
    public function __construct(){

        parent::__construct();
        $username=$this->session->userdata('username');
        $uid=$this->session->userdata('uid');

        /*
         * 踢出
         */
        if(!$username||!$uid)
        {redirect('admin/login/index');}

    }
}