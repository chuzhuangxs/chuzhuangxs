<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/27
 * Time: 23:00
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');






class Article_model extends CI_model{

    /*
     * 发表文章
     */

    public function add($data){
        $this->db->insert('article',$data);
    }


    public function  article_category(){

        $data=$this->db->select('aid,title,cname,time')->from('article')->join('category','article.cid=category.cid')->order_by('aid','asc')->get()->result_array();//关联数据库中的不同表，设置取出顺序
        return $data;

    }


    /*
     * 编辑文章
     */
    public function update_article($aid,$data){
        $this->db->update('article',$data,array('aid'=>$aid));



    }



    /*
     * 删除文章
     */
    public function del($aid){
$this->db->delete('article',array('aid'=>$aid));

    }

    /*
     * 查看数据
     */
    public function check($aid){

        $data=$this->db->where(array('aid'=>$aid))->get('article')->result_array();

        return $data;
    }


    /*
     * 首页查询文章
     */
    public function check_article(){


        $data['art']=$this->db->select('aid,thumb,title,info')->order_by('time','desc')->get_where('article',array('type'=>0))->result_array();
        $data['hot']=$this->db->select('aid,thumb,title,info')->order_by('time','desc')->get_where('article',array('type'=>1))->result_array();
        return $data;
    }

    /*
     * 右侧文章标题调取
     */
    public function title($limit){

        $data=$this->db->select('aid,title')->order_by('time','desc')->limit($limit)->get('article')->result_array();

        return $data;
    }

}