<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","loomisc-db","F2ke0sm1wyrAgvi0","loomisc-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
    	<title>Dropzone Commander Database</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
		<h1>
		<?php
		if(!($stmt = $mysqli->prepare("SELECT name from dzc_faction WHERE id=" . $_POST['faction']))){
			echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
		}
		if(!$stmt->execute()){
			echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if(!$stmt->bind_result($fname)){
			echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
		if($stmt->fetch()){
			echo $fname . " Roster";
		}
			$stmt->close();
		?>
		</h1>
		
<a href="loomisc_CS340_DZC.php">Return Home</a>
		<table>
	<thead>
		<th></th>
		<th>A</th>
		<th>Mv</th>
		<th>CM</th>
		<th>DP</th>
		<th>Pts</th>
		<th>Type</th>
		<th>Category</th>
		<th>S+C</th>
		<th>Special</th>
	</thead>
	<tbody>
		<?php
if(!($stmt = $mysqli->prepare("
SELECT f.id, u.id, f.name, u.name, u.armor, u.mv, u.cm, u.dp, u.pts, u.utype, c.name, ss.sstext, u.coherency, u.special
FROM dzc_faction f INNER JOIN 
dzc_unit u ON u.fid=f.id INNER JOIN
dzc_category c ON c.id=u.catid INNER JOIN
dzc_squadsize ss ON ss.ssmin=u.fkssmin AND ss.ssmax=u.fkssmax AND ss.ssfixed=u.fkssfixed
WHERE f.id=" . $_POST['faction'] . "
ORDER BY u.id
													"))){
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					if(!$stmt->bind_result($fid, $uid, $faction, $uname, $a, $mv, $cm, $dp, $pts, $type, $cat, $ss, $coh, $usr)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					echo "<h3>Unit List</h3>";
					while($stmt->fetch()){
							 echo "<tr>\n<td>\n" . $uname . 
								 "\n</td>\n<td>\n" . $a .
								 "\n</td>\n<td>\n" . $mv .
								 "\n</td>\n<td>\n" . $cm .
								 "\n</td>\n<td>\n" . $dp .
								 "\n</td>\n<td>\n" . $pts .
								 "\n</td>\n<td>\n" . $type .
								 "\n</td>\n<td>\n" . $cat .
								 "\n</td>\n<td>" . $ss . " " . $coh .
								 "\n</td>\n<td>\n" . $usr .
								 "\n</td><td><form method=\"POST\" action=\"deleteunit.php\">
		<input type=\"hidden\" name=\"uid\" value=" . $uid . ">
		<input type=\"hidden\" name=\"fid\" value=" . $fid . ">
		<input type =\"submit\" name=\"deleteUnit\" value=\"Delete Unit\"></form></td>\n</tr>";
					}
		$stmt->close();
?>
		
	</tbody>
</table>
<br>

<hr width = "60%" align="left">
<br>
<table>
	<thead>
		<th></th>
		<th>E</th>
		<th>Sh</th>
		<th>Ac</th>
		<th>R(f)</th>
		<th>R(c)</th>
		<th>Special</th>
	</thead>
	<tbody>
		<?php
if(!($stmt = $mysqli->prepare("
SELECT f.id, w.id, w.name, w.energy, w.sh, w.ac, w.rf, w.rc, w.special
FROM dzc_faction f INNER JOIN 
dzc_weapon w ON w.fid=f.id
WHERE f.id=" . $_POST['faction'] . "
GROUP BY w.id
													"))){
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					if(!$stmt->bind_result($fid, $wid, $wname, $e, $sh, $ac, $rf, $rc, $wsr)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					echo "<h3>Weapon List</h3>";
					while($stmt->fetch()){
							 echo "<tr>\n<td>\n" . $wname . 
								 "\n</td>\n<td>\n" . $e .
								 "\n</td>\n<td>\n" . $sh .
								 "\n</td>\n<td>\n" . $ac .
								 "+\n</td>\n<td>\n" . $rf .
								 "\n</td>\n<td>\n" . $rc .
								 "\n</td>\n<td>\n" . $wsr .
								 "\n</td><td><form method=\"POST\" action=\"deleteweapon.php\">
		<input type=\"hidden\" name=\"wid\" value=" . $wid . ">
		<input type=\"hidden\" name=\"fid\" value=" . $fid . ">
		<input type =\"submit\" name=\"deleteWeapon\" value=\"Delete Weapon\"></form></td>\n</tr>";
					}
		$stmt->close();
?>
		
	</tbody>
</table>
<br>

<hr width = "60%" align="left">
<br>

<form method="POST" action="addunitweapon.php">
	<fieldset>
		<legend>Arm a Unit</legend>
		
			<?php
			echo '<input type="hidden" name="fid" value=' . $_POST['faction'] . '><p>Unit: <select name="unit" required>';
			
			if(!($stmt = $mysqli->prepare("SELECT id, name FROM dzc_unit WHERE fid=" . $_POST['faction']))){
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}

			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($id, $name)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while($stmt->fetch()){
				echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
			}
			$stmt->close();
			?>
		</select></p>
		<p>Weapon: <select name="weapon" required>
			<?php
			if(!($stmt = $mysqli->prepare("SELECT id, name FROM dzc_weapon WHERE fid=" . $_POST['faction']))){
				echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
			}

			if(!$stmt->execute()){
				echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($id, $name)){
				echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while($stmt->fetch()){
				echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
			}
			
			$stmt->close();
			?>
		</select></p>
		<p>Move and Fire: <input id="mf" type="number" name="mf" min="0" required></p>
		<p>Arc: <input id="arc" type="text" name="arc" required></p>
	</fieldset>
	<input type="submit" name="addUnitWeapon" value="Arm Unit with Weapon">
</form>		
		
<hr width = "60%" align="left">
<br>

		<h3>Units with their Weapons</h3>
<?php
if(!($stmt = $mysqli->prepare("
SELECT f.id, u.id, f.name, u.name, u.armor, u.mv, u.cm, u.dp, u.pts, u.utype, c.name, ss.sstext, u.coherency, u.special,
w.id, w.name, w.energy, w.sh, w.ac, w.rf, w.rc, uw.mf, uw.arc, w.special
FROM dzc_faction f INNER JOIN 
dzc_unit u ON u.fid=f.id INNER JOIN
dzc_category c ON c.id=u.catid INNER JOIN
dzc_squadsize ss ON ss.ssmin=u.fkssmin AND ss.ssmax=u.fkssmax AND ss.ssfixed=u.fkssfixed INNER JOIN
dzc_unit_weapon uw ON uw.uid=u.id INNER JOIN
dzc_weapon w ON w.id = uw.wid
WHERE f.id=" . $_POST['faction'] . "
ORDER BY u.id, w.id
													"))){
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					if(!$stmt->bind_result($fid, $uid, $faction, $uname, $a, $mv, $cm, $dp, $pts, $type, $cat, $ss, $coh, $usr, $wid, $wname, $e, $sh, $ac, $rf, $rc, $mf, $arc, $wsr)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					
					if($stmt->fetch()){
						$final = array();
						$arr = array(
							"fid" => $fid,
							"uid" => $uid,
							"faction" => $faction,
							"uname" => $uname,
							"a" => $a,
							"mv" => $mv,
							"cm" => $cm,
							"dp" => $dp,
							"pts" => $pts,
							"type" => $type,
							"cat" => $cat,
							"ss" => $ss,
							"coh" => $coh,
							"usr" => $usr,
							"weapon" => array()
									);
						$arr["weapon"][] = array(
									"fid" => $fid,
									"uid" => $uid,
									"wid" => $wid,
									"wname" => $wname,
									"e" => $e,
									"sh" => $sh,
									"ac" => $ac,
									"rf" => $rf,
									"rc" => $rc,
									"mf" => $mf,
									"arc" => $arc,
									"wsr" => $wsr
											);
						$final[$uid] = $arr;
						
						while($stmt->fetch()){
							if(array_key_exists($uid,$final)){
								$final[$uid]["weapon"][] = array(
													"fid" => $fid,
													"uid" => $uid,
													"wid" => $wid,
													"wname" => $wname,
													"e" => $e,
													"sh" => $sh,
													"ac" => $ac,
													"rf" => $rf,
													"rc" => $rc,
													"mf" => $mf,
													"arc" => $arc,
													"wsr" => $wsr
															);
							}
							else{
								$arr = array(
									"fid" => $fid,
									"uid" => $uid,
									"faction" => $faction,
									"uname" => $uname,
									"a" => $a,
									"mv" => $mv,
									"cm" => $cm,
									"dp" => $dp,
									"pts" => $pts,
									"type" => $type,
									"cat" => $cat,
									"ss" => $ss,
									"coh" => $coh,
									"usr" => $usr,
									"weapon" => array()
											);
								$arr["weapon"][] = array(
											"fid" => $fid,
											"uid" => $uid,
											"wid" => $wid,
											"wname" => $wname,
											"e" => $e,
											"sh" => $sh,
											"ac" => $ac,
											"rf" => $rf,
											"rc" => $rc,
											"mf" => $mf,
											"arc" => $arc,
											"wsr" => $wsr
													);
								$final[$uid] = $arr;
								}
							}
						foreach ($final as $unit) {
							echo "
<table>
	<thead>
		<th></th>
		<th>A</th>
		<th>Mv</th>
		<th>CM</th>
		<th>DP</th>
		<th>Pts</th>
		<th>Type</th>
		<th>Category</th>
		<th>S+C</th>
		<th>Special</th>
	</thead>
	<tbody>
		<tr>\n<th>" . $unit["uname"] . 
		"</th>\n<td>" . $unit["a"] . 
		"</td>\n<td>" . $unit["mv"] . 
		"\"</td>\n<td>" . $unit["cm"] . 
		"</td>\n<td>" . $unit["dp"] . 
		"</td>\n<td>" . $unit["pts"] . 
		"</td>\n<td>" . $unit["type"] . 
		"</td>\n<td>" . $unit["cat"] . 
		"</td>\n<td>" . $unit["ss"] . " " . $unit["coh"] . 
		"</td>\n<td>" . $unit["usr"] . 
		"</td>\n<td><form method=\"POST\" action=\"deleteunit.php\">
		<input type=\"hidden\" name=\"uid\" value=" . $unit["uid"] . ">
		<input type=\"hidden\" name=\"fid\" value=" . $unit["fid"] . ">
		<input type =\"submit\" name=\"deleteUnit\" value=\"Delete Unit\"></form></td></tr>
	</tbody>
</table>
<br>
<table>
	<thead>
		<th>Weapons</th>
		<th>E</th>
		<th>Sh</th>
		<th>Ac</th>
		<th>R(f)</th>
		<th>R(c)</th>
		<th>MF</th>
		<th>Arc</th>
		<th>Special</th>
	</thead>
	<tbody>
";
							foreach ($unit["weapon"] as $weapon) {
								echo "
		<tr>\n<th>" . $weapon["wname"] . 
		"</th>\n<td>" . $weapon["e"] . 
		"</td>\n<td>" . $weapon["sh"] . 
		"</td>\n<td>" . $weapon["ac"] . 
		"+</td>\n<td>" . $weapon["rf"] . 
		"\"</td>\n<td>" . $weapon["rc"] . 
		"\"</td>\n<td>" . $weapon["mf"] . 
		"\"</td>\n<td>" . $weapon["arc"] .
		"</td>\n<td>" . $weapon["wsr"] . 
		"</td>\n
		<td><form method=\"POST\" action=\"removeWeapon.php\"><input type=\"hidden\" name=\"uid\" value=" . $weapon["uid"] . ">
		<input type=\"hidden\" name=\"wid\" value=" . $weapon["wid"] . ">
		<input type=\"hidden\" name=\"arc\" value=" . $weapon["arc"] . ">
		<input type=\"hidden\" name=\"fid\" value=" . $weapon["fid"] . ">
		<input type =\"submit\" name=\"removeWeapon\" value=\"Remove Weapon from Unit\"></form></td></tr>
								";
							}
							
							echo "
	</tbody>
</table>
<br>
<hr width = \"60%\" align=\"left\">
<br>

								";
							
						}
					$stmt->close();
					}

?>
		
	</body>
</html>