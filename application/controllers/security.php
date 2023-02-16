<?php 
class security extends CI_Controller
{
	public function index()
	{
		$today_date=date('Y-m-d');
		//$page_data['today_upcoming_visitors'] = $this->db->get_where('tbl_visitor',array('visitor_meeting_date'=>$today_date,'visitor_meeting_status'=>));
		
		$upcoming_visitor_query="select * from tbl_visitor where visitor_meeting_date='".$today_date."' and visitor_meeting_status != 'signed-out'";
		//echo $upcoming_visitor_query;
		$page_data['today_upcoming_visitors']=$this->db->query($upcoming_visitor_query);
		$signed_out_visitor_query="select * from tbl_visitor where visitor_meeting_date='".$today_date."' and visitor_meeting_status = 'signed-out'";
		$page_data['today_recently_visited_visitors']=$this->db->query($signed_out_visitor_query);

		$this->load->view('security/security_view',$page_data);
	}

	public function sign_out($param1="")
	{
		if($param1=="signout")
		{
			$up_id = $this->input->post('cmb_visitor');
			$data['visitor_meeting_status']='signed-out';
			$data['visitor_sign_out']=date("Y-m-d H:m:s");
			$this->db->where('visitor_id',$up_id);
			$this->db->update('tbl_visitor',$data);
			redirect(base_url().'security');
		}
		//$current_visitor_query="select * from tbl_visitor where visitor_meeting_status != 'signed-out'  or visitor_meeting_status != 'registered'  or visitor_meeting_status != 'not-registered' ";
		$current_visitor_query="select * from tbl_visitor where visitor_meeting_status = 'signed-in' ";
		//echo $current_visitor_query;
		$page_data['current_visitors']=$this->db->query($current_visitor_query);
		$this->load->view('security/sign_out_view',$page_data);
	}

	public function gate_pass($id)
	{
		$page_data['visitor_res']=$this->db->get_where('tbl_visitor',array('visitor_id'=>$id));
		$this->load->view('security/gate_pass_view',$page_data);
	}

	public function sign_in($param1="")
	{
		if($param1=="create")
		{
			$data['employee_id']=$this->input->post('cmb_employee');
			$data['visitor_full_name']=$this->input->post('txt_person_name');
			$data['visitor_other_name']=$this->input->post('txt_others_name');
			$data['visitor_meeting_status']='signed-in';
			$data['visitor_meeting_date_time']=date('Y-m-d H:m:s');
			$data['visitor_meeting_date']=date('Y-m-d');
			$data['visitor_vehicle_no']=$this->input->post('txt_vehicle_no');
			$data['visitor_mobile']=$this->input->post('txt_mobile');
			$data['visitor_email']=$this->input->post('txt_email');
			$data['visitor_purpose']=$this->input->post('rdo_purpose');
			$data['visitor_remarks']=$this->input->post('txt_remarks');
			$data['visitor_sign_in']=date('Y-m-d H:m:s');


			$sign_string = $this->input->post('sign_string');
			$data['visitor_sign']=$this->save_base64_image($sign_string,rand(1000000,100000000),"files/security/visitor_sign/");

			$image_string = $this->input->post('image_string');
			$data['visitor_image']=$this->save_base64_image($image_string,rand(1000000,100000000),"files/security/visitor_photo/");

			$this->db->insert('tbl_visitor',$data);
			redirect(base_url().'security');
	
		}
		$this->load->view('security/sign_in_view2');
	}

	function save_base64_image($base64_image_string, $output_file_without_extension, $path_with_end_slash="" ) {
	    //usage:  if( substr( $img_src, 0, 5 ) === "data:" ) {  $filename=save_base64_image($base64_image_string, $output_file_without_extentnion, getcwd() . "/application/assets/pins/$user_id/"); }      
	    //
	    //data is like:    data:image/png;base64,asdfasdfasdf
	    $splited = explode(',', substr( $base64_image_string , 5 ) , 2);
	    $mime=$splited[0];
	    $data=$splited[1];

	    $mime_split_without_base64=explode(';', $mime,2);
	    $mime_split=explode('/', $mime_split_without_base64[0],2);
	    if(count($mime_split)==2)
	    {
	        $extension=$mime_split[1];
	        if($extension=='jpeg')$extension='jpg';
	        //if($extension=='javascript')$extension='js';
	        //if($extension=='text')$extension='txt';
	        $output_file_with_extension=$output_file_without_extension.'.'.$extension;
	    }
	    file_put_contents( $path_with_end_slash . $output_file_with_extension, base64_decode($data) );
	    return $output_file_with_extension;
	}

}
?>