<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/20
 * Time: 20:56
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller
{

    public function index()
    {

        $this->load->helper('captcha');//载入验证码函数
        /*
        * 配置项
         */
        $speed = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $word = '';
        for ($i = 0; $i < 4; $i++) {
            $word .= $speed[mt_rand(0, strlen($speed) - 1)];

        }

        $vals = array(
            'word' => $word,
            'img_path' => './captcha/',
            'img_url' => base_url() . '/captcha/',
            'img_width' => 80,
            'img_height' => 30,
            'expiration' => 60,


        );
        //创建验证码
        $cap = create_captcha($vals);
        if(!isset($_SESSION)){session_start();}

        $_SESSION['code']=$cap['word'];
        //p($cap);die;
        $data['captcha'] = $cap['image'];
        $this->load->view('admin/login.html',$data);

    }

    public function login_in(){

        $code=$this->input->post('captcha');

        if(!isset($_SESSION)){
            session_start();
        }

//        p($code);
//        echo '<hr />';
//        p($_SESSION['code']);
       if($code!=$_SESSION['code'])
           error('验证码输入错误');

        $username=$this->input->post('username');

        $this->load->model('admin_model','admin');
        $userData=$this->admin->check($username);

        $password=$this->input->post('password');

//        var_dump($userData);die;

        if(!$userData||$userData[0]['password']!=md5($password))
            error('用户名或密码错误');

        $sessionData=array(

            'username'=>$username,
            'uid'=>$userData[0]['uid'],
            'logintime'=>time(),
        );

        $this->session->set_userdata($sessionData);

        success('admin/admin/index','登录成功');





    }
/*
 * 退出登录
 */
    public function login_out(){
        $this->session->sess_destroy();
        success('admin/login/index','退出成功');

    }


}

