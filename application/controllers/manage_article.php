<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_article extends CI_Controller {
	public function __construct() {
	  	parent::__construct ();
	 	$this->load->library('session');
	 	$this->load->helper('url');
	 	$this->load->model('Article_model','article_model');
 	}
 	
	public function index()
	{
		$res = $this->article_model->getcate();
		$data["category"]=$res->result();
		$data["type"]=0;
		$this->load->view('admin/article-list',$data);
	}
	
	// 根据分类分页
	public function type(){
		$type = $this->uri->segment(3, 0);
		$res = $this->article_model->getcate();
		$data["category"]=$res->result();
		$data["type"]=$type;
		$this->load->view('admin/article-list',$data);
	}
	
	// 新增文章
	public function append(){
		$res = $this->article_model->getcate();
		$data["category"]=$res->result();
		$this->load->view('admin/article-add',$data);
	}
	
	// 添加一条文章数据
	public function addone(){
		if (isset ( $_POST ['add'] ) && ! empty ( $_POST ['add'] )) {
			$newdata = array(
		      'title'  =>  $_POST ['title'] ,
		      'author'    => $_POST ['author'],
		      'add_time' => strtotime($_POST ['add_time']),
		      'type'   => $_POST ['type'],
		      'content' => $_POST['myue']
		    );
		    $this->db->insert('long_article', $newdata);
		    $newid=$this->db->insert_id();
		    if($newid>0){
		    	redirect("manage_article/detail/".$newid);
		    }
		}else{
			redirect("manage_article/append");
		}
	}
	
	// 文章详情页
	public function detail(){
		$article_id = $this->uri->segment(3, 0);
		if($article_id==0){
			redirect("manage_article");
		}else{
			$query = $this->db->get_where("long_article",array("id"=>$article_id));
			if(empty($query->row())){
				// 如果文章为空
				$this->load->view("admin/404");
			}else{
				$data["article"] = $query->row();
				$this->load->view("admin/article-show",$data);
			}
		}
	}
	
	//编辑文章
	public function edit(){
		$res = $this->article_model->getcate();
		$data["category"]=$res->result();
		$article_id = $this->uri->segment(3, 0);
		if($article_id==0){
			redirect("manage_article");
		}else{
			$query = $this->db->get_where("long_article",array("id"=>$article_id));
			if(empty($query->row())){
				// 如果文章为空
				$this->load->view("admin/404");
			}else{
				$data["article"] = $query->row();
				$this->load->view("admin/article-edit",$data);
			}
		}
	}
	
	// 文章搜索结果页
	public function search(){
		$key = urldecode($this->uri->segment(3, ""));
		
		if($key==""){
			redirect("manage_article");
		}else{
			$this->db->like('title',$key);
			$query = $this->db->get_where("long_article",array("is_del"=>0));
			if(empty($query->result())){
				// 如果文章为空
				$this->load->view("admin/404");
			}else{
				$data["alist"]=$query->result();
				$this->load->view("admin/article-search",$data);
			}
		}
	}
	
	// 修改一条文章数据
	public function editone(){
		if (isset ( $_POST ['aid'] ) && ! empty ( $_POST ['aid'] )) {
			$newdata = array(
		      'title'  =>  $_POST ['title'] ,
		      'author'    => $_POST ['author'],
		      'type'   => $_POST ['type'],
		      'content' => $_POST['myue']
		    );
		    if(!empty($_POST ['add_time'])){
		    	$newdata['add_time']=strtotime($_POST ['add_time']);
		    }
			$this->db->where('id', $_POST ['aid']);
			$this->db->update('long_article', $newdata);
		    $affect=$this->db->affected_rows();
		    if($affect>0){
		    	redirect("manage_article");
		    }else{
		    	$this->load->view("admin/404");
		    }
		}else{
			redirect("manage_article/append");
		}
	}
	
	// 删除一篇文章
	public function delete(){
		if (isset ( $_POST ['aid'] ) && ! empty ( $_POST ['aid'] )) {
			$id=$_POST ['aid'];
			$newdata = array(
		      'is_del'  =>  1
		    );
			$this->db->where('id', $id);
			$this->db->update('long_article', $newdata);
			$affect=$this->db->affected_rows();
			echo $affect;
		}else{
			redirect("manage_article");
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
			$query=$this->db->get_where('long_article', array('is_del'=>0), $limit, $offset);
			$query2=$this->db->get_where('long_article', array('is_del'=>0));
		}else{
			$query=$this->db->get_where('long_article', array('is_del'=>0,'type'=>$type), $limit, $offset);
			$query2=$this->db->get_where('long_article', array('is_del'=>0,'type'=>$type));
		}
		$data["alist"]=$query->result();
		$data["total"]=$query2->num_rows();
		echo json_encode($data);
	}
	
}
