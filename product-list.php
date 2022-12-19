<?php

use App\Product;
use App\ProductImage;

$productObj = new Product;
$productImageObj = new ProductImage;


if( isset($_GET['q']) ){

	$query = $productObj->search($_GET['q']);
	$title = 'You searched for... <br />'.$_GET['q'];
	$meta_title = COMPANY_NAME.' | Search';

}
elseif(strstr($url, '/new-in-shop')){

	$query = $productObj->dealWeek();
	$title = 'NEW IN SHOP';
	$meta_title = COMPANY_NAME.' | New In Shop';

}elseif(strstr($url, '/deal-of')){

	$query = $productObj->dealDay();
	$title = 'DEAL OF THE DAY';
	$meta_title = COMPANY_NAME.' | Deal of The Day';

}

if($COUNTURL2 > 0){
    $query = $productObj->getAllBySubCategory($sub_category_id);
    $title = $subCategoryObj->find($sub_category_id)->title;
    $meta_title = COMPANY_NAME.' | '.$subCategoryObj->find($sub_category_id)->title;


}
else {

	$query = $productObj->getAllByCategory($category_id);
	$title = $category_title;
	$meta_title = COMPANY_NAME.' | '.$category_title;
}

require 'header.php';

?>

<style>

@media (min-width: 1025px) {

.same-height3{ height:253px !important;overflow:hidden }
.same-height3 img{ max-height:253px }
.para-height{ height:60px !important;overflow:auto }

}

@media (min-width: 991px) and (max-width: 1024px) {

.same-height3{ height:205px !important;overflow:hidden }
.same-height3 img{ max-height:205px }
.para-height{ height:60px !important;overflow:auto }

}

@media (max-width: 320px) {

.same-height3{ height:110px !important;overflow:hidden }


}

@media (min-width: 321px) and (max-width: 375px) {

.same-height3{ height:120px !important;overflow:hidden }


}

@media (min-width: 376px) and (max-width: 414px) {

.same-height3{ height:150px !important;overflow:hidden }


}

</style>

<script>
$(function() {

if(screen.width < 1025){

	$('.same-height').matchHeight();

}

});
</script>

<div class="container-fluid mt-30">




<style>
    @media(max-width: 991px){
        #filters{
            display: none;
        }
    }
</style>
<div class="container-fluid" style="padding-left:  0 !important;padding-right: 0 !important;">

    <div class="row">
        <h1 class="text-center mb-30 mt-30" style="font-weight: 600 !important;"><?= strtoupper($title) ?></h1>
        <br>
        <div class="visible-xs visible-sm" style="padding-left: 17px;">
            <button onclick="$('#filters').toggle()" style="background: white;border:1px solid #333;padding: 5px;padding-left: 20px;padding-right: 20px;margin-bottom: 20px;">Filters</button>
        </div>

        <div class="col-lg-3 col-md-3" id="filters">
            <div class="panel panel-default">
                <div class="panel-body">

                    <form action="" method="GET">
                        <h4 style="font-weight: 500;">Brands</h4>
                        <hr class="mt-10 mb-10">
                        <div class="">
                            <?php
                            if($COUNTURL2 > 0){

                                $brands = $productObj->getAllBrandsSub($sub_category_id);
                                $bX = 0;
                                foreach ($brands as $brand){ $bX ++; ?>
                                    <input <?php if(isset($_GET["brand". $bX]) and $_GET["brand". $bX] == $brand->brand){ print "checked"; } ?> class="" value="<?= urlencode($brand->brand) ?>" type="checkbox" name="brand<?= $bX ?>"> <span style="font-size: 15px;"><?= $brand->brand ?></span><br>

                                <?php }
                            }
                            else{
                                $brands = $productObj->getAllBrands($category_id);
                                $bX = 0;
                                foreach ($brands as $brand){ $bX ++; ?>
                                    <input <?php if(isset($_GET["brand". $bX]) and $_GET["brand". $bX] == $brand->brand){ print "checked"; } ?> class="" value="<?= urlencode($brand->brand) ?>" type="checkbox" name="brand<?= $bX ?>"> <span style="font-size: 15px;"><?= $brand->brand ?></span><br>

                                <?php }
                            }

                            ?>

                        </div>
                        <h4 style="font-weight: 500;margin-top: 40px;">Price</h4>
                        <?php
                        if($COUNTURL2 > 0){

                            $Prices = $productObj->getMinPriceSub($sub_category_id);
                        }
                        else{
                            $Prices = $productObj->getMinPrice($category_id);
                        }

                        $minPrice = $Prices[0];

                        $maxPrice = $Prices[1];
                        ?>
                        <div>
                            <span style="font-size: 14px;">£<?= $minPrice ?></span>
                            <span style="float:right;font-size: 14px;">£<?= $maxPrice ?></span>
                        </div>
                        <style>
                            input[type=range]:focus{
                                outline: none !important;
                                box-shadow: none !important;
                            }
                        </style>
                        <input class="form-control" style="padding-left: 0;padding-right: 0;margin-bottom: 0;" type="range" name="max_price" step="0.1" min="<?= $minPrice ?>" max="<?= $maxPrice ?>" value="<?php if(isset($_GET["max_price"])){echo $_GET["max_price"];}else{ echo $maxPrice;} ?>" oninput="$('#range-price').text($(this).val())">
                        <div style="text-align: center;transform: translate(0,-12px);">
                            <span style="font-size: 14px;">£<span id="range-price"><?php if(isset($_GET["max_price"])){echo $_GET["max_price"];}else{ echo $maxPrice;} ?></span></span>
                        </div>
                        <button class="btn btn-primary mt-20" type="submit">Apply Filters</button>
                    </form>
                    <h4 style="font-weight: 500;margin-top: 40px;">Categories</h4>
                    <hr class="mt-10 mb-10">
                    <?php  $i = 1;   foreach( $categoryObj->getAll() as $category ){  ?>

                        <div class="">


                            <a class="" style="font-size: 15px !important;" class="filter-category" href="<?php print DOMAIN.'/'.$category->seo_url;?>"><?= $category->title ?></a><br>

                            <?php foreach( $subCategoryObj->getAllByCategoryId($category->id) as $sub_category ){ ?>

                                <a class="" style="font-size: 15px !important;padding-left: 15px;" class="filter-category" href="<?php print DOMAIN.'/'.$sub_category->seo_url;?>"><?= $sub_category->title ?></a><br>
                            <?php } ?>

                        </div>

                        <?php $i++; } ?>

                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9">
            <?php if(!count($query)){ ?>

                <p class="text-center">There are no results for that query.</p>

            <?php } ?>


            <div class="">
                <div class="panel panel-default" >
                    <div class="panel-body" style="padding: 0;">
                        <div class="col-md-12 mb-10 mt-10">
                            12 Results

                        </div>
                        <?php foreach($query as $row){

                            $image = $productImageObj->getRowByFieldNotDeleted('product_id', $row->id);


                            $images =  $productImageObj->getAll( $row->id )[1];


                            ?>

                            <div class=" col-lg-3 col-md-4 col-sm-4 col-xs-6 mb-20" style="padding: 5px;">

                                <div class="thumbnail mb-0" style="padding: 0 !important;border-radius:0px;">

                                    <div class="mb-10">

                                        <a href="<?= DOMAIN ?>/product/<?= $row->seo_url ?>">
                                            <img onmouseleave='$(this).attr("src",$(this).attr("data-first"));' onmouseenter='$(this).attr("src",$(this).attr("data-second"));' src="<?= DOMAIN ?>/product-images/<?= $image->id ?>.<?= $image->ext ?>" data-first="<?= DOMAIN ?>/product-images/<?= $image->id ?>.<?= $image->ext ?>" data-second="<?= DOMAIN ?>/product-images/<?= $images->id ?>.<?= $images->ext ?>" alt="<?= $images->alt ?>" alt="<?= $image->alt ?>" style="width: 100%;border-top-left-radius: 0px;border-top-right-radius: 0px;">

                                        </a>
                                    </div>

                                    <a class="prod-list-link" href="<?= DOMAIN ?>/product/<?= $row->seo_url ?>">
                                        <p class="mb-0 text-center"><?= $row->title ?></p>

                                        <p class="orange text-center">

                                            <strong>
                                                <?php

                                                if($row->special_offer_price){

                                                    print '<span class="red"><strike>£'.$row->price.'</strike></span> £'.$row->special_offer_price;

                                                }else{

                                                    print '£'.$row->price;

                                                }

                                                ?>
                                            </strong>

                                        </p>
                                    </a>
                                </div>


                            </div>

                        <?php } ?>
                    </div>
                </div>



            </div>
        </div>
    </div>



</div>

</div>

<?php require 'footer.php'; ?>