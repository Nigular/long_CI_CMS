<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_ad_type extends CI_Controller {
	public function __construct() {
	  	parent::__construct ();
	 	$this->load->library('session');
	 	$this->load->helper('url');
	 	$this->load->model('Adsense_model','adsense_model');
 	}
	
	public function index()
	{
		//$this->db->from("long_ad_type");
		//$query = $this->db->get();
		$query = $this->db->query('SELECT adt.type_name, adt.id, count(ad.type) countNum FROM `long_ad_type` adt left join `long_ad` ad on ad.type=adt.id group by adt.id');
		$data["type"]=$query->result();
		$this->load->view('admin/ad-type-list',$data);
	}
	
	public function append(){
		if (isset ( $_POST ['title'] ) && ! empty ( $_POST ['title'] )) {
			$newdata = array(
				'type_name'  =>  $_POST ['title']
			);
			$this->db->insert('long_ad_type', $newdata);
		    $newid=$this->db->insert_id();
		    if($newid>0){
		    	echo 1;
		    }else{
		    	echo 0;
		    }
		}else{
			echo 0;
		}
	}
}
