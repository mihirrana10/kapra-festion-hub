<?php 
session_start();
use \Stripe\Checkout\Session;   
use \Stripe\Stripe;

class user extends CI_Controller
{
    public function __construct()
    {
       
        parent::__construct();
        // $this->load->library('session');
        // if (!isset($_SESSION["txt_user_email"])) {
        //     redirect(base_url() . 'index.php');
        // }
        $this->load->library('facebook');
       
                        // Load google oauth library 
                        // $this->load->library('google/google.php'); 
                        $this->load->library('paypal_lib');

        require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

        require_once('vendor/autoload.php');

        

        // require_once('application/libraries/stripe-php/init.php');

        // $this->load->library("session");
        // $this->load->helper('url');
       
        // use Razorpay\Api\Api;
        // use Razorpay\Api\Errors\SignatureVerificationError;
    }


   

    public function index()
	{
        $page_data["resultset"]=$this->db->get("tbl_product_new");
        $resultset=$this->db->get("tbl_product_new");

        
		$this->load->view('user/index',$page_data);
	}

    public function manage_cart()
	{
		$this->load->view('user/cartview');
	}

    public function order_details($order_id)
    {
        $page_data['order_id']=$order_id;
      

        $this->load->view("user/order_details",$page_data);
    }
    public function magazine($catalogue_id)
    {
        $page_data['catalogue_id']=$catalogue_id;
        $this->load->view('user/myaccountview',$page_data);
    }
    public function cancel_order($order_id)
    {
        $ord_data['order_is_returned']='Applied';

        $this->db->where('order_id',$order_id);
        $this->db->update('tbl_order',$ord_data);

        //$page_data['msg']='<div class="alert alert-warning" role="alert"  style="width:100%"><i class="icon-close"></i> Invalid Coupon Code</div>';


        //order email start
        $ordr_res = $this->db->get_where('tbl_order',array('order_id'=>$order_id));
        $ordr_row = $ordr_res->result();

        // $this->send_email_phpmailer_cancel_order(6,$ordr_row[0]->order_billing_email,$ordr_row[0]->order_billing_name,$order_id);
        //order email end




        redirect(base_url().'user/order_details/'.$order_id);
    }

    public function manage_checkout()
	{
		$this->load->view('user/checkoutview');
	}
	public function manage_wishlist()
	{
        // $page_data['active_id']='wishlist';
        if(!isset($_SESSION["user_id"]))
        {
            redirect(base_url().'login');
        }
		$this->load->view('user/wishlistview');
	}
	public function manage_myaccount()
	{
        if(!isset($_SESSION["user_id"]))
        {
            redirect(base_url().'login');
        }
		// $this->load->view('user/wishlistview')
		$this->load->view('user/myaccountview');
	}
	public function manage_about()
	{
		$this->load->view('user/aboutview');
	}
	public function manage_contact()
	{
		$this->load->view('user/contactview');
	}
	public function manage_faq()
	{
		$this->load->view('user/faqview');
	}
	public function manage_product_detail($product_slug="",$param1="")
	{

		 
		//  $product_id         = 0;
		//  if (isset($param1) && trim($param1) != "") {
		// 	 $product_id         = $param1;
			
		//  }

		// $page_data["resultset"]=$this->db->get_where("tbl_product_new", array(
        //     'product_id' => $product_id
        // ));
        
        // print_r($page_data["resultset"]);
        
        $page_data["resultset"]=$this->db->get_where('tbl_product_new',array('product_seo_slug'=>$product_slug));
        // $page_data['item']=$resultset->result();

        // echo "<pre>";
        //     print_r($page_data["resultset"]);
        // echo "</pre>";

		$this->load->view('user/product_detailview',$page_data);
	}


	public function manage_user($param1="",$param2="",$param3="")
	{
		if($param1=="create")
		{
            $data["user_name"]=$this->input->post("txt_user_name");
			$data["user_email"]=$this->input->post("txt_user_email");
			$data["user_password"]=$this->input->post("txt_user_password");
			
			$this->db->insert("tbl_user",$data);
			redirect(base_url()."login");  
		}
		$this->load->view('user/login_view');
	}

	public function place_order()
    {
        $query="SELECT max( order_invoice_number ) as `last_invoice_number` FROM tbl_order";

        $invoice_num_res=$this->db->query($query);
        $invoice_num_row=$invoice_num_res->result();

        $data['order_invoice_number']=$invoice_num_row[0]->last_invoice_number+1;
        /*
        print("<pre>");
        print_r($_POST);
        print("</pre>");
        */

        $data['order_billing_name']=$this->input->post('txt_first_name')." ".$this->input->post('txt_last_name');
        $data['order_billing_company_name']=$this->input->post('txt_company_name');
        $data['order_billing_country_id']=$this->input->post('cmb_country');
        $data['order_billing_state_id']=$this->input->post('cmb_state');
        $data['order_billing_city_id']=$this->input->post('cmb_city');
        $data['order_billing_address_line1']=$this->input->post('txt_address_line1');
        $data['order_billing_address_line2']=$this->input->post('txt_address_line2');
        $data['order_billing_pincode']=$this->input->post('txt_pincode');
        $data['order_billing_phone_number']=$this->input->post('txt_phone');
        $data['order_billing_email']=$this->input->post('txt_email');
        $data['order_notes']=$this->input->post('txt_order_notes');

        if(isset($_SESSION["customer_id"]))
        {
            $data['customer_id']=$_SESSION["customer_id"];
        }

        if(isset($_POST["create_account"]))
        {
            if($this->input->post('create_account')=="on")
            {
                $customer_data['customer_full_name']=$data['order_billing_name'];
                $customer_data['customer_status']='Active';
                $customer_data['customer_email_address']=$data['order_billing_email'];
                $customer_data['customer_mobile_number']=$data['order_billing_phone_number'];
                $customer_data['customer_country_id']=$data['order_billing_country_id'];
                $customer_data['customer_state_id']=$data['order_billing_state_id'];
                $customer_data['customer_city']=$data['order_billing_city_id'];
                $customer_data['customer_doj']=date('Y-m-d');


                //$this->db->insert('tbl_customer',$data);

                $exist_cust_res=$this->db->get_where('tbl_customer',array('customer_email_address'=>$data['order_billing_email']));

                if($exist_cust_res->num_rows()>0)
                {
                    $exist_cust_row=$exist_cust_res->result();
                    $data['customer_id']=$exist_cust_row[0]->customer_id;
                }
                else
                {
                    $this->db->insert('tbl_customer',$customer_data);
                    $data['customer_id']=$this->db->insert_id();
                }
            }
        }

        if(isset($_POST["chk_shiping_address"]))
        {
            if($this->input->post('chk_shiping_address')=="on")
            {
                $data['order_billing_shipping_address_same']='No';

                $data['order_shipping_name']=$this->input->post('txt_ship_first_name')." ".$this->input->post('txt_ship_last_name');
                $data['order_shipping_company_name']=$this->input->post('txt_ship_company_name');
                $data['order_shipping_country_id']=$this->input->post('cmb_ship_country');
                $data['order_shipping_state_id']=$this->input->post('cmb_ship_state');
                $data['order_shipping_city_id']=$this->input->post('cmb_ship_city');
                $data['order_shipping_address_line1']=$this->input->post('txt_ship_address_line1');
                $data['order_shipping_address_line2']=$this->input->post('txt_ship_address_line2');
                $data['order_shipping_pincode']=$this->input->post('txt_ship_pincode');
                $data['order_shipping_phone_number']=$this->input->post('txt_ship_phone');
                $data['order_shipping_email']=$this->input->post('txt_ship_email');
            }


        }

        else
        {
            $data['order_shipping_name']=$data['order_billing_name'];
            $data['order_shipping_company_name']=$data['order_billing_company_name'];
            $data['order_shipping_country_id']=$data['order_billing_country_id'];
            $data['order_shipping_state_id']=$data['order_billing_state_id'];
            $data['order_shipping_city_id']=$data['order_billing_city_id'];
            $data['order_shipping_address_line1']=$data['order_billing_address_line1'];
            $data['order_shipping_address_line2']=$data['order_billing_address_line2'];
            $data['order_shipping_pincode']=$data['order_billing_pincode'];
            $data['order_shipping_phone_number']=$data['order_billing_phone_number'];
            $data['order_shipping_email']=$data['order_billing_email'];
        }

        $this->db->join('tbl_product_new','tbl_cart.product_id=tbl_product_new.product_id');
        $cart_res=$this->db->get_where('tbl_cart',array('tbl_cart.cart_session'=>session_id()));
        
        $total=0;
        $final_total=0;
        foreach($cart_res->result() as $cart_row)
        {   
            $total=$total+($cart_row->product_selling_price*$cart_row->cart_qty);
        }
        $data['order_amount']=$total;
        if(isset($_SESSION["discount_amount"]))
        {
            //$data['order_coupon_id']=date('Y-m-d H:m:s');
            $data['order_coupon_id']=$_SESSION["coupon_id"];
            $data['order_coupon_discount_amount']=$_SESSION["discount_amount"];
        
            $final_total = $total-$_SESSION["discount_amount"];
        }
        else
        {
            $final_total = $total;
        }
        
        $data['order_date']=date('Y-m-d H:m:s');
        $data['order_status']="New";
        //$data['order_amount']=$total;
        /*
        if(isset($_SESSION["discount_amount"]))
        {
        }
        */

        if($this->input->post('txt_payment_type')=="cod")
        {
            $data['order_payment_type']='cod';
        }
        else if($this->input->post('txt_payment_type')=="online")
        {
            $data['order_payment_type']='online';
        }
        $data['order_shipping_amount']="0";
        $data['order_final_amount']=$final_total;

        $this->db->insert('tbl_order',$data);

        $current_order_id=$this->db->insert_id();

        foreach($cart_res->result() as $order_row)
        {
            $order_details_data['order_id']=$current_order_id;
            $order_details_data['product_id']=$order_row->product_id;
            $order_details_data['product_qty']=$order_row->cart_qty;

            $this->db->insert('tbl_order_details',$order_details_data);

        }


        /*
        print("<pre>");
        print_r($data);
        print("</pre>");
        */
        $_SESSION["current_order_id"]=$current_order_id;
        echo "<h1> Current order ".$current_order_id."</h1>";

        if($this->input->post('txt_payment_type')=="cod")
        {
            $_SESSION["mobile_number"] = $data['order_billing_phone_number'];
            //send otp
            echo "Send OTP";

            $otp=rand(100000,999999);


            $up_otp_data['order_otp']=$otp;
            $this->db->where('order_id',$_SESSION["current_order_id"]);
            $this->db->update('tbl_order',$up_otp_data);

            $msg="YOUR OTP FOR THE ORDER ".$otp;
            $msg=urlencode($msg);

            $sms_url="http://login.arihantsms.com/vendorsms/pushsms.aspx?user=vimlaprints&password=vimla1266&msisdn=".$_SESSION["mobile_number"]."&sid=VIMLAA&msg=".$msg."&fl=0&gwid=2";

            $response=file_get_contents($sms_url);
            

           

            /*
            print("<pre>");
            print_r($response);
            print("</pre>");
            */

            redirect(base_url().'user/otp_verify');

        }
        else if($this->input->post('txt_payment_type')=="online")
        {
            //razorpay

            $_SESSION["razorpay_receipt"]=$data['order_invoice_number'];
            $_SESSION["razorpay_amount"]=$data['order_final_amount'];
            $_SESSION["razorpay_name"]=$data['order_billing_name'];
            $_SESSION["razorpay_email"]=$data['order_billing_email'];
            $_SESSION["razorpay_contact"]=$data['order_billing_phone_number'];

            redirect(base_url().'razorpay/pay.php?checkout=manual');
        
        }

                
    }
	
	public function add_to_cart($p_id,$qty="")
    {
        $sid=session_id();
        //echo $sid;
        $cart_query="select * from tbl_cart where product_id='".$p_id."' and 
        cart_session='".$sid."' ";
        $cart_res=$this->db->query($cart_query); 
        if($cart_res->num_rows()>0)
        {
            if(trim($qty)!="" && $qty!=0)
            {
                $update_query="update tbl_cart set cart_qty=".$qty." where cart_session='".$sid."' and product_id='".$p_id."' ";
            }
            else
            {
                $update_query="update tbl_cart set cart_qty=cart_qty+1 where cart_session='".$sid."' and product_id='".$p_id."' ";
            }

            $this->db->query($update_query);
        }
        else
        {

            $insert_data['product_id']=$p_id;
            if(trim($qty)!="" && $qty!=0)
            {
                $insert_data['cart_qty']=$qty;
            }
            else
            {
                $insert_data['cart_qty']='1';
                
            }
            $insert_data['cart_session']=$sid;
            $this->db->insert('tbl_cart',$insert_data);
        }

        $url=$_SERVER["HTTP_REFERER"];
        redirect($url);
    }

	public function update_cart()
    {
        /*print("<pre>");
        print_r($_POST);
        print("</pre>");*/

        for($i=0;$i<count($_POST["txt_id"]);$i++)
        {
            $product_id=$_POST["txt_id"][$i];
            $up_cart_qty=$_POST["txt_qty"][$i];

            $update_cart_query="update tbl_cart set cart_qty='".$up_cart_qty."' where cart_session='".session_id()."' and product_id='".$product_id."' ";

            $this->db->query($update_cart_query);
        }

        $url=$_SERVER["HTTP_REFERER"];
        redirect($url);
    }

	public function remove_cart($id)
    {
        $sid=session_id();
        $query="delete from tbl_cart where cart_session='".$sid."' and product_id='".$id."' ";
        $this->db->query($query);
        $url=$_SERVER["HTTP_REFERER"];
        redirect($url);
    }

	// public function wishlist()
    // {
    //     $page_data['active_id']='wishlist';
    //     if(!isset($_SESSION["customer_id"]))
    //     {
    //         redirect(base_url().'user/register');
    //     }
    //     $this->load->view('user/wishlistview',$page_data);
    // }

	public function remove_wishlist($product_id)
    {
        $query="delete from tbl_wishlist where customer_id='".$_SESSION["user_id"]."' and product_id='".$product_id."' ";
        
        $this->db->query($query);
        $url=$_SERVER["HTTP_REFERER"];
        redirect($url);
    }
	
	 public function wishlist_add($id)
    {
        if(isset($_SESSION["user_id"]))
        {
            $data['customer_id']=$_SESSION["user_id"];
            
            $resultset=$this->db->get_where('tbl_wishlist',array("customer_id"=>$_SESSION["user_id"],"product_id"=>$id));
            if($resultset->num_rows==0)
            {
                $data['product_id']=$id;
                $this->db->insert("tbl_wishlist",$data);
            }
              
        }
        else
        {
            redirect(base_url()."login");
        }
        $url=$_SERVER["HTTP_REFERER"];
        redirect($url);
        
        // $this->load->view('user/index',$page_data);
    }
	

    public function apply_coupon()
    {
        $page_data=array();

        $coupon_code = $this->input->post('checkout-discount-input');
        $current_date = date('Y-m-d H:m:s');
        $query="select * from tbl_coupon where BINARY coupon_code='".$coupon_code."' and coupon_status='Active' and '".$current_date."'  between coupon_start_time and coupon_end_time ";

        $res=$this->db->query($query);
        /*if($res->num_rows()>0)
        {
            foreach($res->result() as $row)
            {

                
            }
        }
        */
        if($res->num_rows()==1)
        {
            $row=$res->result();
            $_SESSION['coupon_code']=$row[0]->coupon_code;
            $_SESSION['coupon_on']=$row[0]->coupon_value_on;
            $_SESSION['coupon_value']=$row[0]->coupon_value;
        }
        else
        {
            //echo "error";
            $page_data['coupon_msg']='<div class="alert alert-danger" role="alert"  style="width:30%"><i class="icon-close"></i> Invalid Coupon Code
</div>';
        }

        // print_r($page_data);
        $this->load->view('user/checkoutview',$page_data);
        
    }

    public function remove_coupon()
    {
        unset($_SESSION['coupon_code']);
        unset($_SESSION['coupon_on']);
        unset($_SESSION['coupon_value']);
        unset($_SESSION['discount_amount']);

        //$url=$_SERVER["HTTP_REFERER"];
        $url=base_url().'user/checkout';
        redirect($url);

    }


    public function manage_category_view($category_slug="")
    {

    //     $page_data['pr_id'] = 0;
    //     $category_id         = 0;
    //     if (isset($param1) && trim($param1) != "") {
    //         $category_id         = $param1;
    //         $page_data['pr_id'] = $param1;
    //     }
        
    //    $page_data["resultset"]=$this->db->get_where("tbl_category", array(
    //        'category_id' => $category_id
    //    ));
    //    $resultset=$this->db->get("tbl_category");

    $page_data["resultset"]=$this->db->get_where('tbl_category',array('category_seo_slug'=>$category_slug));


    

    

    // echo "<pre>";
    //     print_r($page_data["resultset"]);
    // echo "</pre>";    


        $this->load->view('user/category_view',$page_data);
    }

    public function manage_popup_email($param1="",$param2="",$param3="")
    {
            if($param1=="create")
                {
                    $data["subscriber_email"]=$this->input->post("txt_subscriber_email");
                    $this->db->insert("tbl_subscriber",$data);
                    redirect(base_url()."user");
                }
       
    }

    public function product360()
    {
       $this->load->view('user/360product');
    }

    public function saved_address($param1="")
    {
        if(!isset($_SESSION["user_id"]))
        {
            redirect(base_url().'user/register');
        }
        $page_data['msg']="";

        if($param1=="update")
        {
          $save_up_data['address_person_name'] = $this->input->post('txt_first_name')." ".$this->input->post('txt_last_name');
          $save_up_data['address_company_name'] = $this->input->post('txt_company_name');
          $save_up_data['address_line1'] = $this->input->post('txt_address_line1');
          $save_up_data['address_line2'] = $this->input->post('txt_address_line2');
          $save_up_data['address_country_id'] = $this->input->post('cmb_country');
          $save_up_data['address_state_id'] = $this->input->post('cmb_state');
          $save_up_data['address_city_id'] = $this->input->post('cmb_city');
          $save_up_data['address_pincode'] = $this->input->post('txt_pincode');
          $save_up_data['address_email'] = $this->input->post('txt_email');
          $save_up_data['address_phone_number'] = $this->input->post('txt_phone');

          $this->db->where('address_id',$this->input->post('txt_selected_address_id'));
          $this->db->update('tbl_address',$save_up_data);

          $page_data['msg']='
                <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i>  <strong>Your Profile Updated Successfully..!!</strong>
                            </div>
                        </div>
                </div>';

          
        }

        $page_data['customer_res']=$this->db->get_where('tbl_customer',array("customer_id"=>$_SESSION["user_id"]));

        $this->load->view('user/myaccountview',$page_data);
    }

    public function change_password($action="")
    {
        $page_data=array();

        $page_data['active_id']='change_password';
        if($action=="update")
        {
            $old_pwd=$this->input->post('txt_old_pwd');
            $new_pwd=$this->input->post('txt_pwd');
            $cpwd=$this->input->post('txt_cpwd');

            if($new_pwd==$cpwd)
            {
                $old_res=$this->db->get_where('tbl_user',array('user_id'=>$_SESSION["user_id"]));
                $old_row=$old_res->result();
                if($old_row[0]->user_password==$old_pwd)
                {
                    $update_pass_data['user_password']=$new_pwd;
                    $this->db->where('user_id',$_SESSION["user_id"]);
                    $this->db->update('tbl_user',$update_pass_data);

                    $page_data['msgs']='<div class="alert alert-success" role="alert" ><i class="icon-check"></i> Your Password changed successfully</div>';
                }
                else
                {
                    $page_data['msgs']='<div class="alert alert-danger" role="alert"><i class="icon-close"></i> Invalid old password</div>';
                }
            }
            else
            {
                $page_data['msgs']='<div class="alert alert-danger" role="alert" ><i class="icon-close"></i> Password and Confirm Password not matched</div>';
            }

           /* $page_data['msg']='<div class="alert alert-success" role="alert" style="width:30%"><i class="icon-check"></i> Your Password changed successfully</div>';
           */
        }
        $this->load->view('user/myaccountview',$page_data);
    }

    public function edit_profile($param1="")
    {
        if(!isset($_SESSION["user_id"]))
        {
            redirect(base_url().'user/register');
        }
        $page_data['msg']="";
        if($param1=="do_update")
        {
            if($this->input->post('txt_user_name')!="" || $this->input->post('txt_user_mobile_number')!="" ||
             $this->input->post('txt_user_address')!=""  )
            {
                $update_data['user_name']=$this->input->post('txt_user_name');
                $update_data['user_mobile_number']=$this->input->post('txt_user_mobile_number');
                $update_data['user_address']=$this->input->post('txt_user_address');

                $this->db->where('user_id',$_SESSION["user_id"]);
                $this->db->update('tbl_user',$update_data);

                $page_data['msg']='
                <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i>  <strong>Your Profile Updated Successfully..!!</strong>
                            </div>
                        </div>
                </div>';
            }
        }
        $page_data['user_resultset']=$this->db->get_where('tbl_user',array("user_id"=>$_SESSION["user_id"]));

        $this->load->view('user/myaccountview',$page_data);
    }

    // public function categroy_product()
    // {
    //     $page_data["resultset"]=$this->db->get_where('tbl_category',array('category_seo_slug'=>$category_slug));

    //     $this->load->view('user/new_category_view',$page_data);
    // }

    public function search_query($action="",$param="")
    {
        $url=$_SERVER['HTTP_REFERER'];
        
    
        parse_str(parse_url($url, PHP_URL_QUERY), $output);

        //echo  print_r($output, TRUE);

        //echo $output;

        $cat_url="";
        $attr_url="";
        $price_url="";

        if($action=="category")
        {
            if($output['category']=="")
            {
                $cat_url="&category=".$param;
            }
            else
            {
                $cat_url="&category=".$output['category']."_".$param;
            }
            $attr_url="&attr=".$output['attr'];
            $price_url="&price_range=".$output['price_range'];
        }

        if($action=="attr")
        {
            if($output['attr']=="")
            {
                $attr_url="&attr=".$param;
            }
            else
            {
                $attr_url="&attr=".$output['attr']."_".$param;
            }
            $cat_url="&category=".$output['category'];
            $price_url="&price_range=".$output['price_range'];
        }

        if($action=="price_range")
        {
            
            $price_url="&price_range=".$param;
            $cat_url="&category=".$output['category'];
            $attr_url="&attr=".$output['attr'];
        }

        /*if(empty($output))
        {
            if($action=="category")
            {
                $cat_url="&category=".$param;
            }
            if($action=="attr")
            {
                $attr_url="&attr=".$param;
            }
            if($action=="price_range")
            {
                $price_url="&price_range=".$param;
            }
        }
        else
        {
            foreach ($output as $key => $value) 
            {
                if($key=="category")
                {
                    $cat_url="&category=".$value;
                }
                if($key=="attr")
                {
                    $attr_url="&attr=".$value;
                }
                if($key=="price_range")
                {
                    $price_url="&price_range=".$value;
                }

                $output_value = explode("_", $value);
                if($action=="category")
                {
                    if($key=="category")
                    {
                        $cat_url="&category=".$value."_".$param;
                    }
                    else
                    {
                        $cat_url="&category=".$param;
                    }
                }
                if($action=="attr")
                {
                    if($key=="attr")
                    {

                        $attr_url="&attr=".$value."_".$param;
                    }
                    else
                    {
                        $attr_url="&attr=".$param;
                    }
                }

                if($action=="price_range")
                {
                    $price_url="&price_range=".$param;
                }
            }
        }

        */

        //echo "Hello world ".$price_url;

        //echo "<br>".$attr_url;

        $final_parsed_url=parse_url($url);

        //$final_url = $final_parsed_url['scheme']."://".$final_parsed_url['host'].$final_parsed_url['path']."?".$cat_url.$attr_url.$price_url;

        //echo $final_url;

        $final_url = $final_parsed_url['scheme']."://".$final_parsed_url['host'].$final_parsed_url['path']."?";

        if($cat_url!="&category=")
        {
            $final_url=$final_url.$cat_url;
        }

        if($attr_url!="&attr=")
        {
            $final_url=$final_url.$attr_url;
        }

        if($price_url!="&price_range=")
        {
            $final_url=$final_url.$price_url;
        }

        echo $final_url;
        //redirect($final_url);



        /*var_dump(parse_url($url));
        var_dump(parse_url($url, PHP_URL_SCHEME));
        var_dump(parse_url($url, PHP_URL_USER));
        var_dump(parse_url($url, PHP_URL_PASS));
        var_dump(parse_url($url, PHP_URL_HOST));
        var_dump(parse_url($url, PHP_URL_PORT));
        var_dump(parse_url($url, PHP_URL_PATH));
        var_dump(parse_url($url, PHP_URL_QUERY));
        var_dump(parse_url($url, PHP_URL_FRAGMENT));
        */

   
    }

    public function remove_search_query($action="",$param="")
    {
        $url=$_SERVER['HTTP_REFERER'];
        
    
        parse_str(parse_url($url, PHP_URL_QUERY), $output);

        echo  print_r($output, TRUE);

        //echo $output;

        $cat_url="";
        $attr_url="";
        $price_url="";

        if($action=="category")
        {
            /*if($output['category']=="")
            {
                $cat_url="&category=".$param;
            }
            else
            {
                $cat_url="&category=".$output['category']."_".$param;
            }
            */
            if($output['category']!="")
            {
                /*
                if (($key = array_search($param, $output['category'])) !== false) 
                {
                    unset($output['category'][$key]);
                }

                echo "<br>Url : ".implode("_", $output['category'])."<br>";
                */
                $check_cat_array=explode("_", $output['category']);
                $delete_array=array($param);
                //var_dump(array_diff($check_cat_array,$delete_array )); 

                $final_c=array_diff($check_cat_array,$delete_array );

                $cat_url="&category=".implode("_", $final_c);


            }
            $attr_url="&attr=".$output['attr'];
            $price_url="&price_range=".$output['price_range'];
        }

        if($action=="attr")
        {
            if($output['attr']!="")
            {
                /*
                if (($key = array_search($param, $output['category'])) !== false) 
                {
                    unset($output['category'][$key]);
                }

                echo "<br>Url : ".implode("_", $output['category'])."<br>";
                */
                $check_attr_array=explode("_", $output['attr']);
                $delete_attr_array=array($param);
                //var_dump(array_diff($check_cat_array,$delete_array )); 

                $final_a=array_diff($check_attr_array,$delete_attr_array );

                $attr_url="&attr=".implode("_", $final_a);


            }
            $cat_url="&category=".$output['category'];
            $price_url="&price_range=".$output['price_range'];
        }

        if($action=="price_range")
        {
            
            $price_url="&price_range=".$param;
            $cat_url="&category=".$output['category'];
            $attr_url="&attr=".$output['attr'];
        }

        

        //echo "Hello world ".$price_url;

        //echo "<br>".$attr_url;

        $final_parsed_url=parse_url($url);

        //$final_url = $final_parsed_url['scheme']."://".$final_parsed_url['host'].$final_parsed_url['path']."?".$cat_url.$attr_url.$price_url;

        //echo $final_url;

        $final_url = $final_parsed_url['scheme']."://".$final_parsed_url['host'].$final_parsed_url['path']."?";

        if($cat_url!="&category=")
        {
            $final_url=$final_url.$cat_url;
        }

        if($attr_url!="&attr=")
        {
            $final_url=$final_url.$attr_url;
        }

        if($price_url!="&price_range=")
        {
            $final_url=$final_url.$price_url;
        }

        redirect($final_url);

    }

    public function product_page()
    {
        
        $this->load->view('user/product_page');
    }

    public function product_setting_page()
    {
      $this->load->view('user/product_setting_page');
    }

    public function allsetting()
    {
        $this->load->view('user/manage_allsettings');
    }

    public function faq()
    {
      $this->load->view('user/faq');
    }

    public function education()
    {
        $this->load->view('user/education');
    }

    public function finejewelry()
    {
        $this->load->view('user/finejewelry');
    }
    
    public function loose_diamonds()
    {
        $this->load->view('user/loose_diamonds');
    }

    public function wedding_rings()
    {
        $this->load->view('user/wedding_rings');
    }

    public function engagement_rings()
    {
      $this->load->view('user/engagement_rings');
    }

    public function gemstones()
    {
        $this->load->view('user/gemstones');
    }

    public function hello()
    {
        $this->load->view('user/hello');
    }

    public function step()
    {
        $this->load->view('user/steps');
    }


    public function payment()
    {
        $this->load->view('user/payment_get');
    }

    public function paypaldemo()
    {
        $this->paypal_lib->paypal_auto_form();
        $this->load->view('user/paypaldemo');

    }

    public function razorpay()
    {
        $this->load->view('user/razorpaydemo');
    }

    public function strip()
    {
    
        require_once('application/libraries/stripe-php/init.php');
        // \Stripe\Stripe::setApiKey(STRIPE_KEY);
        // echo $this->config->item(STRIPE_KEY);
        // echo STRIPE_KEY;

        // \Stripe\Charge::create ([
        //         "amount" => 100 * 100,
        //         "currency" => "inr",
        //         "source" => $this->input->post('stripeToken'),
        //         "description" => "Test payment." 
        // ]);
            
        // $this->session->set_flashdata('success', 'Payment is successful.');
        // redirect('/payment-gateway', 'refresh'); 


        $this->load->view('user/strip');
        
    }

    public function checkout()
    {
      $this->load->view("user/checkout");
    }

    public function create(){
   
        
        $amount  = $this->input->post('amount');
        $qty  = $this->input->post('qty');
        echo $this->config->item('stripe_currency');
        echo "<br>";
        echo $this->config->item('stripe_secret_key');
        Stripe::setApiKey($this->config->item('stripe_secret_key'));
            //  echo $this->config->item('stripe_secret_key');
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'name' => 'T-shirt',
              'description' => 'Comfortable cotton t-shirt',
              'images' => ['https://example.com/t-shirt.png'],
              'amount' => 2000,
              'currency' => 'usd',

              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'https://example.com/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'https://example.com/cancel',
          ]);
        header("Location:".$checkout_session->url);
        
    }


    public function drive()
    {
        $this->load->view('user/drive');
    }

    // function login()
    // {
    //     require_once('vendor/autoload.php');
   
    //  $google_client = new Google_Client();
   
    //  $google_client->setClientId('976532754089-o8eh5ql98ivqv4vjvp6qvdaupgj58d4j.apps.googleusercontent.com'); //Define your ClientID
   
    //  $google_client->setClientSecret('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'); //Define your Client Secret Key
   
    //  $google_client->setRedirectUri('http://localhost/james_allen/user/login'); //Define your Redirect Uri
   
    //  $google_client->addScope('email');
   
    //  $google_client->addScope('profile');
   
    //  if(isset($_GET["code"]))
    //  {
    //   $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
   
    //   if(!isset($token["error"]))
    //   {
    //    $google_client->setAccessToken($token['access_token']);
   
    //    $this->session->set_userdata('access_token', $token['access_token']);
   
    //    $google_service = new Google_Service_Oauth2($google_client);
   
    //    $data = $google_service->userinfo->get();
   
    //    $current_datetime = date('Y-m-d H:i:s');
   
    //    if($this->google_login_model->Is_already_register($data['id']))
    //    {
    //     //update data
    //     $user_data = array(
    //      'first_name' => $data['given_name'],
    //      'last_name'  => $data['family_name'],
    //      'email_address' => $data['email'],
    //      'profile_picture'=> $data['picture'],
    //      'updated_at' => $current_datetime
    //     );
   
    //     $this->google_login_model->Update_user_data($user_data, $data['id']);
    //    }
    //    else
    //    {
    //     //insert data
    //     $user_data = array(
    //      'login_oauth_uid' => $data['id'],
    //      'first_name'  => $data['given_name'],
    //      'last_name'   => $data['family_name'],
    //      'email_address'  => $data['email'],
    //      'profile_picture' => $data['picture'],
    //      'created_at'  => $current_datetime
    //     );
   
    //     $this->google_login_model->Insert_user_data($user_data);
    //    }
    //    $this->session->set_userdata('user_data', $user_data);
    //   }
    //  }
    //  $login_button = '';
    //  if(!$this->session->userdata('access_token'))
    //  {
    //   $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="'.base_url().'asset/sign-in-with-google.png" /></a>';
    //   $data['login_button'] = $login_button;
    //   $this->load->view('user/google_login', $data);
    //  }
    //  else
    //  {
    //   $this->load->view('user/google_login', $data);
    //  }
    // }
   
    // function logout()
    // {
    //  $this->session->unset_userdata('access_token');
   
    //  $this->session->unset_userdata('user_data');
   
    //  redirect('user/google_login/login');
    // }
    
    public function loging(){ 

    include_once APPPATH . "libraries/vendor/autoload.php";

            $google_client = new Google_Client();

            $google_client->setClientId('976532754089-o8eh5ql98ivqv4vjvp6qvdaupgj58d4j.apps.googleusercontent.com'); //Define your ClientID

            $google_client->setClientSecret('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'); //Define your Client Secret Key

            $google_client->setRedirectUri('https://vimlaprints.com/'); //Define your Redirect Uri

            $google_client->addScope('email');

            $google_client->addScope('profile');

            if(isset($_GET["code"]))
            {
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

            if(!isset($token["error"]))
            {
                $google_client->setAccessToken($token['access_token']);

                $this->session->set_userdata('access_token', $token['access_token']);

                $google_service = new Google_Service_Oauth2($google_client);

                $data = $google_service->userinfo->get();

                $current_datetime = date('Y-m-d H:i:s');

                if($this->google_login_model->Is_already_register($data['id']))
                {
                //update data
                $user_data = array(
                'first_name' => $data['given_name'],
                'last_name'  => $data['family_name'],
                'email_address' => $data['email'],
                'profile_picture'=> $data['picture'],
                'updated_at' => $current_datetime
                );

                $this->google_login_model->Update_user_data($user_data, $data['id']);
                }
                else
                {
                //insert data
                $user_data = array(
                'login_oauth_uid' => $data['id'],
                'first_name'  => $data['given_name'],
                'last_name'   => $data['family_name'],
                'email_address'  => $data['email'],
                'profile_picture' => $data['picture'],
                'created_at'  => $current_datetime
                );

                $this->google_login_model->Insert_user_data($user_data);
                }
                $this->session->set_userdata('user_data', $user_data);
            }
            }
            $login_button = '';
            if(!$this->session->userdata('access_token'))
            {
            $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="https://user-images.githubusercontent.com/1531669/41761219-0e0e4d80-7629-11e8-9663-aabe62025d57.png" /></a>';
            $data['login_button'] = $login_button;
            $this->load->view('user/loging', $data);

            }
            else
            {
            $this->load->view('user/loging', $data);
            }
                        

        
         
    } 
     
    // public function loging()
    // {
    //    $this->load->view('user/loging');
    // }

    public function profile(){ 
         /* Redirect to login page if the user not logged in */
        if(!$this->session->userdata('loggedIn')){ 
            redirect('/user/loging'); 
        } 
         
         /* Get user info from session */
        $data['userData'] = $this->session->userdata('userData'); 
         
         /* Load user profile view */
        $this->load->view('user/profile',$data); 
    } 

    public function logout(){ 
        // Reset OAuth access token 
        $this->google->revokeToken(); 
         
        // Remove token and user data from the session 
        $this->session->unset_userdata('loggedIn'); 
        $this->session->unset_userdata('userData'); 
         
        // Destroy entire session data 
        $this->session->sess_destroy(); 
         
        // Redirect to login page 
        redirect('/user/loging'); 
    } 

//     public function facebooklogin()
//     {
//         $data = [];
//         require_once APPPATH. 'libraries/vendor/autoload.php';

        
//     $fb = new Facebook\Facebook([
//         'app_id' => '2137064646482804',
//         'app_secret' => '6f5eb9de42b52f35559db44f79955581',
//         'default_graph_version' => 'v2.5',
//       ]);

//  $helper = $fb->getRedirectLoginHelper();

//  $permissions = ['email','user_location','user_birthday','publish_actions']; 
// // For more permissions like user location etc you need to send your application for review

//  $loginUrl = $helper->getLoginUrl('http://localhost', $permissions);
       
//         $this->load->view('user/facebooklogin',$data); 
        
//     }

    public function hi() {
        $data['fb'] = $this->getauth();
        $data['LogonUrl'] =  $this->facebook->login_url();
        $this->load->view('user/facebooklogin', $data);
        
    }

    public function getauth() {
        $userProfile = array();
        if ($this->facebook->is_authenticated()) {
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
       }
        echo $this->facebook->is_authenticated();   

        return $userProfile;
    }



    public function hidrive()
    {
        include_once APPPATH . "libraries/vendor/autoload.php";
//         require_once 'Google/Client.php';
// require_once 'Google/Service/Drive.php';

$client = new Google_Client();
/* Get your credentials from the console */
$client->setClientId('976532754089-o8eh5ql98ivqv4vjvp6qvdaupgj58d4j.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://vimlaprints.com/');
$client->setScopes(array('https://www.googleapis.com/auth/drive.file'));
$client->setAccessType('offline');


// session_start();

if (isset($_GET['code']) || (isset($_SESSION['access_token']) && $_SESSION['access_token'])) {
    if (isset($_GET['code'])) {
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();
    } else
        $client->setAccessToken($_SESSION['access_token']);

    $service = new Google_Service_Drive($client);

    /* Insert a file */
    $file = new Google_Service_Drive_DriveFile();
    $file->setName(uniqid().'.jpg');
    $file->setDescription('A test document');
    $file->setMimeType('image/jpeg');

    $data = file_get_contents('a.jpg');

    $createdFile = $service->files->create($file, array(
          'data' => $data,
          'mimeType' => 'image/jpeg',
          'uploadType' => 'multipart'
        ));

    print_r($createdFile);

} else {
    $authUrl = $client->createAuthUrl();
    header('Location: ' . $authUrl);
    exit();
}
        
      $this->load->view('user/drive');
  
    }


   
 

  
}
?>