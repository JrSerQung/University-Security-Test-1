<?php
require __DIR__ . '/includes/config.php';
$meta_title = COMPANY_NAME . ' | About Us';
require 'header.php';
?>

    <style>
        p{
            font-size: 16px;
            font-weight: 400;
        }
        h2{
            font-weight: 500;
            font-size: 20px;
        }
        li{
            font-weight: 400;
            font-size: 14px;
        }
        h1{
            font-size: 25px;
            font-weight: 600 !important;
        }
        email{
            text-transform: lowercase;
            word-spacing: -3px;
        }
    </style>
    <div class="container" style="padding-bottom: 40px;padding-top: 30px; color:black;">

        <h1 class="text-center">About Us</h1>
        <hr>

        <div class="about_image">
            <img  src="image/about.jpg" />
        </div>




    </div>


<?php require 'footer.php'; ?>
