<?php
session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);

?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Next Appointment</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Next Available Appointment Based on Your Major</h1>
	    <div class="field">
	    <?php

                        $sql = "select * from Proj2Students where `StudentID` = '$_SESSION[studID]'";
                        $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                        $row = mysql_fetch_row($rs);
                        $major = $row[5];

                        //Find appointments in the future with our major 
                        //in mind
                        $sql = "select * from Proj2Appointments where `Time` > '".date('Y-m-d H:i:s')."' and `Major` like '%".$major."%' and `EnrolledID` = '' order by `Time` ASC Limit 30";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			// if for some reason there really isn't a match, (something got messed up, tell them there really isn't one there)
			$num_rows = mysql_num_rows($rs);

			if($num_rows > 0)
			{
				$row = mysql_fetch_row($rs); // get legit data
				$advisorID = $row[2];
				$datephp = strtotime($row[1]);
				
				//The next appointment is not a group appointment
				if($advisorID != 0){
					$sql2 = "select * from Proj2Advisors where `id` = '$advisorID'";
					$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
					$row2 = mysql_fetch_row($rs2);
					$advisorName = $row2[1] . " " . $row2[2];
					$advisorLocation = $row2[5];
				}

				//Next one is a group appointment
				else{$advisorName = "Group";
				     $advisorLocation = "Group Location";}
			
				//Print out the information
				echo "<label for='info'>";
				echo "Advisor: ", $advisorName, "<br>";
				echo "Appointment: ", date('l, F d, Y g:i A', $datephp), " in ", $advisorLocation, " </label>";

			}
			else // There is no next appointment available
			{
				echo("No appointment was detected.");
			}
	

		?>
        </div>

	    <!--Return home-->
	    <div class="finishButton">
			<button onclick="location.href = '02StudHome.php'" class="button large go" >Return to Home</button>


			
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