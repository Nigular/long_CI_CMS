<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_adsense extends CI_Controller {
	public function __construct() {
	  	parent::__construct ();
	 	$this->load->library('session');
	 	$this->load->helper('url');
	 	$this->load->model('Adsense_model','adsense_model');
 	}
	
	public function index()
	{
		$res = $this->adsense_model->gettype();
		$data["type"]=$res->result();
		$data["thistype"]=0;
		$this->load->view('admin/adsense-list',$data);
	}
	
	
	public function append(){
		$res = $this->adsense_model->gettype();
		$data["type"]=$res->result();
		$this->load->view('admin/adsense-add',$data);
	}
	
	//广告编辑页面
	public function edit(){
		$res = $this->adsense_model->gettype();
		$data["type"]=$res->result();
		$adsense_id = $this->uri->segment(3, 0);
		if($adsense_id==0){
			redirect("manage_adsense");
		}else{
			$query = $this->db->get_where("long_ad",array("id"=>$adsense_id));
			if(empty($query->row())){
				// 如果文章为空
				$this->load->view("admin/404");
			}else{
				$data["adsense"] = $query->row();
				$this->load->view("admin/adsense-edit",$data);
			}
		}
	}
	
	// 修改一条广告
	public function editone(){
		if (isset ( $_POST ['edit'] ) && ! empty ( $_POST ['edit'] )) {
			$newdata = array(
		      'title'  =>  $_POST ['title'] ,
		      'desc'    => $_POST ['desc'],
		      'update_time' => time(),
		      'type'   => $_POST ['type'],
		      'url' => $_POST['link'],
		      'sort' => $_POST['sort']
		    );
			
			if(!empty($_FILES['upfile']['tmp_name'])){
				$config['upload_path'] = './upload/banner';
		        $config['allowed_types'] = 'gif|jpg|png';
		        $config['max_size'] = "2000";
		        $config['file_name'] = uniqid("abcd");
		        $this->load->library('upload',$config);
		        //打印成功或错误的信息
		        if($this->upload->do_upload('upfile'))
		        {
		            $upload_data =  $this->upload->data();
		            $newdata["ad_img"]=$upload_data['file_name'];
		        }
			}
			
			$this->db->where('id', $_POST ['aid']);
			$this->db->update('long_ad', $newdata);
		    $affect=$this->db->affected_rows();
		    if($affect>0){
		    	redirect("manage_adsense");
		    }else{
		    	$this->load->view("admin/404");
		    }
		}else{
			redirect("manage_adsense");
		}
	}
	
	// 根据分类分页
	public function type(){
		$type = $this->uri->segment(3, 0);
		$res = $this->adsense_model->gettype();
		$data["type"]=$res->result();
		$data["thistype"]=$type;
		$this->load->view('admin/adsense-list',$data);
	}
	
	// 删除一篇广告
	public function delete(){
		if (isset ( $_POST ['aid'] ) && ! empty ( $_POST ['aid'] )) {
			$id=$_POST ['aid'];
			$newdata = array(
		      'is_del'  =>  1
		    );
			$this->db->where('id', $id);
			$this->db->update('long_ad', $newdata);
			$affect=$this->db->affected_rows();
			echo $affect;
		}else{
			redirect("manage_adsense");
		}
	}
	
	//添加一则广告
	public function addone(){
		if (isset ( $_POST ['add'] ) && ! empty ( $_POST ['add'] )) {
			$config['upload_path'] = './upload/banner';
	        $config['allowed_types'] = 'gif|jpg|png';
	        $config['max_size'] = "2000";
	        $config['file_name'] = uniqid("abcd");
	        $this->load->library('upload',$config);
	        //打印成功或错误的信息
	        if($this->upload->do_upload('upfile'))
	        {
	            $upload_data =  $this->upload->data();
	            //var_dump($upload_data['file_name']);
	            $newdata = array(
			      'title'  =>  $_POST ['title'] ,
			      'desc'    => $_POST ['desc'],
			      'add_time' => time(),
			      'type'   => $_POST ['type'],
			      'url' => $_POST['link'],
			      'sort' => $_POST['sort'],
			      'ad_img' => $upload_data['file_name']
			    );
			    $this->db->insert('long_ad', $newdata);
			    $newid=$this->db->insert_id();
			    if($newid>0){
			    	redirect("manage_adsense");
			    }
	        }
	        else
	        {
	            $error = array("error" => $this->upload->display_errors());
	            //var_dump($error);
	            $this->load->view("admin/404");
	        }
		    
		}else{
			redirect("manage_adsense");
		}
	}
		
	//AJAX获取文章列表，带分页和栏目参数
	public function getlist(){
		$type=$_POST['type'];
		$page=$_POST['page'];
		$pagesize=$_POST['pagesize'];
		$limit=$pagesize;
		$offset=($page-1)*$pagesize;
		$this->db->order_by("sort","ASC");
		if($type==0){
			$query=$this->db->get_where('long_ad',array('is_del'=>0), $limit, $offset);
			$query2=$this->db->get_where('long_ad',array('is_del'=>0));
		}else{
			$query=$this->db->get_where('long_ad', array('is_del'=>0,'type'=>$type), $limit, $offset);
			$query2=$this->db->get_where('long_ad', array('is_del'=>0,'type'=>$type));
		}
		$data["adlist"]=$query->result();
		$data["total"]=$query2->num_rows();
		
		echo json_encode($data);
	}
}

?>