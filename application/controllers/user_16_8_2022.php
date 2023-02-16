<?php 
session_start();
require 'PHPMailerAutoload.php';

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
        $_SESSION["records_per_page"]="15";

        if(!isset($_SESSION["sms_username"]))
        {
            $config_res=$this->db->get("tbl_config");
            $config_row=$config_res->result();
            $_SESSION["sms_username"]=$config_row[0]->config_sms_username;
            $_SESSION["sms_password"]=$config_row[0]->config_sms_password;
            $_SESSION["sms_senderid"]=$config_row[0]->config_sms_sender_id;
            $_SESSION["razorpay_key_id"]=$config_row[0]->config_razorpay_key_id;
            $_SESSION["razorpay_key_secret"]=$config_row[0]->config_razorpay_key_secret;
            //print_r($_SESSION);
        }


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

        $this->send_email_phpmailer_cancel_order(6,$ordr_row[0]->order_billing_email,$ordr_row[0]->order_billing_name,$order_id);
        //order email end




        redirect(base_url().'user/order_details/'.$order_id);
    }

    public function cancel_order_email($order_id)
    {
          $page_data['order_id']=$order_id;
          //$this->load->view('user/order_email_view',$page_data);
          $this->load->view('user/order_cancel_theme1',$page_data);
    }

    public function send_email_phpmailer_cancel_order($email_template_id="", $email="",$name="",$order_id="")
    {

      $email_template_res=$this->db->get_where('tbl_email_template',array('email_template_id'=>$email_template_id));
      $email_template_row=$email_template_res->result();


      
      $mailto=$email;
      $subject="Your Vimla Prints Order Cancellation Request Received - Order # ".$order_id;
      
      //$message = file_get_contents(base_url().'user/order_email/'.$order_id);
      $message = file_get_contents(base_url().'user/cancel_order_email/'.$order_id);


      //echo $message;
      //$message=$email_template_row[0]->email_template_body;
      

      /*
      $mailto="sandipshirawala@gmail.com";
      $subject="New Registration in ClubBharat";
      $message="<h1>Helloo Guys get the free deals now</h1>";
      */
      

       $email_settings_res=$this->db->get_where('tbl_email_settings',array('email_settings_id'=>$email_template_row[0]->email_settings_id));

      $email_settings_row=$email_settings_res->result();


      

      $mail = new PHPMailer;

      //$mail->SMTPDebug = 4;                               // Enable verbose debug output

      $mail->isSMTP();                                      // Set mailer to use SMTP

      
      $mail->Host     = $email_settings_row[0]->email_settings_host;
      $mail->SMTPAuth = $email_settings_row[0]->email_settings_smtp_auth;
      $mail->Username = $email_settings_row[0]->settings_username;
      $mail->Password = $email_settings_row[0]->settings_password;
      $mail->SMTPSecure = $email_settings_row[0]->settings_smtp_secure;
      $mail->Port     = $email_settings_row[0]->settings_smtp_port;
      

      /*

      $mail->Host     = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'sandipshirawala@gmail.com';
      $mail->Password = 'pass#123';
      $mail->SMTPSecure = 'tls';
      $mail->Port     = 587;

      */

      /*
      $mail->setFrom('info@clubbharat.com', $subject);
      $mail->addReplyTo('info@clubbharat.com', $subject);
      */

      //$mail->setFrom($email_settings_row[0]->settings_username, $subject);
      //$mail->addReplyTo($email_settings_row[0]->settings_username, $subject);

       
      $mail->setFrom($email_settings_row[0]->settings_username, $email_template_row[0]->email_template_sender_name);
      $mail->addReplyTo($email_settings_row[0]->settings_username, $email_template_row[0]->email_template_sender_name);

      //unsubscribe link
      /*
      $mail->AddCustomHeader('List-Unsubscribe', "<mailto:sales@gouptechnologies.com?subject=Unsubscribe>,<http://www.gouptechnologies.com/unsubscribe.php/".$urlid);
      */

      
      $mail->AddCustomHeader('List-Unsubscribe', "<mailto:".$email_settings_row[0]->settings_username."?subject=Unsubscribe>,<http://www.gouptechnologies.com/unsubscribe.php/1");
      
      
      //unsubscribe link end
      
      //$mail->addAddress($mailto,'To Person');     // Add a recipient
      $mail->addAddress($mailto,$name);     // Add a recipient

      //$mail->addAddress('ellen@example.com');               // Name is optional
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');

      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = $subject;
      //$mail->Body    = "<center><h1>Welcome ".$name."</h1></center>".$message;
      $mail->Body    = $message;
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      if(!$mail->send()) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
          echo 'Message has been sent';
      }
    }

    public function email_theme($order_id)
    {
          $page_data['order_id']=$order_id;
          $this->load->view('user/order_email_view_theme1_new',$page_data);
      
    }

    public function order_email($order_id)
    {
        $page_data['order_id']=$order_id;
        //$this->load->view('user/order_email_view',$page_data);
        $this->load->view('user/order_email_view_theme1',$page_data);
    }


    

    public function send_email_phpmailer_order($email_template_id="", $email="",$name="",$order_id="")
    {

      $email_template_res=$this->db->get_where('tbl_email_template',array('email_template_id'=>$email_template_id));
      $email_template_row=$email_template_res->result();


      
      $mailto=$email;
      $subject="Your Vimla Prints New Order Confirmation - Order # ".$order_id;
      
      $message = file_get_contents(base_url().'user/order_email/'.$order_id);
      //echo $message;
      //$message=$email_template_row[0]->email_template_body;
      

      /*
      $mailto="sandipshirawala@gmail.com";
      $subject="New Registration in ClubBharat";
      $message="<h1>Helloo Guys get the free deals now</h1>";
      */
      

       $email_settings_res=$this->db->get_where('tbl_email_settings',array('email_settings_id'=>$email_template_row[0]->email_settings_id));

      $email_settings_row=$email_settings_res->result();


      

      $mail = new PHPMailer;

      //$mail->SMTPDebug = 4;                               // Enable verbose debug output

      $mail->isSMTP();                                      // Set mailer to use SMTP

      
      $mail->Host     = $email_settings_row[0]->email_settings_host;
      $mail->SMTPAuth = $email_settings_row[0]->email_settings_smtp_auth;
      $mail->Username = $email_settings_row[0]->settings_username;
      $mail->Password = $email_settings_row[0]->settings_password;
      $mail->SMTPSecure = $email_settings_row[0]->settings_smtp_secure;
      $mail->Port     = $email_settings_row[0]->settings_smtp_port;
      

      /*

      $mail->Host     = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'sandipshirawala@gmail.com';
      $mail->Password = 'pass#123';
      $mail->SMTPSecure = 'tls';
      $mail->Port     = 587;

      */

      /*
      $mail->setFrom('info@clubbharat.com', $subject);
      $mail->addReplyTo('info@clubbharat.com', $subject);
      */

      //$mail->setFrom($email_settings_row[0]->settings_username, $subject);
      //$mail->addReplyTo($email_settings_row[0]->settings_username, $subject);

       
      $mail->setFrom($email_settings_row[0]->settings_username, $email_template_row[0]->email_template_sender_name);
      $mail->addReplyTo($email_settings_row[0]->settings_username, $email_template_row[0]->email_template_sender_name);

      //unsubscribe link
      /*
      $mail->AddCustomHeader('List-Unsubscribe', "<mailto:sales@gouptechnologies.com?subject=Unsubscribe>,<http://www.gouptechnologies.com/unsubscribe.php/".$urlid);
      */

      
      $mail->AddCustomHeader('List-Unsubscribe', "<mailto:".$email_settings_row[0]->settings_username."?subject=Unsubscribe>,<http://www.gouptechnologies.com/unsubscribe.php/1");
      
      
      //unsubscribe link end
      
      //$mail->addAddress($mailto,'To Person');     // Add a recipient
      $mail->addAddress($mailto,$name);     // Add a recipient

      //$mail->addAddress('ellen@example.com');               // Name is optional
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');

      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = $subject;
      //$mail->Body    = "<center><h1>Welcome ".$name."</h1></center>".$message;
      $mail->Body    = $message;
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      if(!$mail->send()) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
          echo 'Message has been sent';
      }
    }


    public function get_email($order_id)
    {
        $message = file_get_contents(base_url().'user/order_email/'.$order_id);
        echo $message;
    }

    

    public function send_email_now()
    {
        $this->send_email_phpmailer('5','mahendrashirawala@gmail.com','Mahendra Shirawala');
    }

    public function send_email_phpmailer($email_template_id="", $email="",$name="")
    {

      $email_template_res=$this->db->get_where('tbl_email_template',array('email_template_id'=>$email_template_id));
      $email_template_row=$email_template_res->result();


      
      $mailto=$email;
      $subject=$email_template_row[0]->email_template_subject;
      $message=$email_template_row[0]->email_template_body;
      

      /*
      $mailto="sandipshirawala@gmail.com";
      $subject="New Registration in ClubBharat";
      $message="<h1>Helloo Guys get the free deals now</h1>";
      */
      

       $email_settings_res=$this->db->get_where('tbl_email_settings',array('email_settings_id'=>$email_template_row[0]->email_settings_id));

      $email_settings_row=$email_settings_res->result();


      

      $mail = new PHPMailer;

      //$mail->SMTPDebug = 4;                               // Enable verbose debug output

      $mail->isSMTP();                                      // Set mailer to use SMTP

      
      $mail->Host     = $email_settings_row[0]->email_settings_host;
      $mail->SMTPAuth = $email_settings_row[0]->email_settings_smtp_auth;
      $mail->Username = $email_settings_row[0]->settings_username;
      $mail->Password = $email_settings_row[0]->settings_password;
      $mail->SMTPSecure = $email_settings_row[0]->settings_smtp_secure;
      $mail->Port     = $email_settings_row[0]->settings_smtp_port;
      

      /*

      $mail->Host     = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'sandipshirawala@gmail.com';
      $mail->Password = 'pass#123';
      $mail->SMTPSecure = 'tls';
      $mail->Port     = 587;

      */

      /*
      $mail->setFrom('info@clubbharat.com', $subject);
      $mail->addReplyTo('info@clubbharat.com', $subject);
      */

      //$mail->setFrom($email_settings_row[0]->settings_username, $subject);
      //$mail->addReplyTo($email_settings_row[0]->settings_username, $subject);

       
      $mail->setFrom($email_settings_row[0]->settings_username, $email_template_row[0]->email_template_sender_name);
      $mail->addReplyTo($email_settings_row[0]->settings_username, $email_template_row[0]->email_template_sender_name);

      //unsubscribe link
      /*
      $mail->AddCustomHeader('List-Unsubscribe', "<mailto:sales@gouptechnologies.com?subject=Unsubscribe>,<http://www.gouptechnologies.com/unsubscribe.php/".$urlid);
      */

      
      $mail->AddCustomHeader('List-Unsubscribe', "<mailto:".$email_settings_row[0]->settings_username."?subject=Unsubscribe>,<http://www.gouptechnologies.com/unsubscribe.php/1");
      
      
      //unsubscribe link end
      
      //$mail->addAddress($mailto,'To Person');     // Add a recipient
      $mail->addAddress($mailto,$name);     // Add a recipient

      //$mail->addAddress('ellen@example.com');               // Name is optional
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');

      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = $subject;
      //$mail->Body    = "<center><h1>Welcome ".$name."</h1></center>".$message;
      $mail->Body    = $message;
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      if(!$mail->send()) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
          echo 'Message has been sent';
      }
    }

    public function send_email($email)
    {
        $email_temp_res=$this->db->get_where('tbl_email_template',array('email_template_name'=>'Registration'));

        $email_temp_row=$email_temp_res->result();


        $body="";
        $from_email=$email_temp_row[0]->email_template_sender_email;
        $mailto=$email;
        $subject=$email_temp_row[0]->email_template_subject;
        $message=$email_temp_row[0]->email_template_body;

        echo "Message Sent";


        
        //$mailto = $event_row[0]->event_contact_info_email;
        //$subject = 'Payment Link of Event : '.$event_row[0]->event_title;
        
        /*$message = '<html><body>';
        $message .= '<center><p style="color:#080;font-size:18px;">Hello, Please click on the below Link to Pay for the Event Registration and Confirm your Event</p><br>
        <a href="'.base_url().'user/payment/'.$event_id.'">Pay Now</a></center>';
        $message .= '</body></html>';*/

        // a random hash will be necessary to send mixed content
        $separator = md5(time());

        // carriage return type (RFC)
        $eol = "\r\n";

        // main header (multipart mandatory)
        $headers = "From: Vimla Prints <".$from_email.">" . $eol;
        //$headers .= "MIME-Version: 1.0" . $eol;
        //$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
        //$headers .= "Content-Transfer-Encoding: 7bit" . $eol;
        //$headers .= "This is a MIME encoded message." . $eol;

        //$headers .= 'X-Mailer: PHP/' . phpversion();

        /*
         $headers  = 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        */

        // message
        //$body = "--" . $separator . $eol;
        //$body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
        //$body .= "Content-Transfer-Encoding: 8bit" . $eol;
        $body .= $message . $eol;

        
        //SEND Mail
        if (mail($mailto, $subject, $body, $headers)) {
            echo "mail send ... OK"; // or use booleans here
        } else {
            echo "mail send ... ERROR!";
            print_r( error_get_last() );
        }
        //Email Code 2
    }

    public function add_subscriber()
    {
        $data['subscriber_email'] = $this->input->post('txt_email');
        $data['subscriber_ip'] = $_SERVER['REMOTE_ADDR'];
        $data['subscriber_date_time'] = date('Y-m-d H:m:s');
        $data['subscriber_status'] = 'Subscribed';

        $this->db->insert('tbl_subscriber',$data);

        setcookie("subscribed","yes",time() + (60*60*24*365));

        print_r($_COOKIE);

        $url=$_SERVER['HTTP_REFERER'];
        //redirect($url);
    }

    public function delete_all_cookies()
    {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
    }

    public function blogs()
    {
        $this->load->view('user/blog_view');
    }

    public function blog($blog_slug="")
    {
        $page_data['blog_res']=$this->db->get_where('tbl_blog',array('blog_slug'=>$blog_slug));
        $this->load->view('user/blog_detail_view',$page_data);
    }

    public function magazine($catalogue_id)
    {
        $page_data['catalogue_id']=$catalogue_id;
        $this->load->view('user/magazine_flip_view',$page_data);
    }

    public function best_seller()
    {
        $cat_array=array();
        $attr_array=array();
        $page_data['cat_array']=$cat_array;
        $page_data['attr_array']=$attr_array;
        $page_data['query_str']= $_SERVER['QUERY_STRING'];
        $this->load->view('user/best_seller_view',$page_data);
    }

    public function new_in()
    {
         $cat_array=array();
        $attr_array=array();
        $page_data['cat_array']=$cat_array;
        $page_data['attr_array']=$attr_array;
        $page_data['query_str']= $_SERVER['QUERY_STRING'];
        $this->load->view('user/new_in_view',$page_data);
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
            $data['customer_id']=$_SESSION["customer_id"];

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

            /*
            $this->send_email_phpmailer_order(6,$data['order_billing_email'],$data['order_billing_name'],$current_order_id);
            */

            //order email start
            $ordr_res = $this->db->get_where('tbl_order',array('order_id'=>$_SESSION["current_order_id"]));
            $ordr_row = $ordr_res->result();


            $this->send_email_phpmailer_order(6,$ordr_row[0]->order_billing_email,$ordr_row[0]->order_billing_name,$_SESSION["current_order_id"]);
            //order email end




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

    public function search_query_old($action="",$param="")
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

        //echo "Hello world ".$price_url;

        echo "<br>".$attr_url;

        $final_parsed_url=parse_url($url);

        //$final_url = $final_parsed_url['scheme']."://".$final_parsed_url['host'].$final_parsed_url['path']."?".$cat_url.$attr_url.$price_url;

        $final_url = $final_parsed_url['scheme']."://".$final_parsed_url['host'];

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

        //echo $final_url;

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

    /*
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

        
        $final_parsed_url=parse_url($url);

        
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
        
   
    }*/


    public function generate_url($exist_url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $output);

        echo  print_r($output, TRUE);


        $search_filter_array=array();
        foreach ($output as $key => $value) {
            # code...

            $search_filter_array[] =  $key;
        }

        print_r($search_filter_array);

        $final_url_array="";
        if(in_array($action, $search_filter_array))
        {
            echo "edit ".$action." param";

            for($i=0;$i<count($search_filter_array);$i++)
            {
                if($search_filter_array[$i]==$action)
                {
                    echo "<br> ".$search_filter_array[$i]."=".$output[$search_filter_array[$i]]."_".$param;

                    $final_url_array[]=$search_filter_array[$i]."=".$output[$search_filter_array[$i]]."_".$param;

                    

                }
                else
                {
                    echo "<br> ".$search_filter_array[$i]."=".$output[$search_filter_array[$i]];
                    $final_url_array[]=$search_filter_array[$i]."=".$output[$search_filter_array[$i]];

                }
            }
            
        }
        else
        {
            echo "<br>".$action."=".$param;
            $final_url_array[]=$action."=".$param;
            for($i=0;$i<count($search_filter_array);$i++)
            {
                echo "<br> ".$search_filter_array[$i]."=".$output[$search_filter_array[$i]];

                $final_url_array[]=$search_filter_array[$i]."=".$output[$search_filter_array[$i]];
            }
        }

        print("<pre>");
        print_r($final_url_array);
        print("</pre>");

        $final_url=implode("&", $final_url_array);
        
    }

    public function search_query($action="",$param="")
    {
        $url=$_SERVER['HTTP_REFERER'];


        
        parse_str(parse_url($url, PHP_URL_QUERY), $output);

        echo  print_r($output, TRUE);


        $search_filter_array=array();
        foreach ($output as $key => $value) {
            # code...

            $search_filter_array[] =  $key;
        }

        print_r($search_filter_array);

        $final_url_array="";
        if(in_array($action, $search_filter_array))
        {
            echo "edit ".$action." param";

            for($i=0;$i<count($search_filter_array);$i++)
            {
                if($search_filter_array[$i]==$action)
                {
                    echo "<br> ".$search_filter_array[$i]."=".$output[$search_filter_array[$i]]."_".$param;

                    $final_url_array[]=$search_filter_array[$i]."=".$output[$search_filter_array[$i]]."_".$param;

                    

                }
                else
                {
                    echo "<br> ".$search_filter_array[$i]."=".$output[$search_filter_array[$i]];
                    $final_url_array[]=$search_filter_array[$i]."=".$output[$search_filter_array[$i]];

                }
            }
            
        }
        else
        {
            echo "<br>".$action."=".$param;
            $final_url_array[]=$action."=".$param;
            for($i=0;$i<count($search_filter_array);$i++)
            {
                echo "<br> ".$search_filter_array[$i]."=".$output[$search_filter_array[$i]];

                $final_url_array[]=$search_filter_array[$i]."=".$output[$search_filter_array[$i]];
            }
        }

        print("<pre>");
        print_r($final_url_array);
        print("</pre>");

        $final_url=implode("&", $final_url_array);
        //echo $final_url;

        $final_parsed_url=parse_url($url);

        
        $final_url = $final_parsed_url['scheme']."://".$final_parsed_url['host'].$final_parsed_url['path']."?".$final_url;

        echo $final_url;

        redirect($final_url);
        /*
        else
        {
            echo "add ".$action." param";
            for($i=0;$i<count($search_filter_array);$i++)
            {
                    echo "<br> url break".$output[$search_filter_array];
                
            }
            
            //echo "<h2>Final ".$output[$action]."</h2>";
        }

        /*
        else
        {
            echo "add ".$action." param";
        }
        */

        //echo $output;

        
        /*
        $cat_url="";
        $attr_url="";
        $price_url="";

        echo "<h1>".$action."</h1>";

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

        
        $final_parsed_url=parse_url($url);

        
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
        */
   
    }

    public function remove_search_query($action="",$param="")
    {
        $url=$_SERVER['HTTP_REFERER'];


        parse_str(parse_url($url, PHP_URL_QUERY), $output);

        echo  print_r($output, TRUE);


        $search_filter_array=array();
        foreach ($output as $key => $value) {
            # code...

            $search_filter_array[] =  $key;
        }

        print_r($search_filter_array);

        $final_url_array=array();
        if(in_array($action, $search_filter_array))
        {
            echo "edit ".$action." param";

            for($i=0;$i<count($search_filter_array);$i++)
            {
                if($search_filter_array[$i]==$action)
                {
                    /*echo "<br> new world".$search_filter_array[$i]."=".$output[$search_filter_array[$i]]."_".$param;

                    $final_url_array[]=$search_filter_array[$i]."=".$output[$search_filter_array[$i]]."_".$param;*/

                    echo "<h1> checked : ".$search_filter_array[$i]."</h1>";

                    //echo "<h2> once : ".$search_filter_array[$i]."=".$output[$search_filter_array[$i]]."_".$param."</h2>";


                    echo "<h3> third ".$output[$search_filter_array[$i]]."</h3>";

                    $rmv_array = explode("_",$output[$search_filter_array[$i]]);
                    
                    /*
                    print("<pre>");
                    print_r($rmv_array);
                    print("</pre>");
                    */
                    $r_array=array($param);

                    $r_string = implode("_", array_diff($rmv_array, $r_array));

                    if(trim($r_string)!="")
                    {
                        $final_url_array[]=$search_filter_array[$i]."=".$r_string;
                    }

                   






                    

                }
                else
                {
                    echo "<br> ".$search_filter_array[$i]."=".$output[$search_filter_array[$i]];
                    $final_url_array[]=$search_filter_array[$i]."=".$output[$search_filter_array[$i]];

                }
            }
            
        }
        else
        {
            echo "<br>".$action."=".$param;
            $final_url_array[]=$action."=".$param;
            for($i=0;$i<count($search_filter_array);$i++)
            {
                echo "<br> ".$search_filter_array[$i]."=".$output[$search_filter_array[$i]];

                $final_url_array[]=$search_filter_array[$i]."=".$output[$search_filter_array[$i]];
            }
        }

        print("<pre>");
        print_r($final_url_array);
        print("</pre>");

        $final_url=implode("&", $final_url_array);
        //echo $final_url;

        $final_parsed_url=parse_url($url);

        
        $final_url = $final_parsed_url['scheme']."://".$final_parsed_url['host'].$final_parsed_url['path']."?".$final_url;

        echo $final_url;

        redirect($final_url);
        
    }    

    public function remove_search_query_new_old($action="",$param="")
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

    public function remove_search_query_old($action="",$param="")
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

    /*public function search()
    {
        
        
        $page_data=array();
        
        $cat_array=array();
        $attr_array=array();

        //$query="select * from tbl_product_new order by product_id desc";
        //$page_data['product_res']=$this->db->query($query);
        if(isset($_GET['category']))
        {
            if(trim($this->input->get('category'))!="")
            {
                $cat_data=$this->input->get('category');
                //echo $cat_data;
                $cat_array=explode("_", $cat_data);
                
                
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
                

                $query="SELECT * FROM (`tbl_product_attribute_value`) JOIN `tbl_product_new` ON `tbl_product_new`.`product_id`=`tbl_product_attribute_value`.`product_id` ";
                for($i=0;$i<count($attr_array);$i++)
                {
                    if($i==0)
                    {
                        $query=$query." where tbl_product_attribute_value.attribute_value_id=".$attr_array[$i];
                    }
                    else
                    {
                        $query=$query." or tbl_product_attribute_value.attribute_value_id=".$attr_array[$i];
                    }
                }
                //echo $query;

                $page_data['product_res'] = $this->db->query($query);
                

                //$this->db->join('tbl_product_new','tbl_product_new.category_id=tbl_product_category.category_id');
                //$this->db->get_where('tbl_product_categorys',array('tbl_product_category.category_id'=>'1'));
            }
        }
        $page_data['cat_array']=$cat_array;
        $page_data['attr_array']=$attr_array;

        //print_r($page_data);
        $this->load->view('user/search_view',$page_data);
    }
    */
    public function search_text()
    {
        //echo parse_url(current_url(), PHP_URL_QUERY);

        $search_txt=$this->input->get('search_txt');

        
        $page_data=array();

        $page_data['query_str']= $_SERVER['QUERY_STRING'];

        //'$search_text="5777";
        
        $cat_array=array();
        $attr_array=array();
        $price_array=array();

        //$query="select * from tbl_product_new order by product_id desc";
        //$page_data['product_res']=$this->db->query($query);
        $cat_query_string="";
        $attr_query_string="";
        $price_query_string="";

        $query="select * from tbl_product_new where product_name like '%".$search_txt."%' ";
        
        $query=$query." limit 0,".$_SESSION["records_per_page"];

        //echo $query;


        $page_data['product_res'] = $this->db->query($query);


        $page_data['cat_array']=$cat_array;
        $page_data['attr_array']=$attr_array;

        //print_r($page_data);
        $this->load->view('user/search_view',$page_data);
    }

    public function search($action_slug="")
    {
        $page_data=array();

        if($action_slug!="")
        {
            $f_menu_slug_res=$this->db->get_where('tbl_front_menu',array('front_menu_seo_slug'=>$action_slug));

            $f_menu_slug_row=$f_menu_slug_res->result();




            
            $page_data['query_str']=$f_menu_slug_row[0]->front_menu_url;

        }
        else
        {
            $page_data['query_str']= $_SERVER['QUERY_STRING'];
        }
        //echo $_SERVER['QUERY_STRING'];

        $query="";
        //echo parse_url(current_url(), PHP_URL_QUERY);
        if(isset($_GET['search_txt']))
        {
            $search_txt=$this->input->get('search_txt');
            //echo $search_txt;

            $search_txt=$this->input->get('search_txt');

            
            $cat_array=array();
            $attr_array=array();
            $price_array=array();

            //$query="select * from tbl_product_new order by product_id desc";
            //$page_data['product_res']=$this->db->query($query);
            $cat_query_string="";
            $attr_query_string="";
            $price_query_string="";

            $query="select * from tbl_product_new where product_name like '%".$search_txt."%' ";

            if(isset($_GET['price_range']))
            {
                $price_array = explode("_", $_GET["price_range"]);
                $query=$query." and product_selling_price between '".$price_array[0]."' and '".$price_array[1]."' ";
            }
            
        //    $query=$query." limit 0,".$_SESSION["records_per_page"];

        }

        else if(isset($_GET['best_seller']))
        {
            
            $cat_array=array();
            $attr_array=array();
            $price_array=array();

            //$query="select * from tbl_product_new order by product_id desc";
            //$page_data['product_res']=$this->db->query($query);
            $cat_query_string="";
            $attr_query_string="";
            $price_query_string="";

            $query="SELECT tp . * , tod.product_id, sum( tod.product_qty )
                                    FROM tbl_order_details tod
                                    INNER JOIN tbl_product_new tp ON tod.product_id = tp.product_id
                                    GROUP BY tod.product_id
                                    ORDER BY sum( tod.product_qty ) DESC ";


            if(isset($_GET['price_range']))
            {
                $price_array = explode("_", $_GET["price_range"]);
                $query=$query." and product_selling_price between '".$price_array[0]."' and '".$price_array[1]."' ";
            }
            
        //    $query=$query." limit 0,".$_SESSION["records_per_page"];

        }

        else if(isset($_GET['new_in']))
        {
            
            $cat_array=array();
            $attr_array=array();
            $price_array=array();

            //$query="select * from tbl_product_new order by product_id desc";
            //$page_data['product_res']=$this->db->query($query);
            $cat_query_string="";
            $attr_query_string="";
            $price_query_string="";

            
            $query="select * from tbl_product_new  order by product_id desc ";

            if(isset($_GET['price_range']))
            {
                $price_array = explode("_", $_GET["price_range"]);
                $query=$query." and product_selling_price between '".$price_array[0]."' and '".$price_array[1]."' ";
            }
            
        //    $query=$query." limit 0,".$_SESSION["records_per_page"];

        }
        else
        {
            //$search_array = explode("&", $_SERVER['QUERY_STRING']);
            
            //old working
            //$search_array = explode("&", $page_data['query_str']);
            //old working

            $page_data['menu_seo_slug']=$action_slug;
            //new not working
            //echo "query_str ".$page_data['query_str'];
            //echo "query_string ".$_SERVER['QUERY_STRING'];




            if($_SERVER['QUERY_STRING']!="")
            {
                $page_data['query_str'] = $page_data['query_str']."&".$_SERVER['QUERY_STRING'];
            }
            $search_array = explode("&", $page_data['query_str']);
            
            
            //new not working

            //echo "<h2>Final Query String ".$page_data['query_str']."</h2>";
            

        
            $cat_array=array();
            $attr_array=array();

            $attr_string_set=array();

            
            for($i=0;$i<count($search_array);$i++)
            {
                //echo "<br>".$search_array[$i];    

                $filter_data = explode("=", $search_array[$i]);
                //echo "<h1>".$filter_data[0]."</h1>";
                if($filter_data[0]=="price_range")
                {

                }
                else
                {
                    if(isset($filter_data[1]))
                    {
                        $filter_data_val=explode("_", $filter_data[1]);
                            
                        /*
                        print("<pre>");
                        print_r($filter_data_val);
                        print("</pre>");
                        */
                        $attr_string="";
                        for($j=0;$j<count($filter_data_val);$j++)
                        {
                            $attr_array[]=$filter_data_val[$j];

                            /*
                            if($j==0)
                            {
                                $attr_string=$filter_data_val[$j];
                            }
                            else
                            {
                                $attr_string=$attr_string.",".$filter_data_val[$j];
                            }
                            */

                        }

                        $attr_string_set[]=str_replace("_", ",", $filter_data[1]);

                        //$attr_string_set[]=$attr_string;
                    }
                }
            }
            

            //print_r($attr_string_set);



            $query="select * from tbl_product_new ";


            if(!empty($attr_string_set))
            {
            //    echo "<h1>Array is not empty</h1>";

                //$query="select * from tbl_product_new where product id in ";
                $query="select * from tbl_product_new ";
                for($k=0;$k<count($attr_string_set);$k++)
                {
                    if($k==0)
                    {
                     $query = $query. " where product_id in (select product_id from tbl_product_attribute_value where attribute_value_id in(".$attr_string_set[$k].")) ";
                    }
                    else
                    {
                    $query = $query. " and product_id in (select product_id from tbl_product_attribute_value where attribute_value_id in(".$attr_string_set[$k].")) ";
                    }


                }

            }


            if(isset($_GET['price_range']))
            {
                $price_array = explode("_", $_GET["price_range"]);
                //$query=$query." and product_selling_price between '".$price_array[0]."' and '".$price_array[1]."' ";
                if(trim($query)=="select * from tbl_product_new")
                {
                    $query=$query." where product_selling_price between '".$price_array[0]."' and '".$price_array[1]."' ";
                }
                else
                {
                    $query=$query." and product_selling_price between '".$price_array[0]."' and '".$price_array[1]."' ";
                }
            }

            //echo $query;
        //    $query=$query." limit 0,".$_SESSION["records_per_page"];
        }

        

        $total_prod_res=$this->db->query($query);

        $page_data['total_products'] = $total_prod_res->num_rows();

        $query=$query." limit 0,".$_SESSION["records_per_page"];
        //echo $query;



        $page_data['product_res'] = $this->db->query($query);


        
        $page_data['cat_array']=$cat_array;
        $page_data['attr_array']=$attr_array;



        //print_r($page_data);
        $this->load->view('user/search_view',$page_data);
    }

    /*
    public function search()
    {
        
        $page_data=array();

        $page_data['query_str']= $_SERVER['QUERY_STRING'];
        $cat_array=array();
        $attr_array=array();
        $price_array=array();

        //$query="select * from tbl_product_new order by product_id desc";
        //$page_data['product_res']=$this->db->query($query);
        $cat_query_string="";
        $attr_query_string="";
        $price_query_string="";
        $query="";
        //echo parse_url(current_url(), PHP_URL_QUERY);
        if(isset($_GET['search_txt']))
        {
            $search_txt=$this->input->get('search_txt');
            //echo $search_txt;

            $search_txt=$this->input->get('search_txt');

            
            $cat_array=array();
            $attr_array=array();
            $price_array=array();

            //$query="select * from tbl_product_new order by product_id desc";
            //$page_data['product_res']=$this->db->query($query);
            $cat_query_string="";
            $attr_query_string="";
            $price_query_string="";

            $query="select * from tbl_product_new where product_name like '%".$search_txt."%' ";
            
            $query=$query." limit 0,".$_SESSION["records_per_page"];

        }

        else if(isset($_GET['best_seller']))
        {
            
            $cat_array=array();
            $attr_array=array();
            $price_array=array();

            //$query="select * from tbl_product_new order by product_id desc";
            //$page_data['product_res']=$this->db->query($query);
            $cat_query_string="";
            $attr_query_string="";
            $price_query_string="";

            $query="SELECT tp . * , tod.product_id, sum( tod.product_qty )
                                    FROM tbl_order_details tod
                                    INNER JOIN tbl_product_new tp ON tod.product_id = tp.product_id
                                    GROUP BY tod.product_id
                                    ORDER BY sum( tod.product_qty ) DESC";
            
            $query=$query." limit 0,".$_SESSION["records_per_page"];

        }

        else if(isset($_GET['new_in']))
        {
            
            $cat_array=array();
            $attr_array=array();
            $price_array=array();

            //$query="select * from tbl_product_new order by product_id desc";
            //$page_data['product_res']=$this->db->query($query);
            $cat_query_string="";
            $attr_query_string="";
            $price_query_string="";

            
            $query="select * from tbl_product_new  order by product_id desc";
            
            $query=$query." limit 0,".$_SESSION["records_per_page"];

        }
        else
        {
            //echo "no search text";



            if(isset($_GET['category']))
            {
                if(trim($this->input->get('category'))!="")
                {
                    $cat_data=$this->input->get('category');
                    //echo $cat_data;
                    $cat_array=explode("_", $cat_data);
                    
                    
                    $cat_query_string=str_replace("_", ",", $cat_data);

                                 
                }
            }

            if(isset($_GET['attr']))
            {
                if(trim($this->input->get('attr'))!="")
                {
                    $attr_data=$this->input->get('attr');
                    //echo $cat_data;
                    $attr_array=explode("_", $attr_data);
                    
                    
                    $attr_query_string=str_replace("_", ",", $attr_data);
                }
            }

            if(isset($_GET['price_range']))
            {
                if(trim($this->input->get('price_range'))!="")
                {
                    $price_data=$this->input->get('price_range');

                    $price_array=explode("_", $price_data);

                    $price_query_string=str_replace("_", ",", $price_data);
                }
            }

       

            $query="select * from tbl_product_new ";

            $flag=false;
            if(trim($cat_query_string)!="")
            {
                $flag=true;
                $query=$query." where product_id in (select product_id from tbl_product_category where category_id in (".$cat_query_string."))";   
            }
            if(trim($attr_query_string)!="")
            {
                if($flag==true)
                {
                    $query=$query." or product_id in (select product_id from tbl_product_attribute_value where attribute_value_id in(".$attr_query_string."))";
                }
                else
                {
                    $flag=true;
                    $query=$query." where product_id in (select product_id from tbl_product_attribute_value where attribute_value_id in(".$attr_query_string."))";   
                }

            }

            if(trim($price_query_string)!="")
            {
                if($flag==true)
                {
                    $query=$query." and  product_selling_price between '".$price_array[0]."' and '".$price_array[1]."' ";
                }
                else
                {
                    $query=$query." where  product_selling_price between '".$price_array[0]."' and '".$price_array[1]."' ";
                }

            }


            $query=$query." limit 0,".$_SESSION["records_per_page"];

            //echo $query;
        }



        
        


        $page_data['product_res'] = $this->db->query($query);


        $page_data['cat_array']=$cat_array;
        $page_data['attr_array']=$attr_array;

        //print_r($page_data);
        $this->load->view('user/search_view',$page_data);
    }

    */
    

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
                $customer_data['customer_full_name']=$data['order_billing_name'];
                $customer_data['customer_status']='Active';
                $customer_data['customer_email_address']=$data['order_billing_email'];
                $customer_data['customer_mobile_number']=$data['order_billing_phone_number'];
                $customer_data['customer_country_id']=$data['order_billing_country_id'];
                $customer_data['customer_state_id']=$data['order_billing_state_id'];
                $customer_data['customer_city']=$data['order_billing_city_id'];
                $customer_data['customer_doj']=date('Y-m-d');



                //$this->send_email_phpmailer("1",$customer_data['customer_email_address'],$customer_data['customer_full_name']);

                $get_register_email_res=$this->db->get_where('tbl_email_template',array('email_template_for'=>'registration'));

                if($get_register_email_res->num_rows()>0)
                {
                    $get_register_email_row=$get_register_email_res->result();
                    $this->send_email_phpmailer($get_register_email_row[0]->email_template_id,$customer_data['customer_email_address'],$customer_data['customer_full_name']);
                }

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


        if(isset($data['customer_id']))
        {
            if(trim($this->input->post('txt_selected_address_id'))=="")
            {
                $addr_data['customer_id']=$data['customer_id'];
                $addr_data['address_person_name']=$data['order_shipping_name'];
                $addr_data['address_company_name']=$data['order_shipping_company_name'];
                $addr_data['address_country_id']=$data['order_shipping_country_id'];
                $addr_data['address_state_id']=$data['order_shipping_state_id'];
                $addr_data['address_city_id']=$data['order_shipping_city_id'];
                $addr_data['address_line1']=$data['order_shipping_address_line1'];
                $addr_data['address_line2']=$data['order_shipping_address_line2'];
                $addr_data['address_pincode']=$data['order_shipping_pincode'];
                $addr_data['address_phone_number']=$data['order_shipping_phone_number'];
                $addr_data['address_email']=$data['order_shipping_email']; 
                $this->db->insert("tbl_address",$addr_data);           
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

        // gift charge 
        $data['order_giftbox_charge']=$this->input->post('txt_gift_charge');
        // gift charge

        //cod charge
        $data['order_cod_charge']=0;
        if(isset($_SESSION["cod_charge"]))
        {
            $data['order_cod_charge']=$_SESSION["cod_charge"];
        }
        //cod charge

        $data['order_final_amount']=$final_total+$data['order_giftbox_charge']+$data['order_cod_charge'];

        //$data['order_final_amount']=$final_total;

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
        $this->send_email_phpmailer_order(6,$data['order_billing_email'],$data['order_billing_name'],$current_order_id);
        */


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

            /*
            $sms_url="http://login.arihantsms.com/vendorsms/pushsms.aspx?user=vimlaprints&password=vimla1266&msisdn=".$_SESSION["mobile_number"]."&sid=VIMLAA&msg=".$msg."&fl=0&gwid=2";
            */

            $sms_url="http://login.arihantsms.com/vendorsms/pushsms.aspx?user=".$_SESSION["sms_username"]."&password=".$_SESSION["sms_password"]."&msisdn=".$_SESSION["mobile_number"]."&sid=".$_SESSION["sms_senderid"]."&msg=".$msg."&fl=0&gwid=2";
            

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

        /*$sms_url="http://login.arihantsms.com/vendorsms/pushsms.aspx?user=vimlaprints&password=vimla1266&msisdn=".$_SESSION["mobile_number"]."&sid=VIMLAA&msg=".$msg."&fl=0&gwid=2";
        */
        $sms_url="http://login.arihantsms.com/vendorsms/pushsms.aspx?user=".$_SESSION["sms_username"]."&password=".$_SESSION["sms_password"]."&msisdn=".$_SESSION["mobile_number"]."&sid=".$_SESSION["sms_senderid"]."&msg=".$msg."&fl=0&gwid=2";

        echo $sms_url;

        $response=file_get_contents($sms_url);

        

//        redirect(base_url().'user/otp_verify');
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


                //order email start
                $ordr_res = $this->db->get_where('tbl_order',array('order_id'=>$_SESSION["current_order_id"]));
                $ordr_row = $ordr_res->result();


                $this->send_email_phpmailer_order(6,$ordr_row[0]->order_billing_email,$ordr_row[0]->order_billing_name,$_SESSION["current_order_id"]);
                //order email end

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
        $page_data["resultset"]=$this->db->get("tbl_product_new");
        $resultset=$this->db->get("tbl_product_new");

        
		$this->load->view('user/index',$page_data);
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
            $page_data['msg']='<div class="alert alert-danger" role="alert"  style="width:94%"><i class="icon-close"></i> Invalid Coupon Code</div>';
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
        $page_data['cat_array']=array();
        $page_data['attr_array']=array();
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

                //$this->send_email($data['customer_email_address']);

                //$this->send_email_phpmailer('1',$data['customer_email_address'],$data['customer_email_address']);

                $get_register_email_res=$this->db->get_where('tbl_email_template',array('email_template_for'=>'registration'));

                if($get_register_email_res->num_rows()>0)
                {
                    $get_register_email_row=$get_register_email_res->result();
                    $this->send_email_phpmailer($get_register_email_row[0]->email_template_id,$data['customer_email_address'],$data['customer_email_address']);
                }
                
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
                $_SESSION["customer_full_name"]=$login_row[0]->customer_full_name;

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
        if(!isset($_SESSION["customer_id"]))
        {
            redirect(base_url().'user/register');
        }
        $page_data['msg']="";

        if($param1=="do_update")
        {
            

            $page_data['msg']='
                <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i>  <strong>Your Profile Updated Successfully..!!</strong>
                            </div>
                        </div>
                </div>';

            $update_data['customer_full_name']=$this->input->post('txt_full_name');
            $update_data['customer_mobile_number']=$this->input->post('txt_mobile');
            $update_data['customer_dob']=$this->input->post('txt_dob');
            $update_data['customer_gender']=$this->input->post('rdo_gender');
            $update_data['customer_address_line1']=$this->input->post('txt_address_line1');
            $update_data['customer_address_line2']=$this->input->post('txt_address_line2');
            $update_data['customer_country_id']=$this->input->post('cmb_country');
            $update_data['customer_state_id']=$this->input->post('cmb_state');
            $update_data['customer_city']=$this->input->post('cmb_city');
            $update_data['customer_postal_code']=$this->input->post('txt_postal_code');

            if($_FILES["img_profile_pic"]["error"]==0)
            {
                    $newname = $_FILES["img_profile_pic"]["name"];
                    $newname = $this->generate_random_name($newname);
                    
                    $config["file_name"]=$newname;
                    $config["upload_path"]="files/admin/customer/";
                        $config["allowed_types"]="gif|jpg|png|bmp|jpeg|ico|jpeg";
                    $config["max_width"]="102400";
                    $config["max_height"]="76800";
                    $config["max_size"]=1024*1024*2;
                    
                    $this->load->library("upload");
                    $this->upload->initialize($config);
                    $this->upload->do_upload("img_profile_pic");

                    $update_data["customer_profile_pic"]=$newname;
                        $this->smart_resize_image("files/admin/customer/".$newname,262,200,true, "files/admin/customer/thumb/".$newname,false,false);
            }

            $this->db->where('customer_id',$_SESSION["customer_id"]);
            $this->db->update('tbl_customer',$update_data);
            

        }

        $page_data['customer_res']=$this->db->get_where('tbl_customer',array("customer_id"=>$_SESSION["customer_id"]));

        $this->load->view('user/edit_profile_view',$page_data);
    }
    
    /*
    public function edit_profile($param1="")
    {
        if(!isset($_SESSION["customer_id"]))
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
    }*/

    public function saved_address($param1="")
    {
        if(!isset($_SESSION["customer_id"]))
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

        $page_data['customer_res']=$this->db->get_where('tbl_customer',array("customer_id"=>$_SESSION["customer_id"]));

        $this->load->view('user/saved_address_view',$page_data);
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

    public function generate_random_name($filename)
    {
        $ext         = pathinfo($filename, PATHINFO_EXTENSION);
        //echo $ext;
        //$newfilename = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5) . "_" . substr(str_shuffle('aBcEeFgHiJkLmNoPqRstUvWxYz0123456789'), 0, 5) . "_" . rand(1000000, 100000000) .  "_".str_replace(" ", "", $filename)."." . $ext;
        $newfilename = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5) . "_" . substr(str_shuffle('aBcEeFgHiJkLmNoPqRstUvWxYz0123456789'), 0, 5) . "_" . rand(1000000, 100000000) . "_" . str_replace(" ", "", $filename);
        return $newfilename;
    }
    
    public function smart_resize_image($file, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false)
    {
        if ($height <= 0 && $width <= 0) {
            return false;
        }
        
        $info  = getimagesize($file);
        $image = '';
        
        $final_width  = 0;
        $final_height = 0;
        list($width_old, $height_old) = $info;
        
        if ($proportional) {
            if ($width == 0)
                $factor = $height / $height_old;
            elseif ($height == 0)
                $factor = $width / $width_old;
            else
                $factor = min($width / $width_old, $height / $height_old);
            
            $final_width  = round($width_old * $factor);
            $final_height = round($height_old * $factor);
            
        } else {
            $final_width  = ($width <= 0) ? $width_old : $width;
            $final_height = ($height <= 0) ? $height_old : $height;
        }
        
        switch ($info[2]) {
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($file);
                break;
            default:
                return false;
        }
        
        $image_resized = imagecreatetruecolor($final_width, $final_height);
        
        if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)) {
            $trnprt_indx = imagecolortransparent($image);
            
            // If we have a specific transparent color
            if ($trnprt_indx >= 0) {
                
                // Get the original image's transparent color's RGB values
                $trnprt_color = imagecolorsforindex($image, $trnprt_indx);
                
                // Allocate the same color in the new image resource
                $trnprt_indx = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                
                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $trnprt_indx);
                
                // Set the background color for new image to transparent
                imagecolortransparent($image_resized, $trnprt_indx);
                
                
            }
            // Always make a transparent background color for PNGs that don't have one allocated already
            elseif ($info[2] == IMAGETYPE_PNG) {
                
                // Turn off transparency blending (temporarily)
                imagealphablending($image_resized, false);
                
                // Create a new transparent color for image
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
                
                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $color);
                
                // Restore transparency blending
                imagesavealpha($image_resized, true);
            }
        }
        
        imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
        
        if ($delete_original) {
            if ($use_linux_commands)
                exec('rm ' . $file);
            else
                @unlink($file);
        }
        
        switch (strtolower($output)) {
            case 'browser':
                $mime = image_type_to_mime_type($info[2]);
                header("Content-type: $mime");
                $output = NULL;
                break;
            case 'file':
                $output = $file;
                break;
            case 'return':
                return $image_resized;
                break;
            default:
                break;
        }
        
        switch ($info[2]) {
            case IMAGETYPE_GIF:
                imagegif($image_resized, $output);
                break;
            case IMAGETYPE_JPEG:
                imagejpeg($image_resized, $output);
                break;
            case IMAGETYPE_PNG:
                imagepng($image_resized, $output);
                break;
            default:
                return false;
        }
        
        return true;
    }

    



    
}
?>