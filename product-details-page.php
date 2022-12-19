<?php

use App\Product;
use App\ProductImage;

$productObj = new Product;
$productImageObj = new ProductImage;

$row = $productObj->getRowByField('seo_url', $slug);

if(!$row){

	include('404.php');
	exit;

}
if(isset($_POST["email-share"])){
    \App\Helpers\Mail::shareEmail($row,$_POST["send-to"]);
}

if($row->cross_sell_ids){

	$crossSellsArray = json_decode($row->cross_sell_ids);
	$newCrossSell = [];
	foreach($crossSellsArray as $crossSell){
	
		if( !$productObj->find($crossSell)->deleted_at ){
		
			$newCrossSell[] = $crossSell;
		
		}
	
	}

}
 
$attributes = json_decode($row->attributes);


if( isset($_POST['product_id']) ){

	$cartObj->add();

}

$cat = $row->category_id;
$cat = str_replace("[","",$cat);
$cat = str_replace("]","",$cat);
$cat = str_replace('"',"",$cat);
$cat = explode(",",$cat);

$relatedProducts = $productObj->relatedProducts($row->id,$cat);



$meta_title = COMPANY_NAME.' | '.$row->title;

require('header.php');


?>

<style>

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #F5F5F5;
}

/* Style the buttons that are used to open the tab content */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
 }

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
    background:#fff;
    margin-bottom:30px
}

</style>

<script>

function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
     tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
     document.getElementById(cityName).style.display = "block";
     evt.currentTarget.className += " active";
}

</script>

	<?php if( count(App\Helpers\Validation::errors()) || count(App\Helpers\Tools::flashes()) ){   ?>


	
	<?php } ?>

<div class="container-fluid bg-grey pt-20 pl-0 pr-0">

            <div class="container-fluid pb-10">
	    



					<div class="panel panel-default mt-0 mb-0">
						<div class="panel-body pb-30">
                            <?php require __DIR__.'/includes/flash-messages.php'; ?>
		    
		<div class="row mt-10">
		
  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
		
		<div class="left-thumbnail-holder visible-md visible-lg">
			
	<ol class="carousel-indicators">
	
		<?php 
		
		$i = 0;

        foreach( $productImageObj->getAll( $row->id ) as $product_image ){

        ?>

        <li data-target="#myCarousel" data-slide-to="<?= $i ?>" <?php if($i == 0){ ?>class="active <?php if( count($productImageObj->getAll( $row->id )) == 1 ){ print 'hidden-xs'; }  ?> " <?php } ?>>
            <img style="width: 100%;" class="img-responsive left-thumb hid" src="<?= DOMAIN ?>/product-images-thumbnails/<?= $product_image->id ?>.<?= $product_image->ext ?>" alt="<?= $product_image->alt ?> Thumb">
        </li>

        <?php $i++; } ?>

	</ol> 
		
		</div>
		    
		    <div class="col-md-6">

  <div class="carousel-inner" role="listbox">
  
  		<?php
		
		$i = 1;
		
		foreach( $productImageObj->getAll( $row->id ) as $product_image ){
		
		?>
  
    <div class="item <?php if($i == 1){ ?>active <?php } ?> pl-0-mob pr-0-mob">
     <a href="<?= DOMAIN ?>/product-images/<?= $product_image->id ?>.<?= $product_image->ext ?>" data-lightbox="set" data-title="<?= $row->title ?> <?= $i ?>"> <img  class="img-responsive main-image" src="<?= DOMAIN ?>/product-images/<?= $product_image->id ?>.<?= $product_image->ext ?>" alt="<?= $product_image->alt ?> Main">  </a>
    </div>

		<?php $i++; } ?>
    
  </div>
  
  <?php if( count($productImageObj->getAll( $row->id )) > 1 ){  // don't show left and right arrows if there is only 1 image  ?>

  <!-- Controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <i class="fa fa-chevron-left"></i>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <i class="fa fa-chevron-right"></i>
    <span class="sr-only">Next</span>
  </a>
  
  <?php } ?>


		    </div>
		    
		    </div>
		    
<script>
$(function(){
	$('.option-select').change(function(){
		if( this.value != '' ){
			var options = this.value.split('-');


            for (let i = 0; i < $(".carousel-indicators").find("img").length; i++) {
                if($($(".carousel-indicators").find("img")[i]).attr("alt").toUpperCase().includes(options[0].toUpperCase())){
                   $($(".carousel-indicators").find("img")[i]).click();
                }
            }

			var price = options[1].trim();
			price = Number(price);
			price = price.toFixed(2);
            $('#show-price').html( '<span class="red"> NOW &pound;'+price+'</span>' );
			
			$('#cart_price').val( price );
		}
	});
});
</script>
		    
			    <div class="col-md-5 pt-20-mob">

				<h1 style="font-weight:600 !important;"><?= $row->title ?></h1>

				
<?php

			$weight = $row->weight;
			$last_number = substr($weight, -1);
			$weight = number_format($row->weight, 2);
			if($last_number == 0){
			
				$weight = number_format($row->weight, 1);
			
			}

?>				

				<h2 id="show-price" style="font-weight:700;color:#d00000;margin-top: 10px;font-size: 19px;">
				
				<?php
				
				if( $row->special_offer_price ){
				
					print '<span class="" style="color:#333;"> NOW £'.$row->special_offer_price. '</span>';
				
				} else {
				
					print '£'.$row->price;
				
				}
				
				?>
				
				</h2>


                    <div style="color:#1fac1f;font-size: 15px;font-weight: 600;">
                        <span style="color:#333;margin-right: 10px;font-weight: 500;">Availability:</span> <i class="fa fa-check-circle" style="font-size: 15px;color:#1fac1f;"></i> <?= $row->qty_available; ?> in stock
                    </div>
                    <div style="font-size: 15px;">
                        <span style="margin-right: 10px;">SKU:</span> <span style="color:#CA1616;font-weight: 600;"><?= $row->sku ?></span>
                    </div>
                    <hr>



				<?php if($row->product_status){ ?>
			
					<div class="row mt-20">
                        <script>
                            /*
                              $($("img")[i]).click();

                             */
                            $(document).ready(function (){
                                $(".aaa")[0].click();
                            });
                            function findColorImage(that,value,index){

                                for (let i = 0; i < $(".left-thumb").length; i++) {
                                    console.log(i)

                                    if($($(".left-thumb")[i]).attr("alt").toLowerCase().includes(value.toLowerCase())){
                                        $("#color-name").text(value);
                                        $(".left-thumb").css({
                                            border: "none"
                                        });
                                        $(that).css({
                                            border: "2px solid #c5a864"
                                        });

                                        $($(".left-thumb")[i]).click();
                                        $("#color-select").prop("selectedIndex",parseInt(index) + 1);
                                        break;

                                    }
                                }

                            }
                        </script>
						<form action="" method="post">


						<?php if( count($attributes) ){  ?>
						
							<?php for($i = 0; $i < 2; $i++){

								$option = $i * 2;
								$option_value = $option + 1;

								if(isset($row)){

									$attributes = json_decode($row->attributes);

								}

								$attribute_name = isset($attributes[$option]) ? $attributes[$option] : '';
								$attribute_values = isset($attributes[$option_value]) ? $attributes[$option_value] : '';


								if(!$attribute_name){ continue; }
								?>

                                <div class="col-md-6 mb-20">




                                    <p class="mb-3">CHOOSE <?php echo strtoupper($attribute_name) ?>:
                                        <?php
                                        if(strtolower($attribute_name) == "color"){
                                            ?>
                                            <span id="color-name" style="text-transform: capitalize;"></span>
                                            <?php

                                        }

                                        ?>
                                    </p>





                                    <?php

                                    $explodeColons = explode(';', $attribute_values);

                                    ?>

                                    <!-- DON'T CHANGE option_title[] OR option_values[] keys  -->

                                    <input type="hidden" name="option_title[]" value="<?= strtoupper($attribute_name) ?>">


                                    <?php

                                    if(strtolower($attribute_name) == "color"){
                                        ?>
                                        <div class="row">

                                            <?php
                                            $x = 0;
                                            foreach( $productImageObj->getAll( $row->id ) as $product_image ){
                                                ?>
                                                <div class="col-md-3 col-sm-3 col-xs-4 mb-10">
                                                    <img  onclick="findColorImage(this,'<?php echo $product_image->alt; ?>','<?php echo $x ?>')" style="width: 100%;padding:2px;display: unset !important;" class="left-thumb hid aaa" src="<?= DOMAIN ?>/product-images-thumbnails/<?= $product_image->id ?>.<?= $product_image->ext ?>" alt="<?= $product_image->alt ?> Thumb">

                                                </div>
                                                <?php $x++;
                                            }
                                            ?>

                                        </div>
                                        <select style="display: none;" id="color-select" name="option_values[]" class="form-control option-select" required>

                                            <option value="">PLEASE SELECT</option>

                                            <?php
                                            $j = 0;
                                            foreach($explodeColons as $option){



                                                $disabled = strstr(strtoupper($option), 'OUT OF STOCK') ? 'disabled' : '';

                                                if($option == ''){ continue; }

                                                $option = trim($option);
                                                $option_value = $option;
                                                $option = str_replace('-', ' - £', $option);

                                                if( strstr($option, '£') && $j == 0 && $row->special_offer_price ){

                                                    $explode = explode('-', $option_value);
                                                    $option_value = $explode[0].'-'.$row->special_offer_price;
                                                    $explode = explode('-', $option);
                                                    $option = $explode[0].' - £'.$row->special_offer_price;

                                                }

                                                ?>

                                                <option value="<?= strtoupper($option_value) ?>" <?= $disabled ?>><?= strtoupper($option) ?></option>

                                                <?php $j++; } ?>

                                        </select>

                                        <?php
                                    }
                                    else{
                                        ?>
                                            <div class="row">
                                            <div class="col-sm-12">
                                                <select name="option_values[]" class="form-control option-select" required>

                                                    <option value="">PLEASE SELECT</option>

                                                    <?php
                                                    $j = 0;
                                                    foreach($explodeColons as $option){



                                                        $disabled = strstr(strtoupper($option), 'OUT OF STOCK') ? 'disabled' : '';

                                                        if($option == ''){ continue; }

                                                        $option = trim($option);
                                                        $option_value = $option;
                                                        $option = str_replace('-', ' - £', $option);

                                                        if( strstr($option, '£') && $j == 0 && $row->special_offer_price ){

                                                            $explode = explode('-', $option_value);
                                                            $option_value = $explode[0].'-'.$row->special_offer_price;
                                                            $explode = explode('-', $option);
                                                            $option = $explode[0].' - £'.$row->special_offer_price;

                                                        }

                                                        ?>

                                                        <option value="<?= strtoupper($option_value) ?>" <?= $disabled ?>><?= strtoupper($option) ?></option>

                                                        <?php $j++; } ?>

                                                </select>
                                            </div>
                                            </div>

                                        <?php
                                    }

                                    ?>






                                </div>


								    <?php




						}


						?>


						<?php } ?>


						</div>



							<div class="row">



								<input type="hidden" name="product_id" value="<?= $row->id ?>" />
								<input type="hidden" id="price" value="<?= $row->special_offer_price ? $row->special_offer_price : $row->price ?>" />
								<input type="hidden" id="cart_price" name="cart_price" value="<?= $row->special_offer_price ? $row->special_offer_price : $row->price ?>" />
								
									<?php
									
									$max = $row->qty_available > 10 ? 10 : $row->qty_available;
									
									?>
									

								
								</div>
                    <input name="payment_route" value="0" id="payment_route" type="hidden">

                    <div>
                        <input type="number" name="quantity" class="form-control mb-10" value="1" placeholder="Quantity..." max="<?= $row->qty_available ?>">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default form-control" onclick="$('#payment_route').val('0')"> ADD TO CART</button>
                    </div>
                        <div class="mt-20">
                            <style>
                                .share-email{
                                    background: transparent;
                                    transition: .3s;
                                    width: 40px;
                                    height: 40px;
                                    border:1px solid lightgrey;
                                    position: relative;
                                }
                                .share-email i{
                                    position: absolute;
                                    left:50%;
                                    top:50%;
                                    transform: translate(-50%,-50%);
                                }
                                .share-email:hover{
                                    transition: .3s;
                                    background: #d00000;
                                    cursor: pointer;
                                    border: none !important;
                                }
                                .share-email:hover i{
                                    color:white;
                                }
                            </style>

                            <div id="send-form" style="display: none;position: relative">
                                <input name="" value="" placeholder="Send to E-mail..." id="fake-share-email" class="form-control" onkeyup="$('#send-to').val(this.value)">
                                <div class="share-email" onclick="sendShare(this)" style="position: absolute;right:0;top:0;width: 34px !important;height: 34px !important;">
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                            <script>
                                function sendShare(that){
                                    if($("#fake-share-email").val() == ""){
                                        $("#fake-share-email").css({
                                            border:"1px solid #d00000"
                                        });
                                        $(that).css({
                                            border:"1px solid #d00000"
                                        });
                                        $("#fake-share-email").attr("placeholder","Field must be filled out!");
                                    }
                                    else{
                                        $('#email-share').click();
                                    }
                                }
                            </script>

                            <div class="share-email" onclick="$('#send-form').show();$(this).remove();">
                                <i class="far fa-envelope"></i>
                            </div>
                        </div>
							
							</div>
						
						</form>

            <form action="" method="POST">
                <input type="hidden" value="true" name="email-share">
                <input name="send-to" value="" type="hidden" placeholder="Send to E-mail..." class="form-control" id="send-to" required>
                <button style="display: none" type="submit" id="email-share">submit</button>
            </form>
					
						
					</div>
			
					<?php } ?>

			    </div>


		</div>
                <div class="" style="transform: translate(0,-2px)">

                    <!-- Tab links -->
                    <div class="tab">
                        <button style="background: #37393b!important;color:white;" class="tablinks active" onclick="openCity(event, 'description')"><span class="hidden-xs">Product </span>Description</button>
                        <!--  <button class="tablinks" onclick="openCity(event, 'specifications')"><span class="hidden-xs">Product </span>Specifications</button> -->
                    </div>

                    <!-- Tab content -->
                    <div id="description" class="tabcontent" style="display:block">
                        <div class="mt-20" style="font-size: 16px ">

                            <?php

                            $description = nl2br($row->description);

                            $description = str_replace('</p><br />', '</p>', $description);
                            $description = str_replace('</li><br />', '</li>', $description);
                            $description = str_replace('<ul><br />', '<ul>', $description);
                            $description = str_replace('<ul><br />', '<ul>', $description);
                            $description = str_replace('</ul><br />', '</ul>', $description);
                            $description = str_replace('<table><br />', '<table>', $description);
                            $description = str_replace('<tbody><br />', '<tbody><ul>', $description);
                            $description = str_replace('<tr><br />', '<tr>', $description);
                            $description = str_replace('</th><br />', '</th>', $description);
                            $description = str_replace('</td><br />', '</td>', $description);
                            $description = str_replace('</tr><br />', '</tr>', $description);
                            $description = str_replace('><br />', '>', $description);

                            print $description;

                            ?></div>


                    </div>


                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="position: relative;">
                                    <div style="width: 100%;height: 2px;background: lightgrey;margin-top: 30px;"></div>
                                    <h2 style="font-weight: 600;margin-top: 0;text-align: center;transform: translate(0,-15px);background: white;width: fit-content;margin: auto;padding-right: 20px !important;padding-left: 20px !important;">CUSTOMERS ALSO BOUGHT</h2>
                                </div>

                            </div>
                            <?php

                            foreach ($relatedProducts as $item){ ?>
                                <div class="col-md-3 mb-5 col-sm-6 cus-col" style="padding: 10px;">
                                    <?php

                                    $i = 1;

                                    foreach( $productImageObj->getAll( $item->id ) as $product_image ){

                                        ?>

                                        <div class="thumbnail mb-0" style="padding: 0 !important;border-radius:0px;">

                                            <div class="mb-10">
                                                <a href="<?= DOMAIN ?>/product/<?= $item->seo_url ?>">
                                                    <img style="width: 100%;" class="img-responsive" src="<?= DOMAIN ?>/product-images/<?= $product_image->id ?>.<?= $product_image->ext ?>" alt="<?= $product_image->alt ?> Main">
                                                </a>

                                            </div>

                                            <a class="prod-list-link" href="<?= DOMAIN ?>/product/<?= $item->seo_url ?>">
                                                <p class="mb-0 text-center"><?= $item->title ?></p>

                                                <p class="orange text-center">

                                                    <strong>
                                                        <?php

                                                        if($item->special_offer_price){

                                                            print '<span class="red"><strike>£'.$item->price.'</strike></span> £'.$item->special_offer_price;

                                                        }else{

                                                            print '£'.$item->price;

                                                        }

                                                        ?>
                                                    </strong>

                                                </p>
                                            </a>
                                        </div>

                                        <?php break; } ?>

                                </div>
                            <?php } ?>
                        </div>
                </div>
	</div>

	</div>

	</div>




</div>



<script>
$(function() {
	$('.same-height').matchHeight();
	$('.same-height2').matchHeight({byRow : false});
	$('.same-height3').matchHeight({byRow : false});
});
</script>

<?php

if(isset($newCrossSell) && count($newCrossSell)){

	print '<div class="container pb-20">';

	print '<h2 class="orange">You May Also Like</h2>';
	
	print '<div class="row">';

		foreach($newCrossSell as $product_id){ 
		
			$image = $productImageObj->getRowByFieldNotDeleted('product_id', $product_id);
			$product = $productObj->find($product_id);
		
		?>

		<div class="col-sm-3 col-md-3 col-xs-6 mb-20">
			
			<div class="thumbnail mb-0 same-height">
			
				<div class="same-height3">
				<a href="<?= DOMAIN ?>/product/<?= $product->seo_url ?>">
				<img src="<?= DOMAIN ?>/product-images-thumbnails/<?= $image->id ?>.<?= $image->ext ?>" alt="<?= $product->title ?>">
				</a>
				</div>
				
				<a class="prod-list-link" href="<?= DOMAIN ?>/product/<?= $product->seo_url ?>">
					<p class="mb-0 text-center"><?= $product->title ?></p>					
					
					<p class="orange text-center">
					
					<strong>
					<?php
					
					if($product->special_offer_price){
					
						print '<span class="red"><strike>£'.$product->price.'</strike></span> £'.$product->special_offer_price;
					
					}else{
					
						print '£'.$product->price;
					
					}
					
					?>
					</strong>
					
					</p>
				</a>
			</div>
			

		</div>
			
			
	<?php
		
		}
	
	print '</div>';
	
	print '</div>';

}

?>

<style>
    .main-image{
        width: 80%;margin: auto
    }
    @media(max-width: 991px){
        .main-image{
            width: 100% !important;
            margin-bottom: 15px !important;
        }
    }
</style>

 <?php require('footer.php'); ?>