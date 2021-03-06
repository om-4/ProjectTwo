<?php
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Exit Message</title>
    <link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
	    <div class="statusMessage">
	    <?php

                        //Successfully signed up			
			if($status == "complete"){
				echo "You have completed your sign-up for an advising appointment.";
			}

                        //Cancelled during the process of making an appointment
			elseif($status == "none"){
				echo "You did not sign up for an advising appointment.";
			}

                        //Cancel your appointment from the main page
			if($status == "cancel"){
				echo "You have cancelled your advising appointment.";
			}

                        //Rescheduling your appointment
			if($status == "resch"){
				echo "You have changed your advising appointment.";
			}

                        //Cancelling your rescheduling of an appointment
			if($status == "keep"){
				echo "No changes have been made to your advising appointment.";
			}
		?>
        </div>

	        <!--Return home-->
		<form action="02StudHome.php" method="post" name="complete">
	    <div class="returnButton">
			<input type="submit" name="return" class="button large go" value="Return to Home">
	    </div>

	     <footer>
	      <div class ="footer">
		<img src="../photos/website_footer.png" alt="UMBC" style="width:900px;height:82px;">
	      </div>
	     </footer>
		</div>
		</form>
  </body>
</html>