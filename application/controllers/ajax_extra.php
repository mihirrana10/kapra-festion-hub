public function get_asset_client($id)
	{
	    $edit_profile=$this->db->get_where("tbl_asset_client",array(""=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	   <!--<form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_asset_client/edit/do_update/<?php echo $row-> ;?>">-->
	        <div class="form-group">
	                    <label>Asset</label>
	                    <select class="form-control"  id="cmb_asset" name="cmb_asset">
	                    <?php 
	                    $select_res    = $this->db->get("tbl_asset");
	                    foreach($select_res->result() as $select_row)
	                    {
	                        if($select_row->asset_id == $row->asset_id)
	                        {
	                            echo "<option value=".$select_row->asset_id." selected>".$select_row->asset_serial_number."</option>";
	                        }
	                        else
	                        {
	                            echo "<option value=".$select_row->asset_id.">".$select_row->asset_serial_number."</option>";
	                        }
	                    }
	                    ?>
	                    </select>
	        </div>
	        <div class="form-group">
	                    <label>Client</label>
	                    <select class="form-control"  id="cmb_client" name="cmb_client">
	                    <?php 
	                    $select_res    = $this->db->get("tbl_client");
	                    foreach($select_res->result() as $select_row)
	                    {
	                        if($select_row->client_id == $row->client_id)
	                        {
	                            echo "<option value=".$select_row->client_id." selected>".$select_row->client_name."</option>";
	                        }
	                        else
	                        {
	                            echo "<option value=".$select_row->client_id.">".$select_row->client_name."</option>";
	                        }
	                    }
	                    ?>
	                    </select>
	        </div>
	        <div class="form-group">
	                    <label>Location</label>
	                    <select class="form-control"  id="cmb_location" name="cmb_location">
	                    <?php 
	                    $select_res    = $this->db->get("tbl_location");
	                    foreach($select_res->result() as $select_row)
	                    {
	                        if($select_row->location_id == $row->location_id)
	                        {
	                            echo "<option value=".$select_row->location_id." selected>".$select_row->location_name."</option>";
	                        }
	                        else
	                        {
	                            echo "<option value=".$select_row->location_id.">".$select_row->location_name."</option>";
	                        }
	                    }
	                    ?>
	                    </select>
	        </div>
	        <div class="form-group">
	                    <label>Asset Tag</label>
	                    <input class="form-control" id="txt_asset_tag" name="txt_asset_tag" value="<?php echo $row->asset_tag ;?>">
	        </div>
	        <div class="form-group">
	                    <label>Asset Name</label>
	                    <input class="form-control" id="txt_asset_name" name="txt_asset_name" value="<?php echo $row->asset_name ;?>">
	        </div>
	        <div class="form-group">
	                    <label>Asset Join Date</label>
	                    <input class="form-control" id="txt_asset_join_date" name="txt_asset_join_date" value="<?php echo $row->asset_join_date ;?>">
	        </div>
	        <div class="form-group">
	                    <label>Asset Removal Date</label>
	                    <input class="form-control" id="txt_asset_removal_date" name="txt_asset_removal_date" value="<?php echo $row->asset_removal_date ;?>">
	        </div>
	        <div class="form-group">
	                    <label>Asset Condition</label>
	                    <textarea class="form-control" id="txt_asset_condition" name="txt_asset_condition" rows="3"><?php echo $row->asset_condition ;?></textarea>
	        </div>
	        <button type="submit" class="btn btn-success">Submit</button>
	        <button type="reset" class="btn btn-default">Reset</button>
	    </form>
	    <?php 
	        }
	    }
	} 

	
	public function get_license_client($id)
	{
	    $edit_profile=$this->db->get_where("tbl_license_client",array(""=>$id));

	    if(isset($edit_profile))
	    {
	        foreach($edit_profile->result() as $row)
	        {
	    ?>
	    <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_license_client/edit/do_update/<?php echo $row-> ;?>">
	        <div class="form-group">
	                    <label>License</label>
	                    <select class="form-control"  id="cmb_license" name="cmb_license">
	                    <?php 
	                    $select_res    = $this->db->get("tbl_license");
	                    foreach($select_res->result() as $select_row)
	                    {
	                        if($select_row->license_id == $row->license_id)
	                        {
	                            echo "<option value=".$select_row->license_id." selected>".$select_row->license_serial_number."</option>";
	                        }
	                        else
	                        {
	                            echo "<option value=".$select_row->license_id.">".$select_row->license_serial_number."</option>";
	                        }
	                    }
	                    ?>
	                    </select>
	        </div>
	        <div class="form-group">
	                    <label>Client</label>
	                    <select class="form-control"  id="cmb_client" name="cmb_client">
	                    <?php 
	                    $select_res    = $this->db->get("tbl_client");
	                    foreach($select_res->result() as $select_row)
	                    {
	                        if($select_row->client_id == $row->client_id)
	                        {
	                            echo "<option value=".$select_row->client_id." selected>".$select_row->client_name."</option>";
	                        }
	                        else
	                        {
	                            echo "<option value=".$select_row->client_id.">".$select_row->client_name."</option>";
	                        }
	                    }
	                    ?>
	                    </select>
	        </div>
	        <div class="form-group">
	                    <label>License Tag</label>
	                    <input class="form-control" id="txt_license_tag" name="txt_license_tag" value="<?php echo $row->license_tag ;?>">
	        </div>
	        <div class="form-group">
	                    <label>License Name</label>
	                    <input class="form-control" id="txt_license_name" name="txt_license_name" value="<?php echo $row->license_name ;?>">
	        </div>
	        <div class="form-group">
	                    <label>License Join(Add) Date</label>
	                    <input class="form-control" id="txt_license_join_date" name="txt_license_join_date" value="<?php echo $row->license_join_date ;?>">
	        </div>
	        <div class="form-group">
	                    <label>License Removal Date</label>
	                    <input class="form-control" id="txt_license_removal_date" name="txt_license_removal_date" value="<?php echo $row->license_removal_date ;?>">
	        </div>
	        <div class="form-group">
	                    <label>Assigned Asset</label>
	                    <select class="form-control"  id="cmb_asset_client" name="cmb_asset_client">
	                    <?php 
	                    $select_res    = $this->db->get("tbl_asset");
	                    foreach($select_res->result() as $select_row)
	                    {
	                        if($select_row->asset_id == $row->asset_client_id)
	                        {
	                            echo "<option value=".$select_row->asset_id." selected>".$select_row->asset_serial_number."</option>";
	                        }
	                        else
	                        {
	                            echo "<option value=".$select_row->asset_id.">".$select_row->asset_serial_number."</option>";
	                        }
	                    }
	                    ?>
	                    </select>
	        </div>
	        <button type="submit" class="btn btn-success">Submit</button>
	        <button type="reset" class="btn btn-default">Reset</button>
	    </form>
	    <?php 
	        }
	    }
	} 