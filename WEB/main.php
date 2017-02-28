<?php

	include "config.php";
	$user = $_SESSION['currentuser'];
	if($user == ""){
		header('Location: index.php?warn=1');
	}
	$commandNotify = $_GET["sent"];
	$userNotify = $_GET["sentU"];
?>
<html>
<head>

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<script src="js/bootstrap.min.js"></script>
<center><br>
<title>Fred's Admin System - Main</title>

<?php

	if($commandNotify == 1){
		echo "<b>The command will come through in-game in a moment!</b><br><br>";
	}
	if($userNotify == 1){
		echo "<b>The user has been added, they can login now!</b><br><br>";
	}
?>
<h1>Fred's Admin System</h1><br>
You are logged in as: <?php 

if($user == ""){
	echo "<b><a href='index.php'>Click here to login</a></b>";
}
else{
	echo "<b>" . $user . "</b>";
	echo '<br><a href="logout.php">Logout</a>';
}	?>
<hr>
<br><br>

<?php
	$sql = "SELECT * FROM players";
	$result = $conn->query($sql);

	echo "<table style='width:50%'>"; // start a table tag in the HTML
	echo "<tr><th>Name</th><th>SteamID</th><th>User Group</th><th>Actions</th></tr>";
	while($row = $result->fetch_assoc()){   //Creates a loop to loop through results
	echo "<tr><td>" . $row['name'] . "</td><td>" . $row['steamid'] . "</td><td>" . $row['usergroup'] . "</td>";  //$row['index'] the index here is a field name
	
	echo "<td><a href='action.php?type=1&id=" . $row["name"] . "'>Kick</a><a href='action.php?type=2&id=" . $row["name"] . "'>  Ban</a></td>";
	echo "</tr>";
	
	
	}

	echo "</table>"; //Close the table in HTML

?>

<br>

<h3>Run Console Command</h3>
<form action="command.php" method="post">
Command to Run: <input type="text" name="command"><br>
<input type="submit">
</form>
<br>

<h3>Add User ID</h3>
<form action="command.php" method="post">
SteamID: <input type="text" name="steamid"><br>
Usergroup: <input type="text" name="usergroup"><br>
<input type="submit">
</form>

<br>
<h3>Create another Administrator Account</h3>
<form action="createuser.php" method="post">
Desired Username: <input type="text" name="Cusername"><br>
Desired Password: <input type="password" name="Cpassword"><br><br>
<input type="submit">
</form>


</center>
</html>
