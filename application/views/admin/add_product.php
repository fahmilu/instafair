<script type="text/javascript">

$(function(){
	$('div.category>span, div.category>input').hover(
		function() {
			if (!$(this).prev('input').attr('checked') && !$(this).attr('checked')){
				$(this).parent().addClass('hover');
			}
		},
		function() {
			if (!$(this).prev('input').attr('checked') && !$(this).attr('checked')){
				$(this).parent().removeClass('hover');
			}
		}
	);	
	$('div.category>span').click(function(){
		if ($(this).prev('input').attr('checked')){
			$(this).prev('input').attr('checked', false);
			$(this).parent().removeClass('hover');
		} else {
			$(this).prev('input').attr('checked', true);
			$(this).parent().addClass('hover');
		}
	});
	$('a.showtab').click(function(event){
		event.preventDefault();
		var div = $(this).attr('href'); 
		$('div#details, div#desc, div#variations').hide();
		$(div).show();
	});
	$('ul.innernav a').click(function(event){
		event.preventDefault();
		$(this).parent().siblings('li').removeClass('selected'); 
		$(this).parent().addClass('selected');
	});
	$('.addvar').click(function(event){
		event.preventDefault();
		$(this).parent().parent().siblings('div').toggle('400');
	});
	$('div#desc, div#variations').hide();

	$('input.save').click(function(){
		var requiredFields = 'input#productName, input#catalogueID';
		var success = true;
		$(requiredFields).each(function(){
			if (!$(this).val()) {
				$('div.panes').scrollTo(
					0, { duration: 400, axis: 'x' }
				);					
				$(this).addClass('error').prev('label').addClass('error');
				$(this).focus(function(){
					$(this).removeClass('error').prev('label').removeClass('error');
				});
				success = false;
			}
		});
		if (!success){
			$('div.tab').hide();
			$('div.tab:first').show();
		}
		return success;
	});	
});
</script>

<form method="post" action="<?php echo site_url('admin/insert_product/'); ?>" enctype="multipart/form-data" class="default">

<h1 class="headingleft">Add Product <small>(<a href="<?php echo site_url('/admin/product/all'); ?>">Back to Products</a>)</small></h1>

<div class="headingright">
	<input type="submit" value="Save Changes" class="button save" />
</div>

<div class="clear"></div>

<?php if ($errors = validation_errors()): ?>
	<div class="error">
		<?php echo $errors; ?>
	</div>
<?php endif; ?>

<ul class="innernav clear">
	<li class="selected"><a href="#details" class="showtab">Details</a></li>
	<li><a href="#desc" class="showtab">Description</a></li>
</ul>

<br class="clear" />

<div id="details" class="tab">

	<h2 class="underline">Product Details</h2>
	
	<label for="productName">Product name:</label>
	<?php echo @form_input('productName',set_value('productName', $data->productname), 'id="productName" class="formelement"'); ?>
	<br class="clear" />

	<label for="catalogueID">Item Code:</label>
	<?php echo @form_input('catalogueID',set_value('catalogueID', $data->catalogueid), 'id="catalogueID" class="formelement"'); ?>
	<span class="tip">This is for your own catalogue reference and stock keeping.</span>
	<br class="clear" />

	<label for="subtitle">Sub-title / Author:</label>
	<?php echo @form_input('subtitle',set_value('subtitle', $data->subtitle), 'id="subtitle" class="formelement"'); ?>
	<br class="clear" />
	
	<label for="tags">Tags: <br /></label>
	<?php echo @form_input('tags', set_value('tags', $data->tags), 'id="tags" class="formelement"'); ?>
	<span class="tip">Separate tags with a comma (e.g. &ldquo;places, hobbies, favourite work&rdquo;)</span>
	<br class="clear" />
	
	<label for="price">Price:</label>
	<span class="price"><strong>IDR: </strong></span>
	<?php echo @form_input('price_idr',number_format(set_value('price_idr', $data->price_idr)), 'id="price" class="formelement small"'); ?>
    <span class="price"><strong>USD</strong></span>
	<?php echo @form_input('price_usd',number_format(set_value('price_usd', $data->price_usd)), 'id="price" class="formelement small"'); ?>
	<br class="clear" /> 

	<label for="price">Sale Price:</label>
	<span class="price"><strong>IDR: </strong></span>
	<?php echo @form_input('sale_price_idr',number_format(set_value('sale_price_idr', $data->sale_price_idr)), 'id="price" class="formelement small"'); ?>
    <span class="price"><strong>USD</strong></span>
	<?php echo @form_input('sale_price_usd',number_format(set_value('sale_price_usd', $data->sale_price_usd)), 'id="price" class="formelement small"'); ?>
	<br class="clear" /> 

	<label for="image">Image:</label>
	<div class="uploadfile">
		<?php if (isset($data->image1)):?>
			<img src="<?php echo base_url('upload/product/'.$data->image1); ?>" alt="Product image" />
		<?php endif; ?>
		<?php echo @form_upload('image1',$this->validation->image, 'size="16" id="image"'); ?>
	</div>
        <div class="uploadfile" style="margin-left:10px;">
		<?php if (isset($data->image2)):?>
			<img src="<?php echo base_url('upload/product/'.$data->image2); ?>" alt="Product image" />
		<?php endif; ?>
		<?php echo @form_upload('image2',$this->validation->image, 'size="16" id="image"'); ?>
	</div>
        <div class="uploadfile" style="margin-left:10px;" >
		<?php if (isset($data->image3)):?>
			<img src="<?php echo base_url('upload/product/'.$data->image3); ?>" alt="Product image" />
		<?php endif; ?>
		<?php echo @form_upload('image3',$this->validation->image, 'size="16" id="image"'); ?>
	</div>
	<br class="clear" />
	
	<label for="category">Category: <small>[<a href="<?php echo site_url('/admin/category'); ?>" onclick="return confirm('You will lose any unsaved changes.\n\nContinue anyway?')">update</a>]</small></label>
	<div class="categories">
	<?php 
		$values = array();
                foreach($category->result() as $row_c){
                    $values[$row_c->id] = $row_c->name;
                }
                echo @form_dropdown('category_id',$values,set_value('category_id', $data->category_id), 'id="status" class="formelement"'); 
	?>        
	</div>
	<br class="clear" />
	
	<label for="status">Label:</label>
	<?php 
		$values = array(
			'none' => 'none',
			'favorite.png' => 'Favorite',
			'restock.png' => 'Back In Stock'
		);
		echo @form_dropdown('label',$values,set_value('label', $data->label), 'id="status" class="formelement"'); 
	?>
	<br class="clear" />
	<br />

	<h2 class="underline">Availability</h2>
	
	<label for="status">Status:</label>
	<?php 
		$values = array(
			'S' => 'In stock',
			'O' => 'Out of stock',
			'P' => 'Pre-order'
		);
		echo @form_dropdown('status',$values,set_value('status', $data->status), 'id="status" class="formelement"'); 
	?>
	<br class="clear" />
	
	<label for="stock">Stock:</label>
	<?php echo @form_input('stock', set_value('stock', $data->stock), 'id="stock" class="formelement small"'); ?>
	<br class="clear" />
	
	<label for="published">Visible:</label>
	<?php 
		$values = array(
			1 => 'Yes',
			0 => 'No (hide product)',
		);
		echo @form_dropdown('published',$values,set_value('published', $data->published), 'id="published"'); 
	?>
	<br class="clear" />
        <input type="hidden" name="act" value="<?php echo ($act == 'insert') ? 'insert':'update'; ?>" />
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
</div>

<div id="desc" class="tab">	

	<h2 class="underline">Product Description</h2>
	
	<label for="body">Body:</label>
	<?php echo @form_textarea('description', set_value('description', $data->description), 'id="body" class="formelement code half tinymce" rows="15" cols="80" style="width: 50%"'); ?>
	</textarea>
	<br class="clear" /><br />

</div>

<p class="clear" style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>
	
</form>