<?php
require __DIR__ . '/includes/config.php';

use App\Product;
use App\ProductImage;
use App\GalleryImage;

$productObj = new Product;
$productImageObj = new ProductImage;
$galleryImageObj = new GalleryImage;
$categoryObj = new \App\Category();
$subscriberObj = new \App\Subscriber();
$bannerImages = $galleryImageObj->getAll();
$categories = $categoryObj->getAll();

if(isset($_POST["subscribe_email"])){
    $subscriberObj->addNewSubscriber($_POST["subscribe_email"]);
}


require 'header.php';
?>

<?php
if(isset($_GET["subscribe"])){
    ?>
    <script>
        $(document).ready(function (){
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#subscribe").offset().top
            }, 500);
        })
    </script>

    <?php
}

?>

<style>
    html {
        scroll-behavior: smooth;
    }
    .heros .bg{
        background: rgba(0,0,0,.3);
        position: absolute;
        left:0;
        top:0;
        width: 100%;
        height: 100%;
    }
    .heros .center{
        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
        max-width: 700px !important;
        width: 100%;
    }
    .heros .banner-subtitle{
        font-size: 22px !important;
        font-weight: 700 !important;
        margin-bottom: 10px !important;
        text-align: center !important;
        margin-top: 5px !important;
    }
    .heros .banner-title{
        font-size: 40px !important;
        font-weight: 700 !important;
        margin-bottom: 10px !important;
        text-align: center !important;
        margin-top: 5px !important;

    }
    .heros .banner-description{
        font-size: 60px !important;
        font-weight: 700 !important;
        margin-top: 5px !important;
        margin-bottom: 5px !important;
        text-align: center !important;
        line-height: 70px;
    }
    .heros .banner-button{
        margin-top: 25px;
        font-size: 18px !important;
        background: white;
        color:#333;
        border-radius: 2px;
        border: none;
        padding: 5px;
        padding-left: 20px;
        padding-right: 20px;
        transition: .5s;
    }
    .heros .banner-button:hover{
        transition: .5s;
        opacity: .9;
    }
    #slick-images .slick-dots{
        bottom:10px !important;
    }
    #slick-images .slick-dots li.slick-active button:before {
        color:white !important;
        font-size: 10px;
    }
    #slick-images .slick-dots li button:before {
        color:white !important;
        font-size: 8px;
    }
    #slick-images .slick-dotted.slick-slider{
        margin-bottom: 0 !important;
    }
    #slick-products-homepage .slick-dots li.slick-active button:before {

        font-size: 10px;
    }
    #slick-categories-homepage .slick-dots li.slick-active button:before {

        font-size: 10px;
    }
    @media(max-width: 767px){
        .heros .banner-title{
            font-size: 25px !important;
        }
        .heros .banner-subtitle{
            font-size: 15px !important;
        }
        .heros .banner-description{
            font-size: 30px !important;
            line-height: 34px !important;
        }
        .heros .banner-button{
            margin-top: 15px !important;
            font-size: 15px !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
        }
        .heros .center{
            width: 80%;
            left:50% !important;
            top:50% !important;
            transform: translate(-50%,-50%) !important;
        }
        .text-sm-left{
            text-align: left !important;
            margin-top: 5px;
        }
    }
    .banner1-subtitle{
        font-size: 26px;margin-bottom: 0;
    }
    .banner1-title{
        font-size: 36px;margin-bottom: 0px !important;
    }
    .banner1-pos{
        position: absolute;
        left:50%;
        top:50%;
        transform: translate(-50%,-50%);
        text-align: center;
        width: 100%;
    }
    @media(max-width: 475px){
        .banner1-subtitle{
            font-size: 20px;
        }
        .banner1-title{
            font-size: 28px;
        }
        .banner1-height{
            padding: 0;
        }
    }
    @media(max-width: 991px){
        .inspiration-height{
            height: auto !important;
        }
        .inspiration-height div{
            position: relative !important;
            left:0 !important;
            top:0 !important;
            transform: none !important;
        }
        .banner1-pos{
            position: relative !important;
            left:0 !important;
            top:0 !important;
            transform: none !important;
            text-align: center;
            width: 100%;
        }

    }



    .view-btn{
        color:#333 !important;
        background: transparent !important;
        text-decoration: underline !important;
        padding: 5px;
        padding-right: 15px !important;
        padding-left: 15px !important;
        border-radius: 7px;
        border: none !important;
        font-weight: 300 !important;
        font-size: 15px !important;

    }


    #hero-banner2 {
        width: 100%;
        height: 30vh;
        background: url("<?= DOMAIN ?>/images/banner2.jpg") 50% 50% / cover;
        background-size: cover;
        position: relative;
    }


    #hero-banner2 .center-middle-title{
        font-size: 21px;

    }
    #hero-banner2 .center-middle{
        position: absolute;
        left:50%;
        top:50%;
        transform: translate(-50%,-50%);
        width: 100%;
        padding: 10px;
    }
    #hero-banner2 .bg{
        background: rgba(0,0,0,.5);
        position: absolute;
        left:0;
        top:0;
        width: 100%;
        height: 100%;
    }
    #hero-banner2:before {
        content: "";
        position: absolute;
        bottom: 0;
        top: 0;
        left: 0;
        right: 0;
    }
    #hero-banner2 h2{
        color:white;
    }
    #hero-banner2 p{
        color:white;
    }
    #hero-banner2 .hero-img{
        width: 100%;
        max-width: 400px;
        animation: float 2s ease-in-out infinite alternate-reverse both;

    }

    @media(min-width: 1200px){
        #hero-banner2{
            background-attachment: fixed;
        }
    }
    @media(max-width: 767px){
        #hero-banner2 {
            width: 100%;
            height: 40vh;
            background-size: cover;
            position: relative;
        }

    }
    @media(max-width: 450px){
        #hero-banner2 .center-middle-title{
            font-size: 18px;

        }

    }
</style>
<div class="container-fluid" style="padding: 0 !important;">
    <div style="margin-bottom: 0;" id="slick-images">
        <?php
        foreach ($bannerImages as $item){ ?>
            <div>

                <style>
                    #hero-<?= $item->id ?> {
                        width: 100%;
                        height: 70vh;
                        background: url("<?= DOMAIN ?>/gallery-images/<?= $item->id ?>.<?= $item->ext ?>") 50% 50% / cover;
                        background-size: cover;
                        position: relative;
                    }

                    #hero-<?= $item->id ?>:before {
                        content: "";
                        position: absolute;
                        bottom: 0;
                        top: 0;
                        left: 0;
                        right: 0;
                    }
                    #hero-<?= $item->id ?> h2{
                        color:white;
                    }
                    #hero-<?= $item->id ?> p{
                        color:white;
                    }
                    #hero-<?= $item->id ?> .hero-img{
                        width: 100%;
                        max-width: 400px;
                        animation: float 2s ease-in-out infinite alternate-reverse both;

                    }

                    @media(min-width: 1200px){
                        #hero-<?= $item->id ?>{
                            background-attachment: fixed;
                        }
                    }
                    @media(max-width: 767px){
                        #hero-<?= $item->id ?> {
                            width: 100%;
                            height: 40vh;
                            background: url("<?= DOMAIN ?>/gallery/<?= $item->id ?>.<?= $item->extension ?>") 50% 50% / cover;
                            background-size: cover;
                            position: relative;
                        }

                    }
                </style>

                <a href="<?= DOMAIN. $item->alt ?>">
                    <section id="hero-<?= $item->id ?>" class="d-flex align-items-center heros">
                        <div class="bg"></div>
                        <div class="center" style="<?php if($item->alignment == "right"){ echo 'left:calc(100% - 350px);right:0%;'; } if($item->alignment == "left"){ echo 'left: calc(0% + 350px);right:0%;'; } ?>">
                            <h2 class="banner-subtitle"><?= $item->line ?></h2>
                            <h2 class="banner-title"><?= $item->line1 ?></h2>
                            <h2 class="banner-description"><?= $item->line2 ?></h2>
                            <div class="text-center">
                                <button class="banner-button"><?= $item->btntext ?></button>
                            </div>
                        </div>
                    </section>
                </a>
            </div>
        <?php }
        ?>
    </div>
</div>


<div class="container-fluid" style="padding: 0;background: #bb01c7;margin-bottom: 15px;">
    <div class="container" style="padding: 0 !important;">
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <div style="min-height: 86px;max-width: 375px;background: #bb01c7;width: 100%;padding-left: 20px;padding-right:20px;border-radius: 15px;display: inline-block;margin-right: 5px;margin-left: 5px;">
                    <table class="table mb-0" style="min-height: 86px;">
                        <tr>
                            <td style="vertical-align: middle;width: 130px;border: none;">
                                <img src="<?= DOMAIN ?>/images/van%20icon.png" style="max-width: 120px;">
                            </td>
                            <td style="vertical-align: middle;border: none;">
                                <div style="font-size: 16px;color:white;font-weight: 500;">
                                    SAME DAY<br>UK DELIVERY
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="min-height: 86px;max-width: 375px;background: #bb01c7;width: 100%;padding-left: 20px;padding-right:20px;border-radius: 15px;display: inline-block;margin-right: 5px;margin-left: 5px;">
                    <table class="table mb-0" style="min-height: 86px;">
                        <tr>
                            <td style="vertical-align: middle;width: 80px;border: none;">
                                <img src="<?= DOMAIN ?>/images/hands%20icon.png" style="max-width: 80px;">
                            </td>
                            <td style="vertical-align: middle;border: none;">
                                <div style="font-size: 16px;color:white;font-weight: 500;">
                                    GREAT<br>WHOLESALE DEALS
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="min-height: 86px;max-width: 375px;background: #bb01c7;width: 100%;padding-left: 20px;padding-right:20px;border-radius: 15px;display: inline-block;margin-right: 5px;margin-left: 5px;">
                    <table class="table mb-0" style="min-height: 86px;">
                        <tr>
                            <td style="vertical-align: middle;width: 80px;border: none;">
                                <img src="<?= DOMAIN ?>/images/card%20icon.png" style="max-width: 80px;">
                            </td>
                            <td style="vertical-align: middle;border: none;">
                                <div style="font-size: 16px;color:white;font-weight: 500;">
                                    SECURE PAYMENT
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<?php  $i = 1;   foreach( $categoryObj->getAll() as $category ){  ?>

<div class="container-fluid" style="background: black;margin-bottom: 30px;padding: 5px;">
    <div class="" style="max-width: 1700px;margin: auto;padding-left: 20px;padding-right: 20px;">
        <div class="row">
            <div class="col-md-6">
                <div style="color:white;">
                    <?= strtoupper($category->title )?>
                </div>
            </div>
            <div class="col-md-6 text-right text-sm-left">
                <a href="<?= DOMAIN ?>/<?= $category->seo_url ?>" style="color:white;">
                    VIEW ALL
                </a>
            </div>
        </div>
    </div>
</div>

    <?php if(count($subCategoryObj->getAllByCategoryId($category->id))){ ?>
    <div class="container-fluid mb-20">
        <div class="" style="max-width: 1700px;margin: auto;">
            <div class="row">
                <div class="col-md-12">
                    <div id="slick-categories-<?= $category->id ?>" style="width: 100%;">

                            <?php foreach( $subCategoryObj->getAllByCategoryId($category->id) as $sub_category ){ ?>
                                <div class="text-center">
                                    <img src="<?= DOMAIN ?>/subcategory-images/<?= $category->id ?>.jpg" style="width: 100%;">
                                    <div class="mt-15">
                                        <a style="text-align: center !important;font-weight: 300 !important;" href="<?= DOMAIN ?>/<?= $sub_category->seo_url ?>">
                                            <button class="view-btn">
                                                View all <?= $sub_category->title ?>
                                            </button>

                                        </a>
                                    </div>
                                </div>





                        <?php } ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
        <?php
        if($category->seo_url == "arboria-garden-products"){ ?>
            <div class="container-fluid mb-20" style="background: linear-gradient(to right,white,#dbdad8);padding-top: 15px;padding-bottom: 15px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 banner1-height" style="position: relative">
                            <div class="banner1-pos">
                                <p class="banner1-subtitle">CHECK OUT OUR</p>
                                <p class="banner1-title">DEAL OF THE DEAL</p>
                                <div style="margin-bottom: 20px;" class="visible-sm visible-md visible-lg">
                                    <div style="display: inline-block;position: absolute;transform: translate(-80px,5px);color:red;font-size: 24px;"><del style="">£321</del></div>
                                    <span style="font-size: 38px;">£123</span>
                                </div>
                                <div style="margin-bottom: 20px;" class="visible-xs">

                                    <span style="font-size: 38px;"><del style="color:red;font-size: 24px;position: relative;top:-5px;">£321</del> £123</span>
                                </div>
                                <button class="banner-button" style="background: transparent;border:1px solid black;padding: 5px;padding-right: 12px;padding-left: 12px;">SHOP NOW</button>

                            </div>

                        </div>
                        <div class="col-md-6 text-center banner1-height">
                            <img src="<?= DOMAIN ?>/images/fireplace-banner.png" style="width: 100%;max-width: 300px;">
                        </div>
                </div>

                </div>
            </div>

            <?php } ?>
        <?php
        if($category->seo_url == "inglenook-fireside"){ ?>
            <div class="container-fluid mb-20" style="background: linear-gradient(to right,white,#dbdad8);padding-top: 15px;padding-bottom: 15px;">

                    <section id="hero-banner2" class="d-flex align-items-center ">
                        <div class="bg"></div>
                        <div class="center" style="">
                            <div class="center-middle text-center">
                                <div class="center-middle-title" style="color:white;">VIEW OUR PRICES</div>
                                <div class="center-middle-title" style="color:white;">WITH A TRADE ACCOUNT</div>
                                <div style="margin-top: 30px;">
                                    <a href="<?= DOMAIN ?>/login">
                                        <button class="banner-button" style="background: white;border:none !important;padding: 5px;padding-right: 12px;padding-left: 12px;margin-left: 10px;margin-right: 10px;">LOG IN</button>
                                    </a>
                                    <a href="<?= DOMAIN ?>/sign-up">
                                        <button class="banner-button" style="background: white;border:none !important;padding: 5px;padding-right: 12px;padding-left: 12px;margin-left: 10px;margin-right: 10px;">REGISTER</button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </section>
            </div>

        <?php } ?>
    <?php } else{ ?>
        <div class="container-fluid mb-20">
            <div class="" style="max-width: 1700px;margin: auto;">
                <div class="row">
                    <div class="col-md-12">
                        <div id="slick-categories-<?= $category->id ?>" style="width: 100%;">
                            <?php

                            ?>
                            <?php foreach( $productObj->getAllByCategoryLimit($category->id,10) as $row ){
                                $image = $productImageObj->getRowByFieldNotDeleted('product_id', $row->id);


                                $images =  $productImageObj->getAll( $row->id )[1];
                                ?>

                                <div class="mb-20" style="padding: 5px;">

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
    <?php } ?>

    </div>


    <?php $i++; } ?>









<?php require 'footer.php'; ?>
