<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Customer</h4>
        </div>
        <div class="modal-body">
            <!-- Add Modal Form -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-primary">
                            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_customer/create" enctype="multipart/form-data">
                                <div class="box-body">
                                        <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input class="form-control" id="txt_customer_name" name="txt_customer_name">
                                        </div>
                                        <div class="form-group">
                                                    <label>Status</label>
                                                    <?php 
                                                    $radio_array=array("Active","In-Active");
                                                    for($i=0;$i<count($radio_array);$i++)
                                                    {
                                                        ?>
                                                        <input type="radio" id="rdo_customer_status" name="rdo_customer_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
                                                        <?php
                                                    }
                                                    ?>
                                        </div>
                                        <div class="form-group">
                                                    <label>Nickname</label>
                                                    <input class="form-control" id="txt_customer_nickname" name="txt_customer_nickname">
                                        </div>
                                        <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control" id="txt_email_address" name="txt_email_address">
                                        </div>
                                        <div class="form-group">
                                                    <label>Password</label>
                                                    <input class="form-control" id="txt_customer_password" name="txt_customer_password">
                                        </div>
                                        <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" id="txt_customer_description" name="txt_customer_description" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                                    <label>Date of Birth</label>
                                                    <div class="input-group date">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control pull-right" id="txt_customer_dob" name="txt_customer_dob" >
                                                    </div>
                                        </div>
                                        <div class="form-group">
                                                    <label>Gender</label>
                                                    <?php 
                                                    $radio_array=array('Male','Female','Other');
                                                    for($i=0;$i<count($radio_array);$i++)
                                                    {
                                                        ?>
                                                        <input type="radio" id="rdo_customer_gender" name="rdo_customer_gender" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
                                                        <?php
                                                    }
                                                    ?>
                                        </div>
                                        <div class="form-group">
                                                    <label>Address Line 1</label>
                                                    <textarea class="form-control" id="txt_customer_address_line1" name="txt_customer_address_line1" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                                    <label>Address Line 2</label>
                                                    <textarea class="form-control" id="txt_customer_address_line2" name="txt_customer_address_line2" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                                    <label>City</label>
                                                    <select class="form-control"  id="cmb_city" name="cmb_city">
                                                    <?php 
                                                    $select_res    = $this->db->get("tbl_city");
                                                    foreach($select_res->result() as $select_row)
                                                    {
                                                        echo "<option value=".$select_row->city_id.">".$select_row->city_name."</option>";
                                                    }
                                                    ?>
                                                    </select>
                                        </div>
                                        <div class="form-group">
                                                    <label>Postal Code</label>
                                                    <input class="form-control" id="txt_customer_postal_code" name="txt_customer_postal_code">
                                        </div>
                                        <div class="form-group">
                                                    <label>Country</label>
                                                    <select class="form-control"  id="cmb_customer_country" name="cmb_customer_country">
                                                    <?php 
                                                    $select_res    = $this->db->get("tbl_country");
                                                    foreach($select_res->result() as $select_row)
                                                    {
                                                        echo "<option value=".$select_row->country_id.">".$select_row->country_name."</option>";
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
                                                        echo "<option value=".$select_row->state_id.">".$select_row->state_name."</option>";
                                                    }
                                                    ?>
                                                    </select>
                                        </div>
                                        <div class="form-group">
                                                    <label>Profile Pic</label>
                                                    <input type="file" id="img_customer_profie_pic" name="img_customer_profie_pic">
                                        </div>
                                        <div class="form-group">
                                                    <label>DOJ</label>
                                                    <div class="input-group date">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control pull-right" id="txt_customer_doj" name="txt_customer_doj" >
                                                    </div>
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
                  <!--<h3 class="box-title" style="font-size:25px">Customer List</h3>
                <label style="float:right">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New Customer</button>
                </label>-->


                <div class="row">
                    <div class="col-md-6">
                        <h3 class="box-title" style="font-size:25px">Customer List</h3>
                    </div><div class="col-md-3">
                        <form id="search_form" name="search_form" method="post" action="<?php echo base_url()."admin/manage_customer/search/"; ?>">
                                        <div class="form-group" style="float:right">
                                                <!--<label>Search: -->
                                                    <input class="form-control" type="text" id="txt_search" name="txt_search" placeholder="Search Product Name"  onKeyDown="submit_form(event);"
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
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New Customer</button>
                        </label>
                    </div>
                        
                </div>
            </div>


            <div class="box-body table-responsive no-padding">
            
                <table class="table table-bordered table-hover">
                              <thead>
                                  <th>#</th>
                                <th>Full Name</th>
                                <th>Status</th>
                                <th>Nickname</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Description</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Address Line 1</th>
                                <th>Address Line 2</th>
                                <th>City</th>
                                <th>Postal Code</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>Profile Pic</th>
                                <th>DOJ</th>
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
                                    <td><?php echo $result_row->customer_full_name; ?></td>
                                    <td><?php echo $result_row->customer_status; ?></td>
                                    <td><?php echo $result_row->customer_nickname; ?></td>
                                    <td><?php echo $result_row->customer_email_address; ?></td>
                                    <td><?php echo $result_row->customer_password; ?></td>
                                    <td><?php echo $result_row->customer_description; ?></td>
                                    <td><?php echo $result_row->customer_dob; ?></td>
                                    <td><?php echo $result_row->customer_gender; ?></td>
                                    <td><?php echo $result_row->customer_address_line1; ?></td>
                                    <td><?php echo $result_row->customer_address_line2; ?></td>
                                        <td><?php echo $result_row->city_name; ?></td>
                                    <td><?php echo $result_row->customer_postal_code; ?></td>
                                        <td><?php echo $result_row->country_name; ?></td>
                                        <td><?php echo $result_row->state_name; ?></td>
                                    <td>
                                    <?php 
                                        if(trim($result_row->customer_profile_pic)!="")
                                        {
                                        ?>
                                    <img src="<?php echo base_url(); ?>files/admin/customer/thumb/<?php echo $result_row->customer_profile_pic; ?>" width="40px">
                                        <?php 
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $result_row->customer_doj; ?></td>
                                    <td>
                                        <a class="btn btn-success" class="btn btn-info" data-toggle="modal" data-target="#editModal" onclick="get_edit_data(<?php echo $result_row->customer_id; ?>);"><em class="fa fa-pencil"></em></a>
                                        <a class="btn btn-danger confirm-delete" data-id="<?php echo $result_row->customer_id; ?>"><em class="fa fa-trash-o"></em></a>
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
            <h4 class="modal-title">Edit Customer</h4>
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
            var controller = "ajax/get_customer";
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
                        
                            $('#txt_customer_dob_2').datepicker({
                                format: 'yyyy-mm-dd',
                                autoclose: true
                            })
                            $('#txt_customer_doj_2').datepicker({
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
                 <h3>Delete Customer</h3>
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
    window.location=base_url+'admin/manage_customer/delete/'+id;
    $('#deleteModal').modal('hide');
});
</script>
<script src='<?php echo base_url(); ?>template/ckeditor/ckeditor.js'></script>
<script>
  $(function () {
      
                                            $('#txt_customer_dob').datepicker({
                                              format: 'yyyy-mm-dd',
                                              autoclose: true
                                            })
                                            $('#txt_customer_doj').datepicker({
                                              format: 'yyyy-mm-dd',
                                              autoclose: true
                                            })
      })
</script>


