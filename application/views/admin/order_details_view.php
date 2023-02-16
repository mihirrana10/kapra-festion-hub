<?php 

$order_data_res=$this->db->get_where('tbl_order',array('order_id'=>$order_id));
$order_data_row=$order_data_res->result();

?>
<div class="content-wrapper" style="min-height: 1136.3px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php 
      if($order_data_row[0]->order_is_returned=="Applied")
      {
        ?>
        <center>
          <h1>
            <form method="post" action="<?php echo base_url(); ?>admin/update_return_status">
              <input type="hidden" id="or_id" name="or_id" value="<?php echo $order_data_row[0]->order_id; ?>">
              <div class="alert alert-warning" role="alert" width="50%" style="font-size:20px">
                <i class="icon-check"></i> Cancellation Request has been Received, What you want to do?
                <br><br>
                <input type="radio" id="rdo_return_action" name="rdo_return_action" value="Approved" 
                style="margin-right:10px">Approve
                <input type="radio" id="rdo_return_action" name="rdo_return_action" value="Cancelled"
                style="margin-right:10px;margin-left: 50px">Cancel
                <br><br>
                <button type="submit" class="btn btn-success">Update Return Status</button>
              </div>
            </form>
          </h1>
        </center>
        <?php
      }
      else if($order_data_row[0]->order_is_returned=="Approved")
      {
        ?>
        <center>
          <h1>
              <input type="hidden" id="or_id" name="or_id" value="<?php echo $order_data_row[0]->order_id; ?>">
              <div class="alert alert-danger" role="alert" width="50%" style="font-size:20px">
                <i class="icon-check"></i> Order Cancelled
              </div>
            
          </h1>
        </center>
        <?php
      }
      else if($order_data_row[0]->order_is_returned=="Cancelled")
      {
          ?>
          <center>
            <h1>
                <input type="hidden" id="or_id" name="or_id" value="<?php echo $order_data_row[0]->order_id; ?>">
                <div class="alert alert-success" role="alert" width="50%" style="font-size:20px">
                  <i class="icon-check"></i> Order Cancellation Rejected
                </div>
            </h1>
          </center>
          <?php
      }
      ?>
      
      <h1>
        Invoice
        <small>#<?php echo $order_data_row[0]->order_invoice_number; ?></small>
      </h1>
     
    </section>

    <!--<div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>
    </div>-->

    <!-- Main content -->
    <section class="invoice">
      <?php 
      if(isset($_SESSION["order_status_msg"]) && $_SESSION["order_status_msg"]=="yes")
      {
        ?>
        <div class="alert alert-success" role="alert">
          Order Status Updated Successfully
        </div>
        <?php

        unset($_SESSION["order_status_msg"]);
      }
      ?>
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <!--AdminLTE, Inc.-->Order Details
            <small class="pull-right">Date: <?php echo $order_data_row[0]->order_date; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong><?php echo $order_data_row[0]->order_billing_name; ?>
            <?php 
            if(isset($order_data_row[0]->order_billing_company_name))
            {
              echo " - ( ".$order_data_row[0]->order_billing_company_name." )";
            }

            $bill_city_res=$this->db->get_where('tbl_city',array('city_id'=>$order_data_row[0]->order_billing_city_id));
            $bill_city_row=$bill_city_res->result();   
            $bill_state_res=$this->db->get_where('tbl_state',array('state_id'=>$order_data_row[0]->order_billing_state_id));
            $bill_state_row=$bill_state_res->result();            
            $bill_country_res=$this->db->get_where('tbl_country',array('country_id'=>$order_data_row[0]->order_billing_country_id));
            $bill_country_row=$bill_country_res->result();            
            
            ?>
            
            </strong><br>
            <?php echo $order_data_row[0]->order_billing_address_line1; ?><br>
            <?php echo $order_data_row[0]->order_billing_address_line2; ?><br>
            <?php echo $bill_city_row[0]->city_name." - ".$order_data_row[0]->order_billing_pincode.", ".$bill_state_row[0]->state_name.", ".$bill_country_row[0]->country_name; ?><br>
          
            Phone: <?php echo $order_data_row[0]->order_billing_phone_number; ?><br>
            Email: <?php echo $order_data_row[0]->order_billing_email; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?php echo $order_data_row[0]->order_shipping_name; ?>
            <?php 
            if(isset($order_data_row[0]->order_shipping_company_name))
            {
              echo " - ( ".$order_data_row[0]->order_shipping_company_name." )";
            }

            $ship_city_res=$this->db->get_where('tbl_city',array('city_id'=>$order_data_row[0]->order_shipping_city_id));
            $ship_city_row=$ship_city_res->result();   
            $ship_state_res=$this->db->get_where('tbl_state',array('state_id'=>$order_data_row[0]->order_shipping_state_id));
            $ship_state_row=$ship_state_res->result();            
            $ship_country_res=$this->db->get_where('tbl_country',array('country_id'=>$order_data_row[0]->order_shipping_country_id));
            $ship_country_row=$ship_country_res->result();   
            ?>
              
            </strong><br>
            <?php echo $order_data_row[0]->order_shipping_address_line1; ?><br>
            <?php echo $order_data_row[0]->order_shipping_address_line2; ?><br>
            <?php echo $ship_city_row[0]->city_name." - ".$order_data_row[0]->order_shipping_pincode.", ".$ship_state_row[0]->state_name.", ".$ship_country_row[0]->country_name; ?><br>
          
            Phone: <?php echo $order_data_row[0]->order_shipping_phone_number; ?><br>
            Email: <?php echo $order_data_row[0]->order_shipping_email; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?php echo $order_data_row[0]->order_invoice_number; ?></b><br>
          <br>
          <b>Order ID : </b> <?php echo $order_data_row[0]->order_id; ?><br>
          <b>Payment Type : </b> <?php echo $order_data_row[0]->order_payment_type; ?><br>
          <b>Order Status : </b> <?php echo $order_data_row[0]->order_status; ?><br>
          
          <!--<b>Account:</b> 968-34567-->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr style="width: 100%">
              
              <th colspan="2">Product</th>
              <th>Qty</th>
              <!--<th>Serial #</th>
              <th>Description</th>-->
              <th>Unit Price</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $this->db->join('tbl_product_new','tbl_order_details.product_id=tbl_product_new.product_id');
              $order_details_res=$this->db->get_where('tbl_order_details',array('tbl_order_details.order_id'=>$order_id));

              foreach($order_details_res->result() as $order_details_row)
              {
                ?>
                <tr>
                  <td><img src='<?php echo base_url(); ?>files/admin/product/thumb/<?php echo $order_details_row->product_image; ?>' height="80px">
                  <td width="50%"><?php echo $order_details_row->product_name; ?><br>
                    <p style='font-size:10px'> SKU : <?php echo $order_details_row->product_sku; ?></p>
                  </td>
                  <td width="10%"><?php echo $order_details_row->product_qty; ?></td>
                  <td width="10%"><i class="fa fa-inr"></i> <?php echo $order_details_row->product_selling_price; ?></td>
                  <!--<td>455-981-221</td>
                  <td>El snort testosterone trophy driving gloves handsome</td>-->
                  <td width="10%"><i class="fa fa-inr"></i> <?php echo $order_details_row->product_qty*$order_details_row->product_selling_price; ?></td>
                </tr>
                <?php
              }
              ?>
            <!--
            <tr>
              <td>1</td>
              <td>Call of Duty</td>
              <td>455-981-221</td>
              <td>El snort testosterone trophy driving gloves handsome</td>
              <td>$64.50</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Need for Speed IV</td>
              <td>247-925-726</td>
              <td>Wes Anderson umami biodiesel</td>
              <td>$50.00</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Monsters DVD</td>
              <td>735-845-642</td>
              <td>Terry Richardson helvetica tousled street art master</td>
              <td>$10.70</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Grown Ups Blue Ray</td>
              <td>422-568-642</td>
              <td>Tousled lomo letterpress</td>
              <td>$25.99</td>
            </tr>-->
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <!--
          <p class="lead">Payment Methods :</p>
          <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
          -->

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            <?php echo $order_data_row[0]->order_notes; ?>
          </p>

          <p class="lead">Update Order Status</p>
          <form method="post" action="<?php echo base_url(); ?>admin/update_order_status">
            <input type="hidden" id="txt_ord_id" name="txt_ord_id" value="<?php echo $order_data_row[0]->order_id; ?>">
            <div class="form-group">
              <select class="form-control" id="cmb_ord_status" name="cmb_ord_status">
              <?php 
              $ord_sta_array=array('New','Pending','Paid','Shipped','Completed','Cancelled','Returned');

              for($i=0;$i<count($ord_sta_array);$i++)
              {
                ?>
                <option value="<?php echo $ord_sta_array[$i]; ?>"
                  <?php 
                  if($order_data_row[0]->order_status==$ord_sta_array[$i])
                  {
                    echo "selected='selected'";
                  }
                  ?>
                  ><?php echo $ord_sta_array[$i]; ?></option>
                <?php
                
              }
              
              ?>

              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">Update Status</button>
            </div>
          </form>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Details : </p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Subtotal:</th>
                <td><i class="fa fa-inr"></i> <?php echo $order_data_row[0]->order_amount; ?></td>
              </tr>
              <?php 
              //echo $order_data_row[0]->order_coupon_id;
              if($order_data_row[0]->order_coupon_id!=0)
              {
                $coupon_res=$this->db->get_where('tbl_coupon',array('coupon_id'=>$order_data_row[0]->order_coupon_id));
                $coupon_row=$coupon_res->result();
                ?>
                 <tr>
                  <th>Coupon Code - <?php echo $coupon_row[0]->coupon_code ;?>
                    <br>
                    <p style="font-size:12px">
                    <?php 
                    $discount_amount=0;
                    if($coupon_row[0]->coupon_value_on=="%")
                    {
                      echo $coupon_row[0]->coupon_value."% off";
                    }
                    else if($coupon_row[0]->coupon_value_on=="Flat")
                    {
                      echo "Flat ".$coupon_row[0]->coupon_value." off";
                    }
                    ?>
                    </p>
                  </th>
                  <td><i class="fa fa-inr"></i> <?php echo $order_data_row[0]->order_coupon_discount_amount; ?></td>
                 </tr>
                <?php
              }
              ?>
             
              <tr>
                <th>Shipping:</th>
                <td><i class="fa fa-inr"></i> <?php echo $order_data_row[0]->order_shipping_amount; ?></td>
              </tr>
              <?php 
              if($order_data_row[0]->order_giftbox_charge!=0)
              {
                ?>
                <tr>
                  <th style="color:red"><i class="fa fa-gift"></i> Gift Box Packing Charge:</th>
                  <td><i class="fa fa-inr"></i> <?php echo $order_data_row[0]->order_giftbox_charge; ?></td>
                </tr>
                <?php
              }
              ?>
              <?php 
              if($order_data_row[0]->order_cod_charge!=0)
              {
                ?>
                <tr>
                  <th style="color:red"><i class="fa fa-money"></i> COD Charge:</th>
                  <td><i class="fa fa-inr"></i> <?php echo $order_data_row[0]->order_cod_charge; ?></td>
                </tr>
                <?php
              }
              ?>
              <tr>
                <th>Final Total:</th>
                <td><i class="fa fa-inr"></i> <?php echo $order_data_row[0]->order_final_amount; ?></td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>