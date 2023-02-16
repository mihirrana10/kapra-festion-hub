<div class="intro-slider-container">
                <div class="owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{"nav": false}'>
                    <?php 
                    $slider_res=$this->db->get_where('tbl_slider');
                    foreach($slider_res->result() as $slider_row)
                    {
                        ?>
                        <div class="intro-slide" style="background-image: url(<?php echo base_url(); ?>files/admin/slider/<?php echo $slider_row->slider_image; ?>);">
                            <div class="container intro-content">
                                <h3 class="intro-subtitle" style='color:black'><?php echo $slider_row->slider_title ?></h3>
                                <h1 class="intro-title"  style='color:black'><?php  echo $slider_row->slider_subtitle ?></h1>
                                <!-- <a href="<?php echo base_url(); ?>user" class="btn btn-primary"  style='color:black;border-color: black' >
                                    <span>Shop Now</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a> -->
                            </div>
                            
                        </div>
                        <?php
                    }
                    ?>
                    

                    
                </div><!-- End .owl-carousel owl-simple -->

                <span class="slider-loader text-white"></span><!-- End .slider-loader -->
            </div>