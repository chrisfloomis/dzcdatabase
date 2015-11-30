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
		<h1>Dropzone Commander Database</h1>
		<hr>
		<h2>FACTIONS</h2>
		<div>
			<div>
				<table>
					<thead>
						<th>Faction Name</th>
						<th>Faction Hallmarks</th>
					</thead>
					<tbody>
						<?php
							if(!($stmt = $mysqli->prepare("SELECT f.name, f.hallmark FROM dzc_faction f"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($fname, $hm)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
							 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $hm . "\n</td>\n</tr>";
							}
							$stmt->close();

						?>
					</tbody>
				</table>
			</div>
			<br>
			<div>
				<form method="POST" action="addfaction.php">
					<fieldset>
						<legend>Add New Faction</legend>
						<p>Faction Name: <input id="factionName" type="text" name="factionName" required></p>
						<p>Faction Hallmarks: <input id="factionHallmark" type="text" name="factionHallmark"></p>
					</fieldset>
					<input type="submit" name="addFaction" value="Add Faction">
				</form>
			</div>
			<br>
			<div>
				<form method="POST" action="updatefaction.php">
					<fieldset>
						<legend>Update Faction</legend>
						<p>Select Faction to Update <select name="faction">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, name FROM dzc_faction"))){
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
						<p>New Faction Name: <input id="factionName" type="text" name="newName"></p>
						<p>New Faction Hallmarks: <input id="factionHallmark" type="text" name="newHallmark"></p>
					</fieldset>
					<input type="submit" name="updateFaction" value="Update Faction">
				</form>
			</div>
			<br>
			<div>
				<form method="POST" action="deletefaction.php">
					<fieldset>
						<legend>Delete Faction</legend>
						<p>Select Faction to Delete <select name="faction">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, name FROM dzc_faction"))){
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
					</fieldset>
					<input type="submit" name="deleteFaction" value="Delete Faction">
				</form>
			</div>
			<br>
		</div>
		<hr>
		<h2>UNIT CATEGORIES</h2>
		<div>
			<div>
				<table>
					<thead>
						<th>Category Type</th>
						<th>Category Special Rules</th>
					</thead>
					<tbody>
						<?php
							if(!($stmt = $mysqli->prepare("SELECT c.name, c.special FROM dzc_category c"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($cname, $sr)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
							 echo "<tr>\n<td>\n" . $cname . "\n</td>\n<td>\n" . $sr . "\n</td>\n</tr>";
							}
							$stmt->close();

						?>
					</tbody>
				</table>
			</div>
			<br>
			<div>
				<form method="POST" action="addcategory.php">
					<fieldset>
						<legend>Add New Category</legend>
						<p>Category Type: <input id="categoryName" type="text" name="categoryName" required></p>
						<p>Special Rules: <input id="categorySpecialRules" type="text" name="categorySpecial"></p>
					</fieldset>
					<input type="submit" name="addCategory" value="Add Category">
				</form>
			</div>
			<br>
			<div>
				<form method="POST" action="updatecategory.php">
					<fieldset>
						<legend>Update Category</legend>
						<p>Select Category to Update <select name="category">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, name FROM dzc_category"))){
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
						<p>New Category Name: <input id="categoryName" type="text" name="newName"></p>
						<p>New Category Special Rules: <input id="categoryHallmark" type="text" name="newSpecial"></p>
					</fieldset>
					<input type="submit" name="updateCategory" value="Update Category">
				</form>
			</div>
			<br>
			<div>
				<form method="POST" action="deletecategory.php">
					<fieldset>
						<legend>Delete Category</legend>
						<p>Select Category to Delete <select name="category">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT id, name FROM dzc_category"))){
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
					</fieldset>
					<input type="submit" name="deleteCategory" value="Delete Category">
				</form>
			</div>
			<br>
		</div>
		<hr>
		<h2>SQUAD SIZES</h2>
		<div>
			<div>
				<table>
					<thead>
						<th>Squad Minimum</th>
						<th>Optional Squad Size</th>
						<th>Squad Maximum</th>
						<th>Fixed Sizes?</th>
					</thead>
					<tbody>
						<?php
							if(!($stmt = $mysqli->prepare("SELECT ss.ssmin, ss.ssmax, ss.ssfixed, ss.mid FROM dzc_squadsize ss"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($min, $max, $fixed, $mid)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
								echo "<tr>\n<td>\n" . $min . "\n</td>\n<td>\n" . $mid . "\n</td>\n<td>\n" . $max . "\n</td>\n<td>\n" . $fixed . "\n</td>\n</tr>";
							}
							$stmt->close();

						?>
					</tbody>
				</table>
			</div>
			<br>
			<div>
				<form method="POST" action="addsquadsize.php">
					<fieldset>
						<legend>Add New Squad Size</legend>
						<p>Minimum Squad Size: <input id="ssMin" type="number" name="ssMin" required></p>
						<p>Maximum: <input id="ssMax" type="number" name="ssMax" required></p>
						<p>Is the size <input type="radio" name="ssFixed" value="fixed" checked="checked">Fixed or a <input type="radio" name="ssFixed" value="range">Range</p>
						<p>If fixed, is there a middle squad size option? <input id="ssMid" type="number" name="ssMid"></p>
					</fieldset>
					<input type="submit" name="addSquadSize" value="Add Squad Size">
				</form>
			</div>
			<br>
<!--			<div>
				<form method="POST" action="updatesquadsize.php">
					<fieldset>
						<legend>Update Squad Size</legend>
						<p>Select Squad Size to Update <select name="squadsize">
							<?php/*
							if(!($stmt = $mysqli->prepare("SELECT ssmin,ssmax,ssfixed,sstext FROM dzc_squadsize"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($min, $max, $fixed, $text)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
								echo '<option value=" ssmin=' . $min . ' AND ssmax=' . $max . ' AND ssfixed=' . $fixed . ' "> ' . $text . '</option>\n';
							}
							$stmt->close();
							*/?>
						</select></p>
						<p>New Minimum Squad Size: <input id="ssMin" type="number" name="ssMin"></p>
						<p>New Maximum: <input id="ssMax" type="number" name="ssMax"></p>
						<p>Is the size <input type="radio" name="ssFixed" value="fixed">Fixed or a <input type="radio" name="ssFixed" value="range">Range</p>
						<p>If fixed, is there a middle squad size option? <input id="mid" type="number" name="mid"></p>
					</fieldset>
					<input type="submit" name="updatesquadsize" value="Update Squad Size">
				</form>
			</div>
			<br>		-->
			<div>
				<form method="POST" action="deletesquadsize.php">
					<fieldset>
						<legend>Delete Squad Size</legend>
						<p>Select Squad Size to Delete <select name="squadsize">
							<?php
							if(!($stmt = $mysqli->prepare("SELECT ssmin,ssmax,ssfixed,sstext FROM dzc_squadsize"))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($min, $max, $fixed, $text)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
								echo '<option value=" ssmin=' . $min . ' AND ssmax=' . $max . ' AND ssfixed=' . $fixed . ' "> ' . $text . '</option>\n';
								//echo '<input type="hidden" name="where" value=" ssmin=' . $min . ' AND ssmax=' . $max . ' AND ssfixed=' . $fixed . ' "> ' . $text . '</option>\n';
							}
							$stmt->close();
							
							?>
						</select></p>
						</fieldset>
					
					<input type="submit" name="deleteSquadSize" value="Delete Squad Size">
				</form>
			</div>
			<br>
		</div>
		<hr>
		<h2>UNITS</h2>
		<div>
			<div>
				<?php
					if(!($stmt = $mysqli->prepare("
SELECT u.id, f.name, u.name, u.armor, u.mv, u.cm, u.dp, u.pts, u.utype, c.name, ss.sstext, u.coherency, u.special,
w.name, w.energy, w.sh, w.ac, w.rf, w.rc, uw.mf, uw.arc, w.special
FROM dzc_faction f INNER JOIN 
dzc_unit u ON u.fid=f.id INNER JOIN
dzc_category c ON c.id=u.catid INNER JOIN
dzc_squadsize ss ON ss.ssmin=u.fkssmin AND ss.ssmax=u.fkssmax AND ss.ssfixed=u.fkssfixed INNER JOIN
dzc_unit_weapon uw ON uw.uid=u.id INNER JOIN
dzc_weapon w ON w.id = uw.wid
ORDER BY u.id, w.id
													"))){
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					if(!$stmt->bind_result($uid, $faction, $uname, $a, $mv, $cm, $dp, $pts, $type, $cat, $ss, $coh, $usr, $wname, $e, $sh, $ac, $rf, $rc, $mf, $arc, $wsr)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					
					if($stmt->fetch()){
						$final = array();
						$arr = array(
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
		<tr>\n<th>" . $unit["faction"] . 
		"</th>\n<th>" . $unit["uname"] . 
		"</th>\n<td>" . $unit["a"] . 
		"</td>\n<td>" . $unit["mv"] . 
		"\"</td>\n<td>" . $unit["cm"] . 
		"</td>\n<td>" . $unit["dp"] . 
		"</td>\n<td>" . $unit["pts"] . 
		"</td>\n<td>" . $unit["type"] . 
		"</td>\n<td>" . $unit["cat"] . 
		"</td>\n<td>" . $unit["ss"] . " " . $unit["coh"] . 
		"</td>\n<td>" . $unit["usr"] . "</td>\n</tr>
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
		"</td>\n<td>" . $weapon["wsr"] . "</td>\n</tr>
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
			</div>
		</div>
		
			<div>
			<table>
				<tbody>
					<tr>
						<td>REPLACE TABLE TITLE</td>
					</tr>
					<tr>
						<th>Faction</th>
						<th>Name</th>
						<th>Points</th>
					</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT f.name, u.name, u.pts, u.id, w.name, w.id FROM dzc_faction f INNER JOIN dzc_unit u ON u.fid = f.id INNER JOIN dzc_unit_weapon uw ON uw.uid=u.id INNER JOIN dzc_weapon w ON w.id=uw.wid ORDER BY u.id, w.id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($faction, $name, $points, $uid, $wname, $wid)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
					
if($stmt->fetch()){
	$final = array();
	$arr = array(
				"faction" => $faction,
				"unit" => $name,
				"pts" => $points,
				"weapon" => array()
				);
	$arr["weapon"][] = array("id" => $wid, "name" => $wname);
	$final[$uid] = $arr;
	
	while($stmt->fetch()){
		if(array_key_exists($uid,$final)){
			$final[$uid]["weapon"][] = array("id" => $wid, "name" => $wname);
		}
		else{
			$arr = array(
				"faction" => $faction,
				"unit" => $name,
				"pts" => $points,
				"weapon" => array()
						);
			$arr["weapon"][] = array("id" => $wid, "name" => $wname);
			$final[$uid] = $arr;
		}
	}
	
	foreach ($final as $unit) {
		echo "<tr>\n<td>\n" . $unit["faction"] . "\n</td>\n<td>\n" . $unit["unit"] . "\n</td>\n<td>\n" . $unit["pts"] . "\n</td>\n</tr>";
		foreach ($unit["weapon"] as $weapon) {
			echo "<tr>\n<td>\n" . $weapon["id"] . "\n</td>\n<td>\n" . $weapon["name"] . "\n</td>\n</tr>";
		}
	}
					
$stmt->close();
}
 //echo "<tr>\n<td>\n" . $faction . "\n</td>\n<td>\n" . $name . "\n</td>\n<td>\n" . $points . "\n</td>\n</tr>";//}
 //echo "<tr>\n<td>\n" . $wname . "\n</td>\n</tr>";


			
?>
					
<!--
					<tr>
						<td>Shaltari</td>
						<td>Jaguar</td>
						<td>110</td>
					</tr>
!-->
				</tbody>
			</table>
		</div>
		<div>
			<form method="POST" action="">						<!-- ADD TARGET -->
				<fieldset>
					<legend>Unit</legend>
					<p>Faction:
						<select id="faction" class="selTop" autocomplete="off">
							<option value=NULL selected="selected">[Select Faction]</option>
							<option value="UCM">UCM</option>
							<option value="scourge">Scourge</option>
							<option value="PHR">PHR</option>
							<option value="shaltari">Shaltari</option>
						</select>
					</p>
					<p>Name: 
						<input id="unitName" type="text" name="unitName">
					</p>
					<p>Points
						<input id="unitPoints" type="number" name="unitPoints">
					</p>
				</fieldset>
				<input type="submit" name="addUnit" value="Add Unit">
				<input type="submit" name="updateUnit" value="Update Unit">
			</form>
		</div>
	</body>
</html>