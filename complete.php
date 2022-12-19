<?php

ob_start();
require __DIR__.'/includes/config.php';

use App\Order;
use App\Helpers\Tools;
use App\Helpers\Mail;
use App\ProductsFromOrder;

$orderObj = new Order;
$productFromOrderObj = new ProductsFromOrder;

$user->destroyUniqueId();

$meta_title = COMPANY_NAME.' | Order Complete';
require 'header.php';

?>

	<div class="container mb-0 mt-30">
			<div class="col-md-4 hidden-xs hidden-sm" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
			<div class="col-md-4 text-center">  <h1 class="mt-10">ORDER COMPLETE</h1> </div>
			<div class="col-md-4" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
	</div>

<div class="container pt-30 pb-30">

					<div class="panel panel-default">
					<div class="panel-heading"><i class="fa fa-check"></i> ORDER COMPLETE</div>
						<div class="panel-body">

<?php require __DIR__.'/includes/flash-messages.php'; ?>

<?php if( $orderObj->getOrderNumber() ){

$order_id = $orderObj->getOrderNumber() - 100000;
$order = $orderObj->find($order_id);
$user_id = $orderObj->find($order_id)->user_id;
$_SESSION[SESSION.'email'] = trim($user->find($user_id)->email);
$to = $user->find($user_id)->first_name.' '.$user->find($user_id)->last_name;

?>


	<p>Thank you for your order. You have been emailed an order confirmation. Please check your junk mail folder if it does not arrive in your inbox. <br /><br /> Your order number is <?= $orderObj->getOrderNumber() ?>. Please use this in any correspondence regarding your order. Please see details below; <br /><br /></p>
	
	
	
	<div class="table-responsive">
	
	<!---->

		<table class="table" cellspacing="10">
						<thead>
							<tr>
								<th style="width:55%"><strong>Product<strong></th>
								<th style="width:15%"><strong>Price<strong></th>
								<th style="width:8%"><strong>Quantity<strong></th>
								<th style="width:22%;text-align:right"><strong>Subtotal<strong></th>
							</tr>
						</thead>
						<tbody>
							
							<?php
							
							$total = 0;
							
							foreach( $productFromOrderObj->getAll( $order_id ) as $row ){
							
							$sub_total = $order->cost;
							$shipping = $order->shipping;
							
							?>
							
								<tr>
									<td><?= $row->title ?> <br />
									
											<?php if($row->options){
											
											print $row->options;
												
											}
											
											?>
									
									</td>
									<td>&pound;<?= $row->price ?>
									
									</td>
									<td><?= $row->quantity ?></td>
									<td style="text-align:right">&pound;<?= number_format($row->quantity * $row->price, 2); ?></td>
								</tr>
								
							<?php } ?>

							
						</tbody>
						<tfoot>
						
							<tr>
								<td colspan="4" style="text-align:right"><strong>Subtotal &pound;<?= number_format($sub_total, 2) ?></strong></td>
							</tr>						
						
						<?php if($order->promo_code_id){ ?>

							<tr>
			<td colspan="4" style="text-align:right;color:#ff0000"><strong>Discount Price &pound;<?= number_format($orderObj->discountedPriceFromCompleted($order->promo_code_id, $sub_total, $order->discount_type, $order->discount_amount), 2) ?></strong></td>
							</tr>
							
						<?php } ?>
					
							
							<tr>
								<td colspan="4" style="text-align:right"><strong>Shipping &pound;<?= number_format($shipping, 2) ?></strong></td>
							</tr>
							
							<?php if($order->promo_code_id){ ?>
							
							<tr>
								<td colspan="4" style="text-align:right"><strong>Total &pound;<?= number_format($orderObj->discountedPriceFromCompleted($order->promo_code_id, $sub_total, $order->discount_type, $order->discount_amount) + $shipping, 2) ?></strong></td>
							</tr>
							
							<?php } else { ?>
							
							<tr>
								<td colspan="4" style="text-align:right"><strong>Total &pound;<?= number_format($sub_total + $shipping, 2) ?></strong></td>
							</tr>							
							
							<?php } ?>
							
	
						</tfoot>
		</table>
		
		<!---->

	</div>
	
	
	
<?php

$content = ob_get_contents();
$content = explode('<!---->', $content);
$content = $content[1];
$content = str_replace('<table', '<table style="width:700px" ', $content);
$content = str_replace(array('<thead>', '</thead>', '<tbody>', '</tbody>', '<tfoot>', '</tfoot>'), '', $content);
$content = str_replace(array('<th'), '<td', $content);
$content = str_replace(array('</th'), '</td', $content);

?>	


		<a href="<?= DOMAIN ?>/" class="btn btn-default"><i class="fa fa-chevron-left"></i> CONTINUE SHOPPING</a><br /><br />
	

<?php  } else {  ?>

<p class="mb-0">Your session has expired. If you require assistance regarding your enquiry please contact customer service.</p>

<?php } ?>



</div>
</div>
</div>


<?php
if( $orderObj->getOrderNumber() && isset($_SESSION[SESSION.'email']) && !isset($_SESSION[SESSION.'emailsent']) ){

    $user_row = $user->find($order->user_id);

    $message = '<table border="0" cellpadding="10" cellspacing="0" class="brdBottomPadd-two" id="templateContainer" width="100%"><tr><td id="templateContainerHeader"><p>Dear '.ucwords($user->find($user_id)->first_name).',</p><p>Thank you for your order. Your order number is '.$orderObj->getOrderNumber().'.</p><p>Please use this in any correspondence regarding your order. Please see details below;</p><br />'.$content.'<br /></td></tr></table>';

    Mail::send( trim($_SESSION[SESSION.'email']), $message, 'Order Confirmation - '.$orderObj->getOrderNumber(), ucwords($user_row->first_name).' '.ucwords($user_row->last_name)  );
    Mail::send( SMTP_EMAIL, $message, 'Order Confirmation - '.$orderObj->getOrderNumber(), COMPANY_NAME  );
    $_SESSION[SESSION.'emailsent'] = 'set';



}

?>


<?php require 'footer.php'; ?>