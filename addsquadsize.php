<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","loomisc-db","F2ke0sm1wyrAgvi0","loomisc-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

header( "refresh:3;url=loomisc_CS340_DZC.php" );

$error = 0;
//print_r($_POST);
echo "1ssMiddle value is " . $_POST['ssMid'];
if(!($_POST['ssMin'] > 0)){
	echo "ERROR: Minimum Squad Size needs to be at least 1.<br>";
	$error = 1;
}

if(!($_POST['ssMin'] <= $_POST['ssMax'])){
	echo "ERROR: Maximum Squad Size needs to equal to or greater than Minimum.<br>";
	$error = 1;
}

if($_POST['ssFixed'] == "range" && $_POST['ssMid'] != ""){
	echo "ERROR: If squad size is a Range for Squad Size, there is no ssMiddle value<br>";
	$error = 1;
}

if($_POST['ssFixed'] == "fixed" && $_POST['ssMid'] != ""){
	if(!($_POST['ssMin'] <= $_POST['ssMid'])){
		echo "ERROR: ssMiddle Squad Size needs to be greather than Minimum.<br>";
	}
	if(!($_POST['ssMid'] <= $_POST['ssMax'])){
		echo "ERROR: ssMiddle Squad Size needs to be less than Minimum.<br>";
	}
	$error = 1;
}

if($error == 0){
	if($_POST['ssFixed'] == "range"){
		if(!($stmt = $mysqli->prepare("INSERT INTO dzc_squadsize(ssmin, ssmax, ssfixed, sstext) VALUES (?,?,?,?)"))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}
		$fixed = 0;
		$sstext = $_POST['ssMin'] . "-" . $_POST['ssMax'];
		if(!($stmt->bind_param("iiis",$_POST['ssMin'],$_POST['ssMax'],$fixed,$sstext))){
			echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!$stmt->execute()){
			echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		} else {
			echo "Added " . $stmt->affected_rows . " rows to dzc_squadsize.";
		}
	}
	
	if($_POST['ssFixed'] == "fixed"){
		if($_POST['ssMid'] != ""){
			//echo "ssMiddle value is " . $_POST['ssMid'] . "<br>";

			if(!($stmt = $mysqli->prepare("INSERT INTO dzc_squadsize(ssmin, ssmax, ssfixed, mid, sstext) VALUES (?,?,?,?,?)"))){
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}
//echo "ssMiddle value is " . $_POST['ssMid'] . "<br>";
			$fixed = 1;
			$sstext = $_POST['ssMin'] . "/" . $_POST['ssMid'] . "/" . $_POST['ssMax'];

			if(!($stmt->bind_param("iiiis",$_POST['ssMin'],$_POST['ssMax'],$fixed,$_POST['ssMid'],$sstext))){
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			}
//echo "ssMiddle value is " . $_POST['ssMid'] . "<br>";
			if(!$stmt->execute()){
				echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
			} else {
				echo "Added " . $stmt->affected_rows . " rows to dzc_squadsize.";
			}
		}
		else{
			if(!($stmt = $mysqli->prepare("INSERT INTO dzc_squadsize(ssmin, ssmax, ssfixed, sstext) VALUES (?,?,?,?)"))){
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}
			$fixed = 1;
			if($_POST['ssMin'] == $_POST['ssMax']){
				$sstext = $_POST['ssMin'];
			}
			else{
				$sstext = $_POST['ssMin'] . "/" . $_POST['ssMax'];
			}
			if(!($stmt->bind_param("iiis",$_POST['ssMin'],$_POST['ssMax'],$fixed,$sstext))){
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			}
			if(!$stmt->execute()){
				echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
			} else {
				echo "Added " . $stmt->affected_rows . " rows to dzc_squadsize.";
				echo "<br>Redirect back in 3 seconds.";
			}
		}
	}
	
}
?>