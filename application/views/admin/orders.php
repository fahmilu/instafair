<h1 class="headingleft">Order Data</small></h1>

<div class="headingright"></div>

<br class="clear" />
<br class="clear" />

<div id="details" class="tab">
	<?php echo $pagination; ?>
	<?php
	$i = $page_offset + 1;
	foreach ( $order->result() as  $orders ) {
		if($orders->order_status == 1){
			$status = "<span style='color:red;'>Waiting Confirmation</span>";
		}else if($orders->order_status == 2){
			$status = "<span style='color:red;'>Waiting Approval</span>";
		}else{
			$status = "<span style='color:green;'>Done</span>";
		}

		$th = $this->db->get_where('confirms', array('order_id'=>$orders->id));
		if($th->num_rows() > 0){
			$con = $th->row()->confirm_status;
			if($con == 1){
				$confirmation = "<span style='color:red;'>Waiting Approval (<a href=\"".site_url('admin/confirm/'.$orders->id)."\">Go To Confirm Page</a>)</span>";
			}else{
				$status = "<span style='color:green;'>Done</span>";
				$confirmation = "<span style='color:green;'>Complete</span>";
			}			
		}else{
			$confirmation = "<span style='color:red;'>Not Yet</span>";
		}

		$detail = "<a href='".site_url('admin')."'>Order Detail</a>";

		$this->table->add_row($i, $orders->facebook_id, $orders->fullname, 'Vaseline Instafair', $orders->order_price, $detail, $orders->order_created, $status, $confirmation);
		$i++;
	}
	echo $this->table->generate();
	?>
	<?php echo $pagination; ?>
</div>

<p class="clear" style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>