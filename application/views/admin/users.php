<h1 class="headingleft">Facebook User Data</small></h1>

<div class="headingright"></div>

<br class="clear" />
<br class="clear" />

<div id="details" class="tab">
	<?php echo $pagination; ?>
	<?php
	$i = $page_offset + 1;
	foreach ( $user->result() as  $user ) {
		if($user->status_invite == 0){
			$invite = "<span style='color:green;'>completed</span>";
		}else{
			$invite = "<span style='color:red;'>uncomplete</span>";
		}		

		if($user->status_order == 1){
			$order = "<span style='color:green;'>yes</span>";
		}else{
			$order = "<span style='color:red;'>no</span>";
		}
		$this->table->add_row($i, $user->facebook_id, $user->fullname, $user->email, $user->connect_date, $invite, $order);
		$i++;
	}
	echo $this->table->generate();
	?>
	<?php echo $pagination; ?>
</div>

<p class="clear" style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>