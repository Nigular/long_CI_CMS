<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adsense_model extends CI_Model {
	
	//获取分类
	public function gettype(){
		$query=$this->db->get_where('long_ad_type');
		return $query;
	}
	
	
	
	
	
}


?>