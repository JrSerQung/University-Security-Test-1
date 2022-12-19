
<!DOCTYPE HTML>
<head>
    <title><?= isset($meta_title) ? $meta_title : COMPANY_NAME . " | Home"?></title>
    <link href="<?= DOMAIN ?>/images/new/logo.png" rel="icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?= DOMAIN ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= DOMAIN ?>/css/padding.css" />
    <link rel="stylesheet" type="text/css" href="<?= DOMAIN ?>/css/styles.css?v=<?= time() ?>">

    <meta name="description" content="<?= isset($meta_description) ? $meta_description : COMPANY_NAME.' - King of Textiles ' ?>" />
    <script src="<?= DOMAIN ?>/js/jquery-1.11.3.min.js"></script>
    <link rel="stylesheet" href="<?= DOMAIN ?>/lightbox/dist/css/lightbox.css">
    <script src="<?= DOMAIN ?>/lightbox/dist/js/lightbox-plus-jquery.min.js"></script>
    <script src="<?= DOMAIN ?>/js/jquery.matchHeight-min.js"></script>
    <script src="<?= DOMAIN ?>/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/f4af6b6275.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <style>
        html, body{
            overflow-x: hidden !important;
        }
        #q::-ms-clear {
            display: none;
        }
        .social-icons{
            color:white;

        }
        .social-icons:hover{
            color:white !important;
            text-decoration: none !important;
        }

    </style>
    <script>

        $(function(){

            $('.search-submit').click(function(){

                if( $('#q').val() == '' ){

                    alert('Please enter a search term');
                    $('#q').focus();
                    return false;
                }

                $('#search-form').submit();

            });

            $('#icon-search').click(function(){

                $('#mobile-search-form').submit();

            });



        });

    </script>
    <script>
        $(function() {
            $('.search-height').matchHeight({byRow : false});
            $('.service-blocks').matchHeight({byRow : false});
            $('.footer-subscribe-block').matchHeight({byRow : false});
            $('.footer-subscribe-block-left').matchHeight({byRow : false});
            $('.footer-main-block').matchHeight({byRow : false});

            $('.title-1-height').matchHeight({byRow : false});

        });
    </script>
    <style>
        .lds-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
            position: absolute;
            left:50%;
            top:50%;
            transform: translate(-50%,-50%);

        }
        .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 64px;
            height: 64px;
            margin: 8px;
            border: 8px solid #fff;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #fff transparent transparent transparent;
        }
        .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
        }
        .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }
        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }
        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

    </style>
    <script>
        $(function() {

            $("#loader").remove();

        });
    </script>
</head>
<body style="overflow-x: hidden">

<div id="loader" style="position: fixed;top:0;left:0;width: 100%;height: 100vh;background: #dbdad8;z-index: 1999;">
    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
</div>
<style>
    ::placeholder {
        font-weight: 300 !important;
    }

    :-ms-input-placeholder { /* Internet Explorer 10-11 */
        font-weight: 300 !important;
    }

    ::-ms-input-placeholder { /* Microsoft Edge */
        font-weight: 300 !important;
    }

    @media(max-width: 991px){
        .navbar-toggle{
            display: unset !important;
        }
    }
    @media(min-width: 992px){
        .navbar-toggle{
            display: none !important;
        }
    }
    .dark-bg{
        background: #232324 !important;
        color:white;
        padding: 10px;
    }
    .container-fluid-1400{
        max-width: 1600px;
        margin: auto;
    }

    .search-input::placeholder{
        color:#333 !important;

    }
    .search-input{
        border-radius: 40px;
        height: 30px;
        width: 100%;
        padding-left: 35px !important;
        font-weight: 900;
        font-size: 15px;



    }
    .search-input-icon{
        width: 25px;
        height: 25px;
        border-radius: 100%;
        background: #bb01c7;
        position: absolute;
        left:3px;top:3px;
        cursor: pointer;
        color:white;
    }
    .search-input-categories{
        width: 180px;
        height: 42px;
        border-radius: 28px;
        background: #2e2e2e;
        position: absolute;
        color:white;
        left:-1px;
        top:0px;
        cursor: pointer;
        line-height: 45px;
    }
    input::placeholder {
        font-weight: 900;
        letter-spacing: 1.25px;
        font-size: 15px;
        color:#c7c7c7 !important;
    }
    </style>
<div class="container-fluid visible-md visible-lg " style="background: white;padding: 0 !important;padding-top: 0px !important;padding-bottom: 0px !important;">
    <div style="background: #bb01c7;">
        <div class="container-fluid" style="padding:7px;position: relative;max-width: 1350px;">
            <div class="" style="color:white;font-weight: 400;text-align: center">
                <i class="fas fa-mouse-pointer mr-5"></i> <span style="position: relative;font-size: 16px;"> CLICK AND COLLECT AVAILABLE</span>
            </div>
            <div class="half-block text-right" style="display: none">
                <?php
                /*
                if($user->auth() == true){
                    ?>
                    <span class="mr-30" style="font-size: 16px;font-weight: 500;">
                           <a style="color:white !important;" href="<?php echo DOMAIN ?>/login?log=out">Logout</a>
                    </span>
                    <?php
                }else{
                    ?>
                    <span class="mr-30" style="font-size: 16px;font-weight: 500;"><a style="color:white !important;" href="<?php echo DOMAIN ?>/login">Login <i class="fas fa-chevron-down" style="font-size: 14px;padding-left: 10px;"></i></a></span>
                    <?php
                }
*/
                ?>







            </div>
        </div>
    </div>


    <div class="container-fluid" style="background: #000000;padding-bottom: 10px;padding-top: 10px;">
        <div style="max-width: 1400px;margin: auto;width: 95%;">
            <div class="row mt-0">

                <div class="col-lg-3 col-md-4 same-nav-col">
                    <a href="<?php echo DOMAIN ?>">
                        <img src="<?php echo DOMAIN?>/images/logo.png" class="logo-img" style="width: 100%;border-radius: 15px;max-width: 275px;">
                    </a>
                </div>
                <div class="col-md-1 visible-lg">

                </div>

                <div class="col-lg-9 col-md-8 same-nav-col text-right">
                    <div class="mb-10">
                        <div>
                            <a class="desktop-link" style="color:white !important;" href="<?= DOMAIN ?>/about">About Us</a>
                            <a class="desktop-link" style="color:white !important;" href="<?= DOMAIN ?>/contact">Contact Us</a>
                            <span style="color:white;">  <span style="margin-right: 0px;"><a class="desktop-link" style="margin-right: 0px !important;" href="<?= DOMAIN ?>/login">Log In</a> / <a class="desktop-link" style="" href="<?= DOMAIN ?>/sign-up">Register</a></span></span>
                            <a target="_blank" href="https://instagram.com">
                                <i class="fab fa-instagram" style="position:relative;top:-1px;color:white;margin-right: 15px;"></i>
                            </a>

                            <a target="_blank" href="https://twitter.com/">
                                <i class="fab fa-twitter" style="position:relative;top:-1px;color:white;"></i>
                            </a>
                        </div>
                        <div style="width: 100%;max-width: 400px; position: relative;text-align: right;margin-left: auto;display: inline-block;margin-right: 20px;margin-top: 20px;">
                            <form action="<?= DOMAIN ?>/search" method="get" id="search1-form">
                                <input style="font-weight: 500 !important;" class="form-control search-input" placeholder="Search" name="q">
                            </form>
                            <div class="search-input-icon" onclick="$('#search1-form').submit()">
                                <i class="fas fa-search" style="position: absolute;left:50%;top:50%;transform: translate(-50%,-50%);font-size: 15px;"></i>
                            </div>

                        </div>
                        <a href="<?php echo DOMAIN ?>/basket" style="color:white;text-decoration: none !important;">
                            <i class="fa fa-shopping-basket mr-0" style="color:white !important;"></i>
                        </a>



                    </div>




                </div>


            </div>
        </div>
    </div>


</div>
<style>

</style>
<div class="container-fluid dark-bg visible-md visible-lg " style="padding: 0 !important;padding-top: 8px !important;padding-bottom: 8px !important;background: white !important;color:#333 !important;box-shadow: 0 3px 10px lightgrey">
    <div style="margin: auto;width: 95%;background: white;">
        <div class="row" style="width: fit-content;margin: auto;width: -moz-fit-content;">
            <ul class="nav navbar-nav">



                <?php  $i = 1;   foreach( $categoryObj->getAll() as $category ){  ?>

                    <li class="link <?php if($i == count($categoryObj->getAll())){ print 'no-border'; } ?>">

                        <a style="color:#333 !important;font-size: 15px !important;font-weight: 300 !important;" class="" href="<?= DOMAIN ?>/<?= $category->seo_url ?>"><?= $category->title ?></a>


                        <?php if(count($subCategoryObj->getAllByCategoryId($category->id))){ ?>

                            <ul class="dropdown-menu" style="width: fit-content;min-width: 250px;text-align: left !important;">

                                <?php foreach( $subCategoryObj->getAllByCategoryId($category->id) as $sub_category ){ ?>

                                    <li style="text-align: left !important;font-weight: 300 !important;"><a style="text-align: left !important;font-weight: 300 !important;" href="<?= DOMAIN ?>/<?= $sub_category->seo_url ?>"><?= $sub_category->title ?></a></li>

                                <?php } ?>

                            </ul>

                        <?php } ?>

                    </li>

                    <?php $i++; } ?>




            </ul>

        </div>
    </div>

</div>




<style>
    .mobile-logo{
        position:absolute;top:50%;left:20px;transform: translate(-15px,-50%);max-width: 175px;
    }
    @media(max-width: 375px) {
        .mobile-logo{
            max-width: 150px !important;
        }
    }

</style>


<div class="visible-sm visible-xs" style="color:white;font-weight: 300;text-align: center;background: #bb01c7;padding: 5px;">
    <div class="" style="color:white;font-weight: 400;text-align: center">
        <i class="fas fa-mouse-pointer mr-5"></i> <span style="position: relative;font-size: 16px;"> CLICK AND COLLECT AVAILABLE</span>
    </div>
</div>
<nav class="navbar navbar-default navbar-static-top mt-0 mb-0 container-fluid no-padding dark-bg  visible-sm visible-xs" style="padding: 0 !important;min-height: 85px;background: #000000 !important;border: none !important;margin-bottom: 0px;box-shadow: 0 5px 10px #333;" >
    <div class="container no-padding pr-0 pl-0">

        <a class="" href="<?= DOMAIN ?>">
            <img alt="logo" class="img-responsive mobile-logo mobile-logo" src="<?= DOMAIN ?>/images/logo.png" style="">
        </a>

        <div class="navbar-header">
            <button  onclick="$('.toggle-btn').slideToggle()" style="background: #bb01c7 !important;position: absolute;right:0px;top:50%;transform: translate(0,-75%);margin-right: 5px !important;border:none;" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <script>
                var search1Var = false;

                function handleSearch2(){
                    search1Var = !search1Var;

                    if(search1Var == true){
                        $("#mySearch2").stop().animate({
                            height: "60px"
                        });
                    }
                    if(search1Var == false){
                        $("#mySearch2").stop().animate({
                            height: "0"
                        });
                    }
                }
            </script>
                <i  onclick="handleSearch2()" class="fa fa-search" style="color:#333;position: absolute;right:105px;top:50%;transform: translate(0,-50%);margin-right: -5px !important;padding: 1px;background: #bb01c7;width: 35px;height: 35px;text-align: center;line-height: 33px;color:white;border-radius: 100%;"></i>

            <a class="white" href="<?= DOMAIN ?>/basket" style="color:#333;position: absolute;right:52px;top:50%;transform: translate(0,-50%);margin-right: 5px !important;padding: 1px;">
                <i class="fa fa-shopping-cart white" style="color:#333;background: #bb01c7;width: 35px;height: 35px;text-align: center;line-height: 35px;color:white;border-radius: 100%;">

                </i>
            </a>


        </div>
    </div> <!-- mobile -->
</nav>

<style>
    .mobile-cats .link a:hover{
        text-decoration: none !important;
    }
    .mobile-cats .link a{
        font-size: 14px !important;
        font-weight: 300 !important;
    }
    .mobile-cats .link{
        background: #000000 !important;
        color:white !important;
        font-size: 14px !important;

    }
</style>
<div class="container-fluid pl-0 pr-0 toggle-btn mobile-cats" style="display: none;">
    <ul class="nav navbar-nav mt-0" style="">
        <li class="link " style="">

            <a style="" class="visible-sm visible-xs" href="<?php echo DOMAIN ?>">HOME</a>
        </li>
        <li class="link " style="">

            <a style="" class="visible-sm visible-xs" href="<?php echo DOMAIN ?>/about">ABOUT US</a>
        </li>


        <?php  $i = 1;   foreach( $categoryObj->getAll() as $category ){  ?>

            <li class="link <?php if($i == count($categoryObj->getAll())){ print 'no-border'; } ?>" style="">


                <a style="" class="" href="<?php if(count($subCategoryObj->getAllByCategoryId($category->id))){ ?>javascript:void(0) <?php } else { print DOMAIN.'/'.$category->seo_url; }  ?>"><?= strtoupper($category->title) ?></a>

                <?php if(count($subCategoryObj->getAllByCategoryId($category->id))){ ?>

                    <ul class="dropdown-menu" style="min-width:370px">

                        <?php foreach( $subCategoryObj->getAllByCategoryId($category->id) as $sub_category ){ ?>

                            <li><a href="<?= DOMAIN ?>/<?= $sub_category->seo_url ?>"><?= strtoupper($sub_category->title) ?></a></li>

                        <?php } ?>

                    </ul>

                <?php } ?>

            </li>

            <?php $i++; } ?>
        <?php
        if($user->auth() == true){ ?>
            <li class="link " style="font-size: 15px !important;">

                <a style="font-size: 15px !important;color:white !important;" class="visible-sm visible-xs" href="<?php echo DOMAIN ?>/login">MY ACCOUNT</a>
            </li>
        <?php } else{ ?>
        <li class="link " style="font-size: 15px !important;">
            <a style="font-size: 15px !important;color:white !important;" class="visible-sm visible-xs" href="<?php echo DOMAIN ?>/login">LOG IN</a>
        </li>
        <li class="link " style="font-size: 15px !important;">
            <a style="font-size: 15px !important;color:white !important;" class="visible-sm visible-xs" href="<?php echo DOMAIN ?>/sign-up">SIGN UP</a>
        </li>

        <?php } ?>



    </ul>
</div>
<style>
    .text-test{
        font-size: 17px;
    }
</style>
<style>

    @media (max-width: 767px ) {

        .dropdown-menu{ position:relative }
        .dropdown-menu>li>a { font-size:18px }
        .link{ float:left }
        .dropdown-menu{ box-shadow: 0 0px 0px rgba(0,0,0,0); }
    }

</style>


<script>
    $(function () {
        $('.same-height').matchHeight({byRow: false});
        $('.attach-height').matchHeight({byRow: false});
        $('.same-height3').matchHeight({byRow: false});
        $('.same-height2').matchHeight({byRow: false});
        $('.same-nav-col').matchHeight({byRow: false});
        $('.same-nav-cart-block').matchHeight({byRow: false});
    });
</script>



<style>
    #mySearch2{
        height: 0;
        overflow: hidden;
    }

</style>
<div class="pl-20 pr-20 visible-sm visible-xs" id="mySearch2" style="">

    <div class="row mt-10">

        <form action="<?= DOMAIN ?>/search" method="get">

            <div class="col-xs-8">

                <input required class="form-control" placeholder="Search products..." type="text" name="q" value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">

            </div>

            <div class="col-xs-4 pl-0 pr-10">

                <button type="submit" class="btn btn-default more-info form-control" style="background: #000000 !important;">SEARCH</button>

            </div>

        </form>

    </div>

</div>

