  
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
                                                    <input class="form-control" id="txt_product_name" name="txt_product_name">
                                        </div>
                                        <div class="form-group">
                                                    <label>Model Number</label>
                                                    <input class="form-control" id="txt_product_model_number" name="txt_product_model_number">
                                        </div>
                                        <div class="form-group">
                                                    <label>Stock</label>
                                                    <input class="form-control" id="txt_product_stock" name="txt_product_stock">
                                        </div>
                                        <div class="form-group">
                                                    <label>Brief Description</label>
                                                    <textarea class="form-control" id="txt_product_brief_description" name="txt_product_brief_description" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                                    <label>Full Description</label>
                                                    <textarea class="form-control" id="txt_product_full_description" name="txt_product_full_description" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                                    <label>Additional Information</label>
                                                    <textarea class="form-control" id="txt_product_additional_info" name="txt_product_additional_info" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                                    <label>Base Image</label>
                                                    <input type="file" id="img_product" name="img_product">
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
                                                    <label>Category</label>
                                                    <select class="form-control select2" id="cmb_category[]" name="cmb_category[]" multiple="multiple" data-placeholder="Select a Category"
                                                    style="width: 100%;">
                                                      <?php
                                                      $pre_select_array=array('1','2');

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
                                <th>Model Number</th>
                                <th>Stock</th>
                                <th>Brief Description</th>
                                <th>Full Description</th>
                                <th>Additional Information</th>
                                <th>Base Image</th>
                                <th>MRP</th>
                                <th>Selling Price</th>
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
                            foreach($resultset->result() as $result_row)
                            {
                            ?>
                                <tr>
                                <td><?php echo $i; ?></td>
                                    <td><?php echo $result_row->product_name; ?></td>
                                    <td><?php echo $result_row->product_model_number; ?></td>
                                    <td><?php echo $result_row->product_stock; ?></td>
                                    <td><?php echo $result_row->product_brief_description; ?></td>
                                    <td><?php echo $result_row->product_full_description; ?></td>
                                    <td><?php echo $result_row->product_additional_information; ?></td>
                                    <td>
                                    <?php 
                                        if(trim($result_row->product_image)!="")
                                        {
                                        ?>
                                    <img src="<?php echo base_url(); ?>files/admin/product/thumb/<?php echo $result_row->product_image; ?>" width="40px">
                                        <?php 
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $result_row->product_mrp; ?></td>
                                    <td><?php echo $result_row->product_selling_price; ?></td>
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
  <div class="modal-dialog">

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
                        
                            CKEDITOR.replace( "txt_product_brief_description2", {
                                fullPage: true,
                                allowedContent: true,
                                extraPlugins: "wysiwygarea"
                                 
                                });
                            
                            CKEDITOR.replace( "txt_product_full_description2", {
                                fullPage: true,
                                allowedContent: true,
                                extraPlugins: "wysiwygarea"
                                 
                                });
                            
                            CKEDITOR.replace( "txt_product_additional_info2", {
                                fullPage: true,
                                allowedContent: true,
                                extraPlugins: "wysiwygarea"
                                 
                                });
                            
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
      
                                            CKEDITOR.replace( "txt_product_brief_description", {
                                                fullPage: true,
                                                allowedContent: true,
                                                extraPlugins: "wysiwygarea"
                                                 
                                                });
                                            
                                            CKEDITOR.replace( "txt_product_full_description", {
                                                fullPage: true,
                                                allowedContent: true,
                                                extraPlugins: "wysiwygarea"
                                                 
                                                });
                                            
                                            CKEDITOR.replace( "txt_product_additional_info", {
                                                fullPage: true,
                                                allowedContent: true,
                                                extraPlugins: "wysiwygarea"
                                                 
                                                });
                                            
      })
</script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
     })
</script>