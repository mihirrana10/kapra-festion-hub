

<div id="page-wrapper" style="width:100%">
    <div class="container-fluid">
    <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">CMS List
                    <label style="float:right">
                        <a class="btn btn-success" class="btn btn-info" data-toggle="modal" data-target="#editModal" onclick="get_edit_data();"><em class="fa fa-pencil"></em> Edit CMS</a>
                
                <!--        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Edit CMS</button>-->
                    </label>
                </h1>
                <!--<ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Forms
                </li>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New Test</button>
                </ol>-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                 <table class="table table-striped table-bordered bootstrap-datatable">
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
                                    <th><h2>About Us</h2></th>
                                </tr>
                                <tr  >
                                    <td ><?php echo $row->cms_about_us; ?></td>
                                </tr>
                            </table>
                            <table class="table table-striped table-bordered bootstrap-datatable">
                                <tr>
                                    <th><h2>Privacy Policy</h2></th>
                                </tr>
                                <tr>
                                    <td><?php echo $row->cms_privacy_policy; ?></td>
                                </tr>
                            </table>
                            <table class="table table-striped table-bordered bootstrap-datatable">
                                <tr>
                                    <th><h2>Copy Right</h2></th>
                                </tr>
                                <tr>
                                    <td><?php echo $row->cms_copy_right; ?></td>
                                </tr>
                            </table>
                            <table class="table table-striped table-bordered bootstrap-datatable">
                                <tr>
                                    <th><h2>Trade Mark</h2></th>
                                </tr>
                                <tr>
                                    <td><?php echo $row->cms_trademark; ?></td>
                                </tr>
                            </table>
                            <table class="table table-striped table-bordered bootstrap-datatable">
                                <tr>
                                    <th><h2>Terms &amp; Conditions</h2></th>
                                </tr>
                                <tr>
                                    <td><?php echo $row->cms_terms_conditions; ?></td>
                                </tr>
                            </table>
                            <table class="table table-striped table-bordered bootstrap-datatable">
                                <tr>
                                    <th><h2>Contact Us</h2></th>
                                </tr>
                                <tr>
                                    <td><?php echo $row->cms_contact_us; ?></td>
                                </tr>
                            </table>

                            <table class="table table-striped table-bordered bootstrap-datatable">
                                <tr>
                                    <th><h2>Bank Details</h2></th>
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

      <ul class="pagination hidden-xs pull-right">
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
            <h4 class="modal-title">Edit CMS</h4>
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
<style type="text/css">
.h2, h2 {
    font-size: 30px;
}
</style>


