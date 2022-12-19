<?php

use App\Order;
use App\Product;
use App\ProductImage;
use App\PromoCode;
use App\ProductsFromOrder;
use App\Helpers\Tools;

$orderObj = new Order;
$promoObj = new PromoCode;
$productsFromOrderObj = new ProductsFromOrder;
$productObj = new Product;
$productImageObj = new ProductImage;

if( !$orderObj->canView($id) && !$user->isAdmin() ){

	return redirect( 'account.php?page=home', 'You are not authourised to view that page!', 'e' );

}
	
	$row = $orderObj->find($id);
	$user_row = $user->find($row->user_id);
	$query = $productsFromOrderObj->getAll($id);
	
	if( isset($_POST['status']) && $user->isAdmin() & isset($id) ){

		$orderObj->updateStatus($id);
	
	}
	
	if( isset($action) && $action == 'send-dispatched' && $user->isAdmin() & isset($id) ){

		$orderObj->sendDispatchedEmail($id);
	
	}

?>

<?php  if( $user->isAdmin() ){  ?>
<script>
$(function(){
	$('.print-address').click(function(){

			var data = {"first_name":"<?= strtoupper($user_row->first_name) ?>", "last_name":"<?= strtoupper($user_row->last_name) ?>", "address_1":"<?= strtoupper($user_row->address_1) ?>", "address_2":"<?= strtoupper($user_row->address_2) ?>", "town":"<?= strtoupper($user_row->town) ?>", "postcode":"<?= strtoupper($user_row->postcode) ?>", "country":"<?= strtoupper($user_row->country) ?>" };
			var popUp = window.open('', 'Print', 'width=500,height=500');
			popUp.document.write('<p style="font-size:20px;font-family:arial;margin-left:50px;margin-top:50px">'+ data.first_name.toUpperCase() +' '+ data.last_name.toUpperCase() +'<br /> '+ data.address_1.toUpperCase() +' <br /> '+ data.address_2.toUpperCase() +'  <br /> '+ data.town.toUpperCase() +'  <br /> '+ data.postcode.toUpperCase() +'  <br /> '+ data.country.toUpperCase() +' </p>');
	
			popUp.document.close();
			popUp.focus();
			popUp.print();

	})
});
</script>
<?php } ?>


					<form class="form-horizontal" method="post" action="">

						<div class="panel panel-default">
						<div class="panel-heading"><?php if(!$user->isAdmin()){ ?><a href="account?page=orders"><i class="fa fa-chevron-left"></i> BACK</a> | <?php } ?>VIEW ORDER</div>
						<div class="panel-body">
						
						<?php  if( $user->isAdmin() ){  ?>
						
								<div class="form-group">
									<label class="col-md-4 control-label">Tracking Code</label>
									<div class="col-md-6">

									<input type="text" name="tracking_code" class="form-control" placeholder="Enter to set tracking code..." value="<?php if(isset($row)){ print $row->tracking_code; } ?>">

									</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Tracking Code URL</label>
									<div class="col-md-6">

									<input type="text" name="tracking_code_url" class="form-control" placeholder="Tracking code url for dispatched email..." value="<?php if(isset($row)){ print $row->tracking_code_url; } ?>">
									
									<br /><p>Eg. https://www.royalmail.com/track-your-item</p>

									</select>
									</div>
								</div>								
						
								<div class="form-group">
									<label class="col-md-4 control-label">Status</label>
									<div class="col-md-6">
									<select class="form-control" name="status">
									<option value="New" <?php if(isset($row) && $row->status == 'New'){ print 'selected'; } ?>>New</option>
									<option value="Completed" <?php if(isset($row) && $row->status == 'Completed'){ print 'selected'; } ?>>Completed</option>
									<option value="Dispatched" <?php if(isset($row) && $row->status == 'Dispatched'){ print 'selected'; } ?>>Dispatched</option>
									<option value="Pending" <?php if(isset($row) && $row->status == 'Pending'){ print 'selected'; } ?>>Pending</option>
									<option value="Cancelled" <?php if(isset($row) && $row->status == 'Cancelled'){ print 'selected'; } ?>>Cancelled</option>
									</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Contact Methods</label>
									<div class="col-md-6 pt-7">

									<?= str_replace(array('[', ']', '"'), '', $user_row->contacts) ?>

									</select>
									</div>
								</div>								
						
						<?php } else { ?>
						
								<div class="form-group">
									<label class="col-md-4 control-label">Status</label>
									<div class="col-md-6 pt-7">
										<?php if(isset($row)){ print $row->status; } ?>
									</div>
								</div>
						
						<?php }  ?>
						
						
								<div class="form-group">
									<label class="col-md-4 control-label">Order Number</label>
									<div class="col-md-6 pt-7">
										<?php if(isset($row)){ print $row->order_number; } ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Tracking Code</label>
									<div class="col-md-6 pt-7">
										<?php if(isset($row)){ print $row->tracking_code; } ?>
									</div>
								</div>								
						
								<div class="form-group">
									<label class="col-md-4 control-label">Order Date</label>
									<div class="col-md-6 pt-7">
										<?php if(isset($row)){ print date('d/m/Y H:i', strtotime($row->created_at)); } ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Order Notes</label>
									<div class="col-md-6 pt-7">
										<?php if(isset($row)){ print $row->notes; } ?>
									</div>
								</div>								
								
								<?php if(isset($row->status) && $row->status == 'Dispatched'){ ?>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Dispatched Date</label>
									<div class="col-md-6 pt-7">
										<?php if(isset($row)){ print date('d/m/Y H:i', strtotime($row->dispatched_date)); } ?>
									</div>
								</div>

								<?php } ?>
						
								
								<div class="form-group">
									<label class="col-md-4 control-label">Shipping</label>
									<div class="col-md-6 pt-7">
										£<?= $row->shipping ?>
									</div>
								</div>								
								
								<div class="form-group">
									<label class="col-md-4 control-label">Total Cost</label>
									<div class="col-md-6 pt-7">
										£<?php
										
	$cost = $row->cost + $row->shipping;
	
	if($row->promo_code_id){
		
		$cost = Tools::showDiscountPrice($row->cost, $row->discount_amount, $row->discount_type);
		
		$cost = $cost + $row->shipping;
	
	}										
	
		print number_format($cost, 2);
										
										?>
									</div>
								</div>
								
								<?php if($row->promo_code_id){ ?>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Promo Code</label>
									<div class="col-md-6 pt-7">
										<?= strtoupper($promoObj->find($row->promo_code_id)->code) ?>
										
										<?php if($row->discount_type == 'percentage'){
										
											print '('.$row->discount_amount.'% Off)';
										
										 } else {
										
											print '(£'.$row->discount_amount.' Off)';
										
										 } ?>
										
									</div>
								</div>
								
								<?php } ?>


								<?php if($user->isAdmin()){ ?>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-primary mb-10"> EDIT STATUS <i class="fa fa-edit"></i></button>
										<button type="button" class="btn btn-default print-address mb-10"> PRINT ADDRESS <i class="fa fa-print"></i></button>
										<button onclick="window.print()" type="button" class="btn btn-default mb-10"> PRINT PAGE <i class="fa fa-print"></i></button>
										<a href="account?page=order&id=<?= $id ?>&action=send-dispatched" class="btn btn-default mb-10">SEND DISPATCHED EMAIL <i class="fa fa-envelope"></i></a>
									</div>
								</div>
								
								<?php } ?>
							
						</div>
					</div>
		
		
				</form>	

<?php

	$row = $user->find($row->user_id);

?>


						<div class="panel panel-default form-horizontal">
						<div class="panel-heading">CUSTOMER DETAILS</div>
						<div class="panel-body">
								
								<div class="form-group">
									<label class="col-md-4 control-label">Customer Name</label>
									<div class="col-md-6 pt-7">
										<?php if(isset($row)){ print ucwords($row->first_name).' '.ucwords($row->last_name); } ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Address</label>
									<div class="col-md-6 pt-7">
<?php if(isset($row)){ print ucwords($row->address_1); } if(isset($row->address_2) && $row->address_2 != ''){ print ', '.ucwords($row->address_2); } print ', '.ucwords($row->town).', '.strtoupper($row->postcode); if(isset($row->country)){ print ', '.strtoupper($row->country); } ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Email</label>
									<div class="col-md-6 pt-7">
										<?php if(isset($row)){ print strtolower($row->email); } ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Phone</label>
									<div class="col-md-6 pt-7">
										<?php if(isset($row)){ print $row->phone; } ?>
									</div>
								</div>
							
						</div>
						</div>
				


						<div class="panel panel-default form-horizontal">
						<div class="panel-heading">ORDER DETAILS</div>
						<div class="panel-body">
						
						<?php $i = 0; foreach($query as $row){ ?>
						
							<?php if($i > 0){ print "<hr />"; } ?>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Product</label>
									<div class="col-md-6 pt-7">
										<?= $row->title ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">EAN Code</label>
									<div class="col-md-6 pt-7">
										<?= $productObj->find($row->product_id)->product_code ?>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">MPN</label>
									<div class="col-md-6 pt-7">
										<?= $productObj->find($row->product_id)->sku ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Options</label>
									<div class="col-md-6 pt-7">
										<?= $row->options ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label">Quantity</label>
									<div class="col-md-6 pt-7">
										<?= $row->quantity ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Individual Price</label>
									<div class="col-md-6 pt-7">
										<?= $row->price ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Image</label>
									<div class="col-md-6 pt-7">
										<?php
										
										$image = $productImageObj->getRowByFieldNotDeleted('product_id', $row->product_id);
										
										?>
										
										<img alt="" class="img-responsive thumbnail" src="<?= DOMAIN ?>/product-images-thumbnails/<?= $image->id ?>.<?= $image->ext ?>">
										
									</div>
								</div>								

								
							<?php $i++; } ?>
							
						</div>
						</div>