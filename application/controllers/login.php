<?php 
session_start();
class login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		    //  $this->load->library('form_validation');
		//$this->load->database();
	}

	public function index()
	{
		$this->load->view('user/login_view');	
	}
	

	public function login_check()
	{

				$this->db->select("*");
    			$this->db->from("tbl_user");
    			$this->db->where("user_email",$this->input->post('txt_user_email'));
    			$this->db->where("user_password",$this->input->post('txt_user_password'));
    			$query=$this->db->get();
    			if($query->num_rows()>0)
    			{

    				foreach($query->result() as $row)
    				{
    					$_SESSION["user_id"]=$row->user_id;
						$_SESSION["user_name"]=$row->user_name;
						

    				 	// $this->session->set_userdata("user_id",$row->user_id);
    					// $this->session->set_userdata("user_name",$row->user_name);
                
    				}

    				$data['total']=$query->num_rows();

    				//$this->session->set_userdata("user_email",$this->input->post('txt_email'));

    				$_SESSION["user_email"]=$row->user_email;
    						
    					redirect(base_url()."user","refresh");
    				
    				
    			}
    			else
    			{

    				redirect(base_url()."login","refresh");
    				
    			}

            // $this->load->view('user_website/login_view');
            
	}

	public function log_out()
	{
		unset($_SESSION["user_full_name"]);
		unset($_SESSION["user_email"]);
		unset($_SESSION["user_id"]);
		session_destroy();
		//redirect(base_url().'login/login_check');
		redirect(base_url().'login');
	}
}
?>