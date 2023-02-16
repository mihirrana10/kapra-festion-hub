<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from portotheme.com/html/molla/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 12 Jun 2020 07:17:02 GMT -->
<?php
    include_once('head_file.php');
?>

<body>
    <div class="page-wrapper">
    <?php
        include_once('header.php');
    ?>
<!-- End .header -->

        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">My Account<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Account</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="dashboard">
	                <div class="container">
	                	<div class="row">
	                		<aside class="col-md-4 col-lg-3">
	                			<ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
								    <li class="nav-item">
								        <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads" role="tab" aria-controls="tab-downloads" aria-selected="false">Downloads</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" href="<?php echo base_url(); ?>login/log_out">Sign Out</a>
								    </li>
								</ul>
	                		</aside><!-- End .col-lg-3 -->

	                		<div class="col-md-8 col-lg-9">
	                			<div class="tab-content">
								    <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
								    	<p>Hello <span class="font-weight-normal text-dark"><?php echo $_SESSION['user_name']; ?>
                                       </span> (not <span class="font-weight-normal text-dark"><?php echo $_SESSION['user_name']; ?></span>? <a href="<?php echo base_url(); ?>login/log_out">Log out</a>) 
								    	<br>
								    	From your account dashboard you can view your <a href="#tab-orders" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit your password and account details</a>.</p>
								    </div><!-- .End .tab-pane -->

								    <div class="tab-pane fade " id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                    <center>
                                                                <?php 
                            /*$this->db->join('tbl_product_new','tbl_wishlist.product_id=tbl_product_new.product_id');
                            $wishlist_res=$this->db->get_where('tbl_wishlist',array('customer_id'=>$_SESSION["customer_id"]));
                            */
                           

                            //$this->db->join('tbl_order_details','tbl_order.order_id=tbl_order_details.order_id');

                            //$this->db->join('tbl_product_new','tbl_order_details.product_id=tbl_product_new.product_id');,array('customer_id'=>$_SESSION["user_id"])

                            $order_history_res = $this->db->get_where('tbl_order');

                            foreach($order_history_res->result() as $order_history_row)
                            {
                                ?>
                                <table class="table table-responsive" style="border: 1px solid #333;padding:30px;border-radius: 10px">
                                    <tbody >
                                        <tr>
                                            <td >
                                                <table>
                                                    <tr>
                                                        <td style="width: 40%"><strong>ORDER PLACED</strong><br><?php echo $order_history_row->order_date; ?>
                                                        </td>
                                                        <td style="width: 20%"><strong>TOTAL</strong><br><i class="icon-rupee"></i><?php echo $order_history_row->order_final_amount; ?>
                                                        </td>
                                                        <td style="width: 40%"><strong>ORDER # <?php echo $order_history_row->order_invoice_number; ?></strong><br><a href='<?php echo base_url(); ?>user/order_details/<?php echo $order_history_row->order_id; ?>'>Order Details</a> | 
                                                            <a href=#>Invoice</a>
                                                        </td>
                                                    </tr>


                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table class="table table-wishlist table-mobile">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Price</th>
                                                            <!--<th>Stock Status</th>
                                                            <th></th>
                                                            <th></th>-->
                                                        </tr>
                                                        <tbody>
                                                        <?php 
                                                        $this->db->join('tbl_product_new','tbl_order_details.product_id=tbl_product_new.product_id');
                                                        $order_detail_res=$this->db->get_where('tbl_order_details',array('order_id'=>$order_history_row->order_id));
                                                        foreach($order_detail_res->result() as $order_detail_row)
                                                        {
                                                        ?>
                                                        <tr>
                                                            <td class="product-col">
                                                                <div class="product">
                                                                    <figure class="product-media">
                                                                        <a href="#">
                                                                            <img src="<?php echo base_url(); ?>files/admin/product/thumb/<?php echo $order_detail_row->product_image; ?>" alt="Product image">
                                                                        </a>
                                                                    </figure>

                                                                    <h3 class="product-title">
                                                                        <a href="#"><?php echo $order_detail_row->product_name; ?></a>
                                                                        <br>
                                                                        Unit Price : <i class="icon-rupee"></i><?php echo $order_detail_row->product_selling_price; ?>
                                                                         X Quantity : <i class="icon-rupee"></i><?php echo $order_detail_row->product_qty; ?>
                                                                    </h3><!-- End .product-title -->
                                                                </div><!-- End .product -->
                                                            </td>
                                                            <td class="price-col"><i class="icon-rupee"></i><?php echo $order_detail_row->product_selling_price*$order_detail_row->product_qty; ?></td>
                                                            
                                                            <!--<td class="remove-col"><a href="<?php echo base_url(); ?>user/remove_wishlist/<?php echo $order_detail_row->product_id; ?>"><button class="btn-remove"><i class="icon-close"></i></button></a>
                                                            </td>-->
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </thead>
                                                </table>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                                <?php
                            }
                            ?>
                                </center>
								    	<a href="<?php echo base_url().'user/index'?>" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
								    </div><!-- .End .tab-pane -->

								    <div class="tab-pane fade" id="tab-downloads" role="tabpanel" aria-labelledby="tab-downloads-link">
                                    <div class="page-content">
                <div class="cart">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                    
                                    <table class="table table-cart table-mobile">
                                        <thead>
                                            <tr>
                                                <th>Catalogue</th>
                                                <th>Download</th>
                                                <th>View</th>
                                                
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php 
                                            $this->db->order_by('catalogue_sort_order','asc');
                                            $catalogue_res=$this->db->get_where('tbl_catalogue',array('catalogue_status'=>'Active'));

                                            foreach($catalogue_res->result() as $catalogue_row)
                                            {
                                                ?>
                                                <tr>
                                                    <td class="product-col" style="width: 50%">
                                                        <div class="product">
                                                            <figure class="product-media" style="max-width: 160px;">
                                                                <a href="#">
                                                                    <img src="<?php echo base_url(); ?>files/admin/catalogue/thumb/<?php echo $catalogue_row->catalogue_image; ?>" height="100px" alt="Product image">
                                                                </a>
                                                            </figure>

                                                            <h3 class="product-title">
                                                                <a href="#"><?php echo $catalogue_row->catalogue_name; ?></a>
                                                            </h3><!-- End .product-title -->
                                                        </div><!-- End .product -->
                                                    </td>
                                                    <td class="product_-col" style="width: 20%">

                                                        <div class="input-group-append">
                                                            <a href="<?php echo base_url(); ?>files/admin/catalogue/<?php echo $catalogue_row->catalogue_pdf; ?>" target="_blank" class="btn btn-outline-primary-2"><i class="icon-arrow-down"></i> Download</a>
                                                        </div>
                                                        <!--<a href=#><i class="icon icon-arrow-down" style="font-size:30px;font-weight: bold"></i></a>-->
                                                    </td>
                                                    <td class="product_-col" style="width:20%">
                                                        <div class="input-group-append">
                                                            <a href="<?php echo base_url(); ?>user/magazine/<?php echo $catalogue_row->catalogue_id; ?>" class="btn btn-outline-primary-2" target="_blank"><i class="icon-eye"></i> View</a>
                                                        </div>
                                                        <!--<a href=#><i class="icon icon-eye" style="font-size:30px;font-weight: bold"></i></a>-->
                                                    </td>
                                                   
                                                </tr>
                                                <?php

                                                
                                            }
                                            ?>
                                        </tbody>
                                    </table><!-- End .table table-wishlist -->
                                    
                                
                                
                            </div><!-- End .col-lg-9 -->
                            
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .cart -->
            </div>
                                    <p>No downloads available yet.</p>
								    	<a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
								    </div><!-- .End .tab-pane -->

								    <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
								    	<p>The following addresses will be used on the checkout page by default.</p>

								    	<div class="row">
								    		<div class="col-lg-6">
								    			<div class="card card-dashboard">
								    				<div class="card-body">
                                                    <?php 
                                                        $this->db->join('tbl_country','tbl_country.country_id=tbl_address.address_country_id');
                                                        $this->db->join('tbl_state','tbl_state.state_id=tbl_address.address_state_id');
                                                        $this->db->join('tbl_city','tbl_city.city_id=tbl_address.address_city_id');
                                                        $saved_addr_res=$this->db->get_where('tbl_address',array('tbl_address.customer_id'=>$_SESSION["user_id"]));
                                                        foreach($saved_addr_res->result() as $saved_addr_row)
                                                        {
                                                          ?>
								    					<h3 class="card-title">Billing Address</h3>

														<div class=" col-md-5 col-lg-5 summary" id="div_1">
                                                              <p><strong><?php echo $saved_addr_row->address_person_name; ?></strong></p>
                                                              <p><?php echo $saved_addr_row->address_company_name; ?></p>
                                                              <p><?php echo $saved_addr_row->address_line1.", ".$saved_addr_row->address_line2.", ".$saved_addr_row->address_pincode; ?></p>
                                                              
                                                              <p><?php echo $saved_addr_row->city_name.", ".$saved_addr_row->state_name.", ".$saved_addr_row->country_name; ?></p>
                                                              <p><?php echo $saved_addr_row->address_email; ?></p>
                                                              <p><?php echo $saved_addr_row->address_phone_number; ?></p>
                                                              
                                                              
                                                              <label class="btn btn-outline-primary-2" style="margin-top:10px">
                                                                  <input type="radio"  name="cmb_selected_address" value="<?php echo $saved_addr_row->address_id; ?>" onclick="select_address(<?php echo $saved_addr_row->address_id; ?>)" style="margin-right:10px"> Edit Address
                                                              </label>
                                                          </div>
                                                          
                                                          <?php
                                                        }
                                                        ?>
                                                        <script type="text/javascript">
                                                    var controller2 = "user_ajax/get_address";
                                                    var base_url = "http://localhost/vimla_adminlte/";

                                                    function getXMLHTTP() 
                                                    { //fuction to return the xml http object
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
                                                           
                                                    function select_address(addr_id)
                                                    {       
                                                        var strURL=base_url+controller2+"/"+addr_id;
                                                        //alert(strURL);
                                                        var req = getXMLHTTP();
                                                        if (req) {
                                                            req.onreadystatechange = function() {
                                                                if (req.readyState == 4) {
                                                                    // only if "OK"
                                                                    if (req.status == 200) {
                                                                    //alert(req.responseText);                      
                                                                        
                                                                        document.getElementById("txt_selected_address_id").value=addr_id;

                                                                        //alert(req.responseText);

                                                                        var json_array = JSON.parse(req.responseText);
                                                                        /*
                                                                        alert(obj.address_person_name);
                                                                        */
                                                                        for (var i=0; i< json_array.length; i++)
                                                                        {
                                                                            //alert(json_array[i].address_person_name);

                                                                            var res = json_array[i].address_person_name.split(" ");
                                                                            document.getElementById('txt_first_name').value=res[0];
                                                                            document.getElementById('txt_last_name').value=res[1];

                                                                            document.getElementById('txt_company_name').value=json_array[i].address_company_name;

                                                                            document.getElementById('txt_address_line1').value=json_array[i].address_line1;

                                                                            document.getElementById('txt_address_line2').value=json_array[i].address_line2;

                                                                            document.getElementById('cmb_country').value=json_array[i].address_country_id;

                                                                            document.getElementById('cmb_state').value=json_array[i].address_state_id;

                                                                            document.getElementById('cmb_city').value=json_array[i].address_city_id;

                                                                            document.getElementById('txt_pincode').value=json_array[i].address_pincode;

                                                                            document.getElementById('txt_email').value=json_array[i].address_email;

                                                                            document.getElementById('txt_phone').value=json_array[i].address_phone_number;





                                                                            
                                                                        }
                                                                        
                                                                            
                                                                    } else {
                                                                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                                                    }
                                                                }               
                                                            }           
                                                            req.open("GET", strURL, true);
                                                            req.send(null);
                                                            
                                                        }
                                                    }

                                                    
                                            </script>
                                            <form action="<?php echo base_url(); ?>user/saved_address/update" class="contact-form mb-3" method="post">
                                          <?php 
                                          if(isset($msg))
                                          {
                                            echo $msg;
                                          }
                                          ?>
                                            <input type="hidden" id="txt_selected_address_id" name="txt_selected_address_id">
                                            <div class="row">
                                            <div class="col-sm-6">
                                                <label>First Name *</label>
                                                <input type="text" class="form-control" id="txt_first_name" name="txt_first_name" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Last Name *</label>
                                                <input type="text" class="form-control" id="txt_last_name" name="txt_last_name" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <label>Company Name (Optional)</label>
                                        <input type="text" class="form-control" id="txt_company_name" name="txt_company_name">

                                        <label>Country *</label>
                                        <!--<input type="text" class="form-control" required>-->
                                        <select class="form-control" id="cmb_country" name="cmb_country" onchange="get_state(this.value)">
                                                <?php 
                                                $country_res=$this->db->get_where('tbl_country');
                                                foreach($country_res->result() as $country_row)
                                                {
                                                    ?>
                                                    <option 
                                                    value="<?php echo $country_row->country_id; ?>"
                                                    <?php 
                                                    if($country_row->country_name=="India")
                                                    {
                                                        echo "selected='selected'";
                                                    }
                                                    ?>
                                                    >
                                                    <?php echo $country_row->country_name; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                        </select>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>State / County *</label>
                                                <!--<input type="text" class="form-control" required>-->
                                                <select class="form-control" id="cmb_state" name="cmb_state" onchange="get_city(this.value);">
                                                <?php 
                                                    $this->db->join('tbl_country','tbl_state.country_id=tbl_country.country_id');
                                                    $state_res=$this->db->get_where('tbl_state',array('tbl_country.country_name'=>'India'));
                                                    foreach($state_res->result() as $state_row)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $state_row->state_id; ?>"
                                                        <?php 
                                                        if($state_row->state_name=="Gujarat")
                                                        {
                                                            echo "selected='selected'";
                                                        }
                                                        ?>
                                                        ><?php echo $state_row->state_name; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                                </select>

                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Town / City *</label>
                                                <select class="form-control" id="cmb_city" name="cmb_city">
                                                <?php 
                                                    $this->db->join('tbl_state','tbl_city.state_id=tbl_state.state_id');
                                                    $city_res=$this->db->get_where('tbl_city',array('tbl_state.state_name'=>'Gujarat'));
                                                    foreach($city_res->result() as $city_row)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $city_row->city_id; ?>"><?php echo $city_row->city_name; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                                </select>
                                                <!--<input type="text" class="form-control" required>-->
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <label>Street address *</label>
                                        <input type="text" class="form-control" placeholder="House number and Street name" id="txt_address_line1"  
                                        name="txt_address_line1" required>
                                        <input type="text" class="form-control" placeholder="Appartments, suite, unit etc ..." id="txt_address_line2" 
                                        name="txt_address_line2" >

                                        

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Postcode / ZIP *</label>
                                                <input type="text" class="form-control" id="txt_pincode" name="txt_pincode" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Phone *</label>
                                                <input type="tel" placeholder="Please enter 10 Digit Mobile Number" class="form-control" id="txt_phone" name="txt_phone" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <label>Email address *</label>
                                        <input type="email" class="form-control" id="txt_email" name="txt_email" required>

                                            <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                                                <span>SUBMIT</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                        </form>
								    				</div><!-- End .card-body -->
								    			</div><!-- End .card-dashboard -->
								    		</div><!-- End .col-lg-6 -->

								    		<div class="col-lg-6">
								    			<div class="card card-dashboard">
								    				<div class="card-body">
								    					<h3 class="card-title">Shipping Address</h3><!-- End .card-title -->

														<p>You have not set up this type of address yet.<br>
														<a href="#address" id="signin-tab" data-toggle="tab" >Edit <i class="icon-edit"></i></a></p>
                                                        <!-- <li class="nav-item">
                                                            <a class="nav-link active"  role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                                        </li> -->
								    				</div><!-- End .card-body -->
								    			</div><!-- End .card-dashboard -->
								    		</div><!-- End .col-lg-6 -->
								    	</div><!-- End .row -->
								    </div><!-- .End .tab-pane -->
                   
								    <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                          <?php
			 	  	 	// foreach($user_resultset->result() as $edit_row)
			 	  	 	// {
			 	  	 	?>  
			 	 	                     <form method="post" action="<?php echo base_url(); ?>user/edit_profile/do_update">

			                				 <label> Name *</label>
                                             <input type="text" class="form-control"  >

		            						<label>Display Name *</label>
		            						<input type="text" class="form-control" >
		            						<small class="form-text">This will be how your name will be displayed in the account section and in reviews</small>

		                					<label>Email address *</label>
		        							<input type="email" class="form-control" >
                                            
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                    <span>SAVE CHANGES</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>
                                         </form><br>
                        <?php   
                                                // }
                        ?>

                                            <form action="<?php echo base_url(); ?>user/change_password/update" method="post" class="contact-form mb-2">
                                                
                                            <?php 
                                          if(isset($msgs))
                                          {
                                            echo $msgs;
                                          }
                                          ?><label>Current password (leave blank to leave unchanged)</label>
                                                <input type="text" class="form-control" id="txt_old_pwd" name="txt_old_pwd" placeholder="" required>

                                                <label>New password (leave blank to leave unchanged)</label>
                                                <input type="text" class="form-control" id="txt_pwd" name="txt_pwd" placeholder="" required>

                                                <label>Confirm new password</label>
                                                <input type="text" class="form-control" id="txt_cpwd" name="txt_cpwd" placeholder="" required>
                                           

                                                <button type="submit" class="btn btn-outline-primary-2">
                                                    <span>Change Password</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>
                                            </form>
			                			<!-- </form> -->
								    </div><!-- .End .tab-pane -->
								</div>
	                		</div><!-- End .col-lg-9 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .dashboard -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

        <?php
            include_once('footer.php');
        ?>
        <!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>
            
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="active">
                        <a href="index.html">Home</a>

                        <ul>
                            <li><a href="index-1.html">01 - furniture store</a></li>
                            <li><a href="index-2.html">02 - furniture store</a></li>
                            <li><a href="index-3.html">03 - electronic store</a></li>
                            <li><a href="index-4.html">04 - electronic store</a></li>
                            <li><a href="index-5.html">05 - fashion store</a></li>
                            <li><a href="index-6.html">06 - fashion store</a></li>
                            <li><a href="index-7.html">07 - fashion store</a></li>
                            <li><a href="index-8.html">08 - fashion store</a></li>
                            <li><a href="index-9.html">09 - fashion store</a></li>
                            <li><a href="index-10.html">10 - shoes store</a></li>
                            <li><a href="index-11.html">11 - furniture simple store</a></li>
                            <li><a href="index-12.html">12 - fashion simple store</a></li>
                            <li><a href="index-13.html">13 - market</a></li>
                            <li><a href="index-14.html">14 - market fullwidth</a></li>
                            <li><a href="index-15.html">15 - lookbook 1</a></li>
                            <li><a href="index-16.html">16 - lookbook 2</a></li>
                            <li><a href="index-17.html">17 - fashion store</a></li>
                            <li><a href="index-18.html">18 - fashion store (with sidebar)</a></li>
                            <li><a href="index-19.html">19 - games store</a></li>
                            <li><a href="index-20.html">20 - book store</a></li>
                            <li><a href="index-21.html">21 - sport store</a></li>
                            <li><a href="index-22.html">22 - tools store</a></li>
                            <li><a href="index-23.html">23 - fashion left navigation store</a></li>
                            <li><a href="index-24.html">24 - extreme sport store</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="category.html">Shop</a>
                        <ul>
                            <li><a href="category-list.html">Shop List</a></li>
                            <li><a href="category-2cols.html">Shop Grid 2 Columns</a></li>
                            <li><a href="category.html">Shop Grid 3 Columns</a></li>
                            <li><a href="category-4cols.html">Shop Grid 4 Columns</a></li>
                            <li><a href="category-boxed.html"><span>Shop Boxed No Sidebar<span class="tip tip-hot">Hot</span></span></a></li>
                            <li><a href="category-fullwidth.html">Shop Fullwidth No Sidebar</a></li>
                            <li><a href="product-category-boxed.html">Product Category Boxed</a></li>
                            <li><a href="product-category-fullwidth.html"><span>Product Category Fullwidth<span class="tip tip-new">New</span></span></a></li>
                            <li><a href="cart.html">Cart</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="wishlist.html">Wishlist</a></li>
                            <li><a href="#">Lookbook</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="product.html" class="sf-with-ul">Product</a>
                        <ul>
                            <li><a href="product.html">Default</a></li>
                            <li><a href="product-centered.html">Centered</a></li>
                            <li><a href="product-extended.html"><span>Extended Info<span class="tip tip-new">New</span></span></a></li>
                            <li><a href="product-gallery.html">Gallery</a></li>
                            <li><a href="product-sticky.html">Sticky Info</a></li>
                            <li><a href="product-sidebar.html">Boxed With Sidebar</a></li>
                            <li><a href="product-fullwidth.html">Full Width</a></li>
                            <li><a href="product-masonry.html">Masonry Sticky Info</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Pages</a>
                        <ul>
                            <li>
                                <a href="about.html">About</a>

                                <ul>
                                    <li><a href="about.html">About 01</a></li>
                                    <li><a href="about-2.html">About 02</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="contact.html">Contact</a>

                                <ul>
                                    <li><a href="contact.html">Contact 01</a></li>
                                    <li><a href="contact-2.html">Contact 02</a></li>
                                </ul>
                            </li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="faq.html">FAQs</a></li>
                            <li><a href="404.html">Error 404</a></li>
                            <li><a href="coming-soon.html">Coming Soon</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="blog.html">Blog</a>

                        <ul>
                            <li><a href="blog.html">Classic</a></li>
                            <li><a href="blog-listing.html">Listing</a></li>
                            <li>
                                <a href="#">Grid</a>
                                <ul>
                                    <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                    <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                    <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                    <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Masonry</a>
                                <ul>
                                    <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                    <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                    <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                    <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Mask</a>
                                <ul>
                                    <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                                    <li><a href="blog-mask-masonry.html">Blog mask masonry</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Single Post</a>
                                <ul>
                                    <li><a href="single.html">Default with sidebar</a></li>
                                    <li><a href="single-fullwidth.html">Fullwidth no sidebar</a></li>
                                    <li><a href="single-fullwidth-sidebar.html">Fullwidth with sidebar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="elements-list.html">Elements</a>
                        <ul>
                            <li><a href="elements-products.html">Products</a></li>
                            <li><a href="elements-typography.html">Typography</a></li>
                            <li><a href="elements-titles.html">Titles</a></li>
                            <li><a href="elements-banners.html">Banners</a></li>
                            <li><a href="elements-product-category.html">Product Category</a></li>
                            <li><a href="elements-video-banners.html">Video Banners</a></li>
                            <li><a href="elements-buttons.html">Buttons</a></li>
                            <li><a href="elements-accordions.html">Accordions</a></li>
                            <li><a href="elements-tabs.html">Tabs</a></li>
                            <li><a href="elements-testimonials.html">Testimonials</a></li>
                            <li><a href="elements-blog-posts.html">Blog Posts</a></li>
                            <li><a href="elements-portfolio.html">Portfolio</a></li>
                            <li><a href="elements-cta.html">Call to Action</a></li>
                            <li><a href="elements-icon-boxes.html">Icon Boxes</a></li>
                        </ul>
                    </li>
                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

  

<?php
    include_once('footer_file.php');
?>
</body>


<!-- Mirrored from portotheme.com/html/molla/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 12 Jun 2020 07:17:03 GMT -->
</html>
<style type="text/css">
    .toolbox .form-control 
    {
        color: black;
        font-weight: 300;
        font-size: 1.2rem;
    }
    .table th, .table thead th, .table td {
    color:black;
    }

    .table td 
    {
        padding-top: 0rem;
        padding-bottom: 0rem;
        padding:0px;
    }
    .table th, .table thead th, .table td {
    border-top: none;
    border-bottom:none;
    }
    th
    {

    }

</style>
