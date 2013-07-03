<!DOCTYPE html>
<html lang="en">
<head>
<title>Vaseline Instant Fair</title>
<meta charset="UTF-8"/>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/reset.css" /> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/validate/screen.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro|Alegreya">
<!-- Counter -->
<script src="<?php echo base_url();?>assets/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/jquery.json-2.4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/jquery.flipCounter.1.2.pack.js" type="text/javascript"></script>
<!-- Counter END -->
<!-- Scrollbar -->
      <div id="fb-root"></div>
      <script type="text/javascript">
            window.fbAsyncInit = function() {
          FB.init({
              //249604108467582
              appId: '198233767000304',
              cookie: true,
              xfbml: true,
              oauth: true
          });
          // FB.Canvas.setAutoGrow(true);
          $(document).trigger('fbload');
            };
            (function() {
          var e = document.createElement('script'); e.async = true;
          e.src = document.location.protocol +
              '//connect.facebook.net/en_US/all.js';
          document.getElementById('fb-root').appendChild(e);
            }());
        function sendRequestToManyRecipients() {
          FB.ui({method: 'apprequests',
            message: 'Ayo jawab pertanyaan mengapa HTC sangat Brilliant bagi kamu di Incredible Experience with HTC. Menangkan hadiah perjalanan ke Eropa bersama HTC. Join sekarang melalui HTC Indonesia.',
             title: 'Incredible Experience with HTC',
          }, requestCallback);
        }
                  
        function requestCallback(response) {
          var encoded = $.toJSON(response.to);
          // console.log(encoded); 
            $.ajax({
              type: "post",
              url :"<?php echo site_url(); ?>/instafair/submit_invite",  
              data: {id_invite: encoded},
              success: function(data){
              window.location = "<?php echo site_url('instafair/orderpage'); ?>";
              // alert(data); 
              }   
            }); 

            return false;
        }

$(document).ready(function() {
	$('.login-window').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
	
	$(".scrollTest").scrollbars();
});			
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/scrollbars.css" />
<script src="<?php echo base_url();?>assets/js/jquery.ba-resize.min.js"></script>
<script src="<?php echo base_url();?>assets/js/mousehold.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>assets/js/aplweb.scrollbars.js"></script>
<script src="http://threedubmedia.googlecode.com/files/jquery.event.drag-2.0.min.js"></script>
<!-- Scrollbar END -->
</head>
<body id="home">
<div class="wrap">
  <div id="logo"><a href="index.html"><img src="<?php echo base_url();?>assets/images/logo.png"></a></div>