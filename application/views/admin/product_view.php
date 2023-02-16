<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Product</h4>
        </div>
        <div class="modal-body">
            <!-- Add Modal Form -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-primary">
                            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_product/create" enctype="multipart/form-data">
                                <div class="box-body">
                                        <div class="form-group">
                                                    <label>Product Name</label>
                                                    <input class="form-control" id="txt_product_name" name="txt_product_name" onblur="get_slug(this.value);">
                                        </div>
                                        <script type="text/javascript">
                                            function get_slug(product_name)
                                            {
                                                var slug;
                                                slug = product_name.replace(/ /g, "-");
                                                document.getElementById('txt_product_seo_slug').value=slug;
                                            }

                                            function get_slug2(product_name)
                                            {
                                                var slug;
                                                slug = product_name.replace(/ /g, "-");
                                                document.getElementById('txt_product_seo_slug2').value=slug;
                                            }

                                        </script>
                                        <div class="form-group">
                                                    <label>SEO Slug</label>
                                                    <input class="form-control" id="txt_product_seo_slug" name="txt_product_seo_slug">
                                        </div>
                                        <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" id="txt_product_description" name="txt_product_description" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                                    <label>Meta Title</label>
                                                    <input class="form-control" id="txt_product_meta_title" name="txt_product_meta_title">
                                        </div>
                                        <div class="form-group">
                                                    <label>Meta Tag Keywords</label>
                                                    <textarea class="form-control" id="txt_product_meta_tag_keywords" name="txt_product_meta_tag_keywords" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                                    <label>Meta Tag Description</label>
                                                    <textarea class="form-control" id="txt_product_meta_tag_description" name="txt_product_meta_tag_description" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                                    <label>Model Number</label>
                                                    <input class="form-control" id="txt_product_model_no" name="txt_product_model_no">
                                        </div>
                                        <div class="form-group">
                                                    <label>SKU</label>
                                                    <input class="form-control" id="txt_product_sku" name="txt_product_sku">
                                        </div>
                                        <div class="form-group">
                                                    <label>UPC</label>
                                                    <input class="form-control" id="txt_product_upc" name="txt_product_upc">
                                        </div>
                                        <div class="form-group">
                                                    <label>EAN</label>
                                                    <input class="form-control" id="txt_product_ean" name="txt_product_ean">
                                        </div>
                                        <div class="form-group">
                                                    <label>JAN</label>
                                                    <input class="form-control" id="txt_product_jan" name="txt_product_jan">
                                        </div>
                                        <div class="form-group">
                                                    <label>ISBN</label>
                                                    <input class="form-control" id="txt_product_isbn" name="txt_product_isbn">
                                        </div>
                                        <div class="form-group">
                                                    <label>MPN</label>
                                                    <input class="form-control" id="txt_product_mpn" name="txt_product_mpn">
                                        </div>
                                        <div class="form-group">
                                                    <label>MRP</label>
                                                    <input class="form-control" id="txt_product_mrp" name="txt_product_mrp">
                                        </div>
                                        <div class="form-group">
                                                    <label>Selling Price</label>
                                                    <input class="form-control" id="txt_product_selling_price" name="txt_product_selling_price">
                                        </div>
                                        <div class="form-group">
                                                    <label>Tax Class</label>
                                                    <?php 
                                                    $radio_array=array('None','Taxable Goods','Downloadable Goods');
                                                    for($i=0;$i<count($radio_array);$i++)
                                                    {
                                                        ?>
                                                        <input type="radio" id="rdo_product_tax_class" name="rdo_product_tax_class" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
                                                        <?php
                                                    }
                                                    ?>
                                        </div>
                                        <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input class="form-control" id="txt_product_quantity" name="txt_product_quantity">
                                        </div>
                                        <div class="form-group">
                                                    <label>Minimum Quantity</label>
                                                    <input class="form-control" id="txt_product_min_quantity" name="txt_product_min_quantity">
                                        </div>
                                        <div class="form-group">
                                                    <label>Out of Stock Status</label>
                                                    <?php 
                                                    $radio_array=array('2-3 Days','In-Stock','Out of Stock','Pre Order');
                                                    for($i=0;$i<count($radio_array);$i++)
                                                    {
                                                        ?>
                                                        <input type="radio" id="rdo_product_out_of_stock_status" name="rdo_product_out_of_stock_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
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
                                                        ?>
                                                        <input type="radio" id="rdo_product_require_shipping" name="rdo_product_require_shipping" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
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
                                                      <input type="text" class="form-control pull-right" id="txt_product_available_date" name="txt_product_available_date" >
                                                    </div>
                                        </div>
                                        <div class="form-group">
                                                    <label>Length</label>
                                                    <input class="form-control" id="txt_product_dimension_length" name="txt_product_dimension_length">
                                        </div>
                                        <div class="form-group">
                                                    <label>Width</label>
                                                    <input class="form-control" id="txt_product_dimension_width" name="txt_product_dimension_width">
                                        </div>
                                        <div class="form-group">
                                                    <label>Height</label>
                                                    <input class="form-control" id="txt_product_dimension_height" name="txt_product_dimension_height">
                                        </div>
                                        <div class="form-group">
                                                    <label>Length Class</label>
                                                    <?php 
                                                    $radio_array=array('Centimeter','Milimeter','Inch');
                                                    for($i=0;$i<count($radio_array);$i++)
                                                    {
                                                        ?>
                                                        <input type="radio" id="rdo_product_length_class" name="rdo_product_length_class" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
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
                                                        ?>
                                                        <input type="radio" id="rdo_product_weight_class" name="rdo_product_weight_class" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
                                                        <?php
                                                    }
                                                    ?>
                                        </div>
                                        <div class="form-group">
                                                    <label>Weight</label>
                                                    <input class="form-control" id="txt_product_weight" name="txt_product_weight">
                                        </div>
                                        <div class="form-group">
                                                    <label>Status</label>
                                                    <?php 
                                                    $radio_array=array("Active","In-Active");
                                                    for($i=0;$i<count($radio_array);$i++)
                                                    {
                                                        ?>
                                                        <input type="radio" id="rdo_product_status" name="rdo_product_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
                                                        <?php
                                                    }
                                                    ?>
                                        </div>
                                        <div class="form-group">
                                                    <label>Sort Order</label>
                                                    <input class="form-control" id="txt_product_sort_order" name="txt_product_sort_order">
                                        </div>
                                        <div class="form-group">
                                                    <label>Base Image</label>
                                                    <input type="file" id="img_product" name="img_product">
                                        </div>
                                        
                                        <div class="form-group">
                                                    <label>Is Bundled</label>
                                                    <?php 
                                                    $radio_array=array("No","Yes");
                                                    for($i=0;$i<count($radio_array);$i++)
                                                    {
                                                        ?>
                                                        <input type="radio" id="rdo_product_is_bundled" name="rdo_product_is_bundled" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
                                                        <?php
                                                    }
                                                    ?>
                                        </div>
                                        <div class="form-group">
                                                    <label>Manufacturer</label>
                                                    <input class="form-control" id="txt_manufacturer_id" name="txt_manufacturer_id">
                                        </div>
                                        <div class="form-group">
                                                    <label>Category</label>
                                                    <!--<input class="form-control" id="txt_category_id" name="txt_category_id">-->
                                                    <select class="form-control select2" id="cmb_category[]" name="cmb_category[]" multiple="multiple" data-placeholder="Select a Category"
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
                                                      $category_res=$this->db->get_where('tbl_category');
                                                      foreach($category_res->result() as $category_row)
                                                      {
                                                        ?>
                                                        <option value="<?php echo $category_row->category_id; ?>"><?php echo $category_row->category_name; ?></option>
                                                        <?php
                                                      }
                                                      ?>
                                                    </select>
                                        </div>
                                        <div class="form-group">
                                                    <label>Attribute Value</label>
                                                    <select class="form-control select2" id="cmb_attribute[]" name="cmb_attribute[]" multiple="multiple" data-placeholder="Select a Attribute"
                                                    style="width: 100%;">
                                                      <?php
                                                      $this->db->join('tbl_attribute','tbl_attribute_value.attribute_id=tbl_attribute.attribute_id');
                                                      $attr_value_res=$this->db->get_where('tbl_attribute_value');
                                                      foreach($attr_value_res->result() as $attr_value_row)
                                                      {
                                                        ?>
                                                        <option value="<?php echo $attr_value_row->attribute_value_id; ?>"><?php echo $attr_value_row->attribute_name." > ".$attr_value_row->attribute_value; ?></option>
                                                        <?php
                                                      }
                                                      ?>
                                                    </select>
                                        </div>
                                        <div class="form-group">
                                                    <label>Related Products</label>
                                                    <select class="form-control select2" id="cmb_related_products[]" name="cmb_related_products[]" multiple="multiple" data-placeholder="Select a Product"
                                                    style="width: 100%;">
                                                      <?php
                                                      
                                                      $related_product_res=$this->db->get_where('tbl_product_new');
                                                      foreach($related_product_res->result() as $relate_product_row)
                                                      {
                                                        ?>
                                                        <option value="<?php echo $relate_product_row->product_id; ?>"><?php echo $relate_product_row->product_name; ?></option>
                                                        <?php
                                                      }
                                                      ?>
                                                    </select>
                                        </div>
                                        
                                         

                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </form>
                            
                        </div></div>
                    
                </div>
            <!-- Add Modal Form Ends -->
        </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>

<div class="content-wrapper">
    
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                  <!--<h3 class="box-title" style="font-size:25px">Product List</h3>
                <label style="float:right">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New Product</button>
                </label>-->


                <div class="row">
                    <div class="col-md-6">
                        <h3 class="box-title" style="font-size:25px">Product List</h3>
                    </div><div class="col-md-3">
                        <form id="search_form" name="search_form" method="post" action="<?php echo base_url()."admin/manage_product/search/"; ?>">
                                        <div class="form-group" style="float:right">
                                                <!--<label>Search: -->
                                                    <input class="form-control" type="text" id="txt_search" name="txt_search" placeholder="Search product name"  onKeyDown="submit_form(event);"
                                                value="<?php if(isset($search_data))
                                                {echo $search_data; }?>">
                                                <!--</label>-->
                                        </div>
                        </form>
                        <script type="text/javascript">
                            function submit_form(event)
                            {
                                //alert(event.keyCode);
                                if (event.keyCode == 13) 
                                {
                                    //window.location="http://www.google.com";
                                    document.getElementById("search_form").submit();
                                }
                            }
                        </script>
                    </div>
                    <div class="col-md-3">
                        <label style="float:right">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New Product</button>
                        </label>
                    </div>
                        
                </div>
            </div>


            <div class="box-body table-responsive no-padding">
            
                <table class="table table-bordered table-hover">
                              <thead>
                                  <th>#</th>
                                <th>Product Name</th>
                                <th>SEO Slug</th>
                                <!--<th>Description</th>
                                <th>Meta Title</th>
                                <th>Meta Tag Keywords</th>
                                <th>Meta Tag Description</th>-->
                                <th>Model Number</th>
                                <th>SKU</th>
                                <!--<th>UPC</th>
                                <th>EAN</th>
                                <th>JAN</th>
                                <th>ISBN</th>
                                <th>MPN</th>-->
                                <th>MRP</th>
                                <th>Selling Price</th>
                                <!--<th>Tax Class</th>
                                <th>Quantity</th>
                                <th>Minimum Quantity</th>
                                <th>Out of Stock Status</th>
                                <th>Require Shipping</th>
                                <th>Available Date</th>
                                <th>Length</th>
                                <th>Width</th>
                                <th>Height</th>
                                <th>Length Class</th>
                                <th>Weight Class</th>
                                <th>Weight</th>
                                <th>Status</th>
                                <th>Sort Order</th>-->
                                <th>Base Image</th>
                                <!--<th>SEO Slug</th>
                                <th>Is Bundled</th>
                                <th>Manufacturer</th>
                                <th>Category</th>-->
                                <th>More Images</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            <?php
                            if(!isset($start_position))
                            {
                                $i=1;
                            }
                            else
                            {
                                $i=$start_position;
                            }


                            //$resultset=$this->db->get_where('tbl_product_new');

                            foreach($resultset->result() as $result_row)
                            {
                                //if(!file_exists("files/admin/product/".$result_row->product_image))
                                //{
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                            <td><?php echo $result_row->product_name; ?></td>
                                            <td><?php echo $result_row->product_seo_slug; ?></td>
                                            <!--<td><?php echo $result_row->product_description; ?></td>
                                            <td><?php echo $result_row->product_meta_title; ?></td>
                                            <td><?php echo $result_row->product_meta_tag_keywords; ?></td>
                                            <td><?php echo $result_row->product_meta_tag_description; ?></td>-->
                                            <td><?php echo $result_row->product_model_no; ?></td>
                                            <td><?php echo $result_row->product_sku; ?></td>
                                            <!--<td><?php echo $result_row->product_upc; ?></td>
                                            <td><?php echo $result_row->product_ean; ?></td>
                                            <td><?php echo $result_row->product_jan; ?></td>
                                            <td><?php echo $result_row->product_isbn; ?></td>
                                            <td><?php echo $result_row->product_mpn; ?></td>-->
                                            <td><?php echo $result_row->product_mrp; ?></td>
                                            <td><?php echo $result_row->product_selling_price; ?></td>
                                            <!--<td><?php echo $result_row->product_tax_class; ?></td>
                                            <td><?php echo $result_row->product_quantity; ?></td>
                                            <td><?php echo $result_row->product_min_quantity; ?></td>
                                            <td><?php echo $result_row->product_out_of_stock_status; ?></td>
                                            <td><?php echo $result_row->product_require_shipping; ?></td>
                                            <td><?php echo $result_row->product_available_date; ?></td>
                                            <td><?php echo $result_row->product_dimension_length; ?></td>
                                            <td><?php echo $result_row->product_dimension_width; ?></td>
                                            <td><?php echo $result_row->product_dimension_height; ?></td>
                                            <td><?php echo $result_row->product_length_class; ?></td>
                                            <td><?php echo $result_row->product_weight_class; ?></td>
                                            <td><?php echo $result_row->product_weight; ?></td>
                                            <td><?php echo $result_row->product_status; ?></td>
                                            <td><?php echo $result_row->product_sort_order; ?></td>-->
                                            <td>
                                            <?php 
                                                if(trim($result_row->product_image)!="")
                                                {
                                                ?>
                                            <img src="<?php echo base_url(); ?>files/admin/product/thumb/<?php echo $result_row->product_image; ?>" width="75px">
                                                <?php 
                                                }
                                                ?>
                                            </td>
                                            <!--<td><?php echo $result_row->product_seo_slug; ?></td>
                                            <td><?php echo $result_row->product_is_bundled; ?></td>
                                            <td><?php echo $result_row->manufacturer_id; ?></td>
                                            <td><?php echo $result_row->category_id; ?></td>-->
                                            <td>
                                                <a href="<?php echo base_url(); ?>admin/manage_product_additional_image/<?php echo $result_row->product_id; ?>" class="btn btn-info" ><em class="fa fa-image"></em></a>
                                            </td>
                                            <td>
                                                <a class="btn btn-success" class="btn btn-info" data-toggle="modal" data-target="#editModal" onclick="get_edit_data(<?php echo $result_row->product_id; ?>);"><em class="fa fa-pencil"></em></a>
                                                <a class="btn btn-danger confirm-delete" data-id="<?php echo $result_row->product_id; ?>"><em class="fa fa-trash-o"></em></a>
                                            </td>
                                    </tr>
                                    <?php
                                        $i++;
                                //}
                            } 
                            ?>
                            </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <?php 
                    if(isset($paging_string))
                    {
                        echo $paging_string; 
                    }
                ?>
              </ul>
            </div>
          </div>
           </div>
      </div>
    </section>
<!-- /.container-fluid -->
</div>
<script type="text/javascript">
function confirmDelete()
{
  return confirm("Are you sure you want to delete this?");
}
</script>
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Product</h4>
        </div>
        <div class="modal-body">
            <!-- Edit Modal Form -->
                <div class="row">
                    <div class="col-lg-12" id="edit_div">
                    </div>
                </div>
            <!-- Edit Modal Form Ends -->
        </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>
<script type="text/javascript">
            var controller = "ajax/get_product";
            var base_url = "<?php echo base_url(); ?>";

     function getXMLHTTP() { //fuction to return the xml http object
        var xmlhttp=false;  
        try{
            xmlhttp=new XMLHttpRequest();
        }
        catch(e)    {       
            try{            
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e){
                try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e){
                    xmlhttp=false;
                }
            }
        }
            
        return xmlhttp;
    }

    function get_edit_data(primary_id)
    {       
        var strURL=base_url+controller+"/"+primary_id;
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                    //alert(req.responseText);                      
                        document.getElementById("edit_div").innerHTML=req.responseText;

                            $('.select2').select2()
                        
                            CKEDITOR.replace( "txt_product_description2", {
                                fullPage: true,
                                allowedContent: true,
                                extraPlugins: "wysiwygarea"
                                 
                                });
                            
                            $('#txt_product_available_date_2').datepicker({
                                format: 'yyyy-mm-dd',
                                autoclose: true
                            })
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }               
            }           
            req.open("GET", strURL, true);
            req.send(null);
            
        }
    }

    
</script>
<div id="deleteModal"  class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" aria-hidden="true" class="close">X</a>
                 <h3>Delete Product</h3>
            </div>
                <div class="modal-body">
                    <p>You are about to delete.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                        <a href="#" id="btnYes" class="btn btn-sm btn-danger">Yes</a>
                        <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-success">No</a>
                    
                </div>
            
        </div>
    </div>
</div>
<script>
$('#deleteModal').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#deleteModal').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
    var id = $('#deleteModal').data('id');
    //$('[data-id='+id+']').remove();
    window.location=base_url+'admin/manage_product/delete/'+id;
    $('#deleteModal').modal('hide');
});
</script>
<script src='<?php echo base_url(); ?>template/ckeditor/ckeditor.js'></script>
<script>
  $(function () {
      
                                            CKEDITOR.replace( "txt_product_description", {
                                                fullPage: true,
                                                allowedContent: true,
                                                extraPlugins: "wysiwygarea"
                                                 
                                                });
                                            
                                            $('#txt_product_available_date').datepicker({
                                              format: 'yyyy-mm-dd',
                                              autoclose: true
                                            })
      })
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
     })
</script>