
<div class="content-wrapper">

    <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="box-title" style="font-size:25px">Import/Export
                            <button type="button" name="" style="font-size:16px;margin-left:20px" onclick="download_type()" ><i class="fa fa-download"></i> Download File</button></h3>
                            <script type="text/javascript">
                                function download_type()
                                {
                                    //    alert(document.getElementById('rdo_download_type').value);
                                    //alert(document.querySelector('input[name="rdo_download_type"]:checked').value);
                                    var selected_tbl=document.querySelector('input[name="rdo_download_type"]:checked').value;
                                    if(selected_tbl=="category")
                                    {
                                        window.location="<?php echo base_url(); ?>admin/download_category";
                                    }
                                    if(selected_tbl=="attribute")
                                    {
                                        window.location="<?php echo base_url(); ?>admin/download_attr_value";
                                    }
                                    else if(selected_tbl=="product")
                                    {
                                        window.location="<?php echo base_url(); ?>admin/download_products";
                                    }
                                    
                                }
                            </script>
                        <div class="box box-primary">
                            <div class="box-body">

                                    <div class="form-group">
                                      <label>Select and click on "Download files"</label>
                                      <div class="radio">
                                        <label>
                                          <input type="radio" name="rdo_download_type" id="rdo_download_type" value="category" >
                                          Categories
                                        </label>
                                      </div>
                                      <div class="radio">
                                        <label>
                                          <input type="radio" name="rdo_download_type" id="rdo_download_type" value="attribute" >
                                          Attributes
                                        </label>
                                      </div>
                                      <div class="radio">
                                        <label>
                                          <input type="radio" name="rdo_download_type" id="rdo_download_type" value="product">
                                          Products
                                        </label>
                                      </div>
                                      
                                    </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <?php 
                            if(isset($excel_msg))
                            {
                                echo $excel_msg;
                            }
                            ?>
                            
                            <form role="form" method="post" action="<?php echo base_url(); ?>admin/product_xls" enctype="multipart/form-data">
                                <div class="box-body">



                                    <!--<div class="form-group">
                                      <label>Select and click on "Download files"</label>
                                      <div class="radio">
                                        <label>
                                          <input type="radio" name="rdo_download_type" id="rdo_download_type" value="category" checked="">
                                          Categories
                                        </label>
                                      </div>
                                      <div class="radio">
                                        <label>
                                          <input type="radio" name="rdo_download_type" id="rdo_download_type" value="attribute" checked="">
                                          Attributes
                                        </label>
                                      </div>
                                      <div class="radio">
                                        <label>
                                          <input type="radio" name="rdo_download_type" id="rdo_download_type" value="product">
                                          Products
                                        </label>
                                      </div>
                                      
                                    </div>-->
                                    
                                    <div class="form-group">
                                        <label>Excel File - For Products only <font style="color:red;margin-left:200px">Download this file and add downloaded data in <a style="color:red" href="<?php echo base_url(); ?>files/sample.xlsx">this file <i class="fa fa-download"></i></a></font></label>
                                        <input type="file" id="product_xls" name="product_xls">
                                    </div>

                                    <div class="form-group">
                                        <label>Action</label>
                                          <div class="radio" style="margin-top: 0px;">
                                            <label>
                                              <input type="radio" name="rdo_action" id="rdo_action" value="insert">
                                              Insert New Records Only
                                            </label>
                                          </div>
                                          <div class="radio">
                                            <label>
                                              <input type="radio" name="rdo_action" id="rdo_action" value="update">
                                              Update and Insert New Records also
                                            </label>
                                          </div>
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="box-title" style="font-size:25px">Image Upload Files</h3>
                        <div class="box box-primary">
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
                    </div>

                </div>
    </section>
    <!-- /.container-fluid -->
</div>
<script type="text/javascript">
    function confirmDelete() {
        return confirm("Are you sure you want to delete this?");
    }
</script>
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Attribute Value</h4>
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
    var controller = "ajax/get_attribute_value";
    var base_url = "<?php echo base_url(); ?>";

    function getXMLHTTP() { //fuction to return the xml http object
        var xmlhttp = false;
        try {
            xmlhttp = new XMLHttpRequest();
        } catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    xmlhttp = false;
                }
            }
        }

        return xmlhttp;
    }

    function get_edit_data(primary_id) {
        var strURL = base_url + controller + "/" + primary_id;
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        //alert(req.responseText);                      
                        document.getElementById("edit_div").innerHTML = req.responseText;

                        $('.my-colorpicker2').colorpicker()

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
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" aria-hidden="true" class="close">X</a>
                <h3>Delete Attribute Value</h3>
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
        window.location = base_url + 'admin/manage_attribute_value/delete/' + id;
        $('#deleteModal').modal('hide');
    });
</script>
<script src='<?php echo base_url(); ?>template/ckeditor/ckeditor.js'></script>
<script>
    $(function() {

        $('.my-colorpicker2').colorpicker()

    })
</script>