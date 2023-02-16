<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Email Template </h4>
        </div>
        <div class="modal-body">
            <!-- Add Modal Form -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-primary">
                            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_email_template/create" enctype="multipart/form-data">
                                <div class="box-body">
                                        <div class="form-group">
                                                    <label>Email Settings - Email</label>
                                                    <select class="form-control"  id="cmb_email_settings" name="cmb_email_settings">
                                                    <?php 
                                                    $select_res    = $this->db->get("tbl_email_settings");
                                                    foreach($select_res->result() as $select_row)
                                                    {
                                                        echo "<option value=".$select_row->email_settings_id.">".$select_row->settings_username."</option>";
                                                    }
                                                    ?>
                                                    </select>
                                        </div>
                                        <div class="form-group">
                                                    <label>Template Name</label>
                                                    <input class="form-control" id="txt_email_template_name" name="txt_email_template_name">
                                        </div>
                                        <div class="form-group">
                                                    <label>Template Type</label>
                                                    <?php 
                                                    $radio_array=array("Plain","HTML");
                                                    for($i=0;$i<count($radio_array);$i++)
                                                    {
                                                        ?>
                                                        <input type="radio" id="rdo_email_template_type" name="rdo_email_template_type" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
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
                                                        ?>
                                                        <br>
                                                        <input type="radio" id="rdo_email_for" name="rdo_email_for" value="<?php echo $radio_array[$i]; ?>" style="margin-right:10px"><?php echo $radio_array[$i]; ?>
                                                        <?php
                                                    }
                                                    ?>
                                        </div>
                                        <div class="form-group">
                                                    <label>Sender Email</label>
                                                    <input class="form-control" id="txt_email_template_sender_email" name="txt_email_template_sender_email">
                                        </div>
                                        <div class="form-group">
                                                    <label>Sender Name</label>
                                                    <input class="form-control" id="tt_email_template_sender_name" name="tt_email_template_sender_name">
                                        </div>
                                        <div class="form-group">
                                                    <label>Subject</label>
                                                    <input class="form-control" id="txt_email_template_subject" name="txt_email_template_subject">
                                        </div>
                                        <div class="form-group">
                                                    <label>Body</label>
                                                    <textarea class="form-control" id="txt_email_template_body" name="txt_email_template_body" rows="3"></textarea>
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
                  <!--<h3 class="box-title" style="font-size:25px">Email Template  List</h3>
                <label style="float:right">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New Email Template </button>
                </label>-->


                <div class="row">
                    <div class="col-md-6">
                        <h3 class="box-title" style="font-size:25px">Email Template  List</h3>
                    </div><div class="col-md-3">
                        <form id="search_form" name="search_form" method="post" action="<?php echo base_url()."admin/manage_email_template/search/"; ?>">
                                        <div class="form-group" style="float:right">
                                                <!--<label>Search: -->
                                                    <input class="form-control" type="text" id="txt_search" name="txt_search" placeholder="Search email template name"  onKeyDown="submit_form(event);"
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
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New Email Template </button>
                        </label>
                    </div>
                        
                </div>
            </div>


            <div class="box-body table-responsive no-padding">
            
                <table class="table table-bordered table-hover">
                              <thead>
                                  <th>#</th>
                                <th>Email Settings - Email</th>
                                <th>Template Name</th>
                                <th>Template Type</th>
                                <th>Email For</th>
                                <th>Sender Email</th>
                                <th>Sender Name</th>
                                <th>Subject</th>
                                <!--<th>Body</th>-->
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
                                        <td><?php echo $result_row->settings_username; ?></td>
                                    <td><?php echo $result_row->email_template_name; ?></td>
                                    <td><?php echo $result_row->email_template_type; ?></td>
                                    <td><?php echo $result_row->email_template_for; ?></td>
                                    <td><?php echo $result_row->email_template_sender_email; ?></td>
                                    <td><?php echo $result_row->email_template_sender_name; ?></td>
                                    <td><?php echo $result_row->email_template_subject; ?></td>
                                    <!--<td><?php //echo $result_row->email_template_body; ?></td>-->
                                    <td>
                                        <a class="btn btn-success" class="btn btn-info" data-toggle="modal" data-target="#editModal" onclick="get_edit_data(<?php echo $result_row->email_template_id; ?>);"><em class="fa fa-pencil"></em></a>
                                        <a class="btn btn-danger confirm-delete" data-id="<?php echo $result_row->email_template_id; ?>"><em class="fa fa-trash-o"></em></a>
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
            <h4 class="modal-title">Edit Email Template </h4>
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
            var controller = "ajax/get_email_template";
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
                        
                            CKEDITOR.replace( "txt_email_template_body2", {
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
                 <h3>Delete Email Template </h3>
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
    window.location=base_url+'admin/manage_email_template/delete/'+id;
    $('#deleteModal').modal('hide');
});
</script>
<script src='<?php echo base_url(); ?>template/ckeditor/ckeditor.js'></script>
<script>
  $(function () {
      
                                            CKEDITOR.replace( "txt_email_template_body", {
                                                fullPage: true,
                                                allowedContent: true,
                                                extraPlugins: "wysiwygarea"
                                                 
                                                });
                                            
      })
</script>


