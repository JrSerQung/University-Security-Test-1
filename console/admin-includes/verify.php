<?php

$usersObj = new \App\User();
$users = $usersObj->getPendingVerify();
$users2 = $usersObj->getPendingVerifyRverse();
$users3 = $usersObj->getDeleteds();




if(isset($_POST["type"])){
    if($_POST["type"] == "update"){
        $usersObj->updateUser($_POST["id"]);
    }
    if($_POST["type"] == "accept"){
        $usersObj->acceptVerify($_POST["id"]);
        $userPro = $user->find($_POST["id"]);
        \App\Helpers\Mail::acceptVerify($userPro->email,$userPro->first_name);

    }
    if($_POST["type"] == "decline"){
        $usersObj->declineVerify($_POST["id"]);
    }
    if($_POST["type"] == "recover"){
        $usersObj->recoverDeleted($_POST["id"]);
    }
    if($_POST["type"] == "remove"){
        $usersObj->removeActive($_POST["id"]);

        $usersObj->acceptVerify($_POST["id"]);
        $userPro = $user->find($_POST["id"]);
        \App\Helpers\Mail::declineActive($userPro->email,$userPro->first_name);
    }
}
?>

<style>
    .ids{
        display: none;
    }
    .platforms{
        padding: 3px;
        padding-right: 8px !important;
        padding-left: 8px !important;
        background: #40ACC8;
        color:white;
        border-radius: 5px;
        margin-right: 5px;
    }
</style>
<?php
foreach ($users as $user) { ?>
    <div class="container-fluid ids" id="id-<?php echo $user->id ?>" style="margin-bottom: 75px">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $user->first_name . " " . $user->last_name ?>
            </div>
            <div class="panel-body">
                <p>Company Name: <?php echo $user->company_name ?></p>
                <p>Trading Name: <?php echo $user->trading_name ?></p>
                <p>Company Director: <?php echo $user->company_director ?></p>
                <p>VAT Number: <?php echo $user->vat_number ?></p>
                <p>Company Registration Number: <?php echo $user->company_registration_number ?></p>
                <p>How do you currently Trade: <?php
                        foreach (explode("||",$user->trade_platforms) as $item){
                            if($item != "" and $item != " "){
                                echo "<span class='platforms'>". $item  ."</span>";

                            }
                        }
                    ?></p>
                <p>Credit Reference: <?php echo $user->credit_reference ?></p>


                <p>First Name: <?php echo $user->first_name ?></p>
                <p>Last Name: <?php echo $user->last_name ?></p>
                <p>Email: <?php echo $user->email ?></p>
                <p>Phone: <?php echo $user->phone ?></p>
                <p>Address 1: <?php echo $user->address_1 ?></p>
                <p>Address 2: <?php echo $user->address_2 ?></p>
                <p>City: <?php echo $user->town ?></p>
                <p>Postcode: <?php echo $user->postcode ?></p>

                <br>
                <br>

                <form action="" method="POST" id="form-<?php echo $user->id ?>-accept">
                    <input type="hidden" name="id" value="<?php echo $user->id ?>">
                    <input type="hidden" name="type" value="accept">
                    <div>
                        <select name="class" class="form-control" style="max-width: 120px;float:left;margin-right: 20px;" required>
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        <select name="credit_user" class="form-control" style="max-width: 120px;float:left;margin-right: 20px;" required>
                            <option value="">Select</option>
                            <option value="0">Default User</option>
                            <option value="1">Credit User</option>
                        </select>
                        <button class="btn btn-success" type="submit" style="float:left;margin-right: 20px;min-width: 120px;">ACCEPT</button>
                    </div>
                </form>
                <form action="" method="POST" id="form-<?php echo $user->id ?>-decline">
                    <input type="hidden" name="id" value="<?php echo $user->id ?>">
                    <input type="hidden" name="type" value="decline">
                    <button class="btn btn-danger" type="submit"  style="float:right;margin-right: 20px;min-width: 120px;">DECLINE</button>
                </form>
            </div>
        </div>
    </div>
<?php }
?>
<?php
foreach ($users3 as $user) { ?>
    <div class="container-fluid ids" id="id-<?php echo $user->id ?>" style="margin-bottom: 75px">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $user->first_name . " " . $user->last_name ?>
            </div>
            <div class="panel-body">
                <p>Company Name: <?php echo $user->company_name ?></p>
                <p>Trading Name: <?php echo $user->trading_name ?></p>
                <p>Company Director: <?php echo $user->company_director ?></p>
                <p>VAT Number: <?php echo $user->vat_number ?></p>
                <p>Company Registration Number: <?php echo $user->company_registration_number ?></p>
                <p>How do you currently Trade: <?php
                    foreach (explode("||",$user->trade_platforms) as $item){
                        if($item != "" and $item != " "){
                            echo "<span class='platforms'>". $item  ."</span>";

                        }
                    }
                    ?></p>
                <p>Credit Reference: <?php echo $user->credit_reference ?></p>


                <p>First Name: <?php echo $user->first_name ?></p>
                <p>Last Name: <?php echo $user->last_name ?></p>
                <p>Email: <?php echo $user->email ?></p>
                <p>Phone: <?php echo $user->phone ?></p>
                <p>Address 1: <?php echo $user->address_1 ?></p>
                <p>Address 2: <?php echo $user->address_2 ?></p>
                <p>City: <?php echo $user->town ?></p>
                <p>Postcode: <?php echo $user->postcode ?></p>

                <br>
                <br>

                <form action="" method="POST" id="form-<?php echo $user->id ?>-recover">
                    <input type="hidden" name="id" value="<?php echo $user->id ?>">
                    <input type="hidden" name="type" value="recover">
                    <button class="btn btn-warning" type="submit" style="float:left;margin-right: 20px;min-width: 120px;">RECOVER</button>
                </form>
            </div>
        </div>
    </div>
<?php }
?>
<?php
foreach ($users2 as $user) { ?>
    <div class="container-fluid ids" id="id-<?php echo $user->id ?>" style="margin-bottom: 75px">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $user->first_name . " " . $user->last_name ?>
            </div>
            <div class="panel-body">
                <p>Company Name: <?php echo $user->company_name ?></p>
                <p>Trading Name: <?php echo $user->trading_name ?></p>
                <p>Company Director: <?php echo $user->company_director ?></p>
                <p>VAT Number: <?php echo $user->vat_number ?></p>
                <p>Company Registration Number: <?php echo $user->company_registration_number ?></p>
                <p>How do you currently Trade: <?php
                    foreach (explode("||",$user->trade_platforms) as $item){
                        if($item != "" and $item != " "){
                            echo "<span class='platforms'>". $item  ."</span>";

                        }
                    }
                    ?></p>
                <p>Credit Reference: <?php echo $user->credit_reference ?></p>


                <p>First Name: <?php echo $user->first_name ?></p>
                <p>Last Name: <?php echo $user->last_name ?></p>
                <p>Email: <?php echo $user->email ?></p>
                <p>Phone: <?php echo $user->phone ?></p>
                <p>Address 1: <?php echo $user->address_1 ?></p>
                <p>Address 2: <?php echo $user->address_2 ?></p>
                <p>City: <?php echo $user->town ?></p>
                <p>Postcode: <?php echo $user->postcode ?></p>

                <br>
                <br>

                <form action="" method="POST" id="form-<?php echo $user->id ?>-uuu">
                    <input type="hidden" name="id" value="<?php echo $user->id ?>">
                    <input type="hidden" name="type" value="update">
                    <div class="">
                        <select name="class" class="form-control" style="max-width: 120px;float:left;margin-right: 20px;" required>
                            <option <?php if($user->trade_type == ""){print "selected";} ?> value="">Select</option>
                            <option <?php if($user->trade_type == "1"){print "selected";} ?> value="1">1</option>
                            <option <?php if($user->trade_type == "2"){print "selected";} ?> value="2">2</option>
                            <option <?php if($user->trade_type == "3"){print "selected";} ?> value="3">3</option>
                            <option <?php if($user->trade_type == "4"){print "selected";} ?> value="4">4</option>
                        </select>
                        <select name="credit_user" class="form-control" style="max-width: 120px;float:left;margin-right: 20px;" required>
                            <option <?php if($user->credit_user == "0"){print "selected";} ?> value="0">Default User</option>
                            <option <?php if($user->credit_user == "1"){print "selected";} ?> value="1">Credit User</option>
                        </select>
                        <button class="btn btn-success" type="submit" style="float:left;margin-right: 20px;min-width: 120px;">UPDATE</button>
                    </div>
                </form>
                <div class="">

                <form action="" method="POST" id="form-<?php echo $user->id ?>-remove">
                    <input type="hidden" name="id" value="<?php echo $user->id ?>">
                    <input type="hidden" name="type" value="remove">
                    <button class="btn btn-danger" type="submit" style="float:right;margin-right: 20px;min-width: 120px;">REMOVE</button>
                </form>

                </div>
            </div>
        </div>
    </div>
<?php }
?>


<div class="container-fluid-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    VERIFIED USERS
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Company Name</td>
                            <td>Action</td>
                        </tr>
                        <?php
                        foreach ($users2 as $user) { ?>
                            <tr>
                                <td><?php echo $user->first_name . " " . $user->last_name ?></td>
                                <td><?php echo $user->email ?></td>
                                <td><?php echo $user->company_name ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="openRequest('id-<?php echo $user->id ?>')">View User</button>
                                </td>
                            </tr>
                        <?php }
                        ?>


                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    AWAITING TO BE VERIFIED
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Company Name</td>
                            <td>Action</td>
                        </tr>
                        <?php
                        foreach ($users as $user) { ?>
                            <tr>
                                <td><?php echo $user->first_name . " " . $user->last_name ?></td>
                                <td><?php echo $user->email ?></td>
                                <td><?php echo $user->company_name ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="openRequest('id-<?php echo $user->id ?>')">View Request</button>
                                </td>
                            </tr>
                        <?php }
                        ?>


                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    DELETED USERS
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Company Name</td>
                            <td>Action</td>
                        </tr>
                        <?php
                        foreach ($users3 as $user) { ?>
                            <tr>
                                <td><?php echo $user->first_name . " " . $user->last_name ?></td>
                                <td><?php echo $user->email ?></td>
                                <td><?php echo $user->company_name ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="openRequest('id-<?php echo $user->id ?>')">View User</button>
                                </td>
                            </tr>
                        <?php }
                        ?>


                    </table>
                </div>
            </div>
        </div>
    </div>




</div>




<script>
    function verify(id){
        if(confirm("Are you sure you want to do that?")){
            $("#form-" + id + "-accept").submit();
        }
    }
    function openRequest(id){
        $(".ids").hide();
        $("#" + id).show();
    }
</script>