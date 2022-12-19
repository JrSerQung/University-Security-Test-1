<script type="text/javascript" src="slick/slick.min.js"></script>
<style>
    /* the slides */
    .slick-slide {
        margin: 0 5px;
    }

    /* the parent */
    .slick-list {
        margin: 0 -5px;
    }
    .footer-title{
        margin-top: 0 !important;
        font-size: 18px !important;
        color:white !important;
    }

</style>
<script>
    <?php  $i = 1;   foreach( $categoryObj->getAll() as $category ){  ?>

    $("#slick-categories-<?= $category->id ?>").slick({
        dots: true,
        slidesToShow: 5,
        rows:1,
        slidesToScroll: 5,
        autoplay: true,
        infinite: false,
        autoplaySpeed: 3000,
        arrows: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3

                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
        ],
        spacing: 2,
        prevArrow:"<div class='' style='position: absolute !important;left:0px !important;top:50% !important;transform: translate(0,-50%) !important;z-index: 1111 !important;'><i style='font-size: 35px !important;cursor:pointer;padding:10px;color:white;' class='fas fa-caret-left'></i></div>",
        nextArrow:"<div class='' style='position: absolute !important;right:0px !important;top:50% !important;transform: translate(0,-50%) !important;z-index: 1111 !important;'><i style='font-size: 35px !important;cursor:pointer;padding:10px;color:white;' class='fas fa-caret-right'></i></div>"
    });

    <?php } ?>



    $("#slick-images").slick({
        dots: true,
        slidesToShow: 1,
        rows:1,
        slidesToScroll: 1,
        autoplay: false,
        infinite: false,
        autoplaySpeed: 3000,
        arrows: true,
        spacing: 2,
        prevArrow:"<div class='' style='position: absolute !important;left:0px !important;top:50% !important;transform: translate(0,-50%) !important;z-index: 1111 !important;'><i style='font-size: 35px !important;cursor:pointer;padding:10px;color:white;' class='fas fa-caret-left'></i></div>",
        nextArrow:"<div class='' style='position: absolute !important;right:0px !important;top:50% !important;transform: translate(0,-50%) !important;z-index: 1111 !important;'><i style='font-size: 35px !important;cursor:pointer;padding:10px;color:white;' class='fas fa-caret-right'></i></div>"
    });
    $("#slick-categories-homepage").slick({
        dots: true,
        slidesToShow: 3,
        rows:2,
        slidesToScroll: 3,
        autoplay: true,
        infinite: false,
        autoplaySpeed: 3000,
        arrows: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3

                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
        ],
        spacing: 2,
        prevArrow:"<div class='' style='position: absolute !important;left:0px !important;top:50% !important;transform: translate(0,-50%) !important;z-index: 1111 !important;'><i style='font-size: 35px !important;cursor:pointer;padding:10px;color:white;' class='fas fa-caret-left'></i></div>",
        nextArrow:"<div class='' style='position: absolute !important;right:0px !important;top:50% !important;transform: translate(0,-50%) !important;z-index: 1111 !important;'><i style='font-size: 35px !important;cursor:pointer;padding:10px;color:white;' class='fas fa-caret-right'></i></div>"
    });


    $("#slick-related-products").slick({
        dots: true,
        slidesToShow: 4,
        rows:1,
        slidesToScroll: 4,
        autoplay: false,
        infinite: false,
        autoplaySpeed: 3000,
        arrows: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
        ],
        spacing: 2,
        prevArrow:"<div class='' style='position: absolute !important;left:0px !important;top:50% !important;transform: translate(0,-50%) !important;z-index: 1111 !important;'><i style='font-size: 35px !important;cursor:pointer;padding:10px;color:white;' class='fas fa-caret-left'></i></div>",
        nextArrow:"<div class='' style='position: absolute !important;right:0px !important;top:50% !important;transform: translate(0,-50%) !important;z-index: 1111 !important;'><i style='font-size: 35px !important;cursor:pointer;padding:10px;color:white;' class='fas fa-caret-right'></i></div>"
    });

    $("#slick-products-homepage").slick({
        dots: true,
        slidesToShow: 4,
        rows:1,
        slidesToScroll: 4,
        autoplay: false,
        infinite: false,
        autoplaySpeed: 3000,
        arrows: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
        ],
        spacing: 2,
        prevArrow:"<div class='' style='position: absolute !important;left:0px !important;top:50% !important;transform: translate(0,-50%) !important;z-index: 1111 !important;'><i style='font-size: 35px !important;cursor:pointer;padding:10px;color:white;' class='fas fa-caret-left'></i></div>",
        nextArrow:"<div class='' style='position: absolute !important;right:0px !important;top:50% !important;transform: translate(0,-50%) !important;z-index: 1111 !important;'><i style='font-size: 35px !important;cursor:pointer;padding:10px;color:white;' class='fas fa-caret-right'></i></div>"
    });


</script>
<script>
    $(function(){

        if(screen.width > 1024){

            $('.link').hover(function(){

                $(this).find('.dropdown-menu').toggle();

            });

        }

        if(screen.width < 1025){

            $('.link').click(function(){

                $(this).find('.dropdown-menu').toggle();

            });

        }


    });

</script>
<script>


    $(function() {

        $('.sub-banner-icons').matchHeight({byRow : false});
        $('.inspiration-height').matchHeight({byRow : false});
        $('.mailing-height').matchHeight({byRow : false});
        $('.banner1-height').matchHeight({byRow : false});

    });
</script>

<script>
    let way = 0;
    $(".abc").click(function (){
        if(way == 0){
            way ++;
            $("#mySearchB").animate({
                height: "70px"
            })
        }
        else{
            way = 0;
            $("#mySearchB").animate({
                height: "0px"
            })
        }
    });
</script>



<div class="container-fluid" style="background: #464646;padding: 20px;position: relative;">
    <div style="max-width: 1675px;margin: auto">
        <div class="row">
            <div class="col-md-3 mb-30-mob">
                <h2 class="footer-title">MORE INFORMATION</h2>
                <p class="mb-5 footer-item">
                    <a href="<?= DOMAIN ?>/contact">Contact Us</a>
                </p>
                <p class="mb-5 footer-item">
                    <a href="<?= DOMAIN ?>/privacy">Privacy Policy</a>
                </p>
                <p class="mb-5 footer-item">
                    <a href="<?= DOMAIN ?>/delivery">Delivery Information</a>
                </p>
                <p class="mb-20 footer-item">
                    <a href="<?= DOMAIN ?>/terms">Terms & Conditions</a>
                </p>

                <a class="social-icons" href="https://www.facebook.com/" target="_blank">
                    <i style="font-size: 22px;margin-right: 10px;" class="fab fa-facebook"></i>
                </a>

                <a class="social-icons" href="https://twitter.com/" target="_blank">
                    <i style="font-size: 22px;margin-right: 10px;" class="fab fa-twitter"></i>
                </a>

            </div>
            <div class="col-md-3 mb-30-mob">
                <h2 class="footer-title">OUR PRODUCTS</h2>
                <p class="mb-5 footer-item">
                    <a href="<?= DOMAIN ?>/">Best Sellers</a>
                </p>
                <p class="mb-5 footer-item">
                    <a href="<?= DOMAIN ?>/">Featured Products</a>
                </p>
                <p class="mb-5 footer-item">
                    <a href="<?= DOMAIN ?>/">Special Offers</a>
                </p>
                <p class="mb-5 footer-item">
                    <a href="<?= DOMAIN ?>/">Sale</a>
                </p>
            </div>
            <div class="col-md-3 mb-30-mob">
                <h2 class="footer-title">PRODUCT CATEGORIES</h2>
                <?php
                    foreach( $categoryObj->getAll() as $category ) { ?>
                        <p class="mb-5 footer-item">
                            <a href="<?= DOMAIN ?>/<?= $category->seo_url ?>"><?= $category->title ?></a>
                        </p>
                    <?php }
                ?>
            </div>
            <div class="col-md-3 mb-30-mob text-left" id="subscribe">
                <h2 class="footer-title">SIGN UP TO OUR MAILING LIST FOR OFFERS AND UPDATES</h2>

                <div style="margin-top: 15px;">
                    <?php
                    if(isset($_GET["subscribe"]) and $_GET["subscribe"] == "success"){ ?>
                        <p style="color:white;font-size: 15px;margin-bottom: 5px !important;">Thank you for subscribing to our newsletter!</p>
                    <?php }
                    if(isset($_GET["subscribe"]) and $_GET["subscribe"] == "existing"){  ?>
                        <p style="color:white;font-size: 15px;margin-bottom: 5px !important;">You are already subscribed to our newsletter!</p>
                    <?php }

                    ?>

                    <form action="" method="post">
                        <div style="position: relative;">
                            <input class="form-control mb-0" placeholder="Email Address" style="border:none;border-radius: 0 !important;padding-right: 95px !important;" name="subscribe_email">
                            <button class="btn btn-primary" style="background: #000000 !important;color:white !important;font-size: 16px;padding-right: 10px;padding-left: 10px;font-weight: 500;border:none !important;position: absolute;right:0;top:0;">SIGN UP</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
<div class="container-fluid visible-lg visible-md visible-sm" style="background: #ffffff">
    <p style="margin-bottom: 0;color:#333 !important;font-weight: 400;padding: 10px;text-align: center">
        Copyright <?= COMPANY_NAME ?> <?= date("Y") ?> <span style="margin-left: 35px;margin-right: 35px;">|</span> Website by <a style="color:#333;" href="https://www.wtstechnologies.co.uk/" target="_blank">WTS Technologies</a>
    </p>
</div>
<div class="container-fluid visible-xs" style="background: #ffffff">
    <p style="margin-bottom: 0;color:#333 !important;font-weight: 400;padding: 10px;text-align: center">
        Copyright <?= COMPANY_NAME ?> <?= date("Y") ?><br>
        Website by <a style="color:#333 !important;" href="https://www.wtstechnologies.co.uk/" target="_blank">WTS Technologies</a>
    </p>
</div>



</body>
</html>
