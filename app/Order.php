<?php

namespace App;

use App\Helpers\Mail;
use App\Helpers\Tools;

class Order extends ObjectModel
{

    protected $table = 'orders';
    protected $fillable = ['user_id', 'shipping', 'cost', 'promo_code_id', 'discount_type', 'discount_amount', 'notes'];
    protected $user_id;
    protected $shipping;
    protected $cost;
    protected $order_id;
    protected $user;
    protected $cart;
    protected $promo_code;
    protected $productsFromOrder;

    public function __construct()
    {

	$this->user = new User;
	$this->cart = new Cart;
	$this->promo_code = new PromoCode;
	$this->productsFromOrder = new ProductsFromOrder;

    }

	
    public function getAll($status)
    {
	
	if( $status == 'All' ){
		
		/*  IF CUSTOMER IS VIEWING ORDERS  */
	
	return $this->execute("SELECT *, orders.id AS order_id, orders.created_at AS order_date 
					FROM orders WHERE user_id = ? AND deleted_at IS NULL AND status != 'Pending' 
					ORDER BY id DESC ", [$this->user->auth()->id]);
	
	} else {
	
		/*  IF ADMIN IS VIEWING ORDERS  */
		
		if($status == 'Dispatched'){
		
			return $this->execute("SELECT *, orders.id AS order_id, orders.created_at AS order_date 
							FROM orders LEFT JOIN users ON users.id = orders.user_id 
							WHERE orders.status = ? AND orders.deleted_at IS NULL
							ORDER BY orders.dispatched_date DESC  ", [$status] );		
		
		} else {
		
			return $this->execute("SELECT *, orders.id AS order_id, orders.created_at AS order_date 
							FROM orders LEFT JOIN users ON users.id = orders.user_id 
							WHERE orders.status = ? AND orders.deleted_at IS NULL
							ORDER BY orders.id DESC  ", [$status] );
		
		}


	}

    }
		
    public function search($search)
    {

	
	return $this->execute("SELECT *, orders.id AS order_id, orders.created_at AS order_date 
					FROM orders LEFT JOIN users ON users.id = orders.user_id  WHERE 
					( orders.order_number LIKE ? OR users.last_name LIKE ? OR users.email LIKE ? OR users.postcode LIKE ? OR users.phone LIKE ?  ) 
					AND orders.deleted_at IS NULL ORDER BY orders.id DESC ", ["%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%"]);

    }		
		

    public function getOrderNumber()
    {

	if( isset($_COOKIE[SESSION.'order_number']) && $_COOKIE[SESSION.'order_number'] != '' && $_COOKIE[SESSION.'order_number'] != null ){
	
		return $_COOKIE[SESSION.'order_number'];
	
	}
	
	if( isset($_SESSION[SESSION.'order_number']) && $_SESSION[SESSION.'order_number'] != '' && $_SESSION[SESSION.'order_number'] != null ){
	
		return $_SESSION[SESSION.'order_number'];
	
	}
	
	return false;		

    }
		
		
    public function getOrderDescription()
    {

	$description = '';

	$i = 0;

	foreach( $this->cart->getAll() as $row ){
	
		$description .= $i == 0 ? $row->quantity.' X '.$row->title.' '.str_replace(' <br /> ', '', $row->options) : ' : '.$row->quantity.' X '.$row->title.' '.str_replace(' <br /> ', '', $row->options);
		
	$i++;
	
	}
	
	return $description;

    }


		
    public function setOrderToCompleted($order_number)
    {

	$this->updateRow($this->table, ['status' => 'New'], 'order_number = :order_number LIMIT 1 ', [ 'order_number' => $order_number ] );

    }


    public function updateStock($order_number)
    {

	$this->id = $order_number - 100000;
	
	$query = $this->execute("SELECT * FROM products_from_order WHERE order_id = ? AND deleted_at IS NULL ", [$this->id]);
	
	$this->table = 'products';
	
	foreach( $query as $row ){
	
		$stock = $this->find($row->product_id)->qty_available;	
		$this->updateRow('products', ['qty_available' => ($stock - $row->quantity)], 'id = :id LIMIT 1 ', [ 'id' => $row->product_id ] );
	
	}

    }

		
    public function sendDispatchedEmail($order_id)
    {

	/* ROW WITH ORDER DETAILS */
	
	$order_row = $this->find($order_id);
	
	/* ROW WITH USER DETAILS */
	
	$user_row = $this->user->find($order_row->user_id);
	
	$html = "Dear ".ucwords($user_row->first_name).",<br /><br />
	Your order ".$order_row->order_number." has been dispatched to;<br /><br />
	".$user_row->first_name." ".$user_row->last_name."<br />
	".$user_row->address_1."<br />";
	
	if($user_row->address_2){
	
		$html .= $user_row->address_2."<br />";
	
	}
	
	$html .= $user_row->town."<br />".$user_row->postcode."<br /><br />Your tracking code is: ".$order_row->tracking_code."<br /><br /><a href='".$order_row->tracking_code_url."'>".$order_row->tracking_code_url."</a><br /><br />Thanks,<br />Get Goods<br />";
	
	
	$message = '<table width="500" cellpadding="10" cellspacing="0" border="1" style="font-family:arial">';
	$message .= '<tr><td bgcolor="#EAEAEA"><strong>Order Dispatched</strong></td></tr>';
	$message .= '<tr><td>'.$html.'</td></tr>';
	$message .= '</table>';

	

	Mail::send(trim($user_row->email), $message, 'Order Dispatched - '.$order_row->order_number, COMPANY_NAME);
	
	return redirect( $_SERVER['HTTP_REFERER'], 'The dispatched email has been sent' );

    }
		
		
    public function createOrder()
    {

	if( $this->user->auth() ){

		/* IF CUST IS LOGGED IN PASS THE RULES TO UNSET ON USER CLASS */

		$this->user->updateCustomerFromCheckout( array('password') );
		
		$this->user_id = $this->user->auth()->id;
	
	} else {
	
		$this->user_id = $this->user->add();
		
	}


		$this->shipping = $this->cart->shipping();
		$this->cost = $this->cart->subTotal();
		$this->promo_code_id = $this->cart->getPromoDiscountCodeId();		
		$this->discount_type = $this->promo_code->getPromoType();
		$this->discount_amount = $this->promo_code->getPromoCodeAmount();

		$this->order_id = $this->add();
		
		$order_number = $this->order_id + 100000;
		
		$this->updateRow($this->table, ['order_number' => $order_number], 'id = :id', [ 'id' => $this->order_id ] );

		$this->productsFromOrder->addOrderProducts($this->order_id);
		
		$_SESSION[SESSION.'order_number'] = $order_number;
		setcookie(SESSION.'order_number', $order_number, time()+7200, '/');

		return redirect( 'paypal' );

    }
		
		
    public function updateStatus($id)
    {
    
	$redirect = $_SERVER['HTTP_REFERER'];
    
	$status = $this->find($id)->status;
	
	if( $_POST['status'] == 'Dispatched' && $status != 'Dispatched' ){

		$this->updateRow($this->table, ['dispatched_date' => DT], 'id = :id LIMIT 1 ', [ 'id' => $id ] );
	
	}
	
	if( $_POST['status'] != 'Dispatched' && $status == 'Dispatched' ){

		$this->updateRow($this->table, ['dispatched_date' => NULL], 'id = :id LIMIT 1 ', [ 'id' => $id ] );
	
	}

	$this->updateRow($this->table, ['status' => $_POST['status'], 'tracking_code' => $_POST['tracking_code'], 'tracking_code_url' => $_POST['tracking_code_url']], 'id = :id LIMIT 1 ', [ 'id' => $id ] );
	
	return redirect( $redirect, 'The order has been updated' );

    }


    public function canView($id)
    {

	$row = $this->find($id);
	
	if( $row->user_id !== $this->user->auth()->id ){
		
		return false;
	
	}
	
	if( $row->status == 'Pending' ){
		
		return false;
	
	}
	
	return true;

    }
		
		
    public function countOrders()
    {

	$query = $this->execute("SELECT * FROM orders WHERE status != ? AND deleted_at IS NULL  ", ['Pending']);
	
	return count($query);

    }


    public function isHundred()
    {

	$countOrders = $this->countOrders();
	
	if( basename($_SERVER['SCRIPT_NAME']) == 'complete.php' ){
		
		$isZero = $countOrders % 100;
	
	} else {
	
		$isZero = ($countOrders+1) % 100;
	
	}
	
	if( !$isZero && $countOrders > 0 ){
	
		return true;
	
	}
	
	return false;			

    }


    public function getOrderSubTotal($order_id)
    {

	$subTotal = 0;

	$query = $this->productsFromOrder->getAll($order_id);
	
	foreach( $query as $row ){
	
		$subTotal += ($row->quantity * $row->price * $row->discount);
	
	}
	
	/*  IF THERE HAS BEEN A PROMO CODE APPLIED  */
	
	if( $this->find($order_id)->promo_code_id ){
	
		$discount = $this->promo_code->find($this->find($order_id)->promo_code_id)->percentage;
		
		$discount = (100 - $discount) / 100;
		
		$subTotal = $subTotal * $discount;
	
	}
	
	return $subTotal;

    }
		

    public function countPreviousOrders($order_id)
    {

	$query = $this->execute("SELECT * FROM orders WHERE id < ? AND deleted_at IS NULL AND status != 'Pending'  ", [$order_id]);
	
	return addOrdinalNumberSuffix(count($query)+1);

    }


    public function discountedPriceFromCompleted($promo_code_id, $sub_total, $discount_type, $discount_amount)
    {
    
	if($promo_code_id){
    
		if($discount_type == 'percentage'){
		
			return Tools::showDiscountPricePercentage($sub_total, $discount_amount);
		
		} else {
		
			return Tools::showDiscountPriceValue($sub_total, $discount_amount);	
		
		}
		
	}
	
		return false;

    }


    public function getAllByDateAndStatus($from, $to, $status)
    {

	return $this->execute("SELECT *, orders.id AS order_id, orders.created_at AS order_date 
					FROM orders LEFT JOIN users ON users.id = orders.user_id 
					WHERE orders.created_at BETWEEN ? AND ? AND orders.status = ? AND orders.deleted_at IS NULL
					ORDER BY orders.id DESC  ", [$from.' 00:00:00', $to.' 23:59:59', $status] );

    }


    public function export($from, $to)
    {
    
	$from = Tools::formatDate($from);
	$to = Tools::formatDate($to);

	$fields = "Order Date,Name,Order Number,Status,Order Amount,Shipping,Order Details,Qty,Notes \n";
	
	foreach($this->getAllByDateAndStatus($from, $to, $_GET['status']) as $row){
	
	$notes = str_replace(array(",", "\n", "\r"), " ", strtoupper($row->notes));
	$notes = str_replace('  ', ' ', $notes);
	
		foreach($this->productsFromOrder->getAll($row->order_id) as $product){

		$fields .= date('d/m/Y', strtotime($row->order_date))." , ".str_replace(",", "", strtoupper($row->first_name))." ".str_replace(",", "", strtoupper($row->last_name))." , ".$row->order_number." , ".$row->status." , ".$row->cost." , ".$row->shipping." , ".str_replace(",", "", strtoupper($product->title))." , ".$product->quantity." , ".$notes."  \n";
		
		}
	
	}

	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=orders.csv");    //  name the file will be
	header("Pragma: no-cache");
	header("Expires: 0");

	print $fields;
	exit;

    }


    public function delete($id)
    {

	$this->updateRow($this->table, ['deleted_at' => DT], 'id = :id  ', [ 'id' => $id ] );
	
	return redirect($_SERVER['HTTP_REFERER'], 'The order has been deleted');

    }


    public function totalOrders()
    {
    
	$query = $this->execute("SELECT * FROM orders WHERE deleted_at IS NULL 
					AND status != 'Pending' ", []);

	return count($query);

    }
    
    
    public function totalCustomers()
    {
    
	$query = $this->execute("SELECT * FROM orders LEFT JOIN users ON users.id = orders.user_id 
					WHERE orders.deleted_at IS NULL AND orders.status != 'Pending' GROUP BY users.email ", []);

	return count($query);

    }
    
    
    public function orderTotal()
    {
    
	$query = $this->execute("SELECT * FROM orders WHERE deleted_at IS NULL 
					AND status != 'Pending' ORDER BY id DESC ", []);
					
	$total = 0;

	foreach($query as $order){
	
		if($order->discount_type == null){
		
			$total += ( $order->cost + $order->shipping );
		
		} else{
		
			$total += (( Tools::showDiscountPrice($order->cost, $order->discount_amount, $order->discount_type)) + $order->shipping);
		
		}
	}
	
	return $total;

    }


}
