<?php 
session_start();
class user_ajax extends CI_Controller
{
    /*
    public function next_paging_data($next_page_no)
    {
        $records_per_page=30;
        $starting_position = ($next_page_no-1)*$records_per_page;

        //echo $starting_position;
        $product_res=$this->db->limit($records_per_page,$starting_position);
        $product_res=$this->db->get_where("tbl_product_new");
                                    foreach($product_res->result() as $product_row)
                                    {
                                    ?>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                <!--<span class="product-label label-new">New</span>-->
                                                <?php 
                                                    if($product_row->product_quantity==0)
                                                    {
                                                        ?>
                                                        <span class="product-label label-primary">Out of Stock</span>
                                                        <?php
                                                    }
                                                    ?>
                                                <!--<a href="<?php echo base_url(); ?>user/product/<?php echo $product_row->product_id; ?>">-->
                                                <!--<a href="<?php echo base_url(); ?>user/product/<?php echo $product_row->product_seo_slug; ?>/<?php echo $product_row->product_id; ?>">-->
                                                <a href="<?php echo base_url(); ?>user/product/<?php echo $product_row->product_seo_slug; ?>">
                                                    <img src="<?php echo base_url(); ?>files/admin/product/med/<?php echo $product_row->product_image; ?>" alt="Product image" class="product-image">
                                                </a>

                                                <div class="product-action-vertical">
                                                    <!--<a href="//send?text=Text to send withe message: http://www.yoursite.com" class="btn-product-icon icon-whatsapp btn-expandable"><span>Share on Whatsapp</span></a>-->
                                                    <a href="https://web.whatsapp.com/send?text=Please check this product: <?php echo base_url(); ?>user/product/<?php echo $product_row->product_seo_slug; ?>" data-action="share/whatsapp/share" target="_blank" class="btn-product-icon icon-whatsapp btn-expandable"><span>Share on Whatsapp</span></a>

                                                    <!--<a href="<?php echo base_url(); ?>user/wishlist_add/<?php echo $product_row->product_id; ?>" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>-->

                                                    <?php 
                                                        //in_array(needle, haystack)
                                                        if(isset($wishlist_array) && in_array($product_row->product_id, $wishlist_array))
                                                        {
                                                            ?>
                                                            <a href="<?php echo base_url(); ?>user/wishlist_add/<?php echo $product_row->product_id; ?>" class="btn-product-icon selected-wishlist "></a>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <a href="<?php echo base_url(); ?>user/wishlist_add/<?php echo $product_row->product_id; ?>" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                                    <!--<a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>-->
                                                </div><!-- End .product-action-vertical -->

                                                <div class="product-action">
                                                    <!--<a href="<?php echo base_url(); ?>user/add_to_cart/<?php echo $product_row->product_id; ?>" class="btn-product btn-cart"><span>add to cart</span></a>-->
                                                    <?php 
                                                        if($product_row->product_quantity==0)
                                                        {
                                                            ?>
                                                            <!--<span class="product-label label-primary">Out of Stock</span>-->
                                                            <a href="<?php echo base_url(); ?>user/notify_me/<?php echo $product_row->product_id; ?>" class="btn-product"><span>Notify Me</span></a>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <a href="<?php echo base_url(); ?>user/add_to_cart/<?php echo $product_row->product_id; ?>" class="btn-product btn-cart"><span>add to cart</span></a>
                                                            <?php
                                                        }
                                                        ?>


                                                </div><!-- End .product-action -->
                                            </figure><!-- End .product-media -->

                                            <div class="product-body">
                                                
                                                <!--
                                                <div class="product-cat">
                                                    <a href="#">Women</a>
                                                </div>
                                                -->

                                                <!-- End .product-cat -->
                                                <h3 class="product-title">
                                                    <!--<a href="<?php echo base_url(); ?>user/product/<?php echo $product_row->product_id; ?>">-->
                                                    <!--<a href="<?php echo base_url(); ?>user/product/<?php echo $product_row->product_seo_slug; ?>/<?php echo $product_row->product_id; ?>">-->
                                                    <a href="<?php echo base_url(); ?>user/product/<?php echo $product_row->product_seo_slug; ?>">
                                                        <?php echo $product_row->product_name; ?>
                                                    </a>
                                                </h3><!-- End .product-title -->
                                                
                                                <!--<div class="product-price">
                                                    $60.00
                                                </div>-->
                                                <div class="product-price">
                                                    <!--Rs.--><i class="icon-rupee"></i> <?php echo $product_row->product_selling_price; ?>
                                                </div>
                                                
                                                <!-- End .product-price -->
                                                <!--
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 20%;"></div>
                                                    </div>
                                                    <span class="ratings-text">( 2 Reviews )</span>
                                                </div>

                                                <div class="product-nav product-nav-thumbs">
                                                    <a href="#" class="active">
                                                        <img src="<?php echo base_url(); ?>template/user/assets/images/products/product-4-thumb.jpg" alt="product desc">
                                                    </a>
                                                    <a href="#">
                                                        <img src="<?php echo base_url(); ?>template/user/assets/images/products/product-4-2-thumb.jpg" alt="product desc">
                                                    </a>

                                                    <a href="#">
                                                        <img src="<?php echo base_url(); ?>template/user/assets/images/products/product-4-3-thumb.jpg" alt="product desc">
                                                    </a>
                                                </div>-->

                                                <!-- End .product-nav -->
                                            </div><!-- End .product-body -->
                                        </div><!-- End .product -->
                                    </div><!-- End .col-sm-6 col-lg-4 -->
                                    <?php
                                    }
                                    

    }*/

    public function next_paging_data_new($next_page_no,$query_str="")
    {
        //$records_per_page=30;
        $starting_position = ($next_page_no-1)*$_SESSION["records_per_page"];

        //echo $starting_position;

        //echo $next_page_no;


        //$page_data=array();

        //$page_data['query_str']= $_SERVER['QUERY_STRING'];
        
        $cat_array=array();
        $attr_array=array();
        $price_array=array();

        //$query="select * from tbl_product_new order by product_id desc";
        //$page_data['product_res']=$this->db->query($query);
        $cat_query_string="";
        $attr_query_string="";
        $price_query_string="";

        $query="";

        if(isset($_GET["search_txt"]))
        {
            $search_txt=$_GET["search_txt"];
            $query="select * from tbl_product_new where product_name like '%".$search_txt."%' ";
            //$search_txt
        }
        else if(isset($_GET["best_seller"]))
        {
            $query="SELECT tp . * , tod.product_id, sum( tod.product_qty )
                                    FROM tbl_order_details tod
                                    INNER JOIN tbl_product_new tp ON tod.product_id = tp.product_id
                                    GROUP BY tod.product_id
                                    ORDER BY sum( tod.product_qty ) DESC ";
        }
        else if(isset($_GET["new_in"]))
        {
            $query="select * from tbl_product_new  order by product_id desc ";
            
        }
        else
        {
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

            /*
            $query="select * from tbl_product_new where product_id in (select product_id from tbl_product_category where category_id in (".$cat_query_string.")) or product_id in (select product_id from tbl_product_attribute_value where attribute_value_id in(".$attr_query_string."))";
            */


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
        }
        


        $query=$query." limit ".$starting_position.",".$_SESSION["records_per_page"];

        //echo $query;


        //$page_data['product_res'] = $this->db->query($query);
        $product_res=$this->db->query($query);


                                    foreach($product_res->result() as $product_row)
                                    {
                                    ?>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                <!--<span class="product-label label-new">New</span>-->
                                                <?php 
                                                    if($product_row->product_quantity==0)
                                                    {
                                                        ?>
                                                        <span class="product-label label-primary">Out of Stock</span>
                                                        <?php
                                                    }
                                                    ?>
                                                <!--<a href="<?php echo base_url(); ?>user/product/<?php echo $product_row->product_id; ?>">-->
                                                <!--<a href="<?php echo base_url(); ?>user/product/<?php echo $product_row->product_seo_slug; ?>/<?php echo $product_row->product_id; ?>">-->
                                                <a href="<?php echo base_url(); ?>user/product/<?php echo $product_row->product_seo_slug; ?>">
                                                    <img src="<?php echo base_url(); ?>files/admin/product/med/<?php echo $product_row->product_image; ?>" alt="Product image" class="product-image">
                                                </a>

                                                <div class="product-action-vertical">
                                                    <!--<a href="//send?text=Text to send withe message: http://www.yoursite.com" class="btn-product-icon icon-whatsapp btn-expandable"><span>Share on Whatsapp</span></a>-->
                                                    <a href="https://web.whatsapp.com/send?text=Please check this product: <?php echo base_url(); ?>user/product/<?php echo $product_row->product_seo_slug; ?>" data-action="share/whatsapp/share" target="_blank" class="btn-product-icon icon-whatsapp btn-expandable"><span>Share on Whatsapp</span></a>

                                                    <!--<a href="<?php echo base_url(); ?>user/wishlist_add/<?php echo $product_row->product_id; ?>" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>-->

                                                    <?php 
                                                        //in_array(needle, haystack)
                                                        if(isset($wishlist_array) && in_array($product_row->product_id, $wishlist_array))
                                                        {
                                                            ?>
                                                            <a href="<?php echo base_url(); ?>user/wishlist_add/<?php echo $product_row->product_id; ?>" class="btn-product-icon selected-wishlist "></a>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <a href="<?php echo base_url(); ?>user/wishlist_add/<?php echo $product_row->product_id; ?>" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                                    <!--<a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>-->
                                                </div><!-- End .product-action-vertical -->

                                                <div class="product-action">
                                                    <!--<a href="<?php echo base_url(); ?>user/add_to_cart/<?php echo $product_row->product_id; ?>" class="btn-product btn-cart"><span>add to cart</span></a>-->
                                                    <?php 
                                                        if($product_row->product_quantity==0)
                                                        {
                                                            ?>
                                                            <!--<span class="product-label label-primary">Out of Stock</span>-->
                                                            <a href="<?php echo base_url(); ?>user/notify_me/<?php echo $product_row->product_id; ?>" class="btn-product"><span>Notify Me</span></a>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <a href="<?php echo base_url(); ?>user/add_to_cart/<?php echo $product_row->product_id; ?>" class="btn-product btn-cart"><span>add to cart</span></a>
                                                            <?php
                                                        }
                                                        ?>


                                                </div><!-- End .product-action -->
                                            </figure><!-- End .product-media -->

                                            <div class="product-body">
                                                
                                                <!--
                                                <div class="product-cat">
                                                    <a href="#">Women</a>
                                                </div>
                                                -->

                                                <!-- End .product-cat -->
                                                <h3 class="product-title">
                                                    <!--<a href="<?php echo base_url(); ?>user/product/<?php echo $product_row->product_id; ?>">-->
                                                    <!--<a href="<?php echo base_url(); ?>user/product/<?php echo $product_row->product_seo_slug; ?>/<?php echo $product_row->product_id; ?>">-->
                                                    <a href="<?php echo base_url(); ?>user/product/<?php echo $product_row->product_seo_slug; ?>">
                                                        <?php echo $product_row->product_name; ?>
                                                    </a>
                                                </h3><!-- End .product-title -->
                                                
                                                <!--<div class="product-price">
                                                    $60.00
                                                </div>-->
                                                <div class="product-price">
                                                    <!--Rs.--><i class="icon-rupee"></i> <?php echo $product_row->product_selling_price; ?>
                                                </div>
                                                
                                                <!-- End .product-price -->
                                                <!--
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 20%;"></div>
                                                    </div>
                                                    <span class="ratings-text">( 2 Reviews )</span>
                                                </div>

                                                <div class="product-nav product-nav-thumbs">
                                                    <a href="#" class="active">
                                                        <img src="<?php echo base_url(); ?>template/user/assets/images/products/product-4-thumb.jpg" alt="product desc">
                                                    </a>
                                                    <a href="#">
                                                        <img src="<?php echo base_url(); ?>template/user/assets/images/products/product-4-2-thumb.jpg" alt="product desc">
                                                    </a>

                                                    <a href="#">
                                                        <img src="<?php echo base_url(); ?>template/user/assets/images/products/product-4-3-thumb.jpg" alt="product desc">
                                                    </a>
                                                </div>-->

                                                <!-- End .product-nav -->
                                            </div><!-- End .product-body -->
                                        </div><!-- End .product -->
                                    </div><!-- End .col-sm-6 col-lg-4 -->
                                    <?php
                                    }





        //echo $starting_position;
        //$product_res=$this->db->limit($records_per_page,$starting_position);
        //$product_res=$this->db->get_where("tbl_product_new");


       

    }

    public function get_state($country_id)
    {
        echo "<option value='0'>--Select--</option>";
        $state_res=$this->db->get_where('tbl_state',array("country_id"=>$country_id));
        foreach($state_res->result() as $state_row)
        {
        ?>

            <option value="<?php echo $state_row->state_id; ?>">
                <?php echo $state_row->state_name; ?>
            </option>
        <?php
        }
    }
    public function get_city($state_id)
    {
        echo "<option value='0'>--Select--</option>";
        $city_res=$this->db->get_where('tbl_city',array("state_id"=>$state_id));
        foreach($city_res->result() as $city_row)
        {
        ?>
            <option value="<?php echo $city_row->city_id; ?>">
                <?php echo $city_row->city_name; ?>
            </option>
        <?php
        }
    }
    public function change_currency($to)
    {
        if($to == "INR")
        {
            $ex_rate=1;
        }
        else
        {
            
            $exchange_rate_xml = file_get_contents("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
            $xml=simplexml_load_string($exchange_rate_xml) or die("Error: Cannot create object");
            $eur_to=0;
            $eur_inr=0;
            foreach($xml->Cube->Cube->Cube as $xml_row)
            {
                
                //echo "<br>Currency :".$xml_row['currency'];
                //echo " Rate :".$xml_row['rate'];
                
                if($to==$xml_row['currency'])
                {
                    $eur_to=$xml_row['rate'];
                }

                if($xml_row['currency']=="INR")
                {
                    $eur_inr=$xml_row['rate'];
                }
            }
            if($to == "EUR")
            {
                $ex_rate=1/$eur_inr;
            }
            else
            {
                $ex_rate=floatval(1/$eur_inr)*floatval($eur_to);
            }
        }
        $cur_symbol['AUD']="&dollar;";
        $cur_symbol['GBP']="&pound;";
        $cur_symbol['CAD']="&dollar;";
        $cur_symbol['EUR']="&euro;";
        $cur_symbol['INR']="&#8360;";
        $cur_symbol['SGD']="&dollar;";
        $cur_symbol['USD']="&dollar;";
        

        $_SESSION["currency_tag"]=$to;
        $_SESSION["exchange_rate"]=$ex_rate;

        $_SESSION["currency_symbol"]=$cur_symbol[$to];

        //echo $ex_rate;
    }
	public function changeqty($action,$id,$qty)
	{
		$sid=session_id();
		if($action=="volume")
		{
			$query="update tbl_cart set cart_qty='".$qty."' where volume_id='".$id."' and cart_session='".$sid."' ";
		}

		if($action=="product")
		{
			$query="update tbl_cart set cart_qty='".$qty."' where volume_product_id='".$id."' and cart_session='".$sid."' ";
		}
		
		$this->db->query($query);

	}

    public function get_more_volume($catal_id,$start_position,$volume_by,$br_id)
    {
        //start
        $i=1;

        $records_per_page=3;
        $this->db->limit($records_per_page,$start_position);
        
        if($volume_by=="new_arrival")
        {
            $volume_res = $this->db->get_where('tbl_volume',array('volume_new_arrival'=>'Yes'));
        }
        elseif($volume_by=="brand")
        {
            $volume_res = $this->db->get_where('tbl_volume',array('brand_id'=>$br_id,'volume_status'=>'Active'));
        }
        else
        {
            $volume_res = $this->db->get_where('tbl_volume',array('catalogue_id'=>$catal_id,'volume_status'=>'Active'));
        }
        ?>
        <?php 

        foreach($volume_res->result() as $volume_row)
        {
            ?>
            <?php
            if($i==1)
            {
                ?>
                <div class="col-md-4 arriv-middle item">
                    <a href="<?php echo base_url(); ?>user/products/<?php echo $volume_row->volume_id; ?>">
                        <img src="<?php echo base_url(); ?>files/admin/volume/<?php echo $volume_row->volume_image; ?>" class="img-responsive" alt="" style="height:500px">
                    </a>
                    <h3 class="catalogue_name"><?php echo $volume_row->volume_name; ?></h3>
                    <h3 style="font-size:20px" class="catalogue_price">
                    <!--Rs.<?php //echo $volume_row->volume_price; ?>-->
                    <?php echo $_SESSION["currency_symbol"]; ?> 
                        <?php 
                            $volume_price = ($volume_row->volume_price)*$_SESSION["exchange_rate"]; 
                            echo round($volume_price,0);
                    ?>
                    </h3>
                    
                    <a class="add-to-cart whole_cart"  onclick="add_to_cart('volume',<?php echo $volume_row->volume_id; ?>);">Add Catalogue to Cart</a>
                    <a onclick="wishlist_add('volume',<?php echo $volume_row->volume_id; ?>)"  class="whole_cart" style="margin-left:220px">Love It</a>
                    
                </div>
                <?php
            }
            else if($i==2)
            {
                ?>
                <div class="col-md-4 arriv-middle item">
                    <a href="<?php echo base_url(); ?>user/products/<?php echo $volume_row->volume_id; ?>">
                        <img src="<?php echo base_url(); ?>files/admin/volume/<?php echo $volume_row->volume_image; ?>" class="img-responsive" alt="" style="height:500px">
                    </a>
                    <h3 class="catalogue_name"><?php echo $volume_row->volume_name; ?></h3>
                    <h3 style="font-size:20px" class="catalogue_price">
                    <!--Rs.<?php //echo $volume_row->volume_price; ?>-->
                    <?php echo $_SESSION["currency_symbol"]; ?> 
                        <?php 
                            $volume_price = ($volume_row->volume_price)*$_SESSION["exchange_rate"]; 
                            echo round($volume_price,0);
                    ?>
                    </h3>
                    
                    <a class="add-to-cart whole_cart"  onclick="add_to_cart('volume',<?php echo $volume_row->volume_id; ?>);">Add Catalogue to Cart</a>
                    <a onclick="wishlist_add('volume',<?php echo $volume_row->volume_id; ?>)"  class="whole_cart" style="margin-left:220px">Love It</a>
                    
                </div>
                <?php
            }
            else if($i==3)
            {
                ?>
                <div class="col-md-4 arriv-middle item">
                    <a href="<?php echo base_url(); ?>user/products/<?php echo $volume_row->volume_id; ?>">
                        <img src="<?php echo base_url(); ?>files/admin/volume/<?php echo $volume_row->volume_image; ?>" class="img-responsive" alt="" style="height:500px">
                    </a>
                    <h3 class="catalogue_name"><?php echo $volume_row->volume_name; ?></h3>
                    <h3 style="font-size:20px" class="catalogue_price">
                    <!--Rs.<?php //echo $volume_row->volume_price; ?>-->
                    <?php echo $_SESSION["currency_symbol"]; ?> 
                        <?php 
                            $volume_price = ($volume_row->volume_price)*$_SESSION["exchange_rate"]; 
                            echo round($volume_price,0);
                    ?>
                    </h3>
                    
                    <a class="add-to-cart whole_cart"  onclick="add_to_cart('volume',<?php echo $volume_row->volume_id; ?>);">Add Catalogue to Cart</a>
                    <a onclick="wishlist_add('volume',<?php echo $volume_row->volume_id; ?>)"  class="whole_cart" style="margin-left:220px">Love It</a>
                    
                </div>
                <div class="clearfix"> </div><br>
                <?php
                $i=0;
            }
            ?>
            <?php 
            $i++;
        }
        //end 
    }

    public function get_more_catalogue($cat_id,$start_position)
    {
        // start
        $records_per_page=3;
        $this->db->limit($records_per_page,$start_position);
        $i=1;
        $catalogue_res = $this->db->get_where('tbl_catalogue',array('category_id'=>$cat_id,'catalogue_status'=>'Active'));
        foreach($catalogue_res->result() as $catalogue_row)
        {
            if($i==1)
            {
                ?>
                <div class="col-md-4 arriv-middle">
                    <a href="<?php echo base_url(); ?>user/volumes/<?php echo $catalogue_row->catalogue_id; ?>">
                        <img src="<?php echo base_url(); ?>files/admin/catalogue/thumb/<?php echo $catalogue_row->catalogue_image; ?>" class="img-responsive" alt="" style="height:500px">
                    </a>
                    <div class="arriv-info3">
                        <h3 style="text-shadow: 0 0 3px #000000, 0 0 5px #000000;"><?php echo $catalogue_row->catalogue_name; ?></h3>
                        <div class="crt-btn">
                            <a href="<?php echo base_url(); ?>user/volumes/<?php echo $catalogue_row->catalogue_id; ?>">CHECK CATALOG</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            else if($i==2)
            {
                ?>
                <div class="col-md-4 arriv-middle">
                    <a href="<?php echo base_url(); ?>user/volumes/<?php echo $catalogue_row->catalogue_id; ?>">
                        <img src="<?php echo base_url(); ?>files/admin/catalogue/thumb/<?php echo $catalogue_row->catalogue_image; ?>" class="img-responsive" alt="" style="height:500px">
                    </a>
                    <div class="arriv-info3">
                        <h3 style="text-shadow: 0 0 3px #000000, 0 0 5px #000000;"><?php echo $catalogue_row->catalogue_name; ?></h3>
                        <div class="crt-btn">
                            <a href="<?php echo base_url(); ?>user/volumes/<?php echo $catalogue_row->catalogue_id; ?>">CHECK CATALOG</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            else if($i==3)
            {
                ?>
                <div class="col-md-4 arriv-middle">
                    <a href="<?php echo base_url(); ?>user/volumes/<?php echo $catalogue_row->catalogue_id; ?>">
                        <img src="<?php echo base_url(); ?>files/admin/catalogue/thumb/<?php echo $catalogue_row->catalogue_image; ?>" class="img-responsive" alt="" style="height:500px">
                    </a>
                    <div class="arriv-info3">
                        <h3 style="text-shadow: 0 0 3px #000000, 0 0 5px #000000;"><?php echo $catalogue_row->catalogue_name; ?></h3>
                        <div class="crt-btn">
                            <a href="<?php echo base_url(); ?>user/volumes/<?php echo $catalogue_row->catalogue_id; ?>">CHECK CATALOG</a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div><br>
                <?php
                $i=0;
            }
            $i++;
        }
        // end
    }

    public function get_more_product($volume_id,$start_position)
    {
        $records_per_page = 4;
        $this->db->limit($records_per_page,$start_position);
        $volume_product_res2 = $this->db->get_where("tbl_volume_product",array("volume_product_status"=>'Active',"volume_id"=>$volume_id));
        if($volume_product_res2->num_rows()>0)
        {
        ?>
        <!--<div class="specia-top">-->
            <ul class="grid_2">
                <?php 
                
                $cnt=0;
                foreach($volume_product_res2->result() as $volume_product_row)
                {
                    if($cnt%4==0)
                    {

                    ?>
                    <div class="clearfix"> </div>
                    </ul>
                    <br>
                    <ul class="grid_2">
                    <?php
                    }
                    ?>
                    <li >
                        <center>
                            <div class="item special-info grid_1 simpleCart_shelfItem">
                                <a href="<?php echo base_url(); ?>user/product_full/<?php echo $volume_product_row->volume_product_id; ?>">
                        <img src="<?php echo base_url(); ?>files/admin/product/med/<?php echo $volume_product_row->volume_product_image; ?>" class="img-responsive" alt="" style="padding: 1em 0;border: 1px solid #e9e9e9;max-height:400px">
                        </a> <h5>D. No. <?php echo $volume_product_row->volume_product_name; ?></h5>
                            

                                <?php
                            /*if(isset($_SESSION["user_id"]))
                            {
                                ?>
                                <div class="item_add"><span class="item_price"><h6>ONLY Rs. <?php echo $volume_product_row->volume_product_price; ?></h6></span></div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <br>
                                <?php
                            }
                            */
                            ?>
                                <div class="item_add"><span class="item_price"><h6>
                                <!--Rs. <?php //echo $volume_product_row->volume_product_price; ?>-->
                                    <?php echo $_SESSION["currency_symbol"]; ?> 
                                        <?php 
                                            $product_price = ($volume_product_row->volume_product_price)*$_SESSION["exchange_rate"]; 
                                            echo round($product_price,0);
                                    ?>
                                    </h6></span></div>
                                <a class="add-to-cart home_cart_btn" type="button" onclick="add_to_cart('product',<?php echo $volume_product_row->volume_product_id; ?>);" >Add to cart</a>
    <a onclick="wishlist_add('volume_product',<?php echo $volume_product_row->volume_product_id; ?>)"  class="home_cart_btn">Love It</a>

                            </div>
                        </center>
                    </li>
                    <?php
                    $cnt++;
                }
                ?>
                <div class="clearfix"> </div>
            </ul>
        <!--</div>-->
        <?php
        }
       

    }

	public function get_min_qty()
    {
        $settings_row=$this->db->get("tbl_settings")->result();
        $data['single_min_qty']= $settings_row[0]->settings_single_min_qty;
        $data['total_min_qty']=$settings_row[0]->settings_total_min_qty;
        return $data;
    }

	public function add_to_cart($add_action,$id)
	{

		$min_qty_array=$this->get_min_qty();
        
        $data['cart_qty']=$min_qty_array['single_min_qty'];
        
        $sid=session_id();
        $data['cart_session']=$sid;

        if($add_action=="volume")
        {
            //echo "volume";
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
            //echo "product";
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

        //$sid=session_id();
		$cart_res=$this->db->get_where('tbl_cart',array('cart_session'=>$sid));
		$tot_cart_product = 0 ;
		foreach($cart_res->result() as $cart_row)
		{
			if($cart_row->volume_id!=0)
			{
				$volume_product_count_res=$this->db->get_where('tbl_volume_product',array("volume_id"=>$cart_row->volume_id));
				$volume_products = $volume_product_count_res->num_rows();
				$tot_cart_product =$tot_cart_product+($volume_products*$cart_row->cart_qty);
				
			}
			if($cart_row->volume_product_id!=0)
			{
				$tot_cart_product=$tot_cart_product+$cart_row->cart_qty;
			}
		}

		echo $tot_cart_product;



	}

    public function wishlist_add($action,$id)
    {
        if(isset($_SESSION["user_id"]))
        {
            $data['user_id']=$_SESSION["user_id"];
            if($action=="volume_product")
            {
                $resultset=$this->db->get_where('tbl_wishlist',array("user_id"=>$_SESSION["user_id"],"volume_product_id"=>$id));
                if($resultset->num_rows==0)
                {
                    $data['volume_product_id']=$id;
                    $this->db->insert("tbl_wishlist",$data);
                }
            }
            if($action=="volume")
            {
                $resultset=$this->db->get_where('tbl_wishlist',array("user_id"=>$_SESSION["user_id"],"volume_id"=>$id));
                if($resultset->num_rows==0)
                {
                    $data['volume_id']=$id;  
                    $this->db->insert("tbl_wishlist",$data); 
                }
            }
        }
        else
        {
            echo "1";
        }
        //$url=$_SERVER["HTTP_REFERER"];
        //redirect($url);
    }
}
?>