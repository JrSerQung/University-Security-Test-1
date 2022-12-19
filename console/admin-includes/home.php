<?php

$orderObj = new App\Order;

?>

<h1>DASHBOARD</h1>

<style>

.white{ color:#fff }
.font-big{ font-size:50px }
.opacity{ opacity:0.5 }

</style>

<br class="hidden-xs" />
<br class="hidden-xs" />
<div class="row">

	<div class="col-md-4">
	
		<h5 style="background:#359DB6;color:#fff;padding:10px;margin-bottom:0px"><strong>TOTAL ORDERS</strong></h5>
		
		<div class="col-md-12" style="background:#4BB1CB">
		
			<div class="row">
		
			<div class="col-md-3 col-sm-3 col-xs-3" style="padding-top:20px;padding-bottom:20px">  <i class="fa fa-shopping-cart white font-big opacity"></i> </div>
			<div class="col-md-9 col-sm-9 col-xs-9 white font-big text-right" style="padding-top:10px;padding-bottom:20px"><?= $orderObj->totalOrders() ?></div>
			
			</div>
		
		</div>
	
	</div>
	
	<div class="col-md-4">
	
		<h5 style="background:#359DB6;color:#fff;padding:10px;margin-bottom:0px"><strong>TOTAL SALES</strong></h5>
		
		<div class="col-md-12" style="background:#4BB1CB">
		
			<div class="row">
		
			<div class="col-md-3 col-sm-3 col-xs-3" style="padding-top:20px;padding-bottom:20px">  <i class="fa fa-gbp white font-big opacity"></i> </div>
			<div class="col-md-9 col-sm-9 col-xs-9 white font-big text-right" style="padding-top:10px;padding-bottom:20px"><?= number_format($orderObj->orderTotal(), 2) ?></div>
			
			</div>
		
		</div>
	
	</div>
	
	<div class="col-md-4">
	
		<h5 style="background:#359DB6;color:#fff;padding:10px;margin-bottom:0px"><strong>TOTAL CUSTOMERS</strong></h5>
		
		<div class="col-md-12" style="background:#4BB1CB">
		
			<div class="row">
		
			<div class="col-md-3 col-sm-3 col-xs-3" style="padding-top:20px;padding-bottom:20px">  <i class="fa fa-user white font-big opacity"></i> </div>
			<div class="col-md-9 col-sm-9 col-xs-9 white font-big text-right" style="padding-top:10px;padding-bottom:20px"><?= $orderObj->totalCustomers() ?></div>
			
			</div>
		
		</div>
	
	</div>

</div>