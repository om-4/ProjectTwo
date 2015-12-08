<?php
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Student Advising Home</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">

		<h2>Hello 
		<?php
                        $debug = false;
                        include('../CommonMethods.php');
                        $COMMON = new Common($debug);
                        $sql = "select * from  Proj2Students where `StudentID` = '$_SESSION[studID]'";
                        $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                        $row = mysql_fetch_row($rs);

                        //Display user's name
                        $name = $row[1];
			echo $name;
		?>
        </h2>

	    <div class="selections">
		<form action="StudProcessHome.php" method="post" name="Home">
	    <?php

			  /*Connect to our database
			$debug = false;
			include('../CommonMethods.php');
			$COMMON = new Common($debug);*/
			
			$studExist = false;
			$adminCancel = false;
			$noApp = false;
			$studid = $_SESSION["studID"];


                        //Look in our student table for the ID the user input
			$sql = "select * from Proj2Students where `StudentID` = '$studid'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			
                        //If we get a row, the user exists
			if (!empty($row)){
				$studExist = true;
				if($row[6] == 'C'){
					$adminCancel = true;
				}
				if($row[6] == 'N'){
					$noApp = true;
				}
			}

/*Student does not exist yet in the table
			else{

			  //Insert the data if student ID does not exist
			    $sql = "INSERT INTO Proj2Students (`FirstName`, `LastName`, `StudentID`, `Email`, `Major`) VALUES ('$_POST[firstN]', '$_POST[lastN]', '$studid', '$_POST[email]', '$_POST[major]')";

			    $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);


			    }*/

			if ($studExist == false || $adminCancel == true || $noApp == true){

			        //Display cancellation message
				if($adminCancel == true){
					echo "<p style='color:red'>The advisor has cancelled your appointment! Please schedule a new appointment.</p>";
				}
				echo "<button type='submit' name='selection' class='button large selection' value='Signup'>Signup for an appointment</button><br>";
			}
			else{

			        //View current appointment button
				echo "<button type='submit' name='selection' class='button large selection' value='View'>View my appointment</button><br>";
				//Reschedule appointment button
				echo "<button type='submit' name='selection' class='button large selection' value='Reschedule'>Reschedule my appointment</button><br>";

				//Cancel current appointment button
				echo "<button type='submit' name='selection' class='button large selection' value='Cancel'>Cancel my appointment</button><br>";
			}

                        //Search for appointment button
			echo "<button type='submit' name='selection' class='button large selection' value='Search'>Search for appointment</button><br>";

                        //Show next available appointment based on major
                        echo "<button type='submit' name='selection' class='button large selection' value='NextApp'>Show next available appointment</button><br>";

                        //Edit user information button
			echo "<button type='submit' name='selection' class='button large selection' value='Edit'>Edit student information</button><br>";
		?>
		</form>
        </div>

		<form action="Logout.php" method="post" name="Logout">
	    <div class="logoutButton">
			<input type="submit" name="logout" class="button large go" value="Logout">
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
