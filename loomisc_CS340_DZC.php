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
		<h2>UNITS & WEAPONS</h2>
		<div>
			<form method="POST" action="factionRoster.php">
					<fieldset>
						<legend>Faction Roster</legend>
						<p>Select Faction to view it's units and weapons <select name="faction">
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
					
					<input type="submit" name="viewFactionRoster" value="View Faction Roster">
				</form>
		</div>
		
		<form method="POST" action="addunit.php">
					<fieldset>
						<legend>Add New Unit</legend>
						<p>Faction: <select name="faction" required>
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
						<p>Unit Name: <input id="unitName" type="text" name="unitName" required></p>
						<p>Armor: <input id="armor" type="number" name="armor" min="1" required></p>
						<p>Movement: <input id="mv" type="number" name="mv" min="0" required></p>
						<p>Counter Measures: <input id="cm" type="text" name="cm" required></p>
						<p>Damage Points: <input id="dp" type="number" name="dp" min="1" required></p>
						<p>Point Cost: <input id="pts" type="number" name="pts" min="1"></p>
						<p>Type: <input id="utype" type="text" name="utype" required></p>
						<p>Category: <select name="category">
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
						<p>Squad Size: <select name="squadsize">
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
							echo '<option value="' . $min . '_' . $max . '_' . $fixed . '"> ' . $text . '</option>\n';

						}
						$stmt->close();

						?>
						</select></p>
						<p>Coherency: <input id="coherency" type="text" name="coherency" required></p>
						<p>Special Rules: <input id="special" type="text" name="special"></p>
					</fieldset>
					<input type="submit" name="addUnit" value="Add Unit">
				</form>
		
		<form method="POST" action="addweapon.php">
					<fieldset>
						<legend>Add New Weapon</legend>
						<p>Faction: <select name="faction" required>
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
						<p>Weapon Name: <input id="weaponName" type="text" name="weaponName" required></p>
						<p>Energy: <input id="energy" type="number" name="energy"></p>
						<p>Shots: <input id="sh" type="number" name="sh" min="1" required></p>
						<p>Accuracy: <input id="ac" type="number" name="ac" min="1" max="6" required></p>
						<p>Range Full: <input id="rf" type="number" name="rf"></p>
						<p>Range Countered: <input id="rc" type="number" name="rc"></p>
						<p>Special Rules: <input id="special" type="text" name="special"></p>
					</fieldset>
					<input type="submit" name="addWeapon" value="Add Weapon">
				</form>
		
		
	</body>
</html>