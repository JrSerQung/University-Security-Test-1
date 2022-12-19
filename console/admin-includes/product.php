<?php

use App\Product;
use App\Category;
use App\SubCategory;
use App\ProductImage;

$productObj = new Product;
$categoryObj = new Category;
$subcategoryObj = new SubCategory;
$productimageObj = new ProductImage;


if($action == 'delete-image'){

	$productimageObj->delete($_GET['image_id']);

}

if($action == 'edit'){

	$row = $productObj->find($id);
	$categoriesArray = json_decode($row->category_id, true);
	$subCategoriesArray = json_decode($row->sub_category_id, true);
	if(count($subCategoriesArray) == 0){ $subCategoriesArray = []; }
	$product_images = $productimageObj->getAll();

}

if( isset($_POST['title']) ){

	if(!strstr($_POST['seo_url'], '-')){

		redirect( $_SERVER['HTTP_REFERER'], 'You must separate words by a - in Product URL', 'e' );

	}


	if(isset($_POST['delivery_options'])){

		$_POST['delivery_options'] = json_encode($_POST['delivery_options']);

	} else {

		return redirect( $_SERVER['HTTP_REFERER'], 'You must enter a delivery option', 'e' );

	}

	if($action == 'add'){

		$productObj->add();

	} else {

		$productObj->update($id);

	}

}

?>

<script>

$(function(){

	$.get('account.php?page=product&action=add&get=sessions', function(data){

		var data = jQuery.parseJSON(data);

		$('#form input[type=text], #form input[type=email], #form textarea').each(function(){

			if (typeof data[this.id] !== 'undefined') {

				$('#' + this.id).val(data[this.id]);

			}

		});

		$('#form select').each(function(){

			$('#' + this.id + ' option[value='+data[this.id]+']').prop('selected', true);

		});

	});

});

</script>

<script src="tinymce/js/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: "textarea",
  plugins: "code, lists, advlist"
});
</script>

<script>

$(function(){

	$('#submitButton').click(function(){

		if( $('#title').val() == '' ){

			alert('You must enter a title');
			$('#title').focus();
			return false;

		}

		if( $('#seo_url').val() == '' ){

			alert('You must enter a product url');
			$('#seo_url').focus();
			return false;

		}

		if( $('#seo_url').val().indexOf('-') < 0 ){

			alert('You must enter dashes in the product url');
			$('#seo_url').focus();
			return false;

		}

		var deliveryTicked = false;

		$('.delivery-option').each(function(){

			if( $(this).is(':checked') ){

				deliveryTicked = true;

			}

		});

		if( deliveryTicked == false ){

			alert('You must select a delivery method');
			$('#next-day').focus();
			return false;

		}

		var categoryTicked = false;

		$('.category_checkbox').each(function(){

			if( $(this).is(':checked') ){

				categoryTicked = true;

			}

		});


		if( categoryTicked == false ){

			alert('You must select a category');
			return false;

		}


		if( $('#price').val() == '' ){

			alert('You must enter a price');
			$('#price').focus();
			return false;

		}

		$('#form').submit();

	});


});

</script>

<h1>PRODUCT</h1>

<p>Once uploaded, to delete an image, just click it.</p>


	<form enctype="multipart/form-data" <?php if($action == 'add'){ print 'id="form"'; } ?> class="form-horizontal" method="post" action="">

						<div class="panel panel-default">
						<div class="panel-heading"><?= strtoupper($action) ?> PRODUCT</div>
						<div class="panel-body">

								<div class="form-group">
									<label class="col-md-4 control-label">Title</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" name="title" id="title" value="<?php if(isset($row)){ print $row->title; } ?>">
									</div>
								</div>

								<div class="form-group" style="display:none;">
									<label class="col-md-4 control-label">EAN Code</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" name="product_code" id="product_code" value="<?php if(isset($row)){ print $row->product_code; } ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">SKU</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" name="sku" id="sku" value="<?php if(isset($row)){ print $row->sku; } ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Product URL</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" name="seo_url" id="seo_url" value="<?php if(isset($row)){ print $row->seo_url; } ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label"></label>
									<div class="col-md-6">
										<p>eg. your-product-name</p>
										<p>This should have a dash in between each word, no spaces</p>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">In Stock</label>
									<div class="col-md-6">

										<select class="form-control" name="product_status" id="product_status">
										<option value="0">No</option>
										<option value="1" <?php if(isset($row) && $row->product_status == 1 ){ print 'selected'; } ?>>Yes</option>

										</select>

									</div>
								</div>

								<div class="form-group" style="display:none;">
									<label class="col-md-4 control-label">Deal of the Day</label>
									<div class="col-md-6">

										<select class="form-control" name="deal_day" id="deal_day">
										<option value="0">No</option>
										<option value="1" <?php if(isset($row) && $row->deal_day == 1 ){ print 'selected'; } ?>>Yes</option>

										</select>

									</div>
								</div>

								<div class="form-group" style="display:none;">
									<label class="col-md-4 control-label">New In Shop</label>
									<div class="col-md-6">

										<select class="form-control" name="deal_week" id="deal_week">
										<option value="0">No</option>
										<option value="1" <?php if(isset($row) && $row->deal_week == 1 ){ print 'selected'; } ?>>Yes</option>

										</select>

									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Best Seller</label>
									<div class="col-md-6">

										<select class="form-control" name="best_seller" id="best_seller">
										<option value="0">No</option>
										<option value="1" <?php if(isset($row) && $row->best_seller == 1 ){ print 'selected'; } ?>>Yes</option>

										</select>

									</div>
								</div>


								<div class="form-group" style="display:none;">
									<label class="col-md-4 control-label">Sale Item</label>
									<div class="col-md-6">

										<select class="form-control" name="sale_item" id="sale_item">
										<option value="0">No</option>
										<option value="1" <?php if(isset($row) && $row->sale_item == 1 ){ print 'selected'; } ?>>Yes</option>

										</select>

									</div>
								</div>


								<div class="form-group">
									<label class="col-md-4 control-label">Delivery Options</label>
									<div class="col-md-6">

<input class="delivery-option" autocomplete="off"  id="next-day" type="checkbox" name="delivery_options[]" value="Next Day Tracked Delivery" <?php if(isset($row) && strstr($row->delivery_options, 'Next Day Tracked Delivery')){ print 'checked'; } ?>>  <label style="margin-right:10px" for="next-day">Next Day Tracked Delivery </label> <br />

<input class="delivery-option" autocomplete="off"  id="next-day2" type="checkbox" name="delivery_options[]" value="Tracked Delivery - 2 to 7 Working Days" <?php if(isset($row) && strstr($row->delivery_options, '2 to 7 Working Days')){ print 'checked'; } ?>>  <label style="margin-right:10px" for="next-day2">Tracked Delivery - 2 to 7 Working Days </label> <br />

<input class="delivery-option" autocomplete="off"  id="next-day3" type="checkbox" name="delivery_options[]" value="Large Items - Palletised delivery (1 to 2 Working Days)" <?php if(isset($row) && strstr($row->delivery_options, '(1 to 2 Working Days)')){ print 'checked'; } ?>>  <label style="margin-right:10px" for="next-day3">Large Items - Palletised delivery (1 to 2 Working Days)</label>  <br />

<input class="delivery-option" autocomplete="off"  id="next-day4" type="checkbox" name="delivery_options[]" value="Royal Mail (2 to 3 Working Days)" <?php if(isset($row) && strstr($row->delivery_options, '(2 to 3 Working Days)')){ print 'checked'; } ?>>  <label style="margin-right:10px" for="next-day4">Royal Mail (2 to 3 Working Days)</label>

									</div>
								</div>



								<div class="form-group">
									<label class="col-md-4 control-label">* Category</label>
									<div class="col-md-6">

									<p style="margin-top:8px"><strong>( You must select at least 1 category )</strong></p>

										<?php

										foreach($categoryObj->getAll() as $category){

											$checked = isset($categoriesArray) && in_array($category->id, $categoriesArray) ? 'checked' : '';

											print '<input class="category_checkbox" autocomplete="off"  '.$checked.' id="category-'.$category->id.'" type="checkbox" name="categories[]" value="'.$category->id.'"> <label style="margin-right:10px" for="category-'.$category->id.'">'.$category->title.' </label> ';

										}

										?>

										<br /><br />

									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">* Sub Category</label>
									<div class="col-md-6">

									<p style="margin-top:8px"><strong>( You must select at least 1 sub category, and the sub category must belong to your selected category )</strong></p>

										<?php

										$array = [];

										foreach($subcategoryObj->getAllConsole() as $sub_category){

										$checked = isset($subCategoriesArray) && in_array($sub_category->sub_category_id, $subCategoriesArray) ? 'checked' : '';

											if(!in_array($sub_category->title, $array)){

												print '<h5 style="text-decoration:underline;margin-top:20px">'.$sub_category->title.'</h5>';

											}

	print '<input autocomplete="off"  '.$checked.' id="sub_category-'.$sub_category->sub_category_id.'" type="checkbox" name="sub_categories[]" value="'.$sub_category->sub_category_id.'"> <label style="margin-right:10px" for="sub_category-'.$sub_category->sub_category_id.'">'.$sub_category->sub_category_title.' </label> ';

										$array[] = $sub_category->title;

										}



										?>

										<br /><br />
									</div>
								</div>


								<div class="form-group" style="display:none;">
									<label class="col-md-4 control-label">Weight</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" name="weight" id="weight" value="<?php if(isset($row)){ print $row->weight; } ?>">
									</div>
								</div>

								<div class="form-group" style="display:none;">
									<label class="col-md-4 control-label">Height</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" name="height" id="height" value="<?php if(isset($row)){ print $row->height; } ?>">
									</div>
								</div>

								<div class="form-group" style="display:none;">
									<label class="col-md-4 control-label">Width</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" name="width" id="width" value="<?php if(isset($row)){ print $row->width; } ?>">
									</div>
								</div>

								<div class="form-group" style="display:none;">
									<label class="col-md-4 control-label">Depth</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" name="depth" id="depth" value="<?php if(isset($row)){ print $row->depth; } ?>">
									</div>
								</div>

								<div class="form-group" style="display:none;">
									<label class="col-md-4 control-label">Capacity</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" name="capacity" id="capacity" value="<?php if(isset($row)){ print $row->capacity; } ?>">
									</div>
								</div>

								<div class="form-group" style="display:none;">
									<label class="col-md-4 control-label">Dimensions Extra</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" name="dimensions_extra" id="dimensions_extra" value="<?php if(isset($row)){ print $row->dimensions_extra; } ?>">
									</div>
								</div>

								<div class="form-group" style="display:none;">
									<label class="col-md-4 control-label">Dimensions Extra 2</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" name="dimensions_extra_2" id="dimensions_extra_2" value="<?php if(isset($row)){ print $row->dimensions_extra_2; } ?>">
									</div>
								</div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Quantity Available</label>
                                <div class="col-md-6">
                                    <input autocomplete="off" type="text" class="form-control" name="qty_available" id="qty_available" value="<?php if(isset($row)){ print $row->qty_available; } ?>">
                                </div>
                            </div>

								<div class="form-group">
									<label class="col-md-4 control-label">Price</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" name="price" id="price" value="<?php if(isset($row)){ print $row->price; } ?>">
									</div>
								</div>


								<div class="form-group">
									<label class="col-md-4 control-label">Special Offer Price</label>
									<div class="col-md-6">
									<input autocomplete="off" placeholder="Leave blank if not special offer" type="text" class="form-control" name="special_offer_price" id="special_offer_price" value="<?php if(isset($row)){ print $row->special_offer_price; } ?>">
									</div>
								</div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Brand</label>
                                <div class="col-md-6">
                                    <input autocomplete="off" type="text" class="form-control" name="brand" id="brand" value="<?php if(isset($row)){ print $row->brand; } ?>">
                                </div>
                            </div>

								<div class="form-group">
									<label class="col-md-4 control-label">Description</label>
									<div class="col-md-6">

				<textarea class="form-control" rows="10" name="description" id="description"><?php  if(isset($row)){ print $row->description; } elseif(isset($_SESSION[SESSION.'description'])){ print $_SESSION[SESSION.'description']; } ?></textarea>

									</div>
								</div>


								<?php

								for($i = 0; $i < 2; $i++){

								$option = $i * 2;
								$option_value = $option + 1;

								if(isset($row)){

									$attributes = json_decode($row->attributes);

								}

								$attribute_name = isset($attributes[$option]) ? $attributes[$option] : '';
								$attribute_values = isset($attributes[$option_value]) ? $attributes[$option_value] : '';

								?>

								<div class="form-group">
									<label class="col-md-4 control-label">Attribute Name</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" placeholder="eg. Option" class="form-control"  name="attributes[]" value="<?= $attribute_name ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Attribute Values</label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" placeholder="Small-10.00; Medium-15.00; Large-19.00" class="form-control"  name="attributes[]" value="<?= $attribute_values ?>">
										<br /><p>eg. Small-10.00; Medium-15.00; Large (OUT OF STOCK)-19.00 (if price changes)</p>
										<p>eg. Small; Medium (OUT OF STOCK); Large (if price isn't affected)</p>
									</div>
								</div>

								<?php } ?>


								<?php for($i = 1; $i < 11; $i++){ ?>

								<div class="form-group">
									<label class="col-md-4 control-label">Image Description <?= $i; ?></label>
									<div class="col-md-6">
									<input autocomplete="off" type="text" class="form-control" id="alt-<?= $i; ?>" name="alt-<?= $i; ?>" value="<?php if(isset($product_images[$i-1]->alt)){ print $product_images[$i-1]->alt; } ?>">
									</div>
								</div>

								<?php if(isset( $product_images[$i-1]->id )){ ?>

							<input autocomplete="off" type="hidden" name="id-<?= $i; ?>" value="<?= $product_images[$i-1]->id ?>">
							<input autocomplete="off" type="hidden" name="ext-<?= $i; ?>" value="<?= $product_images[$i-1]->ext ?>">

								<?php } ?>

								<div class="form-group">
									<label class="col-md-4 control-label">Image <?= $i; ?> (JPG, PNG or GIF)</label>
									<div class="col-md-6">
									<input autocomplete="off" type="file" class="form-control" name="file-<?= $i; ?>">

										<?php

										if(isset($product_images[$i-1]->ext)){

	print "<br /><a onclick=\"return confirm('Are you sure you want to delete this image?')\" href='account.php?page=product&action=delete-image&image_id=".$product_images[$i-1]->id."'><img style='width:150px' src='../product-images/".$product_images[$i-1]->id.".".$product_images[$i-1]->ext."'></a>";

										}

										?>

									</div>
								</div>

								<?php } ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="button" onclick="$('#more-images').slideToggle()">More images</button>
                                </div>
                            </div>

                                <div style="display: none;" id="more-images">
                                    <?php for($i = 11; $i < 31; $i++){ ?>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Image Description <?= $i; ?></label>
                                            <div class="col-md-6">
                                                <input autocomplete="off" type="text" class="form-control" id="alt-<?= $i; ?>" name="alt-<?= $i; ?>" value="<?php if(isset($product_images[$i-1]->alt)){ print $product_images[$i-1]->alt; } ?>">
                                            </div>
                                        </div>

                                        <?php if(isset( $product_images[$i-1]->id )){ ?>

                                            <input autocomplete="off" type="hidden" name="id-<?= $i; ?>" value="<?= $product_images[$i-1]->id ?>">
                                            <input autocomplete="off" type="hidden" name="ext-<?= $i; ?>" value="<?= $product_images[$i-1]->ext ?>">

                                        <?php } ?>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Image <?= $i; ?> (JPG, PNG or GIF)</label>
                                            <div class="col-md-6">
                                                <input autocomplete="off" type="file" class="form-control" name="file-<?= $i; ?>">

                                                <?php

                                                if(isset($product_images[$i-1]->ext)){

                                                    print "<br /><a onclick=\"return confirm('Are you sure you want to delete this image?')\" href='account.php?page=product&action=delete-image&image_id=".$product_images[$i-1]->id."'><img style='width:150px' src='../product-images/".$product_images[$i-1]->id.".".$product_images[$i-1]->ext."'></a>";

                                                }

                                                ?>

                                            </div>
                                        </div>

                                    <?php } ?>
                                </div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button <?php if($action == 'add'){ ?> id="submitButton" type="button" <?php } else { ?> type="submit" <?php } ?> class="btn btn-primary"> <?= strtoupper($action) ?> PRODUCT </button>
									</div>
								</div>

						</div>
					</div>


	</form>
