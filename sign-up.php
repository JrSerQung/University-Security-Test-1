<?php
require __DIR__ . '/includes/config.php';

$meta_title = COMPANY_NAME.' | Sign up';



if(isset($_POST["password"])){
    $id = $user->add();

    $userPro = $user->find($id);
    \App\Helpers\Mail::registerToCustomer($userPro->email, $userPro->first_name);
    \App\Helpers\Mail::registerToClient($userPro->first_name);
    return redirect("login");
}
require 'header.php';
?>

<style>
    label{
        font-size: 16px;
        font-weight: 500 !important;
    }
    small{
        font-size: 13px !important;
    }
    textarea{
        min-height: 75px;
    }
</style>
<div class="container pb-30 pt-30">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-left mt-30" style="font-weight: 500 !important;">Trade Account Opening Form</h1>
            <hr>
            <p style="font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus aliquam amet aperiam asperiores assumenda autem consequuntur dicta dolor dolorem ea eius error esse in iusto labore, molestiae mollitia nobis nulla praesentium quis quo ratione reprehenderit rerum sapiente, sit tempore temporibus ut veritatis voluptatem! Consectetur est eveniet mollitia non voluptatum!</p>

            <?php require __DIR__.'/includes/flash-messages.php'; ?>
            <form action="" method="post">

                <div class="panel panel-default mt-20">
                    <div class="panel-heading">COMPANY INFORMATION</div>
                    <div class="panel-body">
                        <label>Company Name *</label>
                        <input class="form-control mb-20" name="company_name" required>

                        <label>Trading Name *</label>
                        <input class="form-control mb-20" name="trading_name" required>

                        <label>Company Director *</label>
                        <input class="form-control mb-20" name="company_director" required>

                        <label>VAT Number</label>
                        <input class="form-control mb-20" name="vat_number">

                        <label>Company Registration Number</label>
                        <input class="form-control mb-20" name="company_registration_number">

                        <label>*How do you currently Trade</label>
                        <br>
                        <input class=" mb-20" type="checkbox" id="a1" onchange="addPlatform1('Shop / Showroom || ',this)"> Shop / Showroom <br>
                        <input class=" mb-20" type="checkbox" id="a2" onchange="addPlatform2('Online Only || ',this)"> Online Only <br>
                        <input class=" mb-20" type="checkbox" id="a3" onchange="addPlatform3('Warehouse / Distributor || ',this)"> Warehouse / Distributor <br><br>
                        <input class="form-control mb-20" name="trade_platforms" id="platform" type="hidden">

                        <script>
                            let textT = "";
                            function addPlatform1(text,that){
                                let b = document.querySelector("#a1").checked;

                                if(b == true){
                                    textT += text;
                                    $("#platform").val(textT )
                                }
                                if(b == false){
                                    textT = textT.replace(text,"");
                                    $("#platform").val(textT)
                                }

                            }
                            function addPlatform2(text,that){
                                let b = document.querySelector("#a2").checked;

                                if(b == true){
                                    textT += text;
                                    $("#platform").val(textT)
                                }
                                if(b == false){
                                    textT = textT.replace(text,"");
                                    $("#platform").val(textT)
                                }

                            }
                            function addPlatform3(text,that){
                                let b = document.querySelector("#a3").checked;

                                if(b == true){
                                    textT += text;
                                    $("#platform").val(textT)
                                }
                                if(b == false){
                                    textT = textT.replace(text,"");
                                    $("#platform").val(textT)
                                }

                            }
                        </script>
                        <label>Credit Reference</label>
                        <br>
                        <small>Please Enter below at least 2 Credit References</small>
                        <textarea class="form-control mb-20" name="credit_reference"></textarea>


                    </div>
                </div>



                <div class="panel panel-default">
                    <div class="panel-heading">CONTACT INFORMATION</div>
                    <div class="panel-body">

                        <label>First name *</label>
                        <input class="form-control mb-20" name="first_name" required>

                        <label>Last name *</label>
                        <input class="form-control mb-20" name="last_name" required>

                        <label>E-mail *</label>
                        <input class="form-control mb-20" name="email" required type="email">

                        <label>Contact Number *</label>
                        <input class="form-control mb-20" name="phone" required>


                        <label>Address 1 *</label>
                        <input class="form-control mb-20" name="address_1" required>

                        <label>Address 2</label>
                        <input class="form-control mb-20" name="address_2">

                        <label>City *</label>
                        <input class="form-control mb-20" name="town" required>

                        <label>Postcode *</label>
                        <input class="form-control mb-20" name="postcode" required>

                        <label>Password *</label>
                        <input class="form-control mb-20" name="password" required type="password">

                    </div>

                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">CLARIFICATION</div>
                    <div class="panel-body">
                        <label>Digital Signature</label>
                        <br>
                        <small>I hereby declare that the information submitted through the New Client Registration Form are true and correct to the best of my knowledge and belief</small>
                        <input class="form-control mb-20" name="business_name">


                        <label>Data Privacy and Consent</label>
                        <br>
                        <input class=" mb-20" type="checkbox" required> I agree to the terms of service. <br><br>
                        <button class="btn btn-success" style="width: 100%;background: #69247b !important;border:1px solid #69247b;" type="submit">Register</button>
                    </div>

                </div>





            </form>
        </div>
    </div>
</div>


<?php

require 'footer.php';

?>
