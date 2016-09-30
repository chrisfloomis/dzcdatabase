<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","loomisc-db","F2ke0sm1wyrAgvi0","loomisc-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

header( "refresh:3;url=loomisc_CS340_DZC.php" );

if(!($stmt = $mysqli->prepare("DELETE FROM dzc_faction WHERE id=" . $_POST['faction']))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Deleted " . $stmt->affected_rows . " from dzc_faction.";
	echo "<br>Redirect back in 3 seconds.";
}
?>