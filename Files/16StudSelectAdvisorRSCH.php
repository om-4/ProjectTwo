<?php
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Advisor</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Individual Advising</h1>
		<h2>Select Advisor</h2>
	    <div class="field">

                <!--Form where we send the user input-->
		<form action="17StudSelectTimeRSCH.php" method="post" name="SelectAdvisor">
	    <?php
			$sql = "select * from Proj2Advisors";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

                        //Go through advisor table and display advisors
			while($row = mysql_fetch_row($rs)){
				echo "<label for='",$row[0],"'><input id='",$row[0],"' type='radio' name='advisor' required value='", $row[0],"'>", $row[1]," ", $row[2],"</label><br>";
			}
		?>
        </div>

	    <!--Submit button-->
	    <div class="nextButton">
			<input type="submit" name="next" class="button large go" value="Next">
	    </div>
		</div>
		</form>
		<div>

		<!--Return home if user wants to cancel-->
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