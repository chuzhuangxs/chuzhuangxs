<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/20
 * Time: 17:42
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_controller{

    /*
     * Ĭ�Ϸ���
     */

    public function index(){
        $this->load->view('admin/index.html');
    }
/*
 * Ĭ�ϻ�ӭ����
 */
    public function  copy(){
        $this->load->view('admin/copy.html');
    }

    public function change(){
        $this->load->view('admin/passwd.html');

    }

    /*
     * 修改密码
     */
    public function change_password(){

        $this->load->model('admin_model','admin');
        $username=$this->session->userdata('username');
        $userData=$this->admin->check($username);
        $password=$this->input->post('password');
        if(md5($password)!=$userData[0]['password'])//判断原始密码
            error('原始密码错误');



        $passwordF=$this->input->post('passwordF');
        $passwordS=$this->input->post('passwordS');
        if($passwordF!=$passwordS)
            error('两次密码不相同');



        $uid=$this->session->userdata('uid');

        $data=array(
            'password'=>md5($passwordF),

        );
        $this->admin->change($uid,$data);

        success('admin/admin/index','修改成功');

    }
}
