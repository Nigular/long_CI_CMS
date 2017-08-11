<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLogin extends CI_Controller {
 	private $pass = '';
	public function __construct() {
	  	parent::__construct ();
	 	$this->load->library('session');
	 	$this->load->helper('url');
 	}
 	
 	public function index() {
 		$data["err_tip"]="";
	  	$this->load->view ('admin/login',$data);
	}

	public function formsubmit() {
		if (isset ( $_POST ['submit'] ) && ! empty ( $_POST ['submit'] )) {
		    $data = array (
		      'user' => $_POST ['username'],
		      'pass' => md5($_POST ['password'])
		    );
		    $newdata = array(
		      'username'  =>  $data ['user'] ,
		      'userip'     => $_SERVER['REMOTE_ADDR'],
		      'luptime'   =>time()
		    );
		    // 登录验证
		    if ($_POST ['submit'] == 'login') {
		    	// 查询用户名的数据
			    $query = $this->db->get_where ( 'long_user', array (
			       'user' => $data ['user'] 
			    ), 1, 0 );
			    if(count($query->result())==0){
			    	$data["err_tip"]="用户名不存在";
			    	$this->load->view ( 'admin/login',$data);
			    	return;	//结束
			    }
			    foreach ( $query->result () as $row ) {
			      $pass = $row->pass;
			    }
			    //验证该用户名的密码跟用户填写的密码是否一致
	     		if ($pass == $data ['pass']) {
			      	$this->session->set_userdata($newdata);
			      	redirect("manage");
			    }else{
			    	$data["err_tip"]="密码不正确";
			    	$this->load->view ( 'admin/login',$data);
			    }
			}else if ($_POST ['submit'] == 'register') {	//注册动作
			    $this->session->set_userdata($newdata);
			    $this->db->insert ( 'long_user', $data );
			    redirect("manage");
		    }else{
		    	var_dump("断了");die;
		     	$this->session->sess_destroy();
		     	$this->load->view ( 'admin/login' );
		    }
		}else{
			$data["err_tip"]="非法操作";
	  		$this->load->view ('admin/login',$data);
		}
	}
	
	public function loginout() {
		$data["err_tip"]="";
		$this->session->sess_destroy();
		$this->load->view ( 'admin/login',$data);
	}
}
