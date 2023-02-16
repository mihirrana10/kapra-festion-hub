<?php
$this->db->join('tbl_country','tbl_order.order_shipping_country_id=tbl_country.country_id');
$this->db->join('tbl_state','tbl_order.order_shipping_state_id=tbl_state.state_id');
$this->db->join('tbl_city','tbl_order.order_shipping_city_id=tbl_city.city_id');

$order_res=$this->db->get_where('tbl_order',array('tbl_order.order_id'=>$order_id));
$order_row=$order_res->result();
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from portotheme.com/html/molla/login.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 12 Jun 2020 07:37:45 GMT -->
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
        <div class="page-content">
                <div class="dashboard">
                    <div class="container">
                        <div class="row">
                          

                            <div class="col-md-10 col-lg-10">
                                <div class="row" style="padding:10px">
                                    <div class="col-md-4" style="text-align: left;color:black">
                                        <strong>Invoice # <?php echo $order_row[0]->order_id; ?></strong>
                                    </div>
                                    <div class="col-md-4" style="text-align: left;color:black">
                                        <strong>Order Status : <?php echo $order_row[0]->order_status; ?></strong>
                                    </div>
                                    
                                    <div class="col-md-4" style="text-align: right;color:black">
                                        <strong>Date : <?php echo $order_row[0]->order_date; ?></strong>
                                    </div>
                                </div>
                                <center>
                                    <table class="table table-responsive"  style="border: 1px solid #ebebeb;background-color:#ebebeb;padding:30px;border-radius: 10px;">
                                        <thead>
                                            <tr>
                                                <th width="33%"><strong>Shipping Address</strong></th>
                                                <th width="33%"><strong>Payment Method</strong></th>
                                                <th width="33%"><strong>Order Summary</strong></th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <tr>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <?php echo $order_row[0]->order_shipping_name; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <?php echo $order_row[0]->order_shipping_address_line1; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <?php echo $order_row[0]->order_shipping_address_line2; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <?php echo $order_row[0]->city_name.", ".$order_row[0]->state_name." - ".
                                                                $order_row[0]->order_shipping_pincode; ?>
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                            <td>
                                                                <?php echo $order_row[0]->country_name; ?>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </td>
                                                <td style="text-align: top;vertical-align: top">
                                                    <?php echo $order_row[0]->order_payment_type;
                                                    ?>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td >Items(s) Sub Total:</td>
                                                            <td  class="number-display"><i class="icon-rupee"></i><?php echo $order_row[0]->order_amount; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Shipping:</td>
                                                            <td class="number-display"><i class="icon-rupee"></i><?php echo $order_row[0]->order_shipping_amount; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total:</td>
                                                            <td class="number-display"><i class="icon-rupee"></i><?php echo $order_row[0]->order_amount; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Discount:</td>
                                                            <td class="number-display">- <i class="icon-rupee"></i><?php echo $order_row[0]->order_coupon_discount_amount; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Grand Total:</strong></td>
                                                            <td class="number-display"><strong><i class="icon-rupee"></i><?php echo $order_row[0]->order_final_amount; ?></strong></td>
                                                        </tr>
                                                        <style type="text/css">
                                                            .number-display
                                                            {
                                                                float:right;
                                                                margin-left: 20px
                                                            }
                                                        </style>
                                                    </table>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table><!-- End .table table-wishlist -->
                                    <table class="table table-responsive" >
                                        <?php 
                                           $this->db->join('tbl_product_new','tbl_order_details.product_id=tbl_product_new.product_id');
                                           $order_detail_res=$this->db->get_where('tbl_order_details',array('order_id'=>$order_row[0]->order_id));

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
                                                                     <font style="font-size:13px">Unit Price : <i class="icon-rupee"></i><?php echo $order_detail_row->product_selling_price; ?>
                                                                        X Quantity : <?php echo $order_detail_row->product_qty; ?>
                                                                     </font>
                                                                  </h3>
                                                                  <!-- End .product-title -->
                                                               </div>
                                                               <!-- End .product -->
                                                            </td>
                                                            <td class="price-col"><i class="icon-rupee"></i><?php echo $order_detail_row->product_selling_price*$order_detail_row->product_qty; ?></td>
                                                            <!--<td class="remove-col"><a href="<?php echo base_url(); ?>user/remove_wishlist/<?php echo $order_detail_row->product_id; ?>"><button class="btn-remove"><i class="icon-close"></i></button></a>
                                                               </td>-->

                                                            <td class="action-col">
                                                                <a href="<?php echo base_url(); ?>user/product_review/<?php echo $order_detail_row->order_id; ?>/<?php echo $order_detail_row->product_id; ?>" class="btn btn-block btn-outline-primary-2"><i class="icon-comments"></i>Write a Review
                                                                </a>
                                                            </td>
                                                         </tr>
                                               <?php
                                            }
                                        ?>
                                    </table>
                                </center>
                                <center>
                                    <?php

                                    if($order_row[0]->order_is_returned=="Applied")
                                    {
                                        ?>
                                        <div class="alert alert-warning" role="alert"  style="width:100%"><i class="icon-close"></i> We received your request to Cancel Order, We will update You Soon.</div>
                                        <?php
                                    } 
                                    else if($order_row[0]->order_is_returned=="Approved")
                                    {
                                        ?>
                                        <div class="alert alert-success" role="alert"  style="width:100%"><i class="icon-close"></i> Your order has been cancelled.</div>
                                        <?php
                                    }
                                    else if($order_row[0]->order_is_returned=="Cancelled")
                                    {
                                        ?>
                                        <div class="alert alert-danger" role="alert"  style="width:100%"><i class="icon-close"></i> We cannot cancel your order, For More details contact sales@vimlaprints.com</div>
                                        <?php
                                    }
                                    else
                                    {
                                        if($order_row[0]->order_status =="New" || $order_row[0]->order_status=="Pending" || $order_row[0]->order_status=="Paid" )
                                        {
                                            ?>
                                            <div class="col-md-3"><a href="<?php echo base_url(); ?>user/cancel_order/<?php echo $order_row[0]->order_id; ?>" class="btn btn-block btn-outline-primary-2"><i class="icon-close"></i>Cancel Order</a></div>
                                            <?php

                                        }
                                    }
                                    ?>
                                    
                                </center>
                            </div><!-- End .col-lg-9 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .dashboard -->
            </div>
        </main><!-- End .main -->

       <?php
            include_once('footer.php')
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


    <!-- Plugins JS File -->
    <?php
        include_once('footer_file.php');
    ?>
</body>


<!-- Mirrored from portotheme.com/html/molla/login.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 12 Jun 2020 07:37:48 GMT -->
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