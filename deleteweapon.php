<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","loomisc-db","F2ke0sm1wyrAgvi0","loomisc-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt = $mysqli->prepare("DELETE FROM dzc_unit_weapon WHERE wid=" . $_POST['wid']))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Deleted " . $stmt->affected_rows . " from dzc_unit_weapon.<br>";
}
$stmt->close();

if(!($stmt = $mysqli->prepare("DELETE FROM dzc_weapon WHERE id=" . $_POST['wid']))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Deleted " . $stmt->affected_rows . " from dzc_weapon.";
}
$stmt->close();

echo "<form method=\"POST\" action=\"factionRoster.php\">
		<input type=\"hidden\" name=\"faction\" value=" . $_POST['fid'] . ">
		<input type=\"submit\" name=\"viewFactionRoster\" value=\"Return to Faction Roster\">
		</form>";

?>