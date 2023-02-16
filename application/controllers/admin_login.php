<?php
session_start();
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class admin_login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		     $this->load->library('form_validation');
		//$this->load->database();
	}
	public function index()
	{
		$config=array(
			array(
				'field'=>'txt_email',
				'label'=>'email',
				'rules'=>'required|valid_email'
				),
			array(
				'field'=>'txt_pwd',
				'label'=>'password',
				'rules'=>'required'
				)
			);
		$this->form_validation->set_rules($config);
		//$this->form_validation->set_message('validate_login');
		//$this->form_validation->set_message('_validate_login',' Login failed!');
		
		$this->form_validation->set_error_delimiters('<span style="color:red">','</span><br>');
		if($this->form_validation->run()==FALSE)
		{
			$page_data['page_title']='Gajanand Admin Login';
			$this->load->view('admin/login_view',$page_data);
		}	
		else
		{
			$this->db->select("*");
			$this->db->from("tbl_admin_user");
			$this->db->where("admin_user_email",$this->input->post('txt_email'));
			$this->db->where("admin_user_pwd",$this->input->post('txt_pwd'));
			$query=$this->db->get();
			if($query->num_rows()>0)
			{

				foreach($query->result() as $row)
				{
					$_SESSION["admin_id"]=$row->admin_user_id;
					$_SESSION["admin_name"]=$row->admin_user_name;

				/*	$this->session->set_userdata("user_id",$row->admin_user_id);
					$this->session->set_userdata("user_name",$row->admin_user_name);*/
				}
				$data['total']=$query->num_rows();
				//$this->session->set_userdata("user_email",$this->input->post('txt_email'));
				$_SESSION["admin_email"]=$row->admin_user_email;
				//redirect(base_url()."admin/manage_category","refresh");
				redirect(base_url()."admin","refresh");
			}
			else
			{
				redirect(base_url().'admin_login');	
			}
		}	
	}

	function logout()
	{
		unset($_SESSION["admin_id"]);
		unset($_SESSION["admin_name"]);
		unset($_SESSION["admin_email"]);
		session_destroy();
		
		redirect(base_url() . 'admin_login', 'refresh');
	}
	
}

?>