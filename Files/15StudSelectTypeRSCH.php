<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Advising Type</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Schedule Appointment</h1>
		<h2>What kind of advising appointment would you like?</h2><br>
        <!-- Form to process the type of advising appointment the user wants -->
	<form action="StudProcessTypeRSCH.php" method="post" name="SelectType">
	<div class="nextButton">
		<input type="submit" name="advisor" class="button large go" value="Individual">
		<input type="submit" name="advisor" class="button large go" value="Group" style="float: right;">
		</div>
		</form>


<br>
<br>
		<div>
                
                <!--Return the user home-->
		<form method="link" action="02StudHome.php">
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>

		 <footer>
	      <div class ="footer">
		<img src="../photos/website_footer.png" alt="UMBC" style="width:900px;height:82px;">
	      </div>
	     </footer>
		</div>
  </body>
</html>
