<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller{




    /*
     * 用构造函数载入公用模型
     */
public function __construct(){
    parent::__construct();

    $this->load->model('category_model','cate');

}


    /*
     * 查看栏目
     */
    public function index(){

        $data['category']=$this->cate->check();
        $this->load->view('admin/cate.html',$data);

    }

    public function add_cate(){


        $this->load->view('admin/add_cate.html');

    }


    public function add(){
        $status=$this->form_validation->run('cate');

        if($status)
        {//echo '数据库操做?';




            $data=array('cname'=>$this->input->post('cname')
            );

            $this->cate->add($data);
            success('admin/category/index','添加成功');



        }

        else{
            $this->load->view('admin/add_cate.html');
        }
    }


    /*
     * 编辑
     */
    public function edit_cate(){

       $cid=$this->uri->segment(4);//取地址的片段


        $data['category']=$this->cate->check_cate($cid);

        $this->load->view('admin/edit_cate.html',$data);
    }

    /*
     * 编辑动作
     */
    public function edit(){
        $status=$this->form_validation->run('cate');

        if($status)
        {

            $cid=$this->input->post('cid');
            $cname=$this->input->post('cname');

            $data=array('cname'=>$cname);
            $data['category']=$this->cate->update_cate($cid,$data);

            success('admin/category/index','编辑成功');
        }

        else{
            $this->load->view('admin/edit_cate.html');
        }

    }

/*
 * 删除
 */

public function del(){

    $cid=$this->uri->segment(4);//去第四段地址

    $this->cate->del($cid);

    success('admin/category/index','删除成功');
}

}