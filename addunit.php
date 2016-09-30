<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","loomisc-db","F2ke0sm1wyrAgvi0","loomisc-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

header( "refresh:3;url=loomisc_CS340_DZC.php" );

$ss = explode('_',$_POST['squadsize']);

if(!($stmt = $mysqli->prepare("INSERT INTO dzc_unit(fid, name, armor, mv, cm, dp, pts, utype, catid, fkssmin, fkssmax, fkssfixed, coherency, special) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("isiisiisiiiiss",$_POST['faction'],$_POST['unitName'],$_POST['armor'],$_POST['mv'],$_POST['cm'],$_POST['dp'],$_POST['pts'],$_POST['utype'],$_POST['category'],$ss[0],$ss[1],$ss[2],$_POST['coherency'],$_POST['special']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to dzc_unit.";
	echo "<br>Redirect back in 3 seconds.";
}

?>