

<div class="content-wrapper">
    
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                  <!--<h3 class="box-title" style="font-size:25px">City List</h3>
                <label style="float:right">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New City</button>
                </label>-->


                <div class="row">
                    <div class="col-md-9">
                        <h3 class="box-title" style="font-size:25px">CMS</h3>
                    </div>

                    <div class="col-md-3">
                        <label style="float:right">
                                 <a  class="btn btn-info" data-toggle="modal" data-target="#editModal" onclick="get_edit_data();"><em class="fa fa-pencil"></em> Edit CMS</a>
                        </label>
                    </div>
                        
                </div>
            </div>


            <div class="box-body table-responsive no-padding">
            
                    <table class="table table-bordered table-hover">
                          <!--<thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Role</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                          </thead>   -->
                          <tbody>
                          <?php 
                          foreach($resultset->result() as $row)
                          {
                            ?>
                            <table class="table table-striped table-bordered bootstrap-datatable" >
                                <tr>
                                    <th><h2 style="font-size:15px;font-weight: bold">About Us</h2></th>
                                </tr>
                                <tr  >
                                    <td ><?php echo $row->cms_about_us; ?></td>
                                </tr>
                            </table>
                            <table class="table table-striped table-bordered bootstrap-datatable">
                                <tr>
                                    <th><h2 style="font-size:15px;font-weight: bold">Privacy Policy</h2></th>
                                </tr>
                                <tr>
                                    <td><?php echo $row->cms_privacy_policy; ?></td>
                                </tr>
                            </table>
                            <table class="table table-striped table-bordered bootstrap-datatable">
                                <tr>
                                    <th><h2 style="font-size:15px;font-weight: bold">Copy Right</h2></th>
                                </tr>
                                <tr>
                                    <td><?php echo $row->cms_copy_right; ?></td>
                                </tr>
                            </table>
                            <table class="table table-striped table-bordered bootstrap-datatable">
                                <tr>
                                    <th><h2 style="font-size:15px;font-weight: bold">Trade Mark</h2></th>
                                </tr>
                                <tr>
                                    <td><?php echo $row->cms_trademark; ?></td>
                                </tr>
                            </table>
                            <table class="table table-striped table-bordered bootstrap-datatable">
                                <tr>
                                    <th><h2 style="font-size:15px;font-weight: bold">Terms &amp; Conditions</h2></th>
                                </tr>
                                <tr>
                                    <td><?php echo $row->cms_terms_conditions; ?></td>
                                </tr>
                            </table>
                            <table class="table table-striped table-bordered bootstrap-datatable">
                                <tr>
                                    <th><h2 style="font-size:15px;font-weight: bold">Contact Us</h2></th>
                                </tr>
                                <tr>
                                    <td><?php echo $row->cms_contact_us; ?></td>
                                </tr>
                            </table>

                            <table class="table table-striped table-bordered bootstrap-datatable">
                                <tr>
                                    <th><h2 style="font-size:15px;font-weight: bold">Bank Details</h2></th>
                                </tr>
                                <tr>
                                    <td><?php echo $row->cms_bank_details; ?></td>
                                </tr>
                            </table>
                            
                            
                            



                            
                            <?php
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
            <h4 class="modal-title">Edit City</h4>
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
            var controller = "ajax/get_cms";
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

    function get_edit_data()
    {       
        var strURL=base_url+controller;
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                    //alert(req.responseText);                      
                        document.getElementById("edit_div").innerHTML=req.responseText;         
                        CKEDITOR.replace( "txt_about_us", {
                                fullPage: true,
                                allowedContent: true,
                                extraPlugins: "wysiwygarea"
                                 
                                });
                        CKEDITOR.replace( "txt_terms_conditions", {
                                fullPage: true,
                                allowedContent: true,
                                extraPlugins: "wysiwygarea"
                                 
                                });  
                        CKEDITOR.replace( "txt_privacy_policy", {
                                fullPage: true,
                                allowedContent: true,
                                extraPlugins: "wysiwygarea"
                                 
                                });  
                        CKEDITOR.replace( "txt_contact_us", {
                                fullPage: true,
                                allowedContent: true,
                                extraPlugins: "wysiwygarea"
                                 
                                });  
                        CKEDITOR.replace( "txt_copy_right", {
                                fullPage: true,
                                allowedContent: true,
                                extraPlugins: "wysiwygarea"
                                 
                                });  
                        CKEDITOR.replace( "txt_bank_details", {
                                fullPage: true,
                                allowedContent: true,
                                extraPlugins: "wysiwygarea"
                                 
                                });  
                        CKEDITOR.replace( "txt_trademark", {
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
                 <h3>Delete CMS</h3>
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
    window.location=base_url+'admin/manage_cms/delete/'+id;
    $('#deleteModal').modal('hide');
});
</script>
<script src='<?php echo base_url(); ?>template/ckeditor/ckeditor.js'></script>