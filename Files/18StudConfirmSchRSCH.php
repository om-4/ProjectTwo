<?php
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Confirm Appointment</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>  </head>
  <body>
	<div id="login">
      <div id="form">
        <div class="top">
		<h1>Confirm Appointment</h1>
	    <div class="field">

                <!--Form where we send the information-->
		<form action = "StudProcessSch.php" method = "post" name = "SelectTime">

                <input type="hidden" name="advisor" value="<?php echo $_POST["postAdvisor"];?>" />

                <input type="hidden" name="appTime" value="<?php echo $_POST["appTime"];?>" />

	    <?php
			$debug = false;
			include('../CommonMethods.php');
			$COMMON = new Common($debug);
                        $sql = "select * from Proj2Students where `StudentID` = '$_SESSION[studID]'";
                        $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                        $row = mysql_fetch_row($rs);
			
                        //Set local variables for student info
			$firstn = $row[1];
			$lastn = $row[2];
			$studid = $row[3];
			$major = $row[5];
			$email = $row[4];
			
                        //If this is a rescheduling
				$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
				//Obtain old information
				$row = mysql_fetch_row($rs);
				$oldAdvisorID = $row[2];
				$oldDatephp = strtotime($row[1]);
				
				//Individual appointment
				if($oldAdvisorID != 0){
					$sql2 = "select * from Proj2Advisors where `id` = '$oldAdvisorID'";
					$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
					$row2 = mysql_fetch_row($rs2);
					$oldAdvisorName = $row2[1] . " " . $row2[2];
					$oldLocation = $row2[6];
					$oldOffice = $row2[5];
				}

				//Group appointment
				else{
				     $oldAdvisorName = "Group";
				     $oldLocation = "Group Location";
				     $oldOffice = "ITE 200";
				}
				
				//Display old appointment info
				echo "<h2>Previous Appointment</h2>";
				echo "<label for='info'>";
				echo "Advisor: ", $oldAdvisorName, "<br>";
				echo "Appointment: ", date('l, F d, Y g:i A', $oldDatephp), "<br>";
                                echo "Location: ", $oldLocation, "<br>";
                                echo "Office: ", $oldOffice, "</label><br>";
			
                        //Set the advisor and current time
			$currentAdvisorName;
			$currentAdvisorID = $_POST["postAdvisor"];
			$currentDatephp = strtotime($_POST["appTime"]);

                        //Individual appointment
			if($currentAdvisorID != 0){
				$sql2 = "select * from Proj2Advisors where `id` = '$currentAdvisorID'";
				$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
				$row2 = mysql_fetch_row($rs2);
				$currentAdvisorName = $row2[1] . " " . $row2[2];
				$advisingLocation = $row2[6];
				$advisorOffice = $row2[5];
			}

                        //Group appointment
			else{
			        $currentAdvisorName = "Group";
				$advisingLocation = "Group Location";
				$advisorOffice = "ITE 200";
			    }
			
                        //Display new appointment info
			echo "<h2>Current Appointment</h2>";
			echo "<label for='newinfo'>";
			echo "Advisor: ",$currentAdvisorName,"<br>";
			echo "Appointment: ",date('l, F d, Y g:i A', $currentDatephp),"<br>";
                        echo "Advising Location: ", $advisingLocation, "<br>";
                        echo "Advisor's Office: ", $advisorOffice, "<label>";
		?>
        </div>

	    <!--Confirmation button-->
	    <div class="nextButton">
		<?php
				echo "<input type='submit' name='finish' class='button large go' value='Reschedule'>";
		?>

	                <!--Cancel button-->
			<input style="margin-left: 50px" type="submit" name="finish" class="button large" value="Cancel">
	    </div>
		</form>
		</div>
  </body>
</html>