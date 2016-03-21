<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/31
 * Time: 22:47
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 后台用户管理
 */
class Admin_model extends CI_model{
     public function check($username){

        $data= $this->db->get_where('admin',array('username'=>$username))->result_array();
         return $data;
     }

    public function change($uid,$data){
        $this->db->update('admin',$data,array('uid'=>$uid));

    }


}