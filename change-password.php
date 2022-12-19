<?php

require __DIR__.'/includes/config.php';
use App\Helpers\Tools;

if(empty($_GET['remember_token'])){

	Tools::error('There has been an error with the reset link. Please try clicking the link again from your email.');

}

if(isset($_POST['remember_token']) && $_POST['remember_token'] != ''){

	$user->resetPassword($_POST['remember_token']);

}

$meta_title = COMPANY_NAME.' | Change Password';

?>

<?php include('header.php'); ?>

	<div class="container mb-0 mt-30">
			<div class="col-md-4 hidden-xs hidden-sm" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
			<div class="col-md-4 text-center">  <h1 class="mt-10">CHANGE PASSWORD</h1> </div>
			<div class="col-md-4" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
	</div>

<div class="container pt-10 pb-50">

<?php require __DIR__.'/includes/flash-messages.php'; ?>

<p class="mt-20">You will then be able to login with your email address and new password. <br /><br /></p>
		
		<form class="form-horizontal form-light" method="post" action="">
		<?php if(!empty($_GET['remember_token'])){ ?><input type="hidden" name="remember_token" value="<?= $_GET['remember_token']; ?>">	<?php } ?>
			
					<div class="panel panel-default">
						<div class="panel-heading">CHANGE PASSWORD</div>
						<div class="panel-body">
								
								<div class="form-group">
									<label class="col-md-4 control-label">New Password</label>
									<div class="col-md-6">
										<input type="password" class="form-control" name="password">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Repeat Password</label>
									<div class="col-md-6">
										<input type="password" class="form-control" name="repeat_password">
									</div>
								</div>
								

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-default"> CHANGE PASSWORD </button>
									</div>
								</div>
							
						</div>
					</div>
			

		
		</form>		

</div>


<?php include('footer.php'); ?>