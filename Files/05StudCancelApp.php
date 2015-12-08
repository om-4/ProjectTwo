<?php
session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Cancel Appointment</title>
  <link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Cancel Appointment</h1>
	    <div class="field">
	    <?php

                        $sql = "select * from Proj2Students where `StudentID` = '$studid'";
                        $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                        $row = mysql_fetch_row($rs);

                        //Set the user's info to local variables
			$firstn = $row[1];
			$lastn = $row[2];
			$studid = $row[3];
			$major = $row[5];
			$email = $row[4];
			
                        //Find the user in the appointments table
			$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

                        //Get the row and save certain current values
			$row = mysql_fetch_row($rs);
			$oldAdvisorID = $row[2];
			$oldDatephp = strtotime($row[1]);				
                        //Individual
			if($oldAdvisorID != 0){
				$sql2 = "select * from Proj2Advisors where `id` = '$oldAdvisorID'";
				$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
				$row2 = mysql_fetch_row($rs2);					
				$oldAdvisorName = $row2[1] . " " . $row2[2];
			}

                        //Group
			else{$oldAdvisorName = "Group";}
			
                        //Display current advising appointment info
			echo "<h2>Current Appointment</h2>";
			echo "<label for='info'>";
			echo "Advisor: ", $oldAdvisorName, "<br>";
			echo "Appointment: ", date('l, F d, Y g:i A', $oldDatephp), "</label><br>";
		?>		
        </div>
	    <div class="finishButton">

			<!--Confirm cancel button-->
			<form action = "StudProcessCancel.php" method = "post" name = "Cancel">
			<input type="submit" name="cancel" class="button large go" value="Cancel">
			<input type="submit" name="cancel" class="button large" value="Keep">
			</form>
	    </div>
		</div>

		<!--Cancel message-->
		<div class="bottom">
			<p>Click "Cancel" to cancel appointment. Click "Keep" to keep appointment.</p>

			 <footer>
	      <div class ="footer">
		<img src="../photos/website_footer.png" alt="UMBC" style="width:900px;height:82px;">
	      </div>
	     </footer>
		</div>
		</form>
  </body>
</html>