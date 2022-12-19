<?php 

require __DIR__.'/includes/config.php';

if( isset($_POST['email']) ){

	$user->requestPasswordReset($_POST['email']);

}

if( isset($_GET['get']) ){

	foreach($_SESSION as $key => $session){

		$key = str_replace(SALT, '', $key);

		$results[$key] = $session;

	}

print json_encode($results); exit;

}
$meta_title = COMPANY_NAME.' | Forgotten Password';
include('header.php'); ?>

<script>

$(function(){

	$.get('forgot-password.php?get=sessions', function(data){
		
		var data = jQuery.parseJSON(data);
		
		$('#form input[type=text], input[type=email').each(function(){
			
			if (typeof data[this.id] !== 'undefined') {
			
				$('#' + this.id).val(data[this.id]);
				
			}
		
		});

	});

});

</script>

	<div class="container mb-0 mt-30">
			<div class="col-md-4 hidden-xs hidden-sm" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
			<div class="col-md-4 text-center">  <h1 class="mt-10">FORGOTTEN PASSWORD?</h1> </div>
			<div class="col-md-4" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
	</div>

<div class="container pt-10 pb-50">


<?php require __DIR__.'/includes/flash-messages.php'; ?>

<p class="mt-20">Just enter your email address and we will send you a link where you can reset your password. <br /><br /></p>
		
		<form class="form-horizontal form-light" id="form" method="post" action="">

					<div class="panel panel-default">
						<div class="panel-heading">ENTER YOUR EMAIL ADDRESS</div>
						<div class="panel-body">
								
								<div class="form-group">
									<label class="col-md-4 control-label">Email Address</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="email" name="email">
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
									
										<button type="submit" class="btn btn-default"> REQUEST LINK </button>
										
									</div>
								</div>
							
						</div>
					</div>
			

		
		</form>

            </div>


    

<?php include('footer.php'); ?>