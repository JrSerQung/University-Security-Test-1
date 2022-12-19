<?php

require __DIR__.'/includes/config.php';

use App\Helpers\Mail;

if( isset($_POST['name']) ){

	Mail::enquiry();

}

if( isset($_POST['newsletter_email']) ){

	Mail::newsletter();

}

require 'header.php';

?>

	<div class="container mb-0 mt-30">
			<div class="col-md-4 hidden-xs hidden-sm" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
			<div class="col-md-4 text-center">  <h1 class="mt-10">CONTACT US</h1> </div>
			<div class="col-md-4" style="border-bottom:2px dotted #311E26"> &nbsp;  </div>
	</div>

<div class="container pt-30 pb-30">

<?php require __DIR__.'/includes/flash-messages.php'; ?>

<p class="mb-30">If you would contact us please give us a call. Alternatively you can send us a message via email or by using our web form.</p>

	<div class="row">
	
		<div class="col-md-5">
		
	  <div class="panel panel-default">

    <div class="panel-body" >

            <form action="" method="post">
              <div class="form-group">
                <label for="name">
                  Name
                </label>
                <input type="text" placeholder="" id="name" name="name" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">
                  Email
                </label>
                <input type="text" placeholder="" id="email" name="email" class="form-control">
              </div>
              <div class="form-group">
                <label for="phone">
                  Phone
                </label>
                <input type="text" id="phone" name="phone" class="form-control">
              </div>
              <div class="form-group">
                <label for="phone">
                  Message
                </label>
                <textarea placeholder="" rows="3" name="message" class="form-control"></textarea>
              </div>
              <button class="btn btn-default font-bigger" type="submit">SUBMIT ENQUIRY</button>
            </form>
			
			
	</div>
	
	</div>
		
		</div>

	
		<div class="col-md-7">
		
			<div class="row">
			
				<div class="col-md-4">
				
				<h3 class="mt-0"><i class="fa fa-map-marker"></i> ADDRESS</h3>
				
				<p>Afro Hair Fashion<br />
				546 Hertford Road  <br />
				Enfield <br />
				EN3 5ST </p>
				
				</div>
				
				<div class="col-md-4">
				
				<h3 class="mt-0">CONTACT INFO</h3>
				
				<p>
				<i class="fa fa-phone"></i> 0208 805 58733<br /> 
				<i class="fa fa-envelope"></i> <a href="<?= DOMAIN ?>/mailto:info@afrohairfashion.co.uk">info@afrohairfashion.co.uk</a>
				</p>
				
				</div>
				
				<div class="col-md-4">
				
				<h3 class="mt-0"><i class="fa fa-clock-o"></i> OPENING HOURS</h3>
				
				<p>
				Monday -Saturday <br /> 09:30 to 19:30<br />
				Sunday <br /> 11:00 to 16:00
				</p>
				
				</div>
			
			</div>
			
			<div class="row mt-20">
			
				<div class="col-md-12">
				
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2474.559556493334!2d-0.04430618411094232!3d51.667900006776065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761f9c1b70a903%3A0xb757dff896a43ef1!2s546+Hertford+Rd%2C+Enfield+EN3+5ST!5e0!3m2!1sen!2suk!4v1538650906914" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>

				
				</div>
			
			</div>
		
		</div>

	</div>

</div>


<?php require 'footer.php'; ?>