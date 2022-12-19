<?php

require __DIR__.'/includes/config.php';

use App\Order;
$orderObj = new Order;
$order_id = $orderObj->getOrderNumber() - 100000;
$order_row = $orderObj->find($order_id);

$cost = number_format($cartObj->total(), 2);



require('header.php');

?>

	<div class="container mb-0 mt-30">
			<div class="col-md-4 hidden-xs hidden-sm" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
			<div class="col-md-4 text-center">  <h1 class="mt-10">PAYMENT...</h1> </div>
			<div class="col-md-4" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
	</div>

<div class="container pt-30 pb-30">

<div class="panel panel-default">
	<div class="panel-body">

			<p class="text-center mt-20">Please wait while you are re-directed to Paypal</p>
			
			<img alt="Paypal Logo" class="img-responsive center-block mb-100" src="images/pp.jpg">
			
	</div>
	</div>

    <form action="https://www.paypal.com/cgi-bin/webscr" name="PPform" id="PPform" method="post" target="_top">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="info@wtstechnologies.com">
        <input type="hidden" name="item_name" value="<?= trim(htmlspecialchars( $orderObj->getOrderDescription() ) ) ?>">
        <input type="hidden" name="item_number" value="<?= $orderObj->getOrderNumber() ?>">
        <input type="hidden" name="amount" value="<?= $cost ?>">
        <input type="hidden" name="no_shipping" value="0">
        <input type="hidden" name="no_note" value="1">
        <input type="hidden" name="currency_code" value="GBP">
        <input type="hidden" name="return" value="<?= DOMAIN ?>/complete">
        <input type="hidden" name="lc" value="GB">
        <input type="hidden" name="bn" value="PP-BuyNowBF">
        <input type='hidden' id='first_name' name='first_name' value="">
        <input type='hidden' id='last_name' name='last_name' value="">
        <input type='hidden' id='address1' name='address1' value="">
        <input type='hidden' name='address2' value="">
        <input type='hidden' id='city' name='city' value="">
        <input type='hidden' id='zip' name='zip' value="">
        <input type='hidden' id='state' name='state'  value="">
        <input type='hidden' id='country' value="">
        <input type='hidden' id='phone' name='night_phone_b' value="">
        <input type='hidden' id='b_email' name='b_email' value="">
    </form>

<script language="JavaScript">
document.forms["PPform"].submit();
</script>

		

			</div>

<?php require('footer.php'); ?>