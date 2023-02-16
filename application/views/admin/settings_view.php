

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
                        <h3 class="box-title" style="font-size:25px">Settings</h3>
                    </div>

                    <div class="col-md-3">
                        <label style="float:right">
                                 <a  class="btn btn-info" data-toggle="modal" data-target="#editModal" onclick="get_edit_data();"><em class="fa fa-pencil"></em> Edit</a>
                        </label>
                    </div>
                        
                </div>
            </div>


            <div class="box-body table-responsive no-padding">
            
                    <table class="table table-bordered table-hover table-striped">
                        <tbody>
                        <?php 
                          foreach($settings->result() as $row)
                          {
                            ?>
                            <tr>
                                <td>Website Title</td>
                                <td><?php echo $row->settings_website_title; ?></td>
                            </tr>
                            <tr>
                                <td>Meta Keywords</td>
                                <td><?php echo $row->settings_meta_keywords; ?></td>
                            </tr>
                            <tr>
                                <td>Meta Description</td>
                                <td><?php echo $row->settings_meta_desc; ?></td>
                            </tr>
                            <tr>
                                <td>Website Name</td>
                                <td><?php echo $row->settings_website_name; ?></td>
                            </tr>
                            <tr>
                                <td>Logo</td>
                                <td><img height='100px' src="<?php echo base_url().'files/admin/logo/'.$row->settings_logo; ?>" ></td>
                            </tr>
                            <tr>
                                <td>Currency Code</td>
                                <td><?php echo $row->settings_currency_code; ?></td>
                            </tr>
                            <tr>
                                <td>Currency Symbol</td>
                                <td><?php echo $row->settings_currency_symbol; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><?php echo $row->settings_address; ?></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td><?php echo $row->settings_phone; ?></td>
                            </tr>
                            <tr>
                                <td>Fax</td>
                                <td><?php echo $row->settings_fax; ?></td>
                            </tr>
                            <tr>
                                <td>Contact Email</td>
                                <td><?php echo $row->settings_contact_email; ?></td>
                            </tr>
                            <tr>
                                <td>Map Address</td>
                                <td><?php echo $row->settings_map_address; ?></td>
                            </tr>   
                            <tr>
                                <td>Toll Free Number</td>
                                <td><?php echo $row->settings_toll_free; ?></td>
                            </tr>
                            <tr>
                                <td>Small Logo</td>
                                <td><img src="<?php echo base_url().'files/admin/logo/'.$row->settings_small_logo; ?>"></td>
                            </tr>
                            <tr>
                                <td>Footer Logo</td>
                                <td><img src="<?php echo base_url().'files/admin/logo/'.$row->settings_footer_logo; ?>"></td>
                            </tr>
                            <tr>
                                <td>Favicon</td>
                                <td><img src="<?php echo base_url().'files/admin/logo/'.$row->settings_favicon; ?>"></td>
                            </tr>
                            <tr>
                                <td>Facebook Url</td>
                                <td><?php echo $row->facebook_url; ?></td>
                            </tr>
                            <tr>
                                <td>Google+ Url</td>
                                <td><?php echo $row->google_plus_url; ?></td>
                            </tr>
                            <tr>
                                <td>Twitter Url</td>
                                <td><?php echo $row->twitter_url; ?></td>
                            </tr>
                            <tr>
                                <td>LinkedIn Url</td>
                                <td><?php echo $row->pinterest_url; ?></td>
                            </tr>
                            <tr>
                                <td>Instagram Url</td>
                                <td><?php echo $row->instagram_url; ?></td>
                            </tr>
                            <tr>
                                <td>Show Badges</td>
                                <td><?php 
                                if($row->settings_show_badges=="1")
                                {
                                    echo "Yes";

                                }
                                else
                                {
                                    echo "No";
                                }
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Minumum Single Piece Qty</td>
                                <td><?php echo $row->settings_single_min_qty; ?></td>
                            </tr>
                            <tr>
                                <td>Minimum Total Piece Qty</td>
                                <td><?php echo $row->settings_total_min_qty; ?></td>
                            </tr>
                            <tr>
                                <td>Popup Iamge</td>
                                <td><img src="<?php echo base_url().'files/admin/popup/'.$row->settings_popup_iamge; ?>"></td>

                            </tr>
                            <tr>
                                <td>Popup Content </td>
                                <td><?php echo $row->settings_popup_content; ?></td>
                            </tr>
                            <tr>
                                <td>Popup Content </td>
                                <td><?php echo $row->settings_popup_big_txt_content; ?></td>
                            </tr>
                            
                            



                                <!--<td class="center">
                                    <a class="btn btn-success" href="#">
                                        <i class="halflings-icon white zoom-in"></i>  
                                    </a>
                                    <a class="btn btn-info" href="<?php echo base_url().'index.php/admin/manage_role/edit/'.$row->role_id.''; ?>">
                                        <i class="halflings-icon white edit"></i>  
                                    </a>
                                    <a class="btn btn-danger"  onclick='return confirmDelete()'  href="<?php echo base_url().'index.php/admin/manage_role/delete/'.$row->role_id.'' ;?>">
                                        <i class="halflings-icon white trash"></i> 
                                    </a>
                                </td>-->
                            
                            <?php
                          }
                          ?>
                        </tbody>
                    </table>
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
            <h4 class="modal-title">Edit Settings</h4>
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
            var controller = "ajax/get_settings";
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
                 <h3>Delete SMS Provider</h3>
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
    window.location=base_url+'admin/manage_sms_provider/delete/'+id;
    $('#deleteModal').modal('hide');
});
</script>


