<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {
	
	//获取分类
	public function getcate(){
		$this->db->order_by("sort","ASC");
		$query=$this->db->get_where('long_category', array('is_delete'=>0));
		return $query;
	}
	
	//根据分类获取文章
	public function getartbyCate($typeid){
		return $this->db->get_where('article',array('type'=>$typeid));
	}
	
}


?>