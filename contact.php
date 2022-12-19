<?php 

require __DIR__.'/includes/config.php';
use App\Helpers\Mail;

if( isset($_POST['name']) ){

    \App\Helpers\Mail::enquiry();

}



$meta_title = COMPANY_NAME.' | Contact Us';
require __DIR__.'/header.php';

?>

<script>

$(function(){
	$('.match-height4').matchHeight();
});
</script>

	<?php if( count(App\Helpers\Validation::errors()) || count(App\Helpers\Tools::flashes()) ){   ?>

	<div class="container mt-10">
	
<?php require __DIR__.'/includes/flash-messages.php'; ?>
	
	</div>
	
	<?php } ?>

            <div class="container contact-holder pt-30 pb-30">
	    
					<div class="panel panel-default">
					<div class="panel-heading" style="background: #0153a5 !important;color:white;text-align: center;">CONTACT US</div>
						<div class="panel-body">	    

                        <div class="row mt-0">
                            <div class="col-sm-6" style="text-align: center !important;">
                                <h3 style="font-size: 20px !important;color:inherit !important;"><i class="fa fa-map-marker"></i> Address</h3>
                                <p style="font-size: 17px !important;">
                                    Dale House,
                                    64 Fink Hill,
                                    Horsforth,
                                    Leeds,
                                    LS18 4DH
                                </p>
                                <hr class="visible-xs" />
                            </div>

                            <div class="col-sm-6" style="text-align: center !important;">
                                <h3 style="font-size: 20px !important;color:inherit !important;"><i class="fa fa-envelope"></i> Email Support</h3>
                                <p style="margin-bottom: 5px !important;font-size: 17px !important;">Please feel free to email us or to use our web form.</p>
                                <p style="font-size: 17px !important;">
                                    <a class="site-color" href="mailto:admin@pricecruncher.co.uk">admin@pricecruncher.co.uk</a>
                                </p>
                                
                            </div>
                        </div>
                            <hr />
			
<script>

$(function(){

	var formHeight = $('.form-height').height();  // get height of form
	var name_label = $('.name_label').height();  // get height of name label
	var diff = name_label + 5;  // difference is height of name label and 5pc margin on label
	$('.map').height(formHeight - diff);  // set height of map minus the label difference
	$('.map').css('margin-top' , diff);   // set margin top the difference so it's level with name input

});

</script>

		<div class="row">
		
			<div class="col-md-6 col-sm-6 pb-20">
			
				<form action="" method="post">
				
					<div class="form-height">

						<div class="form-group">
						<label for="name" class="name_label" style="font-size: 15px !important;">Your Name</label>
						<input required type="text" class="form-control" id="name" name="name">
						</div>

						<div class="form-group">
						<label for="phone" style="font-size: 15px !important;">Telephone <span style="font-size: 12px !important;">(optional)</span></label>
						<input type="text" class="form-control" id="phone" name="phone">
						</div>

						<div class="form-group">
						<label for="email" style="font-size: 15px !important;">Email Address</label>
						<input required type="text" class="form-control" id="email" name="email">
						</div>

						<div class="form-group">
						<label for="message" style="font-size: 15px !important;">Message</label>
						<textarea style="height:100px" name="message" id="message" rows="4" class="form-control"></textarea>
						</div>
					
					</div>

						    <button style="background: #d00000 !important;font-size: 17px;" type="submit" class="btn btn-default ">Send Message</button>

				</form>
			
			</div>
			
			<div class="col-md-6 col-sm-6 pb-20">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2354.3878290565685!2d-1.6459636840210106!3d53.83596564562436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48795897bc2fdd29%3A0x472195643fcf2034!2sDale%20House%2C%2064%20Fink%20Hill%2C%20Horsforth%2C%20Leeds%20LS18%204DH!5e0!3m2!1sen!2suk!4v1669153978094!5m2!1sen!2suk" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			
			</div>
		
		
		</div>		
		</div>		
		</div>		
		
		

            </div>


<?php require 'footer.php';?>