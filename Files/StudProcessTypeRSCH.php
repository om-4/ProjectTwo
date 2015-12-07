<?php
session_start();

//If we have a group appointment
if ($_POST["advisor"] == "Group"){
	include('17StudSelectTimeRSCH.php');
}

//If we have an individual appointment
elseif ($_POST["advisor"] == "Individual"){
	header('Location: 16StudSelectAdvisorRSCH.php');
}
?>