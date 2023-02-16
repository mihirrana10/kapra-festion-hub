<?php
   
    $product_row=$resultset->result();


?>

<!DOCTYPE html>
<html lang="en">
    

<!-- Mirrored from portotheme.com/html/molla/product-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 12 Jun 2020 07:36:42 GMT -->
<?php
    include_once('head_file.php');
?>
   <link rel="stylesheet" href="<?php echo base_url(); ?>template/user/assets/css/template743d.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>template/user/assets/css/slick/slick743d.css?ver=1652347532">
   <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>template/user/assets/css/bootstrap743d.css"> -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>template/user/assets/css/wpbingo743d.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>template/user/assets/css/elegant743d.css">
   <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>template/user/assets/css/icomoon743d.css"> -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>template/user/assets/css/jquery.circlestime743d.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>template/user/assets/css/elegant7materia743d43d.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>template/user/assets/css/photoswipe.minaec2.css">

   <style>
    img {
    border: 0;
    vertical-align: top;
    max-width: 100%;
    height: auto;
}


   </style>

<body>
    <div class="page-wrapper">
       <?php
            include_once('header.php');
       ?>
        <!-- End .header -->

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">With Sidebar</li>
                    </ol>

                    <nav class="product-pager ml-auto" aria-label="Product">
                        <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                            <i class="icon-angle-left"></i>
                            <span>Prev</span>
                        </a>

                        <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                            <span>Next</span>
                            <i class="icon-angle-right"></i>
                        </a>
                    </nav><!-- End .pager-nav -->
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                        <?php
                           foreach($resultset->result() as $result_row)
                           {
                        ?>
                            <div class="product-details-top">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="product-gallery">
                                            <figure class="product-main-image">
                                                <span class="product-label label-top">Top</span>
                                                <img id="product-zoom" src="<?php echo base_url(); ?>files/admin/product/med/<?php echo $result_row->product_image; ?>" alt="product image">

                                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                                    <i class="icon-arrows"></i>
                                                </a>
                                                
                                            </figure><!-- End .product-main-image -->
                                           


                                            <div id="product-zoom-gallery" class="product-image-gallery">
                                                            <?php 
                                                        $product_additional_image_res=$this->db->get_where('tbl_product_additional_image',array('product_id'=>$result_row->product_id));
                                                        foreach($product_additional_image_res->result() as 
                                                            $product_additional_image_row)
                                                        {
                                                            ?>
                                                            
                                                            <a class="product-gallery-item" href="#" data-image="<?php echo base_url(); ?>files/admin/product/<?php echo $product_additional_image_row->product_additional_image; ?>" data-zoom-image="<?php echo base_url(); ?>files/admin/product/big/<?php echo $product_additional_image_row->product_additional_image; ?>">
                                                            
                                                            <img src="<?php echo base_url(); ?>files/admin/product/small/<?php echo $product_additional_image_row->product_additional_image; ?>" alt="product cross">
                                                            
                                                        </a>


                                                            <?php
                                                        }
                                                        
                                                        ?>   
     <img width="25%" height="25%" src="https://wpbingosite.com/wordpress/mojuri/wp-content/uploads/2018/10/15-1.jpg" class="attachment-shop_single size-shop_single wp-post-image" alt="" id="image" title=""  data-large_image_width="1000" data-large_image_height="1000" />
         <div class="mojuri-360-button"><i class="wpb-icon-d-design"></i>360</div>
         <div class="content-product-360-view">
            <div class="product-360-view" data-count="18">
               <div class="mojuri-360-button"></div>
               <div class="images-display">
                  <ul class="images-list">
                     <li class="images-display image-0 active"><img width="450" height="450" src="<?php echo base_url().'files/admin/360/15-2.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="15-2" /></li>
                     <li class="images-display image-1 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/15-3.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="15-3" /></li>
                     <li class="images-display image-2 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/15-4.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="15-4" /></li>
                     <li class="images-display image-3 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/15-5.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="15-5" /></li>
                     <li class="images-display image-4 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/15-6.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="15-6" /></li>
                     <li class="images-display image-5 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/15-7.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="15-7" /></li>
                     <li class="images-display image-6 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/15-8.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="15-8" /></li>
                     <li class="images-display image-7 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/15-9.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="15-9" /></li>
                     <li class="images-display image-8 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/16.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="16" /></li>
                     <li class="images-display image-9 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/16-1.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="16-1" /></li>
                     <li class="images-display image-10 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/16-2.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="16-2" /></li>
                     <li class="images-display image-11 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/16-3.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="16-3" /></li>
                     <li class="images-display image-12 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/16-4.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="16-4" /></li>
                     <li class="images-display image-13 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/16-5.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="16-5" /></li>
                     <li class="images-display image-14 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/16-6.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="16-6" /></li>
                     <li class="images-display image-15 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/16-7.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="16-7" /></li>
                     <li class="images-display image-16 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/16-8.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="16-8" /></li>
                     <li class="images-display image-17 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/16-9.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="16-9" /></li>
                     <li class="images-display image-18 "><img width="450" height="450" src="<?php echo base_url().'files/admin/360/17.jpg'?>" class="attachment-shop_catalog size-shop_catalog" alt="17" /></li>
                  </ul>
               </div>
            </div>
         </div>                 </div><!-- End .product-image-gallery -->
                                            
                                        </div><!-- End .product-gallery -->
                                    </div><!-- End .col-md-6 -->
                                    
                                   
                                    <div class="col-md-6">
                                        <div class="product-details product-details-sidebar">
                                            <h1 class="product-title"><?php echo $result_row->product_name;?></h1><!-- End .product-title -->

                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                                <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                            </div><!-- End .rating-container -->

                                            <div class="product-price">
                                            <i class="icon-rupee"></i><?php echo $result_row->product_mrp;?>
                                            </div><!-- End .product-price -->

                                            <div class="product-content">
                                                <p><?php echo $result_row->product_brief_description; ?></p>
                                            </div><!-- End .product-content -->
                                                
                                            <div class="details-filter-row details-row-size">
                                            <?php 
                                                $this->db->join('tbl_attribute_value','tbl_attribute_value.attribute_value_id=tbl_product_attribute_value.attribute_value_id');
                                                $this->db->join('tbl_attribute','tbl_attribute.attribute_id=tbl_attribute_value.attribute_id');
                                                
                                                $attr_res=$this->db->get_where('tbl_product_attribute_value',array("tbl_product_attribute_value.product_id"=>$product_row[0]->product_id));

                                                $fabric="";
                                                $type="";
                                                $occassion="";
                                                $pattern="";
                                                $color="#efe7db";
                                                $size="small";
                                                foreach($attr_res->result() as $attr_row)   
                                                {
                                                    if($attr_row->attribute_name=="Size")
                                                    {
                                                        $size=$attr_row->attribute_value;
                                                    }
                                                    if($attr_row->attribute_name=="Type")
                                                    {
                                                        $type=$attr_row->attribute_value;
                                                    }
                                                    if($attr_row->attribute_name=="Occassion")
                                                    {   
                                                        $occassion=$attr_row->attribute_value;
                                                    }
                                                    if($attr_row->attribute_name=="By Pattern")
                                                    {
                                                        $pattern=$attr_row->attribute_value;
                                                    }
                                                    if($attr_row->attribute_name=="Color")
                                                    {
                                                        $color=$attr_row->attribute_value;
                                                    }
                                                }
                                            ?>
                                                
                                            <label>Color:</label>

                                                <div class="product-nav product-nav-dots">
                                                    <a href="#" class="active" style="<?php echo $color; ?>"><span class="sr-only">Color name</span></a>
                                                    <!-- <a href="#" style="background: #efe7db;"><span class="sr-only">Color name</span></a> -->
                                                </div><!-- End .product-nav -->
                                            </div><!-- End .details-filter-row -->

                                            <div class="details-filter-row details-row-size">
                                                <label for="size">Size:</label>
                                                <div class="select-custom">
                                                    <select name="size" id="size" class="form-control">
                                                        <option value="#" selected="selected">Select a size</option>
                                                        <option value="s"><?php echo $size; ?></option>
                                                        <option value="m">Medium</option>
                                                        <option value="l">Large</option>
                                                        <option value="xl">Extra Large</option>
                                                    </select>
                                                </div><!-- End .select-custom -->

                                                <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                                            </div><!-- End .details-filter-row -->

                                            <div class="product-details-action">
                                                <div class="details-action-col">
                                                    <label for="qty">Qty:</label>
                                                    <div class="product-details-quantity">
                                                        <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                                    </div><!-- End .product-details-quantity -->

                                                    <a href="<?php echo base_url(); ?>user/add_to_cart/<?php echo $result_row->product_id; ?>" class="btn-product btn-cart"><span>add to cart</span></a>
                                                </div><!-- End .details-action-col -->

                                                <div class="details-action-wrapper">
                                                    <a href="<?php echo base_url(); ?>user/wishlist_add/<?php echo $result_row->product_id; ?>" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                                    <!-- <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a> -->
                                                </div><!-- End .details-action-wrapper -->
                                            </div><!-- End .product-details-action -->

                                            <div class="product-details-footer details-footer-col">
                                                <div class="product-cat">
                                                    <span>Category:</span>
                                                    <a href="#">Women</a>,
                                                    <a href="#">Dresses</a>,
                                                    <a href="#">Yellow</a>
                                                </div><!-- End .product-cat -->

                                                <div class="social-icons social-icons-sm">
                                                    <span class="social-label">Share:</span>
                                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                                </div>
                                            </div><!-- End .product-details-footer -->
                                        </div><!-- End .product-details -->
                                    </div>
                                    
                                   <!-- End .col-md-6 -->
                                </div><!-- End .row -->
                            </div>
                           
                            <!-- End .product-details-top -->

                            <div class="product-details-tab">
                                <ul class="nav nav-pills justify-content-center" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                                        <div class="product-desc-content">
                                          <p><?php echo $result_row->product_description; ?></p>
                                        </div><!-- End .product-desc-content -->
                                    </div><!-- .End .tab-pane -->
                                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                                        <div class="product-desc-content">
                                        <p><?php echo $result_row->product_additional_information; ?></p>
                                        </div><!-- End .product-desc-content -->
                                    </div><!-- .End .tab-pane -->
                                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                                        <div class="product-desc-content">
                                            <h3>Delivery & returns</h3>
                                            <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                                            We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                                        </div><!-- End .product-desc-content -->
                                    </div><!-- .End .tab-pane -->
                                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                                        <div class="reviews">
                                            <h3>Reviews (2)</h3>
                                            <div class="review">
                                                <div class="row no-gutters">
                                                    <div class="col-auto">
                                                        <h4><a href="#">Samanta J.</a></h4>
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                                            </div><!-- End .ratings -->
                                                        </div><!-- End .rating-container -->
                                                        <span class="review-date">6 days ago</span>
                                                    </div><!-- End .col -->
                                                    <div class="col">
                                                        <h4>Good, perfect size</h4>

                                                        <div class="review-content">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                                        </div><!-- End .review-content -->

                                                        <div class="review-action">
                                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                        </div><!-- End .review-action -->
                                                    </div><!-- End .col-auto -->
                                                </div><!-- End .row -->
                                            </div><!-- End .review -->

                                            <div class="review">
                                                <div class="row no-gutters">
                                                    <div class="col-auto">
                                                        <h4><a href="#">John Doe</a></h4>
                                                        <div class="ratings-container">
                                                            <div class="ratings">
                                                                <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                            </div><!-- End .ratings -->
                                                        </div><!-- End .rating-container -->
                                                        <span class="review-date">5 days ago</span>
                                                    </div><!-- End .col -->
                                                    <div class="col">
                                                        <h4>Very good</h4>

                                                        <div class="review-content">
                                                            <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                                        </div><!-- End .review-content -->

                                                        <div class="review-action">
                                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                        </div><!-- End .review-action -->
                                                    </div><!-- End .col-auto -->
                                                </div><!-- End .row -->
                                            </div><!-- End .review -->
                                        </div><!-- End .reviews -->
                                    </div><!-- .End .tab-pane -->
                                </div><!-- End .tab-content -->
                            </div><!-- End .product-details-tab -->
                            <?php
                              }    
                            ?>
                            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
                            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                                data-owl-options='{
                                    "nav": false, 
                                    "dots": true,
                                    "margin": 20,
                                    "loop": false,
                                    "responsive": {
                                        "0": {
                                            "items":1
                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        },
                                        "1200": {
                                            "items":4,
                                            "nav": true,
                                            "dots": false
                                        }
                                    }
                                }'>
                                <?php 


// $resultset=$this->db->get("tbl_product_new");

$this->db->join('tbl_product_new','tbl_related_product.related_product_id=tbl_product_new.product_id');
$related_product_res=$this->db->get_where('tbl_related_product',array('tbl_related_product.product_id'=>$product_row[0]->product_id));
foreach($related_product_res->result() as $relate_product_row)
{
    ?>
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                <a href="<?php echo base_url(); ?>user/manage_product_detail/<?php echo   $relate_product_row->product_seo_slug; ?>">
                                                <img src="<?php echo base_url(); ?>files/admin/product/med/<?php echo $relate_product_row->product_image; ?>" alt="Product image" class="product-image">
                                                <?php 
                                            $product_additional_image_res=$this->db->get_where('tbl_product_additional_image',array('product_id'=>$relate_product_row->product_id));
                                            foreach($product_additional_image_res->result() as 
                                                $product_additional_image_row)
                                            {
                                                ?>
                                                <img src="<?php echo base_url(); ?>files/admin/product/med/<?php echo $product_additional_image_row->product_additional_image; ?>" class="product-image-hover">
                                                <?php
                                            }
                                                ?>
                                            </a>

                                    <div class="product-action-vertical">
                                        <a href="<?php echo base_url(); ?>user/wishlist_add/<?php echo $relate_product_row->product_id; ?>" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <h3 class="product-title"><a href="product.html"><?php echo $relate_product_row->product_seo_slug; ?></a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                    <i class="icon-rupee"></i><?php echo $relate_product_row->product_selling_price;?>
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                                <div class="product-action">
                                    <a href="<?php echo base_url(); ?>user/add_to_cart/<?php echo $relate_product_row->product_id; ?>" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </div>
                            <?php
}
                            ?>

                            </div><!-- End .owl-carousel -->
                        </div><!-- End .col-lg-9 -->

                        <aside class="col-lg-3">
                            <div class="sidebar sidebar-product">
                                <div class="widget widget-products">
                                    <h4 class="widget-title">Related Product</h4><!-- End .widget-title -->
                                   
                                    <div class="products">
                                    <?php 


                        // $resultset=$this->db->get("tbl_product_new");

                        $this->db->join('tbl_product_new','tbl_related_product.related_product_id=tbl_product_new.product_id');
                        $related_product_res=$this->db->get_where('tbl_related_product',array('tbl_related_product.product_id'=>$product_row[0]->product_id));
                        foreach($related_product_res->result() as $relate_product_row)
                        {
                            ?>
                                        <div class="product product-sm">
                                            <figure class="product-media">
                                                <a href="<?php echo base_url(); ?>user/manage_product_detail/<?php echo   $relate_product_row->product_seo_slug; ?>">
                                                    <img src="<?php echo base_url(); ?>files/admin/product/med/<?php echo $relate_product_row->product_image; ?>" alt="Product image" class="product-image">
                                                </a>
                                            </figure>

                                            <div class="product-body">
                                                <h5 class="product-title"><a href="<?php echo base_url(); ?>user/manage_product_detail/<?php echo   $relate_product_row->product_seo_slug; ?>"><?php echo $relate_product_row->product_seo_slug; ?></a></h5><!-- End .product-title -->
                                                <div class="product-price">
                                                    <!-- <span class="new-price">122</span> -->
                                                    <span class="old-price"> <i class="icon-rupee"></i><?php echo $relate_product_row->product_selling_price;?></span>
                                                </div><!-- End .product-price -->
                                            </div><!-- End .product-body -->
                                        </div>
                                        <?php
                        }
                        ?>
                                    </div><!-- End .products -->
                          
                                    <a href="category.html" class="btn btn-outline-dark-3"><span>View More Products</span><i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .widget widget-products -->

                                <div class="widget widget-banner-sidebar">
                                    <div class="banner-sidebar-title">ad box 280 x 280</div><!-- End .ad-title -->
                                    
                                    <div class="banner-sidebar banner-overlay">
                                        <a href="#">
                                            <img src="<?php echo base_url(); ?>template/user/assets/images/blog/sidebar/banner.jpg" alt="banner">
                                        </a>
                                    </div><!-- End .banner-ad -->
                                </div><!-- End .widget -->
                            </div><!-- End .sidebar sidebar-product -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->

                </div><!-- End .container -->
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

    <!-- Sign in / Register Modal -->
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
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="singin-email">Username or email address *</label>
                                            <input type="text" class="form-control" id="singin-email" name="singin-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" class="form-control" id="singin-password" name="singin-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="#" class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email" class="form-control" id="register-email" name="register-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" id="register-password" name="register-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->
    

    <!-- Plugins JS File -->
    <?php
        include_once('footer_file.php');
    ?>
</body>


<!-- Mirrored from portotheme.com/html/molla/product-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 12 Jun 2020 07:36:55 GMT -->
</html>