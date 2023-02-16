<?php 
class ajax extends CI_Controller
{
	public function get_subscriber($id)
	{
	    $edit_profile=$this->db->get_where("tbl_subscriber",array("subscriber_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_subscriber/edit/do_update/<?php echo $row->subscriber_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Email</label>
	                                    <input class="form-control" id="txt_subscriber_email" name="txt_subscriber_email" value="<?php echo $row->subscriber_email ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>IP</label>
	                                    <input class="form-control" id="txt_subscriber_ip" name="txt_subscriber_ip" value="<?php echo $row->subscriber_ip ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Date Time</label>
	                                    <input class="form-control" id="txt_subscriber_date_time" name="txt_subscriber_date_time" value="<?php echo $row->subscriber_date_time ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array('Subscribed','Unsubscribed');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->subscriber_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_subscriber_status" name="rdo_subscriber_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_subscriber_status" name="rdo_subscriber_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 
	public function get_email_settings($id)
	{
	    $edit_profile=$this->db->get_where("tbl_email_settings",array("email_settings_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_email_settings/edit/do_update/<?php echo $row->email_settings_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Email Title</label>
	                                    <input class="form-control" id="txt_email_settings_title" name="txt_email_settings_title" value="<?php echo $row->email_settings_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Host Name</label>
	                                    <input class="form-control" id="txt_email_settings_host" name="txt_email_settings_host" value="<?php echo $row->email_settings_host ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>SMTP Auth</label>
	                                <?php 
	                                $radio_array=array("true","false");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->email_settings_smtp_auth)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_email_settings_smtp_auth" name="rdo_email_settings_smtp_auth" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_email_settings_smtp_auth" name="rdo_email_settings_smtp_auth" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Username - Email</label>
	                                    <input class="form-control" id="txt_settings_username" name="txt_settings_username" value="<?php echo $row->settings_username ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Password</label>
	                                    <input class="form-control" id="txt_settings_password" name="txt_settings_password" value="<?php echo $row->settings_password ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>SMTP Secure</label>
	                                    <input class="form-control" id="txt_settings_smtp_secure" name="txt_settings_smtp_secure" value="<?php echo $row->settings_smtp_secure ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>SMTP Port</label>
	                                    <input class="form-control" id="txt_settings_smtp_port" name="txt_settings_smtp_port" value="<?php echo $row->settings_smtp_port ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array("Active","In-Active");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->email_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_email_status" name="rdo_email_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_email_status" name="rdo_email_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 
	public function get_config()
	{
	    $edit_profile=$this->db->get("tbl_config");

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	    <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_config/edit/do_update"  enctype="multipart/form-data">
	    	<div class="col-lg-12">

		        <div class="form-group">
		                    <label>SMS Username</label>
		                    <input type="text" class="form-control" id="txt_sms_username" name="txt_sms_username" value="<?php echo $row->config_sms_username ;?>">
		        </div>
		        <div class="form-group">
		                    <label>SMS Password</label>
		                    <input type="text" class="form-control" id="txt_sms_password" name="txt_sms_password" value="<?php echo $row->config_sms_password ;?>">
		        </div>
		        <div class="form-group">
		                    <label>SMS Sender ID</label>
		                    <input type="text" class="form-control" id="txt_sms_sender_id" name="txt_sms_sender_id" value="<?php echo $row->config_sms_password ;?>">
		        </div>
		        <div class="form-group">
		                    <label>Razorpay API Key</label>
		                    <input type="text" class="form-control" id="txt_razoray_key_id" name="txt_razoray_key_id" value="<?php echo $row->config_razorpay_key_id ;?>">
		        </div>
		        <div class="form-group">
		                    <label>Razorpay API Secret</label>
		                    <input type="text" class="form-control" id="txt_razoray_key_secret" name="txt_razoray_key_secret" value="<?php echo $row->config_razorpay_key_secret ;?>">
		        </div>
		        <div class="form-group">
		                    <label>Giftbox charge on per Unit</label>
		                    <!--<input type="text" class="form-control" id="txt_razoray_key_secret" name="txt_razoray_key_secret" value="<?php echo $row->config_razorpay_key_secret ;?>">-->
		                    <?php 
		                    $radio_array=array("No","Yes");
                            for($i=0;$i<count($radio_array);$i++)
                            {
                            ?>
                                <br><input type="radio" id="rdo_giftbox_per_unit" name="rdo_giftbox_per_unit" value="<?php echo $radio_array[$i]; ?>"
                                <?php 
                                if($row->config_giftbox_charge_per_unit==$radio_array[$i])
                                {
                                	echo "checked='checked'";
                                }
                                ?>
                                ><?php echo $radio_array[$i]; ?>
                            <?php
                            }
		                    ?>
		        </div>
		        <div class="form-group">
		                    <label>Giftbox Charge</label>
		                    <input type="text" class="form-control" id="txt_giftbox_charge" name="txt_giftbox_charge" value="<?php echo $row->config_giftbox_charge ;?>">
		        </div>
		        <div class="form-group">
		                    <label>COD Charge</label>
		                    <input type="text" class="form-control" id="txt_cod_charge" name="txt_cod_charge" value="<?php echo $row->config_cod_charge ;?>">
		        </div>
	        </div>
	        <div class="col-lg-12">
	        <button type="submit" class="btn btn-success">Submit</button>
	        <button type="reset" class="btn btn-default">Reset</button>
	        </div>
	    </form>
	    <?php 
	        }
	    }
	}
	
	public function get_insta($id)
	{
	    $edit_profile=$this->db->get_where("tbl_insta",array("insta_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_insta/edit/do_update/<?php echo $row->insta_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Title</label>
	                                    <input class="form-control" id="txt_insta_title" name="txt_insta_title" value="<?php echo $row->insta_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Image</label><br>
	                                <?php 
	                                if(trim($row->insta_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/insta/<?php echo $row->insta_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_insta" name="img_insta">
	                        </div>
	                        <div class="form-group">
	                                    <label>URL</label>
	                                    <input class="form-control" id="txt_insta_url" name="txt_insta_url" value="<?php echo $row->insta_url ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Sort Order</label>
	                                    <input class="form-control" id="txt_insta_sort_order" name="txt_insta_sort_order" value="<?php echo $row->insta_sort_order ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array("Active","In-Active");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->insta_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_insta_status" name="rdo_insta_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_insta_status" name="rdo_insta_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_front_menu($id)
	{
	    $edit_profile=$this->db->get_where("tbl_front_menu",array("front_menu_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_front_menu/edit/do_update/<?php echo $row->front_menu_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Menu Title</label>
	                                    <input class="form-control" id="txt_front_menu" name="txt_front_menu" value="<?php echo $row->front_menu_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>URL</label>
	                                    <input class="form-control" id="txt_front_menu_url" name="txt_front_menu_url" value="<?php echo $row->front_menu_url ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>FA - ICON</label>
	                                    <input class="form-control" id="txt_front_menu_icon" name="txt_front_menu_icon" value="<?php echo $row->front_menu_icon ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Icon Image</label><br>
	                                <?php 
	                                if(trim($row->front_menu_icon_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/front_menu/<?php echo $row->front_menu_icon_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="txt_front_menu_icon_image" name="txt_front_menu_icon_image">
	                        </div>
	                        <div class="form-group">
	                                    <label>Sort Order</label>
	                                    <input class="form-control" id="txt_front_menu_sort_order" name="txt_front_menu_sort_order" value="<?php echo $row->front_menu_sort_order ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Visible Start Date</label>
	                            <div class="input-group date">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input type="text" class="form-control pull-right" id="txt_front_menu_start_date_2" name="txt_front_menu_start_date"  value="<?php echo $row->front_menu_visible_start_date ;?>" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>Visible End Date</label>
	                            <div class="input-group date">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input type="text" class="form-control pull-right" id="txt_front_menu_end_date_2" name="txt_front_menu_end_date"  value="<?php echo $row->front_menu_visible_end_date ;?>" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>Left Side Image</label><br>
	                                <?php 
	                                if(trim($row->front_menu_left_side_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/front_menu/<?php echo $row->front_menu_left_side_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_front_menu_left_side_image" name="img_front_menu_left_side_image">
	                        </div>
	                        <div class="form-group">
	                                    <label>Right Side Image</label><br>
	                                <?php 
	                                if(trim($row->front_menu_right_side_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/front_menu/<?php echo $row->front_menu_right_side_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_front_menu_right_side_image" name="img_front_menu_right_side_image">
	                        </div>
	                        <div class="form-group">
	                                    <label>Text on Image</label>
	                                    <input class="form-control" id="txt_front_menu_text_on_image" name="txt_front_menu_text_on_image" value="<?php echo $row->front_menu_text_on_image ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Front Menu Label</label>
	                                    <select class="form-control"  id="cmb_front_menu_label_id" name="cmb_front_menu_label_id">
	                                    	<option value="0">--None--</option>
	                                    <?php 
	                                    $select_res    = $this->db->get("tbl_front_menu_label");
	                                    foreach($select_res->result() as $select_row)
	                                    {
	                                        if($select_row->front_menu_label_id == $row->front_menu_label_id)
	                                        {
	                                            echo "<option value=".$select_row->front_menu_label_id." selected>".$select_row->front_menu_label."</option>";
	                                        }
	                                        else
	                                        {
	                                            echo "<option value=".$select_row->front_menu_label_id.">".$select_row->front_menu_label."</option>";
	                                        }
	                                    }
	                                    ?>
	                                    </select>
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array("Active","In-Active");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->front_menu_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_front_menu_status" name="rdo_front_menu_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_front_menu_status" name="rdo_front_menu_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <!--<div class="form-group">
	                                    <label>Parent Id</label>
	                                    <input class="form-control" id="txt_parent_id" name="txt_parent_id" value="<?php //echo $row->parent_id ;?>">
	                        </div>-->
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_front_menu_label($id)
	{
	    $edit_profile=$this->db->get_where("tbl_front_menu_label",array("front_menu_label_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_front_menu_label/edit/do_update/<?php echo $row->front_menu_label_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Front Menu Label</label>
	                                    <input class="form-control" id="txt_front_menu_label" name="txt_front_menu_label" value="<?php echo $row->front_menu_label ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Label Font Color</label>
	                            <div class="input-group my-colorpicker2">
	                                <input type="text"  id="txt_front_menu_label_color" name="txt_front_menu_label_color" class="form-control"  value="<?php echo $row->front_menu_label_color ;?>">
	                                <div class="input-group-addon">
	                                   <i></i>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>Background Color</label>
	                            <div class="input-group my-colorpicker2">
	                                <input type="text"  id="txt_front_menu_background_color" name="txt_front_menu_background_color" class="form-control"  value="<?php echo $row->front_menu_label_backgroun_color ;?>">
	                                <div class="input-group-addon">
	                                   <i></i>
	                                </div>
	                            </div>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	}
	
	public function get_catalogue($id)
	{
	    $edit_profile=$this->db->get_where("tbl_catalogue",array("catalogue_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_catalogue/edit/do_update/<?php echo $row->catalogue_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Catalogue Name</label>
	                                    <input class="form-control" id="txt_catalogue_name" name="txt_catalogue_name" value="<?php echo $row->catalogue_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Image</label><br>
	                                <?php 
	                                if(trim($row->catalogue_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/catalogue/<?php echo $row->catalogue_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_catalogue" name="img_catalogue">
	                        </div>
	                        <div class="form-group">
	                                    <label>Description</label>
	                            <textarea class="form-control" id="txt_catalogue_description2" name="txt_catalogue_description" rows="3"><?php echo $row->catalogue_description ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Release Date</label>
	                            <div class="input-group date">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input type="text" class="form-control pull-right" id="txt_catalogue_release_date_2" name="txt_catalogue_release_date"  value="<?php echo $row->catalogue_release_date ;?>" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array("Active","In-Active");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->catalogue_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_catalogue_status" name="rdo_catalogue_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_catalogue_status" name="rdo_catalogue_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Sort Order</label>
	                                    <input class="form-control" id="txt_catalogue_sort_order" name="txt_catalogue_sort_order" value="<?php echo $row->catalogue_sort_order ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>PDF File</label><br><a href="<?php echo base_url(); ?>files/admin/catalogue/<?php echo $row->catalogue_pdf; ?>" ><?php echo $row->catalogue_pdf ;?></a><input type="file" id="pdf_catalogue" name="pdf_catalogue">Allowed files-(pdf|doc|docx)
	                        </div>
                            <div class="form-group">
                                <label>Products</label>
    	                        <select class="form-control select2" id="cmb_products2[]" name="cmb_products[]" multiple="multiple" data-placeholder="Select a Products"
                                                        style="width: 100%;">
                                <?php
                                  $catalogue_product_res=$this->db->get_where('tbl_catalogue_product',array('catalogue_id'=>$row->catalogue_id));
                                    $product_array=array();
                                    foreach($catalogue_product_res->result() as $catalogue_product_row)
                                    {
                                        $product_array[]=$catalogue_product_row->product_id;
                                    }

                                    $product_res=$this->db->get_where('tbl_product_new');
                                    foreach($product_res->result() as $product_row)
                                    {
                                        if(in_array($product_row->product_id, $product_array))
                                        {
                                        ?>
                                            <option value="<?php echo $product_row->product_id; ?>" selected='selected'><?php echo $product_row->product_name; ?></option>
                                        <?php
                                    	}
                                        else
                                        {
                                        ?>
                                        <option value="<?php echo $product_row->product_id; ?>"><?php echo $product_row->product_name; ?></option>
                                        <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 
	public function get_block($id)
	{
	    $edit_profile=$this->db->get_where("tbl_block",array("block_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_block/edit/do_update/<?php echo $row->block_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Title</label>
	                                    <input class="form-control" id="txt_block_title" name="txt_block_title" value="<?php echo $row->block_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Description</label>
	                            <textarea class="form-control" id="txt_block_desc2" name="txt_block_desc" rows="3"><?php echo $row->block_desc ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Block Group</label>
	                                <?php 
	                                $radio_array=array('Best Deals','Bottom','Place One','Place Two','Place Three','Sidebar');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->block_group)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_block_group" name="rdo_block_group" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_block_group" name="rdo_block_group" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Columns</label>
	                                <?php 
	                                $radio_array=array('4','6','8','12');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->block_columns)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_block_columns" name="rdo_block_columns" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_block_columns" name="rdo_block_columns" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Sort Order</label>
	                                    <input class="form-control" id="txt_block_order" name="txt_block_order" value="<?php echo $row->block_order ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Block Image</label><br>
	                                <?php 
	                                if(trim($row->block_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/block/<?php echo $row->block_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_block" name="img_block">
	                        </div>
	                        <div class="form-group">
	                                    <label>Background Image</label><br>
	                                <?php 
	                                if(trim($row->block_background_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/block/<?php echo $row->block_background_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_block_background" name="img_block_background">
	                        </div>
	                        <div class="form-group">
	                                    <label>Background Color</label>
	                            <div class="input-group my-colorpicker2">
	                                <input type="text"  id="txt_block_background_color" name="txt_block_background_color" class="form-control"  value="<?php echo $row->block_background_color ;?>">
	                                <div class="input-group-addon">
	                                   <i></i>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array("Active","In-Active");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->block_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_block_status" name="rdo_block_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_block_status" name="rdo_block_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 
	
	public function get_product_additional_image($id)
	{
	    $edit_profile=$this->db->get_where("tbl_product_additional_image",array("product_additional_image_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_product_additional_image/edit/do_update/<?php echo $row->product_additional_image_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                		<input type="hidden" class="form-control" id="txt_product_id" name="txt_product_id" value="<?php echo $row->product_id ;?>">
	                        <div class="form-group">
	                                    <label>Image</label><br>
	                                <?php 
	                                if(trim($row->product_additional_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/product/<?php echo $row->product_additional_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_product" name="img_product">
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_tag($id)
	{
	    $edit_profile=$this->db->get_where("tbl_tag",array("tag_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_tag/edit/do_update/<?php echo $row->tag_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Tag Title</label>
	                                    <input class="form-control" id="txt_tag_name" name="txt_tag_name" value="<?php echo $row->tag_name ;?>">
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 
	
	public function get_sms_provider($id)
	{
	    $edit_profile=$this->db->get_where("tbl_sms_provider",array("sms_provider_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_sms_provider/edit/do_update/<?php echo $row->sms_provider_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>SMS Provider Name</label>
	                                    <input class="form-control" id="txt_sms_provider_name" name="txt_sms_provider_name" value="<?php echo $row->sms_provider_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Provider API URL</label>
	                                    <input class="form-control" id="txt_sms_provider_url" name="txt_sms_provider_url" value="<?php echo $row->sms_provider_url ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Username</label>
	                                    <input class="form-control" id="txt_sms_provider_username" name="txt_sms_provider_username" value="<?php echo $row->sms_provider_user ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Password</label>
	                                    <input class="form-control" id="txt_sms_provider_password" name="txt_sms_provider_password" value="<?php echo $row->sms_provider_password ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array("Active","In-Active");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->sms_provider_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_sms_provider_status" name="rdo_sms_provider_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_sms_provider_status" name="rdo_sms_provider_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 
	public function get_slider($id)
	{
	    $edit_profile=$this->db->get_where("tbl_slider",array("slider_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_slider/edit/do_update/<?php echo $row->slider_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Title</label>
	                                    <input class="form-control" id="txt_slider_title" name="txt_slider_title" value="<?php echo $row->slider_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Title Text Color</label>
	                            <div class="input-group my-colorpicker2">
	                                <input type="text"  id="txt_slider_text_color" name="txt_slider_text_color" class="form-control"  value="<?php echo $row->slider_title_text_color ;?>">
	                                <div class="input-group-addon">
	                                   <i></i>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>SubTitle</label>
	                                    <input class="form-control" id="txt_slider_subtitle" name="txt_slider_subtitle" value="<?php echo $row->slider_subtitle ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>SubTitle Text Color</label>
	                                    <input class="form-control" id="txt_slider_subtitle_color" name="txt_slider_subtitle_color" value="<?php echo $row->slider_subtitle_text_color ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Link</label>
	                                    <input class="form-control" id="txt_slider_link" name="txt_slider_link" value="<?php echo $row->slider_link ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Image</label><br>
	                                <?php 
	                                if(trim($row->slider_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/slider/<?php echo $row->slider_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_slider" name="img_slider">
	                        </div>
	                        <div class="form-group">
	                                    <label>Sort Order</label>
	                                    <input class="form-control" id="txt_slider_order" name="txt_slider_order" value="<?php echo $row->slider_order ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Thumbnail</label><br>
	                                <?php 
	                                if(trim($row->slider_thumbnail)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/slider/<?php echo $row->slider_thumbnail; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_slider_thumbnail" name="img_slider_thumbnail">
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_role_type($id)
	{
	    $edit_profile=$this->db->get_where("tbl_role_type",array("role_type_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_role_type/edit/do_update/<?php echo $row->role_type_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Role Type</label>
	                                    <input class="form-control" id="txt_role_type_name" name="txt_role_type_name" value="<?php echo $row->role_type_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array("Active","In-Active");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->role_type_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_role_type_status" name="rdo_role_type_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_role_type_status" name="rdo_role_type_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_submenu($id)
	{
	    $edit_profile=$this->db->get_where("tbl_submenu",array("submenu_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_submenu/edit/do_update/<?php echo $row->submenu_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Submenu Name</label>
	                                    <input class="form-control" id="txt_submenu_name" name="txt_submenu_name" value="<?php echo $row->submenu_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Submenu Title</label>
	                                    <input class="form-control" id="txt_submenu_title" name="txt_submenu_title" value="<?php echo $row->submenu_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Link Url</label>
	                                    <input class="form-control" id="txt_submenu_url" name="txt_submenu_url" value="<?php echo $row->submenu_url ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Display</label>
	                                    <input class="form-control" id="txt_submenu_display" name="txt_submenu_display" value="<?php echo $row->submenu_display ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Menu</label>
	                                    <input class="form-control" id="txt_menu" name="txt_menu" value="<?php echo $row->menu_id ;?>">
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_menu($id)
	{
	    $edit_profile=$this->db->get_where("tbl_menu",array("menu_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_menu/edit/do_update/<?php echo $row->menu_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Menu Name</label>
	                                    <input class="form-control" id="txt_menu_name" name="txt_menu_name" value="<?php echo $row->menu_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Title</label>
	                                    <input class="form-control" id="txt_menu_title" name="txt_menu_title" value="<?php echo $row->menu_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>URL Link</label>
	                                    <input class="form-control" id="txt_menu_url" name="txt_menu_url" value="<?php echo $row->menu_url ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Display</label>
	                                <?php 
	                                $radio_array=array("Yes","No");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->menu_display)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_menu_display" name="rdo_menu_display" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_menu_display" name="rdo_menu_display" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Sort Order</label>
	                                    <input class="form-control" id="txt_menu_sort_order" name="txt_menu_sort_order" value="<?php echo $row->menu_sort_order ;?>">
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	/*
	public function get_product($id)
	{
	    $edit_profile=$this->db->get_where("tbl_product",array("product_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_product/edit/do_update/<?php echo $row->product_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Product Name</label>
	                                    <input class="form-control" id="txt_product_name" name="txt_product_name" value="<?php echo $row->product_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Model Number</label>
	                                    <input class="form-control" id="txt_product_model_number" name="txt_product_model_number" value="<?php echo $row->product_model_number ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Stock</label>
	                                    <input class="form-control" id="txt_product_stock" name="txt_product_stock" value="<?php echo $row->product_stock ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Brief Description</label>
	                            <textarea class="form-control" id="txt_product_brief_description2" name="txt_product_brief_description" rows="3"><?php echo $row->product_brief_description ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Full Description</label>
	                            <textarea class="form-control" id="txt_product_full_description2" name="txt_product_full_description" rows="3"><?php echo $row->product_full_description ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Additional Information</label>
	                            <textarea class="form-control" id="txt_product_additional_info2" name="txt_product_additional_info" rows="3"><?php echo $row->product_additional_information ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Base Image</label><br>
	                                <?php 
	                                if(trim($row->product_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/product/<?php echo $row->product_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_product" name="img_product">
	                        </div>
	                        <div class="form-group">
	                                    <label>MRP</label>
	                                    <input class="form-control" id="txt_product_mrp" name="txt_product_mrp" value="<?php echo $row->product_mrp ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Selling Price</label>
	                                    <input class="form-control" id="txt_product_selling_price" name="txt_product_selling_price" value="<?php echo $row->product_selling_price ;?>">
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	}
	*/ 

	public function get_product($id)
	{
	    $edit_profile=$this->db->get_where("tbl_product_new",array("product_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_product/edit/do_update/<?php echo $row->product_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Product Name</label>
	                                    <input class="form-control" id="txt_product_name" name="txt_product_name" value="<?php echo $row->product_name ;?>" onblur="get_slug2(this.value);">
	                        </div>
	                        <div class="form-group">
	                                    <label>SEO Slug</label>
	                                    <input class="form-control" id="txt_product_seo_slug2" name="txt_product_seo_slug" value="<?php echo $row->product_seo_slug ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Description</label>
	                            <textarea class="form-control" id="txt_product_description2" name="txt_product_description" rows="3"><?php echo $row->product_description ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Meta Title</label>
	                                    <input class="form-control" id="txt_product_meta_title" name="txt_product_meta_title" value="<?php echo $row->product_meta_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Meta Tag Keywords</label>
	                                    <textarea class="form-control" id="txt_product_meta_tag_keywords" name="txt_product_meta_tag_keywords" rows="3"><?php echo $row->product_meta_tag_keywords ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Meta Tag Description</label>
	                                    <textarea class="form-control" id="txt_product_meta_tag_description" name="txt_product_meta_tag_description" rows="3"><?php echo $row->product_meta_tag_description ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Model Number</label>
	                                    <input class="form-control" id="txt_product_model_no" name="txt_product_model_no" value="<?php echo $row->product_model_no ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>SKU</label>
	                                    <input class="form-control" id="txt_product_sku" name="txt_product_sku" value="<?php echo $row->product_sku ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>UPC</label>
	                                    <input class="form-control" id="txt_product_upc" name="txt_product_upc" value="<?php echo $row->product_upc ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>EAN</label>
	                                    <input class="form-control" id="txt_product_ean" name="txt_product_ean" value="<?php echo $row->product_ean ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>JAN</label>
	                                    <input class="form-control" id="txt_product_jan" name="txt_product_jan" value="<?php echo $row->product_jan ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>ISBN</label>
	                                    <input class="form-control" id="txt_product_isbn" name="txt_product_isbn" value="<?php echo $row->product_isbn ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>MPN</label>
	                                    <input class="form-control" id="txt_product_mpn" name="txt_product_mpn" value="<?php echo $row->product_mpn ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>MRP</label>
	                                    <input class="form-control" id="txt_product_mrp" name="txt_product_mrp" value="<?php echo $row->product_mrp ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Selling Price</label>
	                                    <input class="form-control" id="txt_product_selling_price" name="txt_product_selling_price" value="<?php echo $row->product_selling_price ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Tax Class</label>
	                                <?php 
	                                $radio_array=array('None','Taxable Goods','Downloadable Goods');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->product_tax_class)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_product_tax_class" name="rdo_product_tax_class" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_product_tax_class" name="rdo_product_tax_class" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Quantity</label>
	                                    <input class="form-control" id="txt_product_quantity" name="txt_product_quantity" value="<?php echo $row->product_quantity ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Minimum Quantity</label>
	                                    <input class="form-control" id="txt_product_min_quantity" name="txt_product_min_quantity" value="<?php echo $row->product_min_quantity ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Out of Stock Status</label>
	                                <?php 
	                                $radio_array=array('2-3 Days','In-Stock','Out of Stock','Pre Order');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->product_out_of_stock_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_product_out_of_stock_status" name="rdo_product_out_of_stock_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_product_out_of_stock_status" name="rdo_product_out_of_stock_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Require Shipping</label>
	                                <?php 
	                                $radio_array=array("Yes","No");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->product_require_shipping)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_product_require_shipping" name="rdo_product_require_shipping" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_product_require_shipping" name="rdo_product_require_shipping" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Available Date</label>
	                            <div class="input-group date">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input type="text" class="form-control pull-right" id="txt_product_available_date_2" name="txt_product_available_date"  value="<?php echo $row->product_available_date ;?>" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>Length</label>
	                                    <input class="form-control" id="txt_product_dimension_length" name="txt_product_dimension_length" value="<?php echo $row->product_dimension_length ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Width</label>
	                                    <input class="form-control" id="txt_product_dimension_width" name="txt_product_dimension_width" value="<?php echo $row->product_dimension_width ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Height</label>
	                                    <input class="form-control" id="txt_product_dimension_height" name="txt_product_dimension_height" value="<?php echo $row->product_dimension_height ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Length Class</label>
	                                <?php 
	                                $radio_array=array('Centimeter','Milimeter','Inch');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->product_length_class)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_product_length_class" name="rdo_product_length_class" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_product_length_class" name="rdo_product_length_class" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Weight Class</label>
	                                <?php 
	                                $radio_array=array('kilogram','gram','pound','ounce');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->product_weight_class)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_product_weight_class" name="rdo_product_weight_class" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_product_weight_class" name="rdo_product_weight_class" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Weight</label>
	                                    <input class="form-control" id="txt_product_weight" name="txt_product_weight" value="<?php echo $row->product_weight ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array("Active","In-Active");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->product_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_product_status" name="rdo_product_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_product_status" name="rdo_product_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Sort Order</label>
	                                    <input class="form-control" id="txt_product_sort_order" name="txt_product_sort_order" value="<?php echo $row->product_sort_order ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Base Image</label><br>
	                                <?php 
	                                if(trim($row->product_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/product/<?php echo $row->product_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_product" name="img_product">
	                        </div>
	                        
	                        <div class="form-group">
	                                    <label>Is Bundled</label>
	                                <?php 
	                                $radio_array=array("No","Yes");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->product_is_bundled)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_product_is_bundled" name="rdo_product_is_bundled" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_product_is_bundled" name="rdo_product_is_bundled" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Manufacturer</label>
	                                    <input class="form-control" id="txt_manufacturer_id" name="txt_manufacturer_id" value="<?php echo $row->manufacturer_id ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Category</label>
	                                    <!--<input class="form-control" id="txt_category_id" name="txt_category_id" value="<?php echo $row->category_id ;?>">-->
	                                    <select class="form-control select2" id="cmb_category2[]" name="cmb_category[]" multiple="multiple" data-placeholder="Select a Attribute"
                                                    style="width: 100%;">
                                                      <?php
                                                      $prod_cat_res=$this->db->get_where('tbl_product_category',array('product_id'=>$row->product_id));
                                                      $cat_array=array();
                                                      foreach($prod_cat_res->result() as $prod_cat_row)
                                                      {
                                                      	$cat_array[]=$prod_cat_row->category_id;
                                                      }

                                                      $category_res=$this->db->get_where('tbl_category');
                                                      foreach($category_res->result() as $category_row)
                                                      {
                                                      	if(in_array($category_row->category_id, $cat_array))
                                                        {
                                                           
                                                        ?>
                                                        	<option value="<?php echo $category_row->category_id; ?>" selected='selected'><?php echo $category_row->category_name; ?></option>
                                                        <?php
                                                    	}
                                                    	else
                                                    	{
                                                    		?>
                                                    		<option value="<?php echo $category_row->category_id; ?>"><?php echo $category_row->category_name; ?></option>
                                                    		<?php
                                                    	}
                                                      }
                                                      ?>
                                                    </select>
	                        </div>
	                        <div class="form-group">
	                        	<label>Attributes</label>
	                            <select class="form-control select2" id="cmb_attribute2[]" name="cmb_attribute[]" multiple="multiple" data-placeholder="Select a Attribute"
                                                    style="width: 100%;">
                                <?php
                                    $prod_attr_res=$this->db->get_where('tbl_product_attribute_value',array('product_id'=>$row->product_id));
                                    $attr_array=array();
                                    foreach($prod_attr_res->result() as $prod_attr_row)
                                    {
                                        $attr_array[]=$prod_attr_row->attribute_value_id;
                                    }

                                   	$this->db->join('tbl_attribute','tbl_attribute_value.attribute_id=tbl_attribute.attribute_id');
                                    $attr_value_res=$this->db->get_where('tbl_attribute_value');
                                    foreach($attr_value_res->result() as $attr_value_row)
                                    {
                 	                  	if(in_array($attr_value_row->attribute_value_id, $attr_array))
                                        {
                                        ?>
                                            <option value="<?php echo $attr_value_row->attribute_value_id; ?>" selected='selected'><?php echo $attr_value_row->attribute_name." > ".$attr_value_row->attribute_value; ?></option>
                                        <?php
                                       	}
                                        else
                                       	{
                                        ?>
                                            <option value="<?php echo $attr_value_row->attribute_value_id; ?>"><?php echo $attr_value_row->attribute_name." > ".$attr_value_row->attribute_value; ?></option>
                                        <?php
                                       	}
                                    }
               		                ?>
                                </select>
	                        </div>
	                        <div class="form-group">
	                        	<label>Related Products</label>
	                            <select class="form-control select2" id="cmb_related_products[]" name="cmb_related_products[]" multiple="multiple" data-placeholder="Select a Product" style="width: 100%;">
                                <?php
                                    $related_product_res=$this->db->get_where('tbl_related_product',array('product_id'=>$row->product_id));
                                    $related_product_array=array();
                                    foreach($related_product_res->result() as $related_product_row)
                                    {
                                        $related_product_array[]=$related_product_row->related_product_id;
                                    }

                                   	$product_res=$this->db->get_where('tbl_product_new');
                                    foreach($product_res->result() as $product_row)
                                    {
                 	                  	if(in_array($product_row->product_id, $related_product_array))
                                        {
                                        ?>
                                            <option value="<?php echo $product_row->product_id; ?>" selected='selected'><?php echo $product_row->product_name; ?></option>
                                        <?php
                                       	}
                                        else
                                       	{
                                        ?>
                                            <option  value="<?php echo $product_row->product_id; ?>" ><?php echo $product_row->product_name; ?></option>
                                        <?php
                                       	}
                                    }
               		                ?>
                                </select>
	                        </div>
							<div class="form-group">
                                <label>Image Upload Files</label>
                                    <?php 
                                    if(isset($image_msg))
                                    {
                                        echo $image_msg;
                                    }
                                    ?>
                                    <form role="form" method="post" action="<?php echo base_url(); ?>admin/upload_image_zip" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Image Zip File</label>
                                                <input type="file" id="zip_file" name="zip_file">
                                            </div>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                        </div>
                                    </form>
                         </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_page($id)
	{
	    $edit_profile=$this->db->get_where("tbl_page",array("page_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_page/edit/do_update/<?php echo $row->page_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Page Title</label>
	                                    <input class="form-control" id="txt_page_title" name="txt_page_title" value="<?php echo $row->page_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Position</label>
	                                <?php 
	                                $radio_array=array('copyright area','footer 1st column','footer 2nd column','footer 3rd column','main navbar');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->page_view_position)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="txt_page_view_position" name="txt_page_view_position" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="txt_page_view_position" name="txt_page_view_position" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Slug</label>
	                                    <input class="form-control" id="txt_page_slug" name="txt_page_slug" value="<?php echo $row->page_slug ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Content</label>
	                            <textarea class="form-control" id="txt_page_content2" name="txt_page_content" rows="3"><?php echo $row->page_content ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Publish Date</label>
	                            <div class="input-group date">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input type="text" class="form-control pull-right" id="txt_page_publish_at_2" name="txt_page_publish_at"  value="<?php echo $row->page_publish_at ;?>" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>Visibility</label>
	                                <?php 
	                                $radio_array=array('public','merchant');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->page_visibility)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_page_visibility" name="rdo_page_visibility" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_page_visibility" name="rdo_page_visibility" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Image</label><br>
	                                <?php 
	                                if(trim($row->page_featured_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/page/<?php echo $row->page_featured_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_product" name="img_product">
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_manufacturer($id)
	{
	    $edit_profile=$this->db->get_where("tbl_manufacturer",array("manufacturer_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_manufacturer/edit/do_update/<?php echo $row->manufacturer_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Name</label>
	                                    <input class="form-control" id="txt_manufacturer_name" name="txt_manufacturer_name" value="<?php echo $row->manufacturer_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Logo</label><br>
	                                <?php 
	                                if(trim($row->manufacturer_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/manufacturer/<?php echo $row->manufacturer_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_manufacturer" name="img_manufacturer">
	                        </div>
	                        <div class="form-group">
	                                    <label>Description</label>
	                            <textarea class="form-control" id="txt_manufacturer_description2" name="txt_manufacturer_description" rows="3"><?php echo $row->manufacturer_description ;?></textarea>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_faq($id)
	{
	    $edit_profile=$this->db->get_where("tbl_faq",array("faq_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_faq/edit/do_update/<?php echo $row->faq_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Question</label>
	                                    <input class="form-control" id="txt_faq_question" name="txt_faq_question" value="<?php echo $row->faq_question ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Answer</label>
	                            <textarea class="form-control" id="txt_faq_answer2" name="txt_faq_answer" rows="3"><?php echo $row->faq_answer ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>FAQ Topic</label>
	                                    <select class="form-control"  id="cmb_faq_topic" name="cmb_faq_topic">
	                                    <?php 
	                                    $select_res    = $this->db->get("tbl_faq_topic");
	                                    foreach($select_res->result() as $select_row)
	                                    {
	                                        if($select_row->faq_topic_id == $row->faq_topic_id)
	                                        {
	                                            echo "<option value=".$select_row->faq_topic_id." selected>".$select_row->faq_topic_name."</option>";
	                                        }
	                                        else
	                                        {
	                                            echo "<option value=".$select_row->faq_topic_id.">".$select_row->faq_topic_name."</option>";
	                                        }
	                                    }
	                                    ?>
	                                    </select>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_faq_topic($id)
	{
	    $edit_profile=$this->db->get_where("tbl_faq_topic",array("faq_topic_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_faq_topic/edit/do_update/<?php echo $row->faq_topic_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>FAQ Topic Name</label>
	                                    <input class="form-control" id="txt_faq_topic_name" name="txt_faq_topic_name" value="<?php echo $row->faq_topic_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>For</label>
	                                <?php 
	                                $radio_array=array('public','merchant');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->faq_topic_for)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_faq_topic_for" name="rdo_faq_topic_for" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_faq_topic_for" name="rdo_faq_topic_for" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_email_template($id)
	{
	    $edit_profile=$this->db->get_where("tbl_email_template",array("email_template_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_email_template/edit/do_update/<?php echo $row->email_template_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Email Settings - Email</label>
	                                    <select class="form-control"  id="cmb_email_settings" name="cmb_email_settings">
	                                    <?php 
	                                    $select_res    = $this->db->get("tbl_email_settings");
	                                    foreach($select_res->result() as $select_row)
	                                    {
	                                        if($select_row->email_settings_id == $row->email_settings_id)
	                                        {
	                                            echo "<option value=".$select_row->email_settings_id." selected>".$select_row->settings_username."</option>";
	                                        }
	                                        else
	                                        {
	                                            echo "<option value=".$select_row->email_settings_id.">".$select_row->settings_username."</option>";
	                                        }
	                                    }
	                                    ?>
	                                    </select>
	                        </div>
	                        <div class="form-group">
	                                    <label>Template Name</label>
	                                    <input class="form-control" id="txt_email_template_name" name="txt_email_template_name" value="<?php echo $row->email_template_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Template Type</label>
	                                <?php 
	                                $radio_array=array("Plain","HTML");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->email_template_type)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_email_template_type" name="rdo_email_template_type" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_email_template_type" name="rdo_email_template_type" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Email For</label>
	                                <?php 
	                                //$radio_array=array("Platform","Merchant");
	                                $radio_array=array('Platform','Merchant','registration','new_order','order_confirm','order_ship','order_out_for_delivery','order_delivered','order_cancel');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                 	echo "<br>";   
	                                    if($radio_array[$i]==$row->email_template_for)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_email_for" name="rdo_email_for" value="<?php echo $radio_array[$i]; ?>" style="margin-right:10px"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_email_for" name="rdo_email_for" value="<?php echo $radio_array[$i]; ?>" style="margin-right:10px"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Sender Email</label>
	                                    <input class="form-control" id="txt_email_template_sender_email" name="txt_email_template_sender_email" value="<?php echo $row->email_template_sender_email ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Sender Name</label>
	                                    <input class="form-control" id="tt_email_template_sender_name" name="tt_email_template_sender_name" value="<?php echo $row->email_template_sender_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Subject</label>
	                                    <input class="form-control" id="txt_email_template_subject" name="txt_email_template_subject" value="<?php echo $row->email_template_subject ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Body</label>
	                            <textarea class="form-control" id="txt_email_template_body2" name="txt_email_template_body" rows="3"><?php echo $row->email_template_body ;?></textarea>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_download($id)
	{
	    $edit_profile=$this->db->get_where("tbl_download",array("download_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_download/edit/do_update/<?php echo $row->download_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Download File Name</label>
	                                    <input class="form-control" id="txt_download_file_name" name="txt_download_file_name" value="<?php echo $row->download_file_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Download File</label><br><a href="<?php echo base_url(); ?>files/admin/download/<?php echo $row->download_file; ?>" ><?php echo $row->download_file ;?></a><input type="file" id="file_download" name="file_download">Allowed files-(pdf|doc|docx|xls|xlsx|jpg|png|jpeg)
	                        </div>
	                        <div class="form-group">
	                                    <label>Mask Title</label>
	                                    <input class="form-control" id="txt_download_file_mask" name="txt_download_file_mask" value="<?php echo $row->download_file_mask ;?>">
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_customer($id)
	{
	    $edit_profile=$this->db->get_where("tbl_customer",array("customer_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_customer/edit/do_update/<?php echo $row->customer_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Full Name</label>
	                                    <input class="form-control" id="txt_customer_name" name="txt_customer_name" value="<?php echo $row->customer_full_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array("Active","In-Active");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->customer_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_customer_status" name="rdo_customer_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_customer_status" name="rdo_customer_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Nickname</label>
	                                    <input class="form-control" id="txt_customer_nickname" name="txt_customer_nickname" value="<?php echo $row->customer_nickname ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Email</label>
	                                    <input class="form-control" id="txt_email_address" name="txt_email_address" value="<?php echo $row->customer_email_address ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Password</label>
	                                    <input class="form-control" id="txt_customer_password" name="txt_customer_password" value="<?php echo $row->customer_password ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Description</label>
	                                    <textarea class="form-control" id="txt_customer_description" name="txt_customer_description" rows="3"><?php echo $row->customer_description ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Date of Birth</label>
	                            <div class="input-group date">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input type="text" class="form-control pull-right" id="txt_customer_dob_2" name="txt_customer_dob"  value="<?php echo $row->customer_dob ;?>" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>Gender</label>
	                                <?php 
	                                $radio_array=array('Male','Female','Other');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->customer_gender)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_customer_gender" name="rdo_customer_gender" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_customer_gender" name="rdo_customer_gender" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Address Line 1</label>
	                                    <textarea class="form-control" id="txt_customer_address_line1" name="txt_customer_address_line1" rows="3"><?php echo $row->customer_address_line1 ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Address Line 2</label>
	                                    <textarea class="form-control" id="txt_customer_address_line2" name="txt_customer_address_line2" rows="3"><?php echo $row->customer_address_line2 ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>City</label>
	                                    <select class="form-control"  id="cmb_city" name="cmb_city">
	                                    <?php 
	                                    $select_res    = $this->db->get("tbl_city");
	                                    foreach($select_res->result() as $select_row)
	                                    {
	                                        if($select_row->city_id == $row->customer_city)
	                                        {
	                                            echo "<option value=".$select_row->city_id." selected>".$select_row->city_name."</option>";
	                                        }
	                                        else
	                                        {
	                                            echo "<option value=".$select_row->city_id.">".$select_row->city_name."</option>";
	                                        }
	                                    }
	                                    ?>
	                                    </select>
	                        </div>
	                        <div class="form-group">
	                                    <label>Postal Code</label>
	                                    <input class="form-control" id="txt_customer_postal_code" name="txt_customer_postal_code" value="<?php echo $row->customer_postal_code ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Country</label>
	                                    <select class="form-control"  id="cmb_customer_country" name="cmb_customer_country">
	                                    <?php 
	                                    $select_res    = $this->db->get("tbl_country");
	                                    foreach($select_res->result() as $select_row)
	                                    {
	                                        if($select_row->country_id == $row->customer_country_id)
	                                        {
	                                            echo "<option value=".$select_row->country_id." selected>".$select_row->country_name."</option>";
	                                        }
	                                        else
	                                        {
	                                            echo "<option value=".$select_row->country_id.">".$select_row->country_name."</option>";
	                                        }
	                                    }
	                                    ?>
	                                    </select>
	                        </div>
	                        <div class="form-group">
	                                    <label>State</label>
	                                    <select class="form-control"  id="cmb_state" name="cmb_state">
	                                    <?php 
	                                    $select_res    = $this->db->get("tbl_state");
	                                    foreach($select_res->result() as $select_row)
	                                    {
	                                        if($select_row->state_id == $row->customer_state_id)
	                                        {
	                                            echo "<option value=".$select_row->state_id." selected>".$select_row->state_name."</option>";
	                                        }
	                                        else
	                                        {
	                                            echo "<option value=".$select_row->state_id.">".$select_row->state_name."</option>";
	                                        }
	                                    }
	                                    ?>
	                                    </select>
	                        </div>
	                        <div class="form-group">
	                                    <label>Profile Pic</label><br>
	                                <?php 
	                                if(trim($row->customer_profile_pic)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/customer/<?php echo $row->customer_profile_pic; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_customer_profie_pic" name="img_customer_profie_pic">
	                        </div>
	                        <div class="form-group">
	                                    <label>DOJ</label>
	                            <div class="input-group date">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input type="text" class="form-control pull-right" id="txt_customer_doj_2" name="txt_customer_doj"  value="<?php echo $row->customer_doj ;?>" >
	                            </div>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_state($id)
	{
	    $edit_profile=$this->db->get_where("tbl_state",array("state_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_state/edit/do_update/<?php echo $row->state_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>State Name</label>
	                                    <input class="form-control" id="txt_state_name" name="txt_state_name" value="<?php echo $row->state_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Code</label>
	                                    <input class="form-control" id="txt_state_code" name="txt_state_code" value="<?php echo $row->state_code ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Country</label>
	                                    <select class="form-control"  id="cmb_country" name="cmb_country">
	                                    <?php 
	                                    $select_res    = $this->db->get("tbl_country");
	                                    foreach($select_res->result() as $select_row)
	                                    {
	                                        if($select_row->country_id == $row->country_id)
	                                        {
	                                            echo "<option value=".$select_row->country_id." selected>".$select_row->country_name."</option>";
	                                        }
	                                        else
	                                        {
	                                            echo "<option value=".$select_row->country_id.">".$select_row->country_name."</option>";
	                                        }
	                                    }
	                                    ?>
	                                    </select>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_currency($id)
	{
	    $edit_profile=$this->db->get_where("tbl_currency",array("currency_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_currency/edit/do_update/<?php echo $row->currency_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Currency Symbol</label>
	                                    <input class="form-control" id="txt_currency_symbol" name="txt_currency_symbol" value="<?php echo $row->currency_symbol ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>ISO Code</label>
	                                    <input class="form-control" id="txt_currency_iso_code" name="txt_currency_iso_code" value="<?php echo $row->currency_iso_code ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Sub Unit</label>
	                                    <input class="form-control" id="txt_currency_sub_unit" name="txt_currency_sub_unit" value="<?php echo $row->currency_sub_unit ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Symbol First</label>
	                                <?php 
	                                $radio_array=array("Yes","No");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->currency_symbol_first)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_currency_symbol_first" name="rdo_currency_symbol_first" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_currency_symbol_first" name="rdo_currency_symbol_first" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Thousands Seprator</label>
	                                <?php 
	                                $radio_array=array(',','.','space');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->currency_thousands_seprator)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_currency_thousands_seprator" name="rdo_currency_thousands_seprator" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_currency_thousands_seprator" name="rdo_currency_thousands_seprator" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Decimal Mark</label>
	                                <?php 
	                                $radio_array=array(',','.');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->currency_decimal_mark)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_currency_decimal_mark" name="rdo_currency_decimal_mark" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_currency_decimal_mark" name="rdo_currency_decimal_mark" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_coupon($id)
	{
	    $edit_profile=$this->db->get_where("tbl_coupon",array("coupon_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_coupon/edit/do_update/<?php echo $row->coupon_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Coupon Title</label>
	                                    <input class="form-control" id="txt_coupon_name" name="txt_coupon_name" value="<?php echo $row->coupon_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array("Active","In-Active");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->coupon_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_coupon_status" name="rdo_coupon_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_coupon_status" name="rdo_coupon_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Code</label>
	                                    <input class="form-control" id="txt_coupon_code" name="txt_coupon_code" value="<?php echo $row->coupon_code ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Discount</label>
	                                    <input class="form-control" id="txt_coupon_value" name="txt_coupon_value" value="<?php echo $row->coupon_value ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>On</label>
	                                <?php 
	                                $radio_array=array('%','Flat');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->coupon_value_on)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_coupon_value_discount_on" name="rdo_coupon_value_discount_on" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_coupon_value_discount_on" name="rdo_coupon_value_discount_on" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Quantity</label>
	                                    <input class="form-control" id="txt_coupon_quantity" name="txt_coupon_quantity" value="<?php echo $row->coupon_quantity ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Minimum Order Amount</label>
	                                    <input class="form-control" id="txt_coupon_min_order_amount" name="txt_coupon_min_order_amount" value="<?php echo $row->coupon_minimum_order_amount ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Quantity Per Customer</label>
	                                    <input class="form-control" id="txt_coupon_qnt_per_customer" name="txt_coupon_qnt_per_customer" value="<?php echo $row->coupon_quantity_per_customer ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Description</label>
	                            <textarea class="form-control" id="txt_coupon_description2" name="txt_coupon_description" rows="3"><?php echo $row->coupon_description ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Limited Ship Zone</label>
	                                <?php 
	                                $radio_array=array("No","Yes");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->coupon_limited_ship_zone)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_coupon_limited_ship_zone" name="rdo_coupon_limited_ship_zone" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_coupon_limited_ship_zone" name="rdo_coupon_limited_ship_zone" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Limited to Customer</label>
	                                <?php 
	                                $radio_array=array("No","Yes");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->coupon_limited_to_customer)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_coupon_limited_to_customer" name="rdo_coupon_limited_to_customer" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_coupon_limited_to_customer" name="rdo_coupon_limited_to_customer" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Start Date Time</label>
	                            <div class="input-group date">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input type="text" class="form-control pull-right" id="txt_coupon_start_date_2" name="txt_coupon_start_date"  value="<?php echo $row->coupon_start_time ;?>" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>End Date Time</label>
	                            <div class="input-group date">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input type="text" class="form-control pull-right" id="txt_coupon_end_date_2" name="txt_coupon_end_date"  value="<?php echo $row->coupon_end_time ;?>" >
	                            </div>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_city($id)
	{
	    $edit_profile=$this->db->get_where("tbl_city",array("city_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_city/edit/do_update/<?php echo $row->city_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>City</label>
	                                    <input class="form-control" id="txt_city_name" name="txt_city_name" value="<?php echo $row->city_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>State</label>
	                                    <select class="form-control"  id="cmb_state" name="cmb_state">
	                                    <?php 
	                                    $select_res    = $this->db->get("tbl_state");
	                                    foreach($select_res->result() as $select_row)
	                                    {
	                                        if($select_row->state_id == $row->state_id)
	                                        {
	                                            echo "<option value=".$select_row->state_id." selected>".$select_row->state_name."</option>";
	                                        }
	                                        else
	                                        {
	                                            echo "<option value=".$select_row->state_id.">".$select_row->state_name."</option>";
	                                        }
	                                    }
	                                    ?>
	                                    </select>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_country($id)
	{
	    $edit_profile=$this->db->get_where("tbl_country",array("country_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_country/edit/do_update/<?php echo $row->country_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Country</label>
	                                    <input class="form-control" id="txt_country_name" name="txt_country_name" value="<?php echo $row->country_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Code</label>
	                                    <input class="form-control" id="txt_country_code" name="txt_country_code" value="<?php echo $row->country_code ;?>">
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	}
	
	public function get_blog($id)
	{
	    $edit_profile=$this->db->get_where("tbl_blog",array("blog_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_blog/edit/do_update/<?php echo $row->blog_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Title</label>
	                                    <input class="form-control" id="txt_blog_title" name="txt_blog_title" value="<?php echo $row->blog_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Slug</label>
	                                    <input class="form-control" id="txt_blog_slug" name="txt_blog_slug" value="<?php echo $row->blog_slug ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Excerpt</label>
	                                    <input class="form-control" id="txt_blog_excerpt" name="txt_blog_excerpt" value="<?php echo $row->blog_excerpt ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Content</label>
	                            <textarea class="form-control" id="txt_blog_content2" name="txt_blog_content" rows="3"><?php echo $row->blog_content ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Publish Date</label>
	                            <div class="input-group date">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input type="text" class="form-control pull-right" id="txt_blog_publish_at_2" name="txt_blog_publish_at"  value="<?php echo $row->blog_publish_at ;?>" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array("publish","draft");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->blog_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_blog_status" name="rdo_blog_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_blog_status" name="rdo_blog_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Image</label><br>
	                                <?php 
	                                if(trim($row->blog_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/blog/<?php echo $row->blog_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_blog" name="img_blog">
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	}

	public function get_category($id)
	{
	    $edit_profile=$this->db->get_where("tbl_category",array("category_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_category/edit/do_update/<?php echo $row->category_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                		<input type="hidden" class="form-control" id="txt_parent_id" name="txt_parent_id" value="<?php echo $row->parent_id ;?>">
	                        <div class="form-group">
	                                    <label>Category</label>
	                                    <input class="form-control" id="txt_category_name" name="txt_category_name" value="<?php echo $row->category_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Description</label>
	                                    <textarea class="form-control" id="txt_category_description" name="txt_category_description" rows="3"><?php echo $row->category_description ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>SEO Slug</label>
	                                    <input class="form-control" id="txt_category_seo_slug" name="txt_category_seo_slug" value="<?php echo $row->category_seo_slug ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Meta Tag Title</label>
	                                    <input class="form-control" id="txt_category_meta_tag_title" name="txt_category_meta_tag_title" value="<?php echo $row->category_meta_tag_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Meta Tag Keywords</label>
	                                    <textarea class="form-control" id="txt_category_meta_tag_keywords" name="txt_category_meta_tag_keywords" rows="3"><?php echo $row->category_meta_tag_keywords ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Meta Tag Description</label>
	                                    <textarea class="form-control" id="txt_category_meta_tag_description" name="txt_category_meta_tag_description" rows="3"><?php echo $row->category_meta_tag_description ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Image</label><br>
	                                <?php 
	                                if(trim($row->category_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/category/<?php echo $row->category_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_category" name="img_category">
	                        </div>
	                        <div class="form-group">
	                                    <label>Sort Order</label>
	                                    <input class="form-control" id="txt_category_sort_order" name="txt_category_sort_order" value="<?php echo $row->category_sort_order ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Status</label>
	                                <?php 
	                                $radio_array=array("Active","In-Active");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->category_status)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_category_status" name="rdo_category_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_category_status" name="rdo_category_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>FA Icon</label>
	                                    <input class="form-control" id="txt_category_fa_icon" name="txt_category_fa_icon" value="<?php echo $row->category_fa_icon ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>FA Image</label><br>
	                                <?php 
	                                if(trim($row->category_fa_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/category/<?php echo $row->category_fa_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_category" name="img_category">
	                        </div>
	                        <div class="form-group">
	                                    <label>Small Image</label><br>
	                                <?php 
	                                if(trim($row->category_small_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/category/<?php echo $row->category_small_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_small_category" name="img_small_category">
	                        </div>
	                        <div class="form-group">
	                                    <label>Banner Image</label><br>
	                                <?php 
	                                if(trim($row->category_banner_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/category/<?php echo $row->category_banner_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_banner_category" name="img_banner_category">
	                        </div>
	                        <div class="form-group">
	                                    <label>Background Image</label><br>
	                                <?php 
	                                if(trim($row->category_background_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/category/<?php echo $row->category_background_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_background_category" name="img_background_category">
	                        </div>
	                        <div class="form-group">
	                                    <label>Cover Image</label><br>
	                                <?php 
	                                if(trim($row->category_cover_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/category/<?php echo $row->category_cover_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_cover_category" name="img_cover_category">
	                        </div>
	                        <div class="form-group">
	                                    <label>Show On Home</label>
	                                <?php 
	                                $radio_array=array("No","Yes");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->category_show_on_home)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_category_show_on_home" name="rdo_category_show_on_home" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_category_show_on_home" name="rdo_category_show_on_home" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Show On Menu</label>
	                                <?php 
	                                $radio_array=array("No","Yes");
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->category_show_on_menu)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_category_show_on_menu" name="rdo_category_show_on_menu" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_category_show_on_menu" name="rdo_category_show_on_menu" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>

	                        <div class="form-group">
                                                    <label>Attribute</label>
                                                    <select class="form-control select2" id="cmb_attribute2[]" name="cmb_attribute[]" multiple="multiple" data-placeholder="Select a Attribute"
                                                    style="width: 100%;">
                                                      <?php
                                                      /*$pre_select_array=array('1','2');
                                
                                                      $category_res=$this->db->get_where('tbl_category',array('category_status'=>'Active'));
                                                      foreach($category_res->result() as $category_row)
                                                      {
                                                        if(in_array($category_row->category_id, $pre_select_array))
                                                        {
                                                            ?>
                                                        <option selected="selected" value="<?php echo $category_row->category_id; ?>">
                                                            <?php echo $category_row->category_name; ?>
                                                        </option>
                                                        <?php 
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <option value="<?php echo $category_row->category_id; ?>">
                                                                <?php echo $category_row->category_name; ?>
                                                            </option>
                                                            <?php     
                                                        }
                                                        
                                                      }
                                                      */

                                                      $cat_attr_res=$this->db->get_where('tbl_category_attribute',array('category_id'=>$row->category_id));
                                                      $attr_array=array();
                                                      foreach($cat_attr_res->result() as $cat_attr_row)
                                                      {
                                                      	$attr_array[]=$cat_attr_row->attribute_id;
                                                      }

                                                      /*
                                                      print("<pre>");
                                                      print_r($attr_array);
                                                      print("</pre>");
                                                      */
                                                      $attribute_res=$this->db->get_where('tbl_attribute');
                                                      foreach($attribute_res->result() as $attribute_row)
                                                      {
                                                      	if(in_array($attribute_row->attribute_id, $attr_array))
                                                        {
                                                            ?>
                                                        ?>
                                                        	<option value="<?php echo $attribute_row->attribute_id; ?>" selected='selected'><?php echo $attribute_row->attribute_display_title; ?></option>
                                                        <?php
                                                    	}
                                                    	else
                                                    	{
                                                    		?>
                                                    		<option value="<?php echo $attribute_row->attribute_id; ?>"><?php echo $attribute_row->attribute_display_title; ?></option>
                                                    		<?php
                                                    	}
                                                      }
                                                      ?>
                                                    </select>
                                        </div>
	                        
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 


	public function get_admin_user($id)
	{
	    $edit_profile=$this->db->get_where("tbl_admin_user",array("admin_user_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_admin_user/edit/do_update/<?php echo $row->admin_user_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Admin User</label>
	                                    <input class="form-control" id="txt_admin_user_name" name="txt_admin_user_name" value="<?php echo $row->admin_user_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Password</label>
	                                    <input class="form-control" id="txt_admin_user_pwd" name="txt_admin_user_pwd" value="<?php echo $row->admin_user_pwd ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Email</label>
	                                    <input class="form-control" id="txt_admin_user_email" name="txt_admin_user_email" value="<?php echo $row->admin_user_email ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Phone</label>
	                                    <input class="form-control" id="txt_admin_user_phone" name="txt_admin_user_phone" value="<?php echo $row->admin_user_phone ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Mobile</label>
	                                    <input class="form-control" id="txt_admin_user_mobile" name="txt_admin_user_mobile" value="<?php echo $row->admin_user_mobile ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>DOJ</label>
	                            <div class="input-group date">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input type="text" class="form-control pull-right" id="txt_admin_user_doj_2" name="txt_admin_user_doj"  value="<?php echo $row->admin_user_doj ;?>" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>Last Login</label>
	                            <div class="input-group date">
	                                <div class="input-group-addon">
	                                    <i class="fa fa-calendar"></i>
	                                </div>
	                                <input type="text" class="form-control pull-right" id="txt_admin_user_last_login_2" name="txt_admin_user_last_login"  value="<?php echo $row->admin_user_last_login ;?>" >
	                            </div>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_attribute($id)
	{
	    $edit_profile=$this->db->get_where("tbl_attribute",array("attribute_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/mange_attribute/edit/do_update/<?php echo $row->attribute_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Attribute Type</label>
	                                <?php 
	                                $radio_array=array('Color/Pattern','Radio','Select');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->attribute_type)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_attribute_type" name="rdo_attribute_type" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_attribute_type" name="rdo_attribute_type" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>

	                                <p><strong>Note : </strong>choose "Select" for multiple selection</p>
	                        </div>
	                        <div class="form-group">
	                                    <label>Name</label>
	                                    <input class="form-control" id="txt_attribute_name" name="txt_attribute_name" value="<?php echo $row->attribute_name ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Title</label>
	                                    <input class="form-control" id="txt_attribute_display_title" name="txt_attribute_display_title" value="<?php echo $row->attribute_display_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Order</label>
	                                    <input class="form-control" id="txt_attribute_order" name="txt_attribute_order" value="<?php echo $row->attribute_order ;?>">
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_attribute_value($id)
	{
	    $edit_profile=$this->db->get_where("tbl_attribute_value",array("attribute_value_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_attribute_value/edit/do_update/<?php echo $row->attribute_value_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <input type="hidden" class="form-control" id="txt_attribute_id" name="txt_attribute_id" value="<?php echo $row->attribute_id ;?>">
	                        <div class="form-group">
	                                    <label>Value</label>
	                                    <input class="form-control" id="txt_attribute_value" name="txt_attribute_value" value="<?php echo $row->attribute_value ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Sort Order</label>
	                                    <input class="form-control" id="txt_attribute_value_order" name="txt_attribute_value_order" value="<?php echo $row->attribute_value_order ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Color Hexcode</label>
	                            <div class="input-group my-colorpicker2">
	                                <input type="text"  id="txt_attribute_value_color_hexcode" name="txt_attribute_value_color_hexcode" class="form-control"  value="<?php echo $row->attribute_value_color_hexcode ;?>">
	                                <div class="input-group-addon">
	                                   <i></i>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                                    <label>Pattern Image</label><br>
	                                    <?php 
	                                    if(trim($row->attribute_value_pattern_img)!="")
	                                    {
	                                    ?>
	                                    	<img src="<?php echo base_url(); ?>files/admin/pattern/<?php echo $row->attribute_value_pattern_img; ?>" width="200px">
	                                    <?php 
	                                	}
	                                    ?>
	                                    <input type="file" id="txt_attribue_value_pattern_img" name="txt_attribue_value_pattern_img">
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	public function get_banner($id)
	{
	    $edit_profile=$this->db->get_where("tbl_banner",array("banner_id"=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	        <div class="box box-primary">
	            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_banner/edit/do_update/<?php echo $row->banner_id ;?>"  enctype="multipart/form-data">
	                <div class="box-body">
	                        <div class="form-group">
	                                    <label>Banner Title</label>
	                                    <input class="form-control" id="txt_banner_title" name="txt_banner_title" value="<?php echo $row->banner_title ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Description</label>
	                                    <textarea class="form-control" id="txt_banner_desc" name="txt_banner_desc" rows="3"><?php echo $row->banner_desc ;?></textarea>
	                        </div>
	                        <div class="form-group">
	                                    <label>Link</label>
	                                    <input class="form-control" id="txt_banner_link" name="txt_banner_link" value="<?php echo $row->banner_link ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Link Label</label>
	                                    <input class="form-control" id="txt_banner_link_label" name="txt_banner_link_label" value="<?php echo $row->banner_link_label ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Banner Group</label>
	                                <?php 
	                                $radio_array=array('Best Deals','Bottom','Place One','Place Two','Place Three','Sidebar');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->banner_group)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_banner_group" name="rdo_banner_group" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_banner_group" name="rdo_banner_group" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Columns</label>
	                                <?php 
	                                $radio_array=array('4','6','8','12');
	                                for($i=0;$i<count($radio_array);$i++)
	                                {
	                                    
	                                    if($radio_array[$i]==$row->banner_columns)
	                                    {
	                                        ?>
	                                        <input type="radio" checked id="rdo_banner_columns" name="rdo_banner_columns" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    else
	                                    {
	                                        ?>
	                                        <input type="radio" id="rdo_banner_columns" name="rdo_banner_columns" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
	                                        <?php
	                                    }
	                                    ?>
	                                    <?php
	                                }
	                                ?>
	                        </div>
	                        <div class="form-group">
	                                    <label>Sort Order</label>
	                                    <input class="form-control" id="txt_banner_sort_order" name="txt_banner_sort_order" value="<?php echo $row->banner_order ;?>">
	                        </div>
	                        <div class="form-group">
	                                    <label>Image</label><br>
	                                <?php 
	                                if(trim($row->banner_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/banner/<?php echo $row->banner_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_banner" name="img_banner">
	                        </div>
	                        <div class="form-group">
	                                    <label>Background Image</label><br>
	                                <?php 
	                                if(trim($row->banner_background_image)!="")
	                                {
	                                ?>
	                                    <img src="<?php echo base_url(); ?>files/admin/banner/<?php echo $row->banner_background_image; ?>" width="200px">
	                                <?php 
	                                }
	                                ?>
	                                <input type="file" id="img_background_banner" name="img_background_banner">
	                        </div>
	                        <div class="form-group">
	                                    <label>Background Color</label>
	                            <div class="input-group my-colorpicker2">
	                                <input type="text"  id="txt_background_color" name="txt_background_color" class="form-control"  value="<?php echo $row->banner_background_color ;?>">
	                                <div class="input-group-addon">
	                                   <i></i>
	                                </div>
	                            </div>
	                        </div>
	                    <button type="submit" class="btn btn-success">Submit</button>
	                    <button type="reset" class="btn btn-default">Reset</button>
	                </div>
	            </form>
	        </div>
	    <?php 
	        }
	    }
	} 

	
	public function get_settings()
	{
	    $edit_profile=$this->db->get_where("tbl_settings");

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	    <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_settings/edit/do_update"  enctype="multipart/form-data">
	        <div class="control-group success">
	        			<div class="col-lg-6">
	        				
						    <div class="form-group">
						    
							  <label>Website Title </label>
							  	<input type="text" id="txt_title" name="txt_title" class="form-control" value="<?php echo $row->settings_website_title; ?>" >
							</div>
							
							<div class="form-group">
							  <label>Meta Keywords </label>
							  	<textarea id="txt_keyword" name="txt_keyword" class="form-control" ><?php echo $row->settings_meta_keywords; ?></textarea>
							</div>
							<div class="form-group">
							  <label>Meta Description </label>
							  
							 	<textarea id="txt_desc" name="txt_desc" class="form-control" ><?php echo $row->settings_meta_keywords; ?></textarea>
							 
							</div>
							<div  class="form-group">
							  <label>Website Name </label>
							  	<input type="text" id="txt_name" name="txt_name" class="form-control" value="<?php echo $row->settings_website_title; ?>" >
							  
							</div>
							
							<div  class="form-group">
							  <label>Currency Code </label>
							  	<input type="text" id="txt_code" name="txt_code" class="form-control" value="<?php echo $row->settings_currency_code; ?>" >
							  
							</div>
							<div class="form-group">
							  <label >Currency Symbol </label>
							  	<input type="text" id="txt_symbol" name="txt_symbol" class="form-control" value="<?php echo $row->settings_currency_symbol; ?>" >
							  
							</div>
							<div class="form-group">
							  <label class="control-label" for="typeahead">Address </label>
							  	<textarea id="txt_addr" name="txt_addr" class="form-control" ><?php echo $row->settings_address; ?></textarea>
							  
							</div>
							<div  class="form-group">
							  <label >Phone </label>
							  	<input type="text" id="txt_phone" name="txt_phone" class="form-control" value="<?php echo $row->settings_phone; ?>" >
							  
							</div>
							<div class="form-group">
							  <label >Fax </label>
							  	<input type="text" id="txt_fax" name="txt_fax" class="form-control" value="<?php echo $row->settings_fax; ?>" >
							  
							</div>
							<div class="form-group">
							  <label >Contact Email </label>
							  	<input type="text" id="txt_email" name="txt_email" class="form-control" value="<?php echo $row->settings_contact_email; ?>" >
							  
							</div>
							<div class="form-group">
							  <label >Map Address </label>
							 
								<input type="text" id="txt_map_addr" name="txt_map_addr" class="form-control" value="<?php echo $row->settings_map_address; ?>" >
							</div>
							<div class="form-group">
							  <label >Toll Free Number </label>
							 
								<input type="text" id="txt_toll_free" name="txt_toll_free" class="form-control" value="<?php echo $row->settings_toll_free; ?>" >
							 
							</div>
							<div class="form-group">
							  	<label >Minimum Single Piece Qty</label>
							  	  	<input class="form-control"  id="txt_single_min_qty" name="txt_single_min_qty" type="text"   value="<?php echo $row->settings_single_min_qty; ?>">
								  
							</div>

							<div class="form-group">
							  	<label >Minimum Total Piece Qty</label>
							  	  	<input class="form-control" id="txt_total_min_qty" name="txt_total_min_qty" type="text"   value="<?php echo $row->settings_total_min_qty; ?>">
								  
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							  <label >Logo </label>
							  	<br>
							  	<img height='100px' src="<?php echo base_url().'files/admin/logo/'.$row->settings_logo; ?>" >
							  	<input type="file" id="img_logo" name="img_logo" >
							  
							</div>
							<div class="form-group">
							  <label>Small Logo </label>
							  	<br>
							  	<img height='100px' src="<?php echo base_url().'files/admin/logo/'.$row->settings_small_logo; ?>" >
								<input type="file" id="img_logo_small" name="img_logo_small"  >
							 
							</div>	
							<div class="form-group">
							  <label>Footer Logo </label>
							  	<br>
							  	<img height='100px' src="<?php echo base_url().'files/admin/logo/'.$row->settings_footer_logo; ?>" >
								<input type="file" id="img_logo_footer" name="img_logo_footer" >
							 
							</div>	
							<div class="form-group">
							  <label >Favicon</label>
							  <br>
							  	<img height='100px' src="<?php echo base_url().'files/admin/logo/'.$row->settings_favicon; ?>" >
								<input type="file" id="img_favicon" name="img_favicon" class="span6 typeahead"  >
							  
							</div>
							<div class="form-group">
							  <label >Facebook Url </label>
							  	<input type="text" id="txt_fb_url" name="txt_fb_url" class="form-control" value="<?php echo $row->facebook_url; ?>" >
							  
							</div>	
							<div class="form-group">
							  <label >Google+ Url</label>
							  	<input type="text" id="txt_google_url" name="txt_google_url" class="form-control" value="<?php echo $row->google_plus_url; ?>" >
							  
							</div>

							<div class="form-group">
							  <label >Twitter Url</label>
							  	<input type="text" id="txt_twitter_url" name="txt_twitter_url" class="form-control" value="<?php echo $row->twitter_url; ?>" >
							  
							</div>

							<div class="form-group">
							  <label >Pinterest Url</label>
							  	<input type="text" id="txt_linkedin_url" name="txt_linkedin_url" class="form-control" value="<?php echo $row->pinterest_url; ?>" >
							  
							</div>

							<div class="form-group">
							  <label >Instagram Url</label>
							  	<input type="text" id="txt_instagram_url" name="txt_instagram_url" class="form-control" value="<?php echo $row->instagram_url; ?>" >
							  
							</div>


							<div class="form-group">
							  	<label >Show Badges</label>
							  	  	<input id="inlineCheckbox1"  id="chk_show_badges" name="chk_show_badges" type="checkbox"  <?php if(trim($row->settings_show_badges)=="1"){echo " checked='checked'";}  ?> value="1">
								  
							</div>

							<div class="form-group">
							  <label>Popup Iamge </label>
							  	<br>
							  	<img height='100px' src="<?php echo base_url().'files/admin/popup/'.$row->settings_popup_iamge; ?>" >
								<input type="file" id="settings_popup_iamge" name="settings_popup_iamge"  >
							</div>	

							<div class="form-group">
							  <label>Popup Content</label>
							  	<br>
								  <input type="text" id="txt_settings_popup_content" name="txt_settings_popup_content" class="form-control" value="<?php echo $row->settings_popup_content; ?>" >

							</div>
							<div class="form-group">
							  <label>Popup BigText Content</label>
							  	<br>
								  <input type="text" id="txt_settings_popup_big_txt_content" name="txt_settings_popup_big_txt_content" class="form-control" value="<?php echo $row->settings_popup_content; ?>" >

							</div>

							
						</div>
						<div class="col-lg-12">

							
	        <button type="submit" class="btn btn-success">Submit</button>
	        <button type="reset" class="btn btn-default">Reset</button>
	        	</div>
	    </form>
	    <?php 
	        }
	    }
	} 

	

	public function get_cms()
	{
	    $edit_profile=$this->db->get("tbl_cms");

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	    <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_cms/edit/do_update"  enctype="multipart/form-data">
	    	<div class="col-lg-6">

		        <div class="form-group">
		                    <label>About Us</label>
		                    <textarea class="form-control" id="txt_about_us" name="txt_about_us" rows="3"><?php echo $row->cms_about_us ;?></textarea>
		        </div>
		        <div class="form-group">
		                    <label>Privacy Policy</label>
		                    <textarea class="form-control" id="txt_privacy_policy" name="txt_privacy_policy" rows="3"><?php echo $row->cms_privacy_policy ;?></textarea>
		        </div>
		        <div class="form-group">
		                    <label>Copy Right</label>
		                    <textarea class="form-control" id="txt_copy_right" name="txt_copy_right" rows="3"><?php echo $row->cms_copy_right ;?></textarea>
		        </div>
		        <div class="form-group">
		                    <label>Trade Mark</label>
		                    <textarea class="form-control" id="txt_trademark" name="txt_trademark" rows="3"><?php echo $row->cms_trademark ;?></textarea>
		        </div>
	        </div>
	        <div class="col-lg-6">
		        <div class="form-group">
		                    <label>Terms & Conditions</label>
		                    <textarea class="form-control" id="txt_terms_conditions" name="txt_terms_conditions" rows="3"><?php echo $row->cms_terms_conditions ;?></textarea>
		        </div>
		        <div class="form-group">
		                    <label>Contact Us</label>
		                    <textarea class="form-control" id="txt_contact_us" name="txt_contact_us" rows="3"><?php echo $row->cms_contact_us ;?></textarea>
		        </div>
		        <div class="form-group">
		                    <label>Bank Details</label>
		                    <textarea class="form-control" id="txt_bank_details" name="txt_bank_details" rows="3"><?php echo $row->cms_bank_details ;?></textarea>
		        </div>
	        </div>
	        <div class="col-lg-12">
	        <button type="submit" class="btn btn-success">Submit</button>
	        <button type="reset" class="btn btn-default">Reset</button>
	        </div>
	    </form>
	    <?php 
	        }
	    }
	}

	
	
	public function change_status($order_id,$order_status)
	{
		$data['order_status']=$order_status;
		$this->db->where('order_id',$order_id);
		$this->db->update('tbl_order',$data);
		echo '<div class="alert alert-success">
          		<a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Order Status Changed Successfully to : '.$order_status.'</strong>
          	</div>';
	}  
}
?>