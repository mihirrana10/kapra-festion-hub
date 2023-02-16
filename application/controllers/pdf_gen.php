<?php 
session_start();

class pdf_gen extends CI_Controller{
	public function generate_pdf($ord_id)
	{
		$this->db->join("tbl_agent","tbl_order.order_agent=tbl_agent.agent_id","left outer");
       	$row=$this->db->get_where('tbl_order',array("order_id"=>$ord_id))->result();
		
		$date =	$row[0]->order_date;
		$name = $row[0]->order_name;
		$mobile=$row[0]->order_mobile;
		$address=$row[0]->order_address;
		$agent = $row[0]->agent_name;
		$transporter = $row[0]->order_transport;
		$remarks = $row[0]->order_remarks;
		$email = $row[0]->order_email;
		
		?>
		<style type="text/css">
		body
		{
			color:#e52b2e;
			
		}
		#billtable td
		{
			border-left:0.5px solid #e52b2e;
			border-right:0.5px solid #e52b2e;
			border-bottom:1px solid #e52b2e;
			padding-left:5px;
		}
		#details_id td
		{
			border-bottom:1px solid #e52b2e;
		}
		.underln
		{
			border-bottom:1px solid #e52b2e;
		}
		</style>
		<center>
		<table style="border:2px solid #e52b2e" width="100%">
			<tr>
				<td>
					<center>
						<table width="100%">
							<tr>
								<td align="left"><strong>Subject to SURAT Jurisdiction</strong></td>
								<td><strong>ORDER FORM</strong></td>
								<td align="right"><!--<strong>Ph:2335489,2322841<br>-->Mobile : 82389 23571</strong></td>
							</tr>
						</table>
					</center>
				</td>
			</tr>
			<tr>
				<td>
					<center>
					<!--<img src='<?php echo base_url(); ?>template/user/images/pdf_logo.jpg' width="262px">-->
					<strong><label style="font-size:30px">GAJANAND SAREES</label></strong></center>
				</td>

			</tr>
			<tr>
				<td >
					<center><strong>1st Floor, Shop No. 1084, Vankar Textile Market, Ring Road, Surat, Gujarat, 395002</strong></center>
				</td>
			</tr>
			<tr>
				<td style="border:2px solid #e52b2e;">
					<table width="100%">
						<tr>
							<td width="80%">
								<table>
									<tr>
										<td><strong>To M/s,</strong>
										</td>
										<td>	
											<table id="details_id">
												<tr>
													<td width="100%"><?php echo $name; ?>
													</td>
												</tr>
												<tr>
													<td>Mo. <?php echo $mobile; ?>
													</td>
												</tr>
												<tr>
													<td>Address. <?php echo $address; ?>
													</td>
												</tr>
												<!--<tr>
													<td>____________________________________________________________________________________
													</td>
												</tr>-->
											</table>
										</td>
									</tr>
								</table>
							</td>
							<td width="20%">
								<table id="details_id">
									<tr>
										<td><strong>Date</strong></td>
										<td ><?php echo $date; ?></td>
									</tr>
									<tr>
										<td><strong>Agent</strong></td>
										<td ><?php echo $agent; ?></td>
									</tr>
									<tr>
										<td><strong>Trans.</strong></td>
										<td><?php echo $transporter; ?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table style="width:100%" cellspacing="0" cellpadding="0" id="billtable">
						<tr style="color:white;background-color:#e52b2e">
							<th><center>Sr. No.</center></th>
							<th><center>Quality</center></th>
							<th><center>Quantity</center></th>
							<th><center>Rate (Rs.)</center></th>
							<th><center>Total (Rs.)</center></th>
							<!--<th><center>Remarks</center></th>-->
						</tr>
						<?php 
						$sid = session_id();
						 $cart_query ="SELECT `tbl_order_details`.`volume_product_id`,`tbl_order_details`.`volume_id`,`tbl_order_details`.`order_qty`,
			 `tbl_volume`.`volume_name`,`tbl_volume`.`volume_image`,`tbl_volume`.`volume_price`,
			 `tbl_volume_product`.`volume_product_name`,`tbl_volume_product`.`volume_product_image`,`tbl_volume_product`.`volume_product_price`
			 FROM (`tbl_order_details`)
LEFT OUTER JOIN `tbl_volume` ON `tbl_order_details`.`volume_id` = `tbl_volume`.`volume_id`
LEFT OUTER JOIN `tbl_volume_product` ON `tbl_order_details`.`volume_product_id` = `tbl_volume_product`.`volume_product_id`
WHERE `tbl_order_details`.`order_id` = '".$ord_id."'";
						//echo $cart_query;

						$resultset=mysql_query($cart_query);
						$i=1;
						$total=0;
						while($row=mysql_fetch_assoc($resultset))
						{
							extract($row);
							?>
							<tr>
								<td width="5%"><?php echo $i; ?></td>
								<td>
									<?php 
									if($volume_id!=0)
					 				{
					 					echo $volume_name. " (Bale)";
					 				}
					 				else if($volume_product_id!=0)
					 				{
					 					echo "D. No - ".$volume_product_name;
					 				}
									?>
								</td>
								<td align="right" style="padding-right:5px"><?php echo $order_qty; ?></td>
								<td align="right" style="padding-right:5px">
									<?php
									if($volume_id!=0)
					 				{
					 					echo $volume_price;
					 				}
					 				else if($volume_product_id!=0)
					 				{
					 					echo $volume_product_price;
					 				}
									?>
								</td>
								<td align="right" style="padding-right:5px"><?php
									if($volume_id!=0)
					 				{
					 					echo $volume_price*$order_qty;
					 					$total=$total+($volume_price*$order_qty);
					 				}
					 				else if($volume_product_id!=0)
					 				{
					 					echo $volume_product_price*$order_qty;
					 					$total=$total+($volume_product_price*$order_qty);
					 				}
									?>
								</td>
								<!--<td></td>-->
							</tr>	
							<?php
							$i++;
						}
						if($i<=7)
						{
							for($cnt=$i;$cnt<=7;$cnt++)
							{
							?>
							<tr>
								<td width="5%">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<!--<td>&nbsp;</td>-->
							</tr>
							<?php
							}
						}
						?>
						<tr>
							<td colspan="4"><strong>Total</strong>
							</td>
							<td align="right"><strong><?php echo $total; ?></strong>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="underln" style="width:100%">	
				<strong>NOTE</strong> : <?php echo $remarks; ?>
				</td>
			</tr>
			<tr>
				<td class="underln">	
				</td>
			</tr>
			<tr>
				<td>
					<table>
						<tr>
							<td>
						<strong>TERMS & CONDITIONS : </strong> (1) The goods are despatched according to your orders. (2) Crossed Payee A/c. Bank-Drafts should sent in the payment of our  
							</td>
						</tr>
						<tr>
							<td>
								dues. be (3) The order is Subject to SURAT Juridiction only. (4) The terms under/which order was received are not have by reposed and are demand to be
					
							</td>
						</tr>
						<tr>
							<td>
								 accepted to you. (5) No rebate will be allowed at the time of clearing the account of remaining the amount. (6) Nothing in oral can revoke or modify any of terms
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width="100%">
					<table>
						<tr>
							<td style="width:50%;padding-top:40px">
								<table>
									<tr>
										<td style="border-bottom:1px dotted #e52b2e">
										</td>
										
									</tr>
									<tr>
										<td>
										Buyer's Signature
										</td>
									</tr>
								</table>
							</td>
							<td style="width:50%;padding-left:200px;padding-top:40px" >
								<table>
									<tr>
										<td style="border-bottom:1px dotted #e52b2e">
										</td>
									</tr>
									<tr>
										<td>
										Booked By
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</center>
		<?php
	}
}
?>