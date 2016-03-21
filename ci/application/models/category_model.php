<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/24
 * Time: 21:10
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_model
{

    /*
     * 添加
     */
    public function add($data)
    {
        $this->db->insert('category', $data);
    }


    /*
     * 查看栏目
     */
    public function check()
    {

        $data = $this->db->get('category')->result_array();
        return $data;

    }


    /*
     * 查询对应栏目
     */

    public function check_cate($cid){

        $data=$this->db->where(array('cid'=>$cid))->get('category')->result_array();

       return $data;
    }

    /*
     * 更改栏目
     */

    public function update_cate($cid,$data)
    {
        $this->db->update('category',$data,array('cid'=>$cid));

    }
    /*
     * 删除
     */
    public function del($cid)
    {
        $this->db->delete('category',array('cid'=>$cid));
    }



    /*
     * 调取导航栏目
     */
    public function limit_category($limit){
       $data= $this->db->limit($limit)->get('category')->result_array();
        return $data;
    }

}
