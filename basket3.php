<?php

require __DIR__.'/includes/config.php';

use App\PromoCode;
$promoObj = new PromoCode;

$productImageObj = new App\ProductImage;

if(isset($_POST['cart'])){

	unset($_SESSION[SESSION.'shipping']);	
	$cartObj->updateCart();

}

if(isset($_POST['code'])){

	$promoObj->checkPromoCode();

}


if(isset($_GET['delete'])){

	unset($_SESSION[SESSION.'shipping']);
	$cartObj->delete($_GET['delete']);

}

if(isset($_POST['shipping'])){

	$cartObj->setShipping($_POST['shipping']);

}

require 'header.php';

?>

<script>

$(function(){

	$('#shipping').change(function(){
	
		$('#shipping-form').submit();
	
	});

});

</script>

	<div class="container mb-0 mt-30">
			<div class="col-md-4 hidden-xs hidden-sm" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
			<div class="col-md-4 text-center">  <h1 class="mt-10"><i class="fa fa-shopping-basket"></i> SHOPPING BASKET</h1> </div>
			<div class="col-md-4" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
	</div>
	
	<div class="container mt-10">
	
<?php require __DIR__.'/includes/flash-messages.php'; ?>
	
	</div>

<div class="container pt-30 pb-50">

<?php if( !$cartObj->countItems() ){ ?>

<p>Your shopping basket is currently empty.</p>

<?php } else { ?>

	<div class="row mb-10 hidden-xs hidden-sm">
	
		<div class="col-md-1"> <strong>Product</strong> </div>
		<div class="col-md-1 col-md-offset-6"> <strong>Price</strong> </div>
		<div class="col-md-1"> <strong>Quantity</strong> </div>
		<div class="col-md-1"> <strong>Total</strong> </div>
	
	</div>

							<form action="" method="post">
							<input type="hidden" name="cart">
							
							<?php foreach( $cartObj->getAll() as $row ){ ?>

	<div class="row mb-10">
	
		<div class="col-md-1 col-xs-3 col-sm-3">  <img src="product-images/<?= $productImageObj->getRowByField('product_id', $row->id)->id.'.'.$productImageObj->getRowByField('product_id', $row->id)->ext ?>" alt="<?= $row->title ?>" class="img-responsive" /> </div>
		<div class="col-md-6 col-xs-6 col-sm-6">  

			<?= $row->title ?><br />
			
			<?php if($row->options){ print $row->options; } ?>
			
			

		</div>
		
		<div class="col-xs-3 visible-xs visible-sm">  <span class="symbol">£</span><span class="price" data-price="<?= number_format($row->quantity * $row->cart_price, 2) ?>"><?= number_format($row->quantity * $row->cart_price, 2) ?></span> </div>
	 	
		<div class="col-md-1 hidden-xs hidden-sm"> <span class="symbol">£</span><span class="price" data-price="<?= $row->cart_price ?>"><?= $row->cart_price ?></span>  </div>
		
		<div class="col-xs-12 visible-xs visible-sm mt-10">Qty:</div>
		
		<div class="col-md-1 col-xs-3 col-sm-3">  <input style="border-radius:0" type="number" class="form-control text-center" name="quantity<?= $row->cart_id ?>" value="<?= $row->quantity ?>"> </div>
		<div class="col-md-1 hidden-xs hidden-sm">  <span class="symbol">£</span><span class="price" data-price="<?= number_format($row->quantity * $row->cart_price, 2) ?>"><?= number_format($row->quantity * $row->cart_price, 2) ?></span> </div>
		<div class="col-xs-6 visible-xs visible-sm"></div>
		<div class="col-md-2 col-xs-9 col-sm-9 text-right">
		
			<button title="Update" type="submit" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
			<a class="btn btn-default btn-sm white" title="Remove" href="basket.php?delete=<?= $row->cart_id ?>"><i class="fa fa-trash-o"></i></a>
		
		</div>
	
	</div>
	

	<hr />
	
	<?php } ?>
	
	</form>
	
	<div class="row"> 
	<div class="col-md-6"> 
	
		<div class="row">
		
			<div class="col-md-12">
				
				<form action="" method="post" id="shipping-form">
				<select class="form-control mb-20" name="shipping" id="shipping">
				
					<option value="">Please Select Your Shipping Method</option>
					
			<option value="4.95" <?php if($cartObj->shipping() == '4.95'){ print 'selected'; } ?>>Royal Mail Standard Delivery - £4.95</option>
			<option value="6.95" <?php if($cartObj->shipping() == '6.95'){ print 'selected'; } ?>>Royal Mail Next Day - £6.95</option>
			<option value="0.00" <?php if($cartObj->shipping() == '0.00'){ print 'selected'; } ?>>Collect in Store - £0.00</option>				

				
				</select>
				</form>			
				
			</div>
		
			<div class="col-md-12 mt-10 mb-20">
			
				<form action="" method="post">
				
				<div class="row">
			
					<div class="col-md-9 col-xs-6 col-sm-9"> <input type="text" class="form-control" name="code" placeholder="Enter promo code..."> </div>
					<div class="col-md-3 col-xs-6 col-sm-3">  <button class="btn btn-default form-control more-info">REDEEM</button> </div>
				
				</div>
				
				</form>				
			
			</div>
		
		
		</div>
		
	
	</div> 
	
	<div class="col-md-6 text-right mb-10"><strong>Sub Total <span class="symbol">£</span><span class="price" data-price="<?= number_format($cartObj->subTotal(), 2) ?>"><?= number_format($cartObj->subTotal(), 2) ?></span></strong></div> 
	
	<?php if($promoObj->getPromoCodeId()){ ?>
	
	<div class="col-md-6 text-right mb-10 colour-red"><strong>Discounted Price <span class="symbol">£</span><span class="price" data-price="<?= number_format($cartObj->discountedPrice(), 2) ?>"><?= number_format($cartObj->discountedPrice(), 2) ?></span></strong></div> 
	
	<?php } ?>

	<div class="col-md-6"></div> 
	<div class="col-md-6 text-right mb-10"><strong>Shipping <span class="symbol">£</span><span class="price" data-price="<?= number_format($cartObj->shipping(), 2) ?>"><?= number_format($cartObj->shipping(), 2) ?></span></strong></div> 

	<div class="col-md-6"></div> 
	<div class="col-md-6 text-right mb-10"><strong>Total <span class="symbol">£</span><span class="price" data-price="<?= number_format($cartObj->total(), 2) ?>"><?= number_format($cartObj->total(), 2) ?></span></strong></div> 
	</div>
	
	<div class="col-md-6 pull-left col-xs-12 pr-0 pl-0 mt-20 visible-md visible-lg">
	
	<a href="<?= DOMAIN ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> CONTINUE SHOPPING</a>
	
	</div>
	
	<div class="col-md-6 col-xs-12 pr-0 pl-0 mt-20">
	
	<a href="checkout" class="btn btn-default pull-right">CHECKOUT <i class="fa fa-chevron-right"></i></a>
	
	</div>

<?php } ?>

</div>


<?php require 'footer.php'; ?>