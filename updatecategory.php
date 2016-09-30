<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","loomisc-db","F2ke0sm1wyrAgvi0","loomisc-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

header( "refresh:3;url=loomisc_CS340_DZC.php" );


if(!(empty($_POST['newName'] != ""))){
	if(!($stmt = $mysqli->prepare("UPDATE dzc_category c SET c.name=(?) WHERE c.id=" . $_POST['category']))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("s",$_POST['newName']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Updated " . $stmt->affected_rows . " name in dzc_category.<br>";
	}
}

if(!(empty($_POST['newSpecial'] != ""))){
	if(!($stmt = $mysqli->prepare("UPDATE dzc_category c SET c.special=(?) WHERE c.id=" . $_POST['category']))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("s",$_POST['newSpecial']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Updated " . $stmt->affected_rows . " hallmark in dzc_category.";
	}
}

	echo "<br>Redirect back in 3 seconds.";
?>