<?php 
session_start();
class user extends CI_Controller
{
    function __construct() {
        parent::__construct();
        
        if(!isset($_SESSION["exchange_rate"]))
        {
            $_SESSION["currency_symbol"]="&#8360;";
            $_SESSION["exchange_rate"]=1;
            $_SESSION["currency_tag"]="INR";
        }
    }

    public function magazine($catalogue_id)
    {
        $page_data['catalogue_id']=$catalogue_id;
        $this->load->view('user/magazine_flip_view',$page_data);
    }

    public function best_seller()
    {
        $this->load->view('user/best_seller_view');
    }

    public function new_in()
    {
        $this->load->view('user/new_in_view');
    }

    public function contact_us()
    {
        $this->load->view('user/contact_us_view');
    }

    public function download()
    {
        $this->load->view('user/download_view');
    }
    public function product_review($order_id,$pr_id,$action="")
    {
        $page_data=array();
        if($action=="submit")
        {
            $page_data['msg']='<div class="alert alert-success" role="alert" width="50%" style="font-size:20px"><i class="icon-check"></i> Your Review for the Product Successfully Added</div>';
            //$data['product_id']=$this->input->post('txt_product_id');
            $data['product_id']=$pr_id;
            $data['order_id']=$order_id;
            $data['product_overall_rating']=$this->input->post('txt_rating');
            $data['product_review_headline']=$this->input->post('txt_headline');
            $data['product_review_full']=$this->input->post('txt_full_review');
            $data['product_review_date']=date('Y-m-d');
            $data['product_review_status']='Active';

            $this->db->insert('tbl_product_review',$data);
            
        }
        $page_data['order_id']=$order_id;
        $page_data['pr_id']=$pr_id;
        $this->load->view('user/product_review_view',$page_data);
    }

    public function online_order()
    {
        $page_data=array();
        if(isset($_SESSION["razorpay_transaction_id"]))
        {
            //$_SESSION["razorpay_transaction_error"];
            $razorpay_trans_id = $_SESSION["razorpay_transaction_id"];

            //$_SESSION["current_order_id"]

            $razorpay_data['transaction_id']= $razorpay_trans_id;

            $this->db->where('order_id',$_SESSION["current_order_id"]);
            $this->db->update('tbl_order',$razorpay_data);


            session_regenerate_id();
            unset($_SESSION['coupon_code']);
            unset($_SESSION['coupon_on']);
            unset($_SESSION['coupon_value']);
            unset($_SESSION['discount_amount']);
            //$page_data['msg']= $_SESSION["razorpay_transaction_error"];
            $page_data['msg']='<h2 class="title text-center mb-5" style="padding-top: 50px;padding-bottom: 20px"><i class="icon-check"></i>
  Thanks.!! Your Order has been Successfully Placed, We will ship you product soon..!!</h2>
                    
                    <center>
                        <a href="'.base_url().'user" class="btn btn-outline-primary-2" style="margin-bottom: 50px"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                    </center>';
        }
        else if(isset($_SESSION["razorpay_transaction_error"]))
        {
            //$page_data['msg']= $_SESSION["razorpay_transaction_error"];

            $page_data['msg']='<h2 class="title text-center mb-5" style="padding-top: 50px;padding-bottom: 20px;color:red"><i class="icon-check"></i>
  Sorry..!! Your Order has not been placed '.$_SESSION["razorpay_transaction_error"].' </h2>
                    
                    <center>
                        <a href="'.base_url().'user" class="btn btn-outline-primary-2" style="margin-bottom: 50px"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                    </center>';
        }




        $this->load->view('user/order_online_view',$page_data);


        
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
                $old_res=$this->db->get_where('tbl_customer',array('customer_id'=>$_SESSION["customer_id"]));
                $old_row=$old_res->result();
                if($old_row[0]->customer_password==$old_pwd)
                {
                    $update_pass_data['customer_password']=$new_pwd;
                    $this->db->where('customer_id',$_SESSION["customer_id"]);
                    $this->db->update('tbl_customer',$update_pass_data);

                    $page_data['msg']='<div class="alert alert-success" role="alert" ><i class="icon-check"></i> Your Password changed successfully</div>';
                }
                else
                {
                    $page_data['msg']='<div class="alert alert-danger" role="alert"><i class="icon-close"></i> Invalid old password</div>';
                }
            }
            else
            {
                $page_data['msg']='<div class="alert alert-danger" role="alert" ><i class="icon-close"></i> Password and Confirm Password not matched</div>';
            }

           /* $page_data['msg']='<div class="alert alert-success" role="alert" style="width:30%"><i class="icon-check"></i> Your Password changed successfully</div>';
           */
        }
        $this->load->view('user/change_password_view',$page_data);
    }

    public function search_query($action="",$param="")
    {
        /*
        $url="";
        if($action=="category")
        {

        }
        else if($action=="attr")
        {
            $url=$_SERVER['HTTP_REFERER'];
            echo $url;

            print("<pre>");
            print_r(parse_url($url)); 
            print("</pre>");

            $url_array=parse_url($url);
            $extracted_url =explode("&", $url_array['query']);


            //if(in_array("attr", haystack))
            print("<pre>");
            print_r($extracted_url);
            print("</pre>");

            for($i=0;$i<count($extracted_url);$i++)
            {
                //echo $extracted_url[$i];
                $search_array = explode("=", $extracted_url[$i]);
                if($search_array[0]=="attr")
                {
                    if(trim($search_array[1])!="")
                    {
                        $url=$url."&attr=".$param;
                    }
                    else
                    {
                        $url=$url."&attr=".$param;
                    }
                }

            }

        }

        echo $url;
        
        */

        $url=$_SERVER['HTTP_REFERER'];
        //echo $url;

    
        parse_str(parse_url($url, PHP_URL_QUERY), $output);

        echo  print_r($output, TRUE);

        echo $output;

        $cat_url="";
        $attr_url="";
        $price_url="";

        if(empty($output))
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
                    $cat_url="&".$key."=".$value;
                }
                if($key=="attr")
                {
                    $attr_url="&".$key."=".$value;
                }
                if($key=="price_range")
                {
                    $price_url="&".$key."=".$value;
                }

                //echo "<br>".$key." : ".$value;
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
                
                /*
                if($action=="price")
                {
                    if($key=="price")
                    {
                        $attr_url="&attr="$value."_".$param;
                    }
                    else
                    {
                        $attr_url="&price=".$param;
                    }
                }
                */
                

                /*
                if($key=="category")
                {
                    //$value=$value
                }
                else if($param=="attr")
                {
                    $price_url=$value."_".$param;
                }
                else if($key=="price")
                {

                }
                */
            }
        }

        //echo "Hello world ".$price_url;

        echo "<br>".$attr_url;

        $final_parsed_url=parse_url($url);

        $final_url = $final_parsed_url['scheme']."://".$final_parsed_url['host'].$final_parsed_url['path']."?".$cat_url.$attr_url.$price_url;

        echo $final_url;

        redirect($final_url);



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

    public function search()
    {
        
        /*
        echo $this->input->get('category');
        echo "<br>";
        echo $this->input->get('subcat');
        */
        $page_data=array();
        
        if(isset($_GET['category']))
        {
            if(trim($this->input->get('category'))!="")
            {
                $cat_data=$this->input->get('category');
                //echo $cat_data;
                $cat_array=explode("_", $cat_data);
                
                /*
                $query="SELECT * FROM (`tbl_product_category`) JOIN `tbl_product_new` ON `tbl_product_new`.`category_id`=`tbl_product_category`.`category_id` WHERE `tbl_product_category`.`category_id` = '1'";
                */

                $query="SELECT * FROM (`tbl_product_category`) JOIN `tbl_product_new` ON `tbl_product_new`.`product_id`=`tbl_product_category`.`product_id` ";
                for($i=0;$i<count($cat_array);$i++)
                {
                    if($i==0)
                    {
                        $query=$query." where tbl_product_category.category_id=".$cat_array[$i];
                    }
                    else
                    {
                        $query=$query." or tbl_product_category.category_id=".$cat_array[$i];
                    }
                }
                //echo $query;

                $page_data['product_res'] = $this->db->query($query);
                

                //$this->db->join('tbl_product_new','tbl_product_new.category_id=tbl_product_category.category_id');
                //$this->db->get_where('tbl_product_categorys',array('tbl_product_category.category_id'=>'1'));
            }
        }

        if(isset($_GET['attr']))
        {
            if(trim($this->input->get('attr'))!="")
            {
                $attr_data=$this->input->get('attr');
                //echo $cat_data;
                $attr_array=explode("_", $attr_data);
                
                
                //$query="SELECT * FROM (`tbl_product_category`) JOIN `tbl_product_new` ON `tbl_product_new`.`category_id`=`tbl_product_category`.`category_id` WHERE `tbl_product_category`.`category_id` = '1'";
                

                $query="SELECT * FROM (`tbl_product_category`) JOIN `tbl_product_new` ON `tbl_product_new`.`product_id`=`tbl_product_category`.`product_id` ";
                for($i=0;$i<count($cat_array);$i++)
                {
                    if($i==0)
                    {
                        $query=$query." where tbl_product_category.category_id=".$cat_array[$i];
                    }
                    else
                    {
                        $query=$query." or tbl_product_category.category_id=".$cat_array[$i];
                    }
                }
                //echo $query;

                $page_data['product_res'] = $this->db->query($query);
                

                //$this->db->join('tbl_product_new','tbl_product_new.category_id=tbl_product_category.category_id');
                //$this->db->get_where('tbl_product_categorys',array('tbl_product_category.category_id'=>'1'));
            }
        }

        $this->load->view('user/search_view',$page_data);
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

    public function resend_order_otp()
    {

        $otp=rand(100000,999999);
        $up_otp_data['order_otp']=$otp;
        $this->db->where('order_id',$_SESSION["current_order_id"]);
        $this->db->update('tbl_order',$up_otp_data);


        $msg="YOUR OTP FOR THE ORDER ".$otp;
        $msg=urlencode($msg);

        $sms_url="http://login.arihantsms.com/vendorsms/pushsms.aspx?user=vimlaprints&password=vimla1266&msisdn=".$_SESSION["mobile_number"]."&sid=VIMLAA&msg=".$msg."&fl=0&gwid=2";

        $response=file_get_contents($sms_url);

        

        redirect(base_url().'user/otp_verify');
    }

    public function otp_verify($action="")
    {
        $page_data=array();
        if($action=="check")
        {
            $otp = $this->input->post('txt_otp');
            //echo "<h1>".$otp."</h1>";

            $query="select * from tbl_order where order_id='".$_SESSION["current_order_id"]."' and order_otp='".$otp."' ";
            //echo $query;

            $res=$this->db->query($query);
            if($res->num_rows()>0)
            {
                $page_data['close_form']=true;
                /*
                $page_data['msg']='<div class="alert alert-success" role="alert"><i class="icon-check"></i>
  Thanks.!! Your Order has been Successfully Verified, We will ship you product soon..!!
</div>';
                */
                //echo "<h1>Your Order is verified</h1>";

                $verified_data['order_otp_verified']='Yes';
                $this->db->where('order_id',$_SESSION["current_order_id"]);
                $this->db->update('tbl_order',$verified_data);

                session_regenerate_id();
                unset($_SESSION['coupon_code']);
                unset($_SESSION['coupon_on']);
                unset($_SESSION['coupon_value']);
                unset($_SESSION['discount_amount']);
                
                
            }
            else
            {
                //echo "<h1>Your OTP is wrong</h1>";
                $page_data['msg']='<div class="alert alert-danger" role="alert" style="width:30%">
  Invalid.!! OTP is wrong, Please enter right OTP</div>';

            }
        }
        $this->load->view('user/otp_verify_view',$page_data);
    }

    public function notify_me($product_id)
    {
        if(!isset($_SESSION["customer_id"]))
        {
            redirect(base_url().'user/register');
        }

        $query="select * from tbl_notify where product_id='".$product_id."' and customer_id='".$_SESSION["customer_id"]."' ";

        $res=$this->db->query($query);

        if($res->num_rows()==0)
        {
            $data['product_id']=$product_id;
            $data['customer_id']=$_SESSION["customer_id"];
            $this->db->insert('tbl_notify',$data);
        }

        $resultset=$this->db->get_where('tbl_wishlist',array("customer_id"=>$_SESSION["customer_id"],"product_id"=>$product_id));
        if($resultset->num_rows==0)
        {
            $data['product_id']=$product_id;
            $this->db->insert("tbl_wishlist",$data);
        }

        //for url redirection
        $product_res=$this->db->get_where('tbl_product_new',array('product_id'=>$product_id));
        $product_row=$product_res->result();
        $url=base_url().'user/product/'.$product_row[0]->product_seo_slug;
        redirect($url);
        //for url redirection


        //$url=$_SERVER["HTTP_REFERER"];
        //redirect($url);

    }
	public function index()
	{
		$this->load->view('user/index');
	}

    public function apply_coupon()
    {
        print("<pre>");
        print_r($_POST);
        print("</pre>");

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
            $_SESSION["coupon_id"]=$row[0]->coupon_id; 
            $_SESSION['coupon_code']=$row[0]->coupon_code;
            $_SESSION['coupon_on']=$row[0]->coupon_value_on;
            $_SESSION['coupon_value']=$row[0]->coupon_value;
            $url=$_SERVER["HTTP_REFERER"];
            //redirect($url);

            $url = str_replace("/msg", "", $url);
            redirect($url);
            
        }
        else
        {
            //echo "error";
            
            /*$page_data['coupon_msg']='<div class="alert alert-danger" role="alert" ><i class="icon-close"></i> Invalid Coupon Code
</div>';
*/
            //echo $page_data['coupon_msg'];
            $url=$_SERVER["HTTP_REFERER"];

            redirect($url.'/msg');

        }

        //print_r($page_data);
        //$this->load->view('user/checkout_view',$page_data);


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

    public function wishlist()
    {
        $page_data['active_id']='wishlist';
        if(!isset($_SESSION["customer_id"]))
        {
            redirect(base_url().'user/register');
        }
        $this->load->view('user/wishlist_view',$page_data);
    }

    public function order_history()
    {
        $page_data['active_id']='order_history';
        if(!isset($_SESSION["customer_id"]))
        {
            redirect(base_url().'user/register');
        }
        $this->load->view('user/order_history_view',$page_data);
    }

    public function order_details($order_id)
    {
        $page_data['active_id']='order_history';
        if(!isset($_SESSION["customer_id"]))
        {
            redirect(base_url().'user/register');
        }
        $page_data['order_id']=$order_id;
        $this->load->view('user/order_details_view',$page_data);
    }

    public function logout()
    {
        unset($_SESSION["customer_id"]);
        session_destroy();
        redirect(base_url().'user');
    }

    public function checkout($msg="")
    {
        $page_data=array();

         if($msg=="msg")
        {
            $page_data['msg']='<div class="alert alert-danger" role="alert"  style="width:30%"><i class="icon-close"></i> Invalid Coupon Code</div>';
        }

        $this->load->view('user/checkout_view',$page_data);
    }

    

    public function category($category_slug="")
    {
        /*
        $category_res=$this->db->get_where('tbl_category',array('category_seo_slug'=>$category_slug));
        $category_row=$category_res->result();

        $page_data['category_res']=$category_res;
        $page_data['cat_id']=$category_row[0]->category_id;
        */
        $page_data=array();
        $this->load->view('user/category_view',$page_data);
    }

    /*
    public function product($product_id)
    {
        $page_data['pr_id']=$product_id;
        $page_data['product_res']=$this->db->get_where('tbl_product_new',array('product_id'=>$product_id));
        $this->load->view('user/product_view',$page_data);
    }
    */
    
    //public function product($product_slug,$product_id)
    
    public function product($product_slug)
    {
        //$page_data['pr_id']=$product_id;
        //$page_data['product_res']=$this->db->get_where('tbl_product_new',array('product_id'=>$product_id));
        //$page_data['product_res']=$this->db->get_where('tbl_product_new',array('product_seo_slug'=>$product_slug));

        $product_res=$this->db->get_where('tbl_product_new',array('product_seo_slug'=>$product_slug));
        $product_row=$product_res->result();
        $page_data['pr_id']=$product_row[0]->product_id;
        $page_data['product_res']=$product_res;


        $this->load->view('user/product_view',$page_data);
    }


	public function catalogues($category_id)
	{
		$category_data_res=$this->db->get_where('tbl_category',array('category_id'=>$category_id));
        $category_data=$category_data_res->result();
        $data['cat_name']  = $category_data[0]->category_name;
        
        $data['cat_id']=$category_id;
		$this->load->view('user/catalogue_view',$data);
	}

	public function volumes($catalogue_id,$brand_id="")
	{
        $data['br_id']=0;
        if($catalogue_id == "new_arrival")
        {
            $data['volume_by']="new_arrival";
        }
        elseif($catalogue_id=="brand")
        {
            $data['volume_by']="brand";
            $data['br_id']=$brand_id;
        }
        else
        {
            $data['volume_by']="catalogue_wise";
            $catalog_data_res=$this->db->get_where('tbl_catalogue',array('catalogue_id'=>$catalogue_id));
            $catalog_data=$catalog_data_res->result();
            $data['catal_name']  = $catalog_data[0]->catalogue_name;
            $data['catal_id']=$catalogue_id;
        }
        $this->load->view('user/volume_view',$data);
	}

	public function products($volume_id)
	{
        $volume_data_res=$this->db->get_where('tbl_volume',array('volume_id'=>$volume_id));
        $volume_data=$volume_data_res->result();
        $data['volu_name']  = $volume_data[0]->volume_name;
        $data['volu_id']=$volume_id;
        $this->load->view('user/product_view',$data);
	}

	public function product_full($product_id)
	{
        $product_data_res=$this->db->get_where('tbl_volume_product',array('volume_product_id'=>$product_id));
        $product_data=$product_data_res->result();
        $data['product_data_res']=$product_data_res;
        $data['prod_name']  = $product_data[0]->volume_product_name;
        $data['prod_id']    = $product_id;
		$this->load->view('user/product_full_view',$data);
	}

    /*public function add_to_cart($add_action,$id)
    {
        $min_qty_array=$this->get_min_qty();
        
        $data['cart_qty']=$min_qty_array['single_min_qty'];
        
        $sid=session_id();
        $data['cart_session']=$sid;

        if($add_action=="volume")
        {
            echo "volume";
            $cart_check=$this->db->get_where('tbl_cart',array('volume_id'=>$id,'cart_session'=>$sid));
            if($cart_check->num_rows()>0)
            {
                $up_query="update tbl_cart set cart_qty=cart_qty+1 where volume_id='".$id."' and cart_session='".$sid."'";
                $this->db->query($up_query);
            }
            else
            {
                $data['volume_id']=$id;    
                $this->db->insert('tbl_cart',$data);
            }
        }
        if($add_action=="product")
        {
            echo "product";
            $cart_check=$this->db->get_where('tbl_cart',array('volume_product_id'=>$id,'cart_session'=>$sid));
            if($cart_check->num_rows()>0)
            {
                $up_query="update tbl_cart set cart_qty=cart_qty+1 where volume_product_id='".$id."' and cart_session='".$sid."'";
                $this->db->query($up_query);
            }
            else
            {
                $data['volume_product_id']=$id;    
                $this->db->insert('tbl_cart',$data);
            }
            
        }

        

        $url=$_SERVER["HTTP_REFERER"];
        redirect($url);
    }*/

    /*
    public function add_to_cart($p_id)
    {
        $sid=session_id();
        //echo $sid;
        $cart_query="select * from tbl_cart where product_id='".$p_id."' and 
        cart_session='".$sid."' ";
        $cart_res=$this->db->query($cart_query); 
        if($cart_res->num_rows()>0)
        {
            $update_query="update tbl_cart set cart_qty=cart_qty+1 where cart_session='".$sid."' and product_id='".$p_id."' ";

            $this->db->query($update_query);
        }
        else
        {
            $insert_data['product_id']=$p_id;
            $insert_data['cart_qty']='1';
            $insert_data['cart_session']=$sid;
            $this->db->insert('tbl_cart',$insert_data);
        }

        $url=$_SERVER["HTTP_REFERER"];
        redirect($url);
    }
    */

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


    public function get_min_qty()
    {
        $settings_row=$this->db->get("tbl_settings")->result();
        $data['single_min_qty']= $settings_row[0]->settings_single_min_qty;
        $data['total_min_qty']=$settings_row[0]->settings_total_min_qty;
        return $data;
    }

    public function cart($msg="")
    {
        $page_data=array();
        if($msg=="msg")
        {
            $page_data['msg']='<div class="alert alert-danger" role="alert"  style="width:100%"><i class="icon-close"></i> Invalid Coupon Code</div>';
        }
        $this->load->view('user/cart_view',$page_data);
        
    }

    public function remove_cart($id)
    {
        $sid=session_id();
        $query="delete from tbl_cart where cart_session='".$sid."' and product_id='".$id."' ";
        $this->db->query($query);
        $url=$_SERVER["HTTP_REFERER"];
        redirect($url);
    }

    public function remove_wishlist($product_id)
    {
        $query="delete from tbl_wishlist where customer_id='".$_SESSION["customer_id"]."' and product_id='".$product_id."' ";
        
        $this->db->query($query);
        $url=$_SERVER["HTTP_REFERER"];
        redirect($url);
    }

    
    public function register($param1="")
    {
        $page_data=array();
        if($param1=="create")
        {
            if($this->input->post('txt_pwd')==$this->input->post('txt_cpwd'))
            {
                $data['customer_email_address']=$this->input->post('txt_email');
                $data['customer_password']=$this->input->post('txt_pwd');
                $data['customer_mobile_number']=$this->input->post('txt_mobile_number');
                $data['customer_status']='Active';
                $data['customer_doj']=date('Y-m-d');
                
                /*
                $data['user_full_name']=$this->input->post('txt_name');
                $data['user_mobile']=$this->input->post('txt_mobile');
                $data['user_gst_no']=$this->input->post('txt_gst_no');
                */
                $page_data['msg']='
                <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i>  <strong>Your Account Created Successfully..!!</strong>
                            </div>
                        </div>
                </div>';

                /*
                print("<pre>");
                print_r($data);
                print("</pre>");
                */

                $this->db->insert('tbl_customer',$data);
            }
            else
            {
                $page_data['msg']='
                <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i>  <strong>Your Password and Confirm Password not matched..!!</strong>
                            </div>
                        </div>
                </div>';
            }
            $page_data['active_link']='register';
                        
        }

        else if($param1=="login")
        {
            $email=$this->input->post('txt_email');
            $pwd=$this->input->post('txt_pwd');

            //$login_res=$this->db->get_where('')
            $login_query="select * from tbl_customer where customer_email_address='".$email."' and customer_password='".$pwd."' ";
            $login_res=$this->db->query($login_query);

            if($login_res->num_rows()>0)
            {
                $login_row=$login_res->result();
                $_SESSION["customer_id"]=$login_row[0]->customer_id;

                //echo $_SESSION["customer_id"];

                redirect(base_url().'user/dashboard');

            }
            else
            {

                $page_data['msg']='
                <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissable">
                                <i class="fa fa-info-circle"></i>  Username/Email and Password not matched
                            </div>
                        </div>
                </div>';
            }
            $page_data['active_link']='login';

        }
        
        $this->load->view('user/register_view',$page_data);
    }

    public function dashboard()
    {
        $page_data['active_id']='dashboard';
        $this->load->view('user/dashboard_view',$page_data);
    }


    



    public function order()
    {
        if(!isset($_SESSION["user_id"]))
        {
            redirect(base_url().'user/register');
        }

        $this->load->view('user/order_view');
    }

    public function order_full($order_id)
    {
        if(!isset($_SESSION["user_id"]))
        {
            redirect(base_url().'user/register');
        }
        $data['ord_id']=$order_id;
        $this->load->view('user/order_full_view',$data);
    }
    
    public function wishlist_add($id)
    {
        if(isset($_SESSION["customer_id"]))
        {
            $data['customer_id']=$_SESSION["customer_id"];
            
            $resultset=$this->db->get_where('tbl_wishlist',array("customer_id"=>$_SESSION["customer_id"],"product_id"=>$id));
            if($resultset->num_rows==0)
            {
                $data['product_id']=$id;
                $this->db->insert("tbl_wishlist",$data);
            }
            
            
        }
        else
        {
            redirect(base_url()."user/register");
        }
        $url=$_SERVER["HTTP_REFERER"];
        redirect($url);
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
            if($this->input->post('txt_full_name')!="" || $this->input->post('txt_mobile')!="" || $this->input->post('txt_address')!=""  )
            {
                $update_data['user_full_name']=$this->input->post('txt_full_name');
                $update_data['user_mobile']=$this->input->post('txt_mobile');
                $update_data['user_address']=$this->input->post('txt_address');

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

        $this->load->view('user/edit_profile_view',$page_data);
    }
    public function changepwd($param1="")
    {
        if(!isset($_SESSION["user_id"]))
        {
            redirect(base_url().'user/register');
        }
        $page_data['msg']="";
        if($param1=="do_update")
        {
            if($this->input->post('txt_old_pwd')!="" && $this->input->post('txt_new_pwd')!="" && $this->input->post('txt_confirm_new_pwd')!=""  )
            {
                $oldpwd=$this->input->post('txt_old_pwd');
                $newpwd=$this->input->post('txt_new_pwd');
                $confirm_newpwd=$this->input->post('txt_confirm_new_pwd');

                $user_data_res=$this->db->get_where('tbl_user',array("user_id"=>$_SESSION["user_id"]))->result();

                $row=$user_data_res[0];
                //echo "old password :" .$row->user_password;
                if($oldpwd == $row->user_password)
                {
                    if($newpwd == $confirm_newpwd)
                    {
                        $update_data['user_password']=$newpwd;

                        $this->db->where('user_id',$_SESSION["user_id"]);
                        $this->db->update('tbl_user',$update_data);

                        $page_data['msg']='
                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <i class="fa fa-info-circle"></i>  <strong>Your Password Changed Successfully..!!</strong>
                                    </div>
                                </div>
                        </div>';

                    }
                    else
                    {
                        $page_data['msg']='
                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <i class="fa fa-info-circle"></i>  <strong>New Password and Confirm Password not matched!!</strong>
                                    </div>
                                </div>
                        </div>';
                    }

                }
                else
                {
                    $page_data['msg']='
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="fa fa-info-circle"></i>  <strong>Wrong Old Password!!</strong>
                                </div>
                            </div>
                    </div>';
                }

            }
            else
            {
                $page_data['msg']='
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="fa fa-info-circle"></i>  <strong>Please Enter Data Properly!!</strong>
                                </div>
                            </div>
                    </div>';

            }
        }
        
        $this->load->view('user/changepwd_view',$page_data);
    }
    public function contact()
    {
        $this->load->view('user/contact_view');
    }

    public function download_images($volume_id)
    {
        //$files = array('readme.txt', 'test.html', 'image.gif');
        if(isset($files))
        {
            unset($files);
        }
        $files=array();
        $this->db->join("tbl_volume","tbl_volume_product.volume_id=tbl_volume.volume_id");
        $resultset=$this->db->get_where('tbl_volume_product',array("tbl_volume_product.volume_id"=>$volume_id));
        foreach ($resultset->result() as $file_row) 
        {
            $files[]=base_url()."files/admin/product/".$file_row->volume_product_image;
        }
        $zipname = "zip/".str_replace(" ", "_", $file_row->volume_name).'.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
          //$zip->addFile($file);
            $zip->addFromString(basename($file),  file_get_contents($file));  
        }
        $zip->close();

        /*
        print("<pre>");
        print_r($files);
        print("</pre>");
        */
        
       header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);

    }

    



    
}
?>