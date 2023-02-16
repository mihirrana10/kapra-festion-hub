
<aside class="col-lg-2 order-lg-first">
   <div class="sidebar sidebar-shop" >
      <div class="widget widget-clean">
         <a href="#" class="sidebar-filter-clear">Clean All</a>
      </div>
      <!-- End .widget widget-clean -->
      <?php 
        						$this->db->order_by('attribute_order','asc');
        						$attribute_res=$this->db->get_where('tbl_attribute');
        						$cnt=10;
        						foreach($attribute_res->result() as $attribute_row)
        						{
        							$attribute_type=$attribute_row->attribute_type;
        							?>
      <div class="widget widget-collapsible">
         <h3 class="widget-title">
            <a data-toggle="collapse" href="#widget-<?php echo $cnt; ?>" role="button" aria-expanded="true" aria-controls="widget-<?php echo $cnt; ?>">
                                       <?php echo $attribute_row->attribute_display_title; ?>
            </a>
         </h3>
         <!-- End .widget-title -->
         <?php 
										if($attribute_type=="Select")
										{
										?>
											<div class="collapse show" id="widget-<?php echo $cnt; ?>">
												<div class="widget-body">
													<div class="filter-items">
														<?php 
														$attr_value_res=$this->db->get_where('tbl_attribute_value',array('attribute_id'=>$attribute_row->attribute_id));
														foreach($attr_value_res->result() as 
															$attr_value_row)
														{
														?>
														<div class="filter-item">
															<div class="custom-control custom-checkbox">
																<input

																
																 type="checkbox" 

																<?php 
																// if(in_array($attr_value_row->attribute_value_id, $attr_array))
																// {
																// 	echo "checked='checked'";
																// }
																?>
																class="custom-control-input" id="search-attr-<?php echo $attr_value_row->attribute_value_id; ?>">
																<label class="custom-control-label" for="search-attr-<?php echo $attr_value_row->attribute_value_id; ?>"><?php echo $attr_value_row->attribute_value; ?></label>
															</div><!-- End .custom-checkbox -->
														</div><!-- End .filter-item -->
														<?php 
														}
														?>

														
													</div><!-- End .filter-items -->
												</div><!-- End .widget-body -->
											</div><!-- End .collapse -->
										<?php 
										}
										else if($attribute_type=="Color/Pattern")
										{
										?>
											<div class="collapse show" id="widget-<?php echo $cnt; ?>">
												<div class="widget-body">
													<div class="filter-colors">
													<?php 
														$attr_value_res=$this->db->get_where('tbl_attribute_value',array('attribute_id'=>$attribute_row->attribute_id));
														foreach($attr_value_res->result() as 
															$attr_value_row)
														{
															?>
															<a 

															

															

															 style="background:<?php echo $attr_value_row->attribute_value_color_hexcode; ?>"><span class="sr-only"><?php echo $attr_value_row->attribute_value; ?></span>
															 <?php
															 if(trim($attr_value_row->attribute_value_pattern_img)!="")
															{
															 	?>
															 <img src="<?php echo base_url(); ?>files/admin/pattern/<?php echo $attr_value_row->attribute_value_pattern_img; ?>">
															 <?php 
															}
															 ?>
															</a>
															<?php
														}
														?>
														<!--<a href="#" style="background: #b87145;"><span class="sr-only">Color Name</span></a>
														<a href="#" style="background: #f0c04a;"><span class="sr-only">Color Name</span></a>
														<a href="#" style="background: #333333;"><span class="sr-only">Color Name</span></a>
														<a href="#" class="selected" style="background: #cc3333;"><span class="sr-only">Color Name</span></a>
														<a href="#" style="background: #3399cc;"><span class="sr-only">Color Name</span></a>
														<a href="#" style="background: #669933;"><span class="sr-only">Color Name</span></a>
														<a href="#" style="background: #f2719c;"><span class="sr-only">Color Name</span></a>
														<a href="#" style="background: #ebebeb;"><span class="sr-only">Color Name</span></a>-->
													</div><!-- End .filter-colors -->
												</div><!-- End .widget-body -->
											</div><!-- End .collapse -->
										<?php 
										}
										?>
      </div>
      <?php
        							$cnt++;
        						}
        						?>
  
      
      <!-- End .widget -->
   </div>
   <!-- End .sidebar sidebar-shop -->
</aside>