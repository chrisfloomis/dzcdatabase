<?php
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","loomisc-db","F2ke0sm1wyrAgvi0","loomisc-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
    	<title>x</title>										<!-- ADD TITLE -->
		<link rel="stylesheet" href="x.css" type="text/css">	<!-- ADD CSS -->
	</head>
	<body>
		<div>
			<table>
				<tbody>
					<tr>
						<td>REPLACE TABLE TITLE</td>
					</tr>
					<tr>
						<td>faction</td>
						<td>name</td>
						<td>points</td>
					</tr>
<?php
$stmt = $mysqli->prepare
						
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
			<form method="POST" action"">						<!-- ADD TARGET -->
				<fieldset>
					<legend>Unit</legend>
					<p>Faction:
						<select id="faction" class="selTop" autocomplete="off">
							<option value="0" selected="selected">[Select Faction]</option>
							<option value="1">UCM</option>
							<option value="2">Scourge</option>
							<option value="3">PHR</option>
							<option value="4">Shaltari</option>
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