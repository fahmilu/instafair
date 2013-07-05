<h1 class="headingleft">Order Confirmation Data</small></h1>

<div class="headingright"></div>

<br class="clear" />
<br class="clear" />
<?php
	
	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}

?>
<div id="details" class="tab">
	<?php echo $pagination; ?>
	<?php
	$i = $page_offset + 1;
	foreach ( $order->result() as  $orders ) {
		if($orders->confirm_status == 1){
			$status = "<span style='color:red;'>Waiting Approval (<a href=\"".site_url('admin/approval/'.$orders->id)."\">approve</a>) </span>";
		}else if($orders->confirm_status == 2){
			$status = "<span style='color:green;'>Approved</span>";
		}

		$detail = "<a href='".site_url('admin')."'>Order Detail</a>";

		$this->table->add_row($i, $orders->facebook_id, $orders->fullname, 'Vaseline Instafair',$orders->order_price, $orders->no_rek, $orders->name_no_rek, $status);
		$i++;
	}
	echo $this->table->generate();
	?>
	<?php echo $pagination; ?>
</div>

<p class="clear" style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>