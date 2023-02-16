<?php 
session_start();
class user_ajax extends CI_Controller
{
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