<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Order</h4>
        </div>
        <div class="modal-body">
            <!-- Add Modal Form -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-primary">
                            <form role="form" method="post" action="<?php echo base_url(); ?>admin/manage_order/create" enctype="multipart/form-data">
                                <div class="box-body">
                                        <div class="form-group">
                                                    <label>Invoice Number</label>
                                                    <input class="form-control" id="txt_order_invoice_number" name="txt_order_invoice_number">
                                        </div>
                                        <div class="form-group">
                                                    <label>Order Date</label>
                                                    <input class="form-control" id="txt_order_date" name="txt_order_date">
                                        </div>
                                        <div class="form-group">
                                                    <label>Status</label>
                                                    <?php 
                                                    $radio_array=array('New','Pending','Paid','Shipped','Completed','Cancelled');
                                                    for($i=0;$i<count($radio_array);$i++)
                                                    {
                                                        ?>
                                                        <input type="radio" id="rdo_order_status" name="rdo_order_status" value="<?php echo $radio_array[$i]; ?>"><?php echo $radio_array[$i]; ?>
                                                        <?php
                                                    }
                                                    ?>
                                        </div>
                                        <div class="form-group">
                                                    <label>Amount</label>
                                                    <input class="form-control" id="txt_order_amount" name="txt_order_amount">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
                                        </div>
                                        <div class="form-group">
                                                    <label></label>
                                                    <input class="form-control" id="" name="">
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
                  <!--<h3 class="box-title" style="font-size:25px">Order List</h3>
                <label style="float:right">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New Order</button>
                </label>-->


                <div class="row">
                    <div class="col-md-6">
                        <h3 class="box-title" style="font-size:25px">Order List</h3>
                    </div><div class="col-md-3">
                        <form id="search_form" name="search_form" method="post" action="<?php echo base_url()."admin/manage_order/search/"; ?>">
                                        <div class="form-group" style="float:right">
                                                <!--<label>Search: -->
                                                    <input class="form-control" type="text" id="txt_search" name="txt_search" placeholder="Search order invoice number"  onKeyDown="submit_form(event);"
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
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add New Order</button>
                        </label>
                    </div>
                        
                </div>
            </div>


            <div class="box-body table-responsive no-padding">
            
                <table class="table table-bordered table-hover">
                              <thead>
                                <!--<th>#</th>-->
                                <th>Invoice#</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Payment Type</th>
                                <th>OTP Verified</th>
                                
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
                                <!--<td><a  href="<?php echo base_url(); ?>admin/order_details/<?php echo $result_row->order_id; ?>"><?php echo $i; ?></a></td>-->
                                    <td><a href="<?php echo base_url(); ?>admin/order_details/<?php echo $result_row->order_id; ?>"><?php echo $result_row->order_invoice_number; ?></a></td>
                                    <td><?php echo $result_row->order_date; ?></td>
                                    <td><?php echo $result_row->order_status; ?></td>
                                    <!--<td><?php echo $result_row->order_amount; ?></td>
                                    <td><?php echo $result_row->order_coupon_id; ?></td>
                                    <td><?php echo $result_row->order_coupon_discount_amount; ?></td>
                                    <td><?php echo $result_row->order_shipping_amount; ?></td>-->
                                    <td><?php echo $result_row->order_final_amount; ?></td>
                                    <td><?php echo $result_row->order_billing_name; ?></td>
                                    <!--<td><?php echo $result_row->order_billing_company_name; ?></td>
                                    <td><?php echo $result_row->order_billing_address_line1; ?></td>
                                    <td><?php echo $result_row->order_billing_address_line2; ?></td>
                                    <td><?php echo $result_row->order_billing_country_id; ?></td>
                                    <td><?php echo $result_row->order_billing_state_id; ?></td>
                                    <td><?php echo $result_row->order_billing_city_id; ?></td>
                                    <td><?php echo $result_row->order_billing_pincode; ?></td
                                    <td><?php echo $result_row->order_billing_email; ?></td>-->
                                    <td><?php echo $result_row->order_billing_phone_number; ?></td>
                                    <!--<td><?php echo $result_row->order_billing_shipping_address_same; ?></td>
                                    <td><?php echo $result_row->order_shipping_name; ?></td>
                                    <td><?php echo $result_row->order_shipping_company_name; ?></td>
                                    <td><?php echo $result_row->order_shipping_address_line1; ?></td>
                                    <td><?php echo $result_row->order_shipping_address_line2; ?></td>
                                    <td><?php echo $result_row->order_shipping_country_id; ?></td>
                                    <td><?php echo $result_row->order_shipping_state_id; ?></td>
                                    <td><?php echo $result_row->order_shipping_city_id; ?></td>
                                    <td><?php echo $result_row->order_shipping_pincode; ?></td>
                                    <td><?php echo $result_row->order_shipping_email; ?></td>
                                    <td><?php echo $result_row->order_shipping_phone_number; ?></td>
                                    <td><?php echo $result_row->order_courier_receipt_id; ?></td>
                                    <td><?php echo $result_row->order_is_returned; ?></td>-->
                                    <td><?php echo $result_row->order_payment_type; ?></td>
                                    <td>
                                        <?php 
                                        if($result_row->order_payment_type=="cod")
                                        {
                                            if($result_row->order_otp_verified=="Yes")
                                            {
                                                ?>
                                                <p style="padding-left:10px;padding-right:10px;color:white;background-color:green">Yes
    </p>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <p style="padding-left:10px;padding-right:10px;color:white;background-color:red">No
                                                </p>
                                                <?php
                                            }
                                        }
                                        ?>
                                            
                                    </td>
                                    <!--<td><?php echo $result_row->order_notes; ?></td>
                                    <td><?php echo $result_row->customer_id; ?></td>-->
                                    <td>
                                        <a class="btn btn-success" class="btn btn-info" data-toggle="modal" data-target="#editModal" onclick="get_edit_data(<?php echo $result_row->order_id; ?>);"><em class="fa fa-pencil"></em></a>
                                        <a class="btn btn-danger confirm-delete" data-id="<?php echo $result_row->order_id; ?>"><em class="fa fa-trash-o"></em></a>
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
            <h4 class="modal-title">Edit Order</h4>
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
            var controller = "ajax/get_order";
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
                 <h3>Delete Order</h3>
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
    window.location=base_url+'admin/manage_order/delete/'+id;
    $('#deleteModal').modal('hide');
});
</script>
<script src='<?php echo base_url(); ?>template/ckeditor/ckeditor.js'></script>
<script>
  $(function () {
      
      })
</script>


