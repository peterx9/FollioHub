<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=isset($title)?$title. ' - '. $this->general_settings['application_name']: 'OnJob PHP Job Portal'; ?></title>
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?= base_url($this->general_settings['favicon']); ?>">
	<meta charset="utf-8">
	<meta name="description" content="<?= isset($meta_description) ? $meta_description : ''; ?>">
	<meta name="keywords" content="<?= isset($keywords) ? $keywords : ''; ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="canonical"href="<?= current_url() ?>">
	
	<?php if (isset($show_og_tags)): ?>
	<meta property="og:title" content="<?= $og_title; ?>">
	<meta property="og:description" content="<?= $og_description; ?>">
	<meta property="og:image" content="<?= base_url($og_image); ?>">
	<meta property="og:image:secure_url" content="<?= base_url($og_image); ?>">
	<meta property="og:url" content="<?= $og_url; ?>">
	<meta name="twitter:card" content="summary_large_image">
	<?php endif; ?>

	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/linearicons.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/magnific-popup.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/nice-select.css">					
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/animate.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.theme.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.transitions.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css">
  	<script src="<?= base_url(); ?>assets/js/vendor/jquery-3.3.1.min.js"></script>
</head>


<body>

	<!-- Navbar File-->
	<?php include('navbar.php'); ?>

	<!--main content start-->
		<?php $this->load->view($layout); ?>
	<!--main content end-->

	<!-- Footer File-->
	<?php include('footer.php'); ?>


	<!-- Scripts Files -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/vendor/bootstrap.min.js"></script>	
	<script src="<?= base_url(); ?>assets/js/easing.min.js"></script>			
	<script src="<?= base_url(); ?>assets/js/hoverIntent.js"></script>
	<script src="<?= base_url(); ?>assets/js/superfish.min.js"></script>	
	<script src="<?= base_url(); ?>assets/js/jquery.ajaxchimp.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>	
	<script src="<?= base_url(); ?>assets/js/owl.carousel.min.js"></script>			
	<script src="<?= base_url(); ?>assets/js/jquery.sticky.js"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.nice-select.min.js"></script>			
	<script src="<?= base_url(); ?>assets/js/parallax.min.js"></script>		
	<!-- Notify JS -->
	<script src="<?= base_url() ?>assets/js/notify.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/main.js"></script>	
	<!-- Custom JS-->

	<!-- Below code for Stripe payment form -->
	<script type="text/javascript">
		//set your publishable key
		Stripe.setPublishableKey('pk_test_Vq7vPui3v2LZPWCzT9LBeaVv00RAS7HwZ1');

		//callback to handle the response from stripe
		function stripeResponseHandler(status, response) {
			if (response.error) {
				//enable the submit button
				$('#payBtn').removeAttr("disabled");
				//display the errors on the form
				$('#payment-errors').addClass('alert alert-danger');
				$("#payment-errors").html(response.error.message);
			} else {
				var form$ = $("#paymentFrm");
				//get token id
				var token = response['id'];
				//insert the token into the form
				form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
				//submit form to the server
				form$.get(0).submit();
			}
		}
		$(document).ready(function() {
			//on form submit
			$("#paymentFrm").submit(function(event) {
				//disable the submit button to prevent repeated clicks
				$('#payBtn').attr("disabled", "disabled");

				//create single-use token to charge the user
				Stripe.createToken({
					number: $('#card-number').val(),
					cvc: $('#card-cvc').val(),
					exp_month: $('#card-expiry-month').val(),
					exp_year: $('#card-expiry-year').val()
				}, stripeResponseHandler);

				//submit from callback
				return false;
			});
		});
	</script>
	<?php include('js_footer.php'); ?>
</body>
</html>