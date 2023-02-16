<div class="container">
                <div class="intro-slider-container slider-container-ratio mb-2">
                    <div class="intro-slider owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{"nav": false}'>

                        <?php 
                        $this->db->order_by('slider_order','asc');
                        $slider_res=$this->db->get_where('tbl_slider',array('slider_status'=>'Active'));
                        foreach($slider_res->result() as $slider_row)
                        {
                            ?>
                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)" srcset="<?php echo base_url(); ?>files/admin/slider/thumb/<?php echo $slider_row->slider_thumbnail; ?>">
                                        <img src="<?php echo base_url(); ?>files/admin/slider/<?php echo $slider_row->slider_image; ?>" alt="Image Desc">
                                    </picture>
                                </figure><!-- End .slide-image -->

                                <!--<div class="intro-content">
                                    <h3 class="intro-subtitle">Deals and Promotions</h3>
                                    <h1 class="intro-title text-white">Sneakers & Athletic Shoes</h1>
                                    <div class="intro-price text-white">from $9.99</div>
                                    <a href="category.html" class="btn btn-white-primary btn-round">
                                        <span>SHOP NOW</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>-->
                            </div>
                            <?php
                        }
                        ?>
                        
                    </div><!-- End .intro-slider owl-carousel owl-simple -->
                    <span class="slider-loader"></span><!-- End .slider-loader -->
                </div><!-- End .intro-slider-container -->
            </div><!-- End .container -->

            <style type="text/css">
                .intro-slider-container::before, .intro-slider .slide-image::before 
                {
                    padding-top: 25.735042735%;
                }
            </style>
