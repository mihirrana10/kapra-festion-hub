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
        /*
        print("<pre>");
        print_r($_POST);
        print("</pre>");
        */
        
        $data['order_billing_name']=$this->input->post('txt_first_name')." ".$this->input->post('txt_last_name');
        //$data['']=$this->input->post('txt_company_name');
        $data['order_billing_country_id']=$this->input->post('cmb_country');
        $data['order_billing_state_id']=$this->input->post('cmb_state');
        $data['order_billing_city_id']=$this->input->post('cmb_city');
        $data['order_billing_address_line1']=$this->input->post('txt_address_line1');
        $data['order_billing_address_line2']=$this->input->post('txt_address_line2');
        $data['order_billing_pincode']=$this->input->post('txt_pincode');
        $data['order_billing_phone_number']=$this->input->post('txt_phone');
        $data['order_billing_email']=$this->input->post('txt_email');
        $data['order_notes']=$this->input->post('txt_order_notes');

        if(isset($_POST["create_account"]))
        {
            if($this->input->post('create_account')=="on")
            {

            }
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
            $data['order_coupon_id']=date('Y-m-d H:m:s');
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
        $data['order_shipping_amount']="0";
        $data['order_final_amount']=$final_total;

        print("<pre>");
        print_r($data);
        print("</pre>");

                
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
        $this->load->view('user/checkout_view',$page_data);
        
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
        if(!isset($_SESSION["customer_id"]))
        {
            redirect(base_url().'user/register');
        }
        $this->load->view('user/wishlist_view');
    }

    public function logout()
    {
        unset($_SESSION["customer_id"]);
        session_destroy();
        redirect(base_url().'user');
    }

    public function checkout()
    {
        $this->load->view('user/checkout_view');
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

    public function get_min_qty()
    {
        $settings_row=$this->db->get("tbl_settings")->result();
        $data['single_min_qty']= $settings_row[0]->settings_single_min_qty;
        $data['total_min_qty']=$settings_row[0]->settings_total_min_qty;
        return $data;
    }

    public function cart()
    {
        $this->load->view('user/cart_view');
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

    public function save_order()
    {
        //$url=$_SERVER["HTTP_REFERER"];
        //if($url != base_url()."user/save_order")
        if(isset($_SERVER["HTTP_REFERER"]))
        {

            $data['order_date']=date('Y-m-d');
            $data['order_invoice_no']='100';
            $data['order_name']=$this->input->post('txt_name');
            $data['order_gst_number']=$this->input->post('txt_gst_no');
            $data['order_agent']=$this->input->post('cmb_agent');
            $data['order_transport']=$this->input->post('txt_transport');
            $data['order_packaging']=$this->input->post('rdo_packaging');
            $data['order_email']=$this->input->post('txt_email');
            $data['order_mobile']=$this->input->post('txt_mobile');
            $data['order_address']=$this->input->post('txt_address');

            $data['order_status']='New';
            //$data['user_id']=$this->input->post('txt_user_id');
            if(isset($_SESSION["user_id"]))
            {
                $data['user_id']=$_SESSION["user_id"];
            }

            $data['order_remarks']=$this->input->post('txt_remarks');
            
            $this->db->insert('tbl_order',$data);
            
            $o_id = $this->db->insert_id();
            $sid=session_id();

            
            //$order_update_res=$this->db->get_where('tbl_cart',array('cart_session'=>$sid));

            $order_update_query = "SELECT `tbl_cart`.`volume_product_id`,`tbl_cart`.`volume_id`,`tbl_cart`.`cart_qty`,
                 `tbl_volume`.`volume_name`,`tbl_volume`.`volume_image`,`tbl_volume`.`volume_price`,
                 `tbl_volume_product`.`volume_product_name`,`tbl_volume_product`.`volume_product_image`,`tbl_volume_product`.`volume_product_price`
                 FROM (`tbl_cart`)
    LEFT OUTER JOIN `tbl_volume` ON `tbl_cart`.`volume_id` = `tbl_volume`.`volume_id`
    LEFT OUTER JOIN `tbl_volume_product` ON `tbl_cart`.`volume_product_id` = `tbl_volume_product`.`volume_product_id`
    WHERE `tbl_cart`.`cart_session` = '".$sid."'";

            //echo $order_update_query;

            $order_update_res = $this->db->query($order_update_query);
            
            $order_detail_data=array();
            $total=0;
            foreach ($order_update_res->result() as $order_row) 
            {
                $order_detail_data['order_id']=$o_id;
                $order_detail_data['volume_product_id']=$order_row->volume_product_id;
                $order_detail_data['volume_id']=$order_row->volume_id;
                $order_detail_data['order_qty']=$order_row->cart_qty;

                $this->db->insert('tbl_order_details',$order_detail_data);

                if($order_row->volume_id!=0)
                {
                    $sub_total = $order_row->volume_price*$order_row->cart_qty;
                }
                else if($order_row->volume_product_id!=0)
                {
                    $sub_total = $order_row->volume_product_price*$order_row->cart_qty;
                }

                $total = $total + $sub_total;
            }
            //update order amount 
            
            $update_amount_data['order_amount']= $total;
            $this->db->where('order_id',$o_id);
            $this->db->update('tbl_order',$update_amount_data);

            //update order amount ends



            //delete cart 
            $this->db->where('cart_session',$sid);
            $this->db->delete('tbl_cart');
            //delete cart ends


            ?>
            <script type="text/javascript">
            
            var pdfurl="<?php echo base_url(); ?>dompdf/index.php?ord_id="+<?php echo $o_id; ?>;
            
            function getXMLHTTP() { //fuction to return the xml http object
                var xmlhttp=false;  
                try{
                    xmlhttp=new XMLHttpRequest();
                }
                catch(e)    {       
                    try{            
                        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch(e){
                        try{
                        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                        }
                        catch(e){
                            xmlhttp=false;
                        }
                    }
                }
                    
                return xmlhttp;
            }
            var req = getXMLHTTP();
            req.open("GET",pdfurl , true);
            req.send(null);
            
            </script>
            <?php

            
            $page_data['msg']='<div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i>  <strong>Your Order Details Sent Successfully..!!</strong> Vimla Prints will be in touch with you, Thanks..!!
                                <br>
                                <i class="fa fa-info-circle"></i>  <strong>Get Your Order Receipt here..<a href="'.base_url().'files/order_pdf/invoice_'.$o_id.'.pdf" target="_blank">Invoice No : '.$o_id.'</a></strong> 
                                
                            </div>
                        </div>
                    </div>';
            $this->load->view('user/cart_view',$page_data);
            //redirect("http://localhost/pdf/dompdf_0-8-1/dompdf/index.php?ord_id=".$o_id);
        }
        else
        {
            redirect(base_url().'user');
        }
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