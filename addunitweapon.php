<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","loomisc-db","F2ke0sm1wyrAgvi0","loomisc-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

header( "refresh:3;url=loomisc_CS340_DZC.php" );

if(!($stmt = $mysqli->prepare("INSERT INTO dzc_unit_weapon(uid, wid, mf, arc) VALUES (?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("iiis",$_POST['unit'],$_POST['weapon'],$_POST['mf'],$_POST['arc']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to dzc_unit_weapon.";
}
echo "<form method=\"POST\" action=\"factionRoster.php\">
		<input type=\"hidden\" name=\"faction\" value=" . $_POST['fid'] . ">
		<input type=\"submit\" name=\"viewFactionRoster\" value=\"Return to Faction Roster\">
		</form>";

?>