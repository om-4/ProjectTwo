<?php
session_start();

$debug = false;

/*if(isset($_POST["advisor"])){
	$_SESSION["advisor"] = $_POST["advisor"];
	}*/

//Set advisor and student major
$localAdvisor = $_POST["advisor"];

//Connect to database
include('../CommonMethods.php');
$COMMON = new Common($debug);

$sql = "select *  from Proj2Students where `StudentID` = '$_SESSION[studID]'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

$localMaj = $row[5];

//Find the advisor in the advisors table
$sql = "select * from Proj2Advisors where `id` = '$localAdvisor'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$advisorName = $row[1]." ".$row[2];
if ($row[6] != ""){
  $advisingLocation = $row[6];
  }
else{
  $advisingLocation = "Group Location";
}
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Appointment</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>

  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Select Appointment Time</h1>
	    <div class="field">

                <!--Form where we send the input to-->
		<form action = "10StudConfirmSch.php" method = "post" name = "SelectTime">

                <input type="hidden" name="postAdvisor" value="<?php echo $localAdvisor;?>" />

	    <?php

// http://php.net/manual/en/function.time.php fpr SQL statements below
// Comparing timestamps, could not remember. 

			$curtime = time();

			if ($_POST["advisor"] != "Group")  // for individual conferences only
			{ 

			        //Find appointments that are not already passed, where we find the user's major, and where we find the advisor we want
				$sql = "select * from Proj2Appointments where `EnrolledNum` = 0 
					and (`Major` like '%$localMaj%' or `Major` = '') and `Time` > '".date('Y-m-d H:i:s')."' and `AdvisorID` = ".$localAdvisor." 
					order by `Time` ASC limit 30";

				//Display text to the user about their choice of advisor
				echo "<h2>Individual Advising</h2><br>";
				echo "<label for='prompt'>Select appointment with ",$advisorName,":</label><br>";
			}

			else // for group conferences
			{

				//Find group appointments
				$sql = "select * from Proj2Appointments where `EnrolledNum` < `Max` and `Max` > 1 and (`Major` like '%$localMaj%' or `Major` = '')  and `Time` > '".date('Y-m-d H:i:s')."' order by `Time` ASC limit 30";

				//Display text to the user
				echo "<h2>Group Advising</h2><br>";
				echo "<label for='prompt'>Select appointment:</label><br>";
			}

                        //Do the sql selection
                        $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

                        //Find all available appointments based on the above information
			while($row = mysql_fetch_row($rs)){
				$datephp = strtotime($row[1]);
				echo "<label for='",$row[0],"'>";
				echo "<input id='",$row[0],"' type='radio' name='appTime' required value='", $row[1], "'>", date('l, F d, Y g:i A', $datephp) ,", Location: ", $advisingLocation, "</label><br>\n";
			}
		?>
        </div>

	    <!--Submit button-->
	    <div class="nextButton">
			<input type="submit" name="next" class="button large go" value="Next">
	    </div>
		</form>
		<div>

		<!--Return home-->
		<form method="link" action="02StudHome.php">
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
		</div>
		<div class="bottom">
		<p>Note: Appointments are maximum 30 minutes long.</p>
		<p style="color:red">If there are no more open appointments, contact your advisor or click <a href='02StudHome.php'>here</a> to start over.</p>
		</div>
  </body>
</html>