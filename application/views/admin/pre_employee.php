<form method="post" action="<?php echo site_url('admin/'.$redirect); ?>" enctype="multipart/form-pre" class="default">

<h1 class="headingleft"><?php echo $pre->title;?></small></h1>

<div class="headingright">
	<input type="submit" value="Save Changes" class="button save" />
</div>

<br class="clear" />

<div id="details" class="tab">
	
	<label for="productName">Title</label>
	<?php echo @form_input('title',set_value('title', $pre->title), 'id="productName" class="formelement"'); ?>
	<br class="clear" />

	<label for="catalogueID">Content English:</label>
	<?php echo @form_textarea('content_en', set_value('content_en', $pre->content_en), 'id="elm1" class="formelement code half tinymce_en" rows="15" cols="100" style="width: 70%"'); ?>
	<br class="clear" />

	<label for="subtitle">Content Bahasa:</label>
	<?php echo @form_textarea('content_id', set_value('content_id', $pre->content_id), 'id="elm2" class="formelement code half tinymce_id" rows="15" cols="80" style="width: 70%"'); ?>
	<br class="clear" />	

	<label for="subtitle">Case:</label>
	<select name="case_status">
		<option value="0" <?php echo ($pre->case_status == 0)? "selected":"";?>>Disable</option>
		<option value="1" <?php echo ($pre->case_status == 1)? "selected":"";?>>Enable</option>
	</select>
	<br class="clear" />

	<label for="catalogueID">Case Study English:</label>
	<?php echo @form_textarea('case_en', set_value('case_en', $pre->case_en), 'id="elm3" class="formelement code half tinymce_en" rows="15" cols="100" style="width: 70%"'); ?>
	<br class="clear" />

	<label for="subtitle">Case Study Bahasa:</label>
	<?php echo @form_textarea('case_id', set_value('case_id', $pre->case_id), 'id="elm4" class="formelement code half tinymce_id" rows="15" cols="80" style="width: 70%"'); ?>
	<br class="clear" />
	

</div>

<p class="clear" style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>
	
</form>