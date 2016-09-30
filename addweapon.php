<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","loomisc-db","F2ke0sm1wyrAgvi0","loomisc-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

header( "refresh:3;url=loomisc_CS340_DZC.php" );

if(!($stmt = $mysqli->prepare("INSERT INTO dzc_weapon(fid, name, energy, sh, ac, rf, rc, special) VALUES (?,?,?,?,?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("isiiiiis",$_POST['faction'],$_POST['weaponName'],$_POST['energy'],$_POST['sh'],$_POST['ac'],$_POST['rf'],$_POST['rc'],$_POST['special']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to dzc_weapon.";
	echo "<br>Redirect back in 3 seconds.";
}

?>