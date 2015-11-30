<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","loomisc-db","F2ke0sm1wyrAgvi0","loomisc-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}


if(!(empty($_POST['newName'] != ""))){
	if(!($stmt = $mysqli->prepare("UPDATE dzc_faction f SET f.name=(?) WHERE f.id=" . $_POST['faction']))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("s",$_POST['newName']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Updated " . $stmt->affected_rows . " name in dzc_faction.<br>";
	}
}

if(!(empty($_POST['newHallmark'] != ""))){
	if(!($stmt = $mysqli->prepare("UPDATE dzc_faction f SET f.hallmark=(?) WHERE f.id=" . $_POST['faction']))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("s",$_POST['newHallmark']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Updated " . $stmt->affected_rows . " hallmark in dzc_faction.";
	}
}

?>