<?php 

require __DIR__.'/includes/config.php';

if( isset($_POST['email']) ){

	$user->login($user_role_id = 1);

}

if( isset($_GET['log']) ){

	App\User::logout();

}

if($user->auth()){

	redirect( 'account.php?page=home');

}

$meta_title = COMPANY_NAME.' | Login';
require __DIR__.'/header.php';

?>



	<?php if( count(App\Helpers\Validation::errors()) || count(App\Helpers\Tools::flashes()) ){   ?>

	<div class="container mt-10 mb-10">
	
<?php require __DIR__.'/includes/flash-messages.php'; ?>
	
	</div>
	
	<?php } ?>

<div class="container pt-30 pb-50">
		
		<form class="form-horizontal form-light" id="form" method="post" action="">
			
					<div class="panel panel-default">
					<div class="panel-heading">PLEASE LOGIN TO YOUR ACCOUNT HERE</div>
						<div class="panel-body">
								
								<div class="form-group">
									<label class="col-md-4 control-label">Email Address</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="email" name="email">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Password</label>
									<div class="col-md-6">
										<input type="password" class="form-control" name="password">
									</div>
								</div>
								

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-default"> LOGIN </button>
										<a href="<?= DOMAIN ?>/forgot-password.php">Forgotten Your Password?</a>
									</div>
								</div>
							
						</div>
					</div>
			
		
		</form>
		

</div>

<?php require __DIR__.'/footer.php'; ?>