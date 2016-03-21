<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/21
 * Time: 11:21
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller{

    /*
     *查看文章
     */
    public function index(){
        /*
         * 分类页配置
         */
        $this->load->library('pagination');
        $perPage=2;

        $config['base_url'] = site_url('admin/article/index');
        $config['total_rows'] = $this->db->count_all_results('article');//统计文章数据个数
        $config['per_page'] = $perPage;
        $config['uri_segment']=4;
        $config['first_link']='第一页';
        $config['last_link']='最后一页';
        $config['prev_link']='上一页';
        $config['next_link']='下一页';


        $this->pagination->initialize($config);

        $data['links']= $this->pagination->create_links();
        //p($data);die;

        $offset=$this->uri->segment(4);
        $this->db->limit($perPage,$offset);//从数据库取出数据，从哪开始截取，截取几个





        $this->load->model('article_model','art');

        $data['article']=$this->art->article_category();
       // p($data);die;
        $this->load->view('admin/check_article.html',$data);
    }


    public function send_article(){

/*
发表文章
*/
        $this->load->model('category_model','cate');
        $data['category']=$this->cate->check();


        $this->load->view('admin/article.html',$data);
    }


    public function send(){
        /*发表文章动作
        */

        /*
         * 文件上传配置
         */
        $config['upload_path']='./uploads';
        $config['allowed_types']='gif|jpg|png|jpeg';
        $config['max_size']='10000';

        $config['file_name']=time().mt_rand(1000,9999);

        $this->load->library('upload',$config);//载入上传类
        $status=$this->upload->do_upload('thumb');//执行上传

        $wrong=$this->upload->display_errors();
        if($wrong){
            error($wrong);
        }

        $info=$this->upload->data();//

        //p($info);die;


        /*
         * 缩略图配置
         */

        $arr['image_library'] = 'gd2';
        $arr['source_image'] =$info['full_path'];
        $arr['create_thumb'] = FALSE;
        $arr['maintain_ratio'] = TRUE;
        $arr['width'] = 200;
        $arr['height'] = 200;

        $this->load->library('image_lib',$arr);//载入缩略图类
           //执行动作
        $status=$this->image_lib->resize();

        if(!$status)
        {
           error('缩略图上传失败');
        }


        $this->load->library('form_validation');  //表单验证类
      
        $status=$this->form_validation->run('article');

       if($status){

           $this->load->model('article_model','art');

           $data=array(
               'title'=>$this->input->post('title'),
                'type'=>$this->input->post('type'),
               'cid'=>$this->input->post('cid'),
               'thumb'=>$info['file_name'],
               'info'=>$this->input->post('info'),
               'content'=>$this->input->post('content'),
               'time'=>time()
           );
           $this->art->add($data);
           success('admin/article/index','发表成功');

       }

        else {$this->load->view('admin/article.html');}
    }


//编辑文章
    public function edit_article(){
        $aid=$this->uri->segment(4);//取地址的片段
        $this->load->model('article_model','art');
        $data['article']=$this->art->check($aid);


        $this->load->view('admin/edit_article.html',$data);



    }


    //编辑动作
    public function edit(){


        $this->load->model('article_model','art');
        $aid=$this->input->post('aid');

        $data=array(
            'title'=>$this->input->post('title'),
        );
            $data['article']=$this->art->update_article($aid,$data);

          echo '1';


    }

    /*
     * 删除文章
     */
    public function del(){
        $aid=$this->uri->segment(4);


        $this->load->model('article_model','art');
        $this->art->del($aid);
        success('admin/article/index','删除成功');

    }


}