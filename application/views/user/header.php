<?php error_reporting(0); ?>
<?php 
   $this->db->join('tbl_product_new','tbl_cart.product_id=tbl_product_new.product_id');
                                               $view_cart_res=$this->db->get_where('tbl_cart',array('cart_session'=>session_id() ));
   $active_link="cart";
       
   ?>
<?php 
   $this->db->join('tbl_product_new','tbl_wishlist.product_id=tbl_product_new.product_id');
                                   $wishlist_new_res=$this->db->get_where('tbl_wishlist',array('customer_id'=>$_SESSION["user_id"]));
                                  
   $total_products=$wishlist_new_res->num_rows();
   ?>
   
<header class="header header-2 header-intro-clearance pt-1">
   <div class="header-top">
      <div class="container">
         <div class="header-right">
            <ul class="top-menu">
               <li>
                  <ul>
                     <li></li>
                  </ul>
               </li>
            </ul>
         </div>
      </div>
      <!-- End .container -->
   </div>
   <!-- End .header-top -->
   <div class="header-middle">
      <div class="container">
         <div class="header-left">
            <button class="mobile-menu-toggler" >
            <span class="sr-only">Toggle mobile menu</span>
            <i class="icon-bars"></i>
            </button>
            <a href="<?php echo base_url();?>user/index " class="logo">
            <img src="<?php echo base_url(); ?>template/user/assets/images/demos/demo-2/logo.png" alt="James Allen Logo" width="400" height="150">
            </a>
         </div>
         <!-- End .header-left -->
         <!--<div class="header-center">
            <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                <form action="#" method="get">
                    <div class="header-search-wrapper search-wrapper-wide">
                        <label for="q" class="sr-only">Search</label>
                        <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." required>
                        <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            </div>-->
         <div class="header-right">
            <div class="account">
               <a href="<?php echo base_url(); ?>user/manage_myaccount" title="My account">
                  <div class="icon">
                     <i class="icon-user"></i>
                  </div>
                  <p>Account</p>
               </a>
            </div>
          
            <!-- End .compare-dropdown -->
            <div class="wishlist">
               <a href="<?php echo base_url(); ?>user/manage_wishlist" title="Wishlist">
                  <div class="icon">
                     <i class="icon-heart-o"></i>
                     <span class="wishlist-count badge"><?php echo $total_products; ?></span>
                  </div>
                  <p>Wishlist</p>
               </a>
            </div>
            <!-- End .compare-dropdown -->
            <div class="dropdown cart-dropdown">
               <a href="" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                  <div class="icon">
                     <i class="icon-shopping-cart"></i>
                     <span class="cart-count"><?php echo $view_cart_res->num_rows(); ?></span>
                  </div>
                  <p>Cart</p>
               </a>
               <div class="dropdown-menu dropdown-menu-right">
                  <div class="dropdown-cart-products">
                     <?php 
                        $this->db->join('tbl_product_new','tbl_cart.product_id=tbl_product_new.product_id');
                        $cart_res=$this->db->get_where('tbl_cart',array('cart_session'=>session_id()));
                        
                        $total=0;
                        foreach($cart_res->result() as $cart_row)
                        {
                            ?>
                     <div class="product">
                        <div class="product-cart-details">
                           <h4 class="product-title">
                              <a href="<?php echo base_url(); ?>user/manage_product_detail/<?php echo strtolower($cart_row->product_seo_slug); ?>">
                              <?php 
                                 echo $cart_row->product_name;
                                 ?>
                              </a>
                           </h4>
                           <span class="cart-product-info">
                           <span class="cart-product-qty"><?php echo $cart_row->cart_qty; ?></span>
                           x <i class="icon-rupee"></i><?php echo $cart_row->product_selling_price; ?>
                           </span>
                        </div>
                        <!-- End .product-cart-details -->
                        <figure class="product-image-container">
                           <a href="<?php echo base_url(); ?>user/manage_product_detail/<?php echo strtolower($cart_row->product_seo_slug); ?>" class="product-image">
                           <img src="<?php echo base_url(); ?>files/admin/product/thumb/<?php echo $cart_row->product_image; ?>" alt="product">
                           </a>
                        </figure>
                        <a href="<?php echo base_url(); ?>user/remove_cart/<?php echo $cart_row->product_id; ?>" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                     </div>
                     <!-- End .product -->
                     <?php
                        $total=$total+($cart_row->cart_qty*$cart_row->product_selling_price);
                        }
                        ?>
                  </div>
                  <!-- End .cart-product -->
                  <div class="dropdown-cart-total">
                     <span>Total</span>
                     <span class="cart-total-price"><i class="icon-rupee"></i><?php echo $total; ?></span> 
                  </div>
                  <!-- End .dropdown-cart-total -->
                  <div class="dropdown-cart-action">
                     <a href="<?php echo base_url(); ?>user/manage_cart" class="btn btn-primary">View Cart</a>
                     <a href="<?php echo base_url(); ?>user/manage_checkout" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                  </div>
                  <!-- End .dropdown-cart-total -->
               </div>
            
               <!-- End .dropdown-menu -->
            </div>
            <div class="account">
            <a href="#signin-modal" data-toggle="modal">
                  <div class="icon">
                     <i class="icon-user"></i>
                  </div>
                  <p>Login<p></a>
            </div>
            <!-- End .cart-dropdown -->
         </div>
         <!-- End .header-right -->
      </div>
      <!-- End .container -->
   </div>
   <!-- End .header-middle -->
   <div class="header-bottom sticky-header">
      <div class="container">
         <?php
            $front_menu_res=$this->db->get_where('tbl_front_menu',array('parent_id'=>0,'front_menu_status'=>'Active'));
            
               ?>
         <div class="header-center">
            <nav class="main-nav">
               <ul class="menu sf-arrows">
                  <?php 
                     foreach($front_menu_res->result() as $front_menu_row)
                     {   
                         $submenu_res=$this->db->get_where('tbl_front_menu',array('parent_id'=>$front_menu_row->front_menu_id));
                         ?>
                  <?php
                     if($submenu_res->num_rows()>0)
                     {
                        ?>
                  <li>
                     <a href="#" class="sf-with-ul">
                     <?php echo str_replace(" ","&nbsp;",$front_menu_row->front_menu_title); ?>
                     </a>
                     <?php
                        $submenus_total = $submenu_res->num_rows();
                        $div_number=floor(12/$submenus_total);
                        
                            ?>
                     <div class="megamenu megamenu-md">
                        <div class="row no-gutters">
                           <div class="col-md-11">
                              <div class="menu-col">
                                 <div class="row">
                                    <?php 
                                       foreach($submenu_res->result() as $submenu_row)
                                       {
                                         ?>
                                        <div class="col-md-<?php echo $div_number; ?>">
                                        <div class="menu-title"><?php echo $submenu_row->front_menu_title; ?></div>
                                        <!-- End .menu-title -->
                                        <ul>
                                            <?php 
                                                $third_level_menu_res=$this->db->get_where('tbl_front_menu',array('parent_id'=>$submenu_row->front_menu_id));
                                                foreach($third_level_menu_res->result() as $third_level_menu_row)
                                                {
                                                ?>
                                            <li><a href="category-list.html"><?php echo $third_level_menu_row->front_menu_title; ?></a></li>
                                            <?php
                                                }
                                                ?>
                                        </ul>
                                        </div>
                                    <!-- End .col-md-6 -->
                                    <?php 
                                       }
                                       ?>
                                 </div>
                              </div>
                           </div>
                           <!-- End .col-md-8 -->
                        </div>
                        <!-- End .row -->
                     </div>
                     <!-- End .megamenu megamenu-md -->
                  </li>
                  <?php
                     }
                     else
                     {
                         ?>
                  <li>
                     <?php 
                        if($front_menu_row->front_menu_external_link=="Yes")
                        {
                          ?>
                     <a href="<?php echo $front_menu_row->front_menu_url; ?>" target="_blank">
                     <?php echo str_replace(" ", "&nbsp;", 
                        $front_menu_row->front_menu_title) ; ?>
                     </a>
                     <?php
                        }
                        else
                        {
                        ?>
                     <a href="<?php echo base_url().'user/'.$front_menu_row->front_menu_url; ?>">
                     <?php echo str_replace(" ", "&nbsp;", 
                        $front_menu_row->front_menu_title) ; ?>
                     </a>
                     <?php 
                        }
                        ?>
                  </li>
                  <?php
                     } 
                     }
                     ?>
                  <!-- class="sf-with-ul" -->
               </ul>
               <!-- End .menu -->
            </nav>
            <!-- End .main-nav -->
         </div>
      </div>
      <!-- End .container -->
   </div>
   <!-- End .header-bottom -->
</header>
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="icon-close"></i></span>
            </button>
            <div class="form-box">
               <div class="form-tab">
                  <ul class="nav nav-pills nav-fill" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                     </li>
                  </ul>
                  <div class="tab-content" id="tab-content-5">
                     <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                        <form action="<?php echo base_url('login/login_check'); ?>" method="post">
                           <div class="form-group">
                              <label for="singin-email">Username or email address *</label>
                              <input type="text" class="form-control" id="singin-email" name="txt_user_email" required>
                           </div>
                           <!-- End .form-group -->
                           <div class="form-group">
                              <label for="singin-password">Password *</label>
                              <input type="password" class="form-control" id="singin-password"  name="txt_user_password" required>
                           </div>
                           <!-- End .form-group -->
                           <div class="form-footer">
                              <button type="submit" class="btn btn-outline-primary-2">
                              <span>LOG IN</span>
                              <i class="icon-long-arrow-right"></i>
                              </button>
                              <div class="custom-control custom-checkbox">
                                 <input type="checkbox" class="custom-control-input" id="signin-remember">
                                 <label class="custom-control-label" for="signin-remember">Remember Me</label>
                              </div>
                              <!-- End .custom-checkbox -->
                              <a href="#" class="forgot-link">Forgot Your Password?</a>
                           </div>
                           <!-- End .form-footer -->
                        </form>
                        <div class="form-choice">
                           <p class="text-center">or sign in with</p>
                           <div class="row">
                              <div class="col-sm-6">
                                 <a href="#" class="btn btn-login btn-g">
                                 <i class="icon-google"></i>
                                 Login With Google
                                 </a>
                              </div>
                              <!-- End .col-6 -->
                              <div class="col-sm-6">
                                 <a href="#" class="btn btn-login btn-f">
                                 <i class="icon-facebook-f"></i>
                                 Login With Facebook
                                 </a>
                              </div>
                              <!-- End .col-6 -->
                           </div>
                           <!-- End .row -->
                        </div>
                        <!-- End .form-choice -->
                     </div>
                     <!-- .End .tab-pane -->
                     <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form role="form" method="post" action="<?php echo base_url(); ?>user/manage_user/create" enctype="multipart/form-data">
                        <div class="form-group">
                              <label for="register-name">Your Name *</label>
                              <input type="text" class="form-control" id="register-email" name="txt_user_name" required>
                           </div>   
                        <div class="form-group">
                              <label for="register-email">Your email address *</label>
                              <input type="email" class="form-control" id="register-email" name="txt_user_email" required>
                           </div>
                           <!-- End .form-group -->
                           <div class="form-group">
                              <label for="register-password">Password *</label>
                              <input type="password" class="form-control" id="register-password" name="txt_user_password" required>
                           </div>
                           <!-- End .form-group -->
                           <div class="form-footer">
                              <button type="submit" class="btn btn-outline-primary-2">
                              <span>SIGN UP</span>
                              <i class="icon-long-arrow-right"></i>
                              </button>
                              <div class="custom-control custom-checkbox">
                                 <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                 <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                              </div>
                              <!-- End .custom-checkbox -->
                           </div>
                           <!-- End .form-footer -->
                        </form>
                        <div class="form-choice">
                           <p class="text-center">or sign in with</p>
                           <div class="row">
                              <div class="col-sm-6">
                                 <a href="#" class="btn btn-login btn-g">
                                 <i class="icon-google"></i>
                                 Login With Google
                                 </a>
                              </div>
                              <!-- End .col-6 -->
                              <div class="col-sm-6">
                                 <a href="#" class="btn btn-login  btn-f">
                                 <i class="icon-facebook-f"></i>
                                 Login With Facebook
                                 </a>
                              </div>
                              <!-- End .col-6 -->
                           </div>
                           <!-- End .row -->
                        </div>
                        <!-- End .form-choice -->
                     </div>
                     <!-- .End .tab-pane -->
                  </div>
                  <!-- End .tab-content -->
               </div>
               <!-- End .form-tab -->
            </div>
            <!-- End .form-box -->
         </div>
         <!-- End .modal-body -->
      </div>
      <!-- End .modal-content -->
   </div>
   <!-- End .modal-dialog -->
</div>
<!-- End .modal -->