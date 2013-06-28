<?php 
$attributes = array('id' => 'editPassword', 'class'=>'default');
echo form_open(site_url('auth/change_pwd'),$attributes);
?>
<script type="text/javascript">
    var optionsBootstrap = {
        classNamePrefix: 'bvalidator_bootstrap_',
        position: {x:'right', y:'center'},
        offset:     {x:15, y:0},
        template: '<div class="{errMsgClass}"><div class="bvalidator_bootstrap_arrow"></div><div class="bvalidator_bootstrap_cont1">{message}</div></div>',    
        templateCloseIcon: '<div style="display:table"><div style="display:table-cell">{message}</div><div style="display:table-cell"><div class="{closeIconClass}">&#215;</div></div></div>'
    };

	$(document).ready(function(){
		var myvalidator = jQuery('#editPassword').bValidator(optionsBootstrap);
				jQuery('#editPassword').submit(function() {
					if(myvalidator.isValid()){
					jQuery.ajax({
						type: 'POST',
						url: '<?php echo site_url('auth/check_oldpass');?>',
						data: jQuery(this).serialize(),
						success: function(data) {
							if(data == '1'){
								jQuery.ajax({
									type: 'POST',
									url: jQuery('#editPassword').attr('action'),
									data: jQuery('#editPassword').serialize(),
									success: function(data) {
										alert(data);
										window.location = "<?php echo $redirect_url;?>";
									}
								})
							}else{
								alert('Old password is invalid.');
							}
						}
					})
					return false;
					}
				});
	});
</script>

<br />
<h1 class="headingleft">Change Password</h1>
<div class="headingright"><!-- <a href="<?php echo site_url('retailer/dashboard');?>" class="button grey">CANCEL</a> --></div>
<br class="clear" />
<hr/>

<!-- 			<label for="Name">Old Password:</label>
				<?php
				$password_lama=array(
				'name' => 'old_pass',
				'id' => 'old_pass',
				'size' => '30',
				'data-bvalidator'=> 'required',
				'autocomplete' => 'off',
				'class' => 'formelement'
				);
				echo form_password($password_lama);
				?>*
				<br class="clear" /> -->

			<label for="Name">New Password:</label>
				<?php
				$password_baru=array(
				'name' => 'new_pass',
				'id' => 'new_pass',
				'size' => '30',
				'data-bvalidator'=> 'required',
				'autocomplete' => 'off',
				'class' => 'formelement'
				);
				echo form_password($password_baru);
				?>*
				<br class="clear" />

			<label for="Name">Confirm New Password:</label>
				<?php
				$password_konfirmasi=array(
				'name' => 'new_pass_konf',
				'id' => 'new_pass_konf',
				'size' => '30','data-bvalidator'=> 'equalto[new_pass], required',	
				'autocomplete' => 'off',
				'class' => 'formelement'
				);
				echo form_password($password_konfirmasi);
				?>*
				<br class="clear" />
			
			<br class="clear" />
			<span>(*) required</span>
			<br class="clear" />
			<br class="clear" />
			<input type="hidden" name="redirect_url" value="<?php echo $redirect_url; ?>" />
			<input type="submit" value="Submit" class="button save" id="submit" style="display:block;" />

<!-- <table>
	<tr>
		<td colspan="3" align="center" style="padding:0px">
			<input type="hidden" name="redirect_url" value="<?php echo $redirect_url; ?>" />
				<input type="submit" value="Kirim" >&nbsp;<input type="reset" value="Reset" >
		</td>
	</tr>
</table> -->
<?php echo form_close()?>