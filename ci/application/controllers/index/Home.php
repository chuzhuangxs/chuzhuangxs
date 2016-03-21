<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/19
 * Time: 23:41
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Ĭ�Ͽ�����
 */

class Home extends CI_Controller{
    public function index(){
        $this->output->enable_profiler('TRUE');//启动调试器


        $this->load->model('article_model','art');
        $data=$this->art->check_article();

        $this->load->model('category_model','cate');
        $data['category']=$this->cate->limit_category(3);
//        p($data);die;

        $data['title']=$this->art->title(6);




       $this->load->view("qian/index.html",$data);
    }


/*
     * 载入分类页
     */
    public function category(){
        $this->load->view('qian/category.html');

    }

    /*
     * 文章查看页
     */
    public function article(){

        $this->load->view('qian/details.html');

    }


}



