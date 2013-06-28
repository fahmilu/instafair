<?php echo form_open_multipart('admin/update_setting');?>
	<h1 class="headingleft">Setting</h1>
	<div class="headingright">
		<input type="submit" value="Save Changes" class="button save">
	</div>
	<div id="clear"></div>
	<hr />

	<label for="productName">Banner:</label><br />
	<input type="radio" name="banner" value="1" <?php if($dt->banner == 1) echo 'checked="checked"';?>>Yes <input type="radio" name="banner" value="0" <?php if($dt->banner == 0) echo 'checked="checked"';?>>No
	<br class="clear" />
	<br class="clear" />
	<label for="productName">Banner Picture:</label><br />
	<img src="<?php echo base_url('upload/banner/'.$dt->banner_pict);?>" />
	<div class="uploadfile">
		<input type="file" name="image" value="" size="16" id="image">
	</div><span class="tip">951 x 68, only png/jpeg/gif file</span>
	<br class="clear" />
	<br class="clear" />
	<label for="productName">Exchange Rate ($ to IDR):</label><br />
	<input type="text" name="kurs" class="formelement" value="<?php echo $dt->kurs; ?>" /><span class="tip">Fill Just a number (e.g. 10000)</span>
	<br class="clear" />
	<br class="clear" />
</form>