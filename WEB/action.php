<?php
include "config.php";
$type = $_GET["type"];
$target = $_GET["id"];


if($type == 1){
	$command = 'ulx kick "' . $target .'" "Kicked by Web Administrator"';
	$conn->query($sql);
}
else{
	$command = 'ulx ban "' . $target .'" 0 "Banned by Web Administrator"';
}



echo "<center><link href='css/bootstrap.min.css' rel='stylesheet' media='screen'><br>";
$sql = "SELECT username FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row to check all dem passwords, not safe but oh well :(
    while($row = $result->fetch_assoc()) {
        if($row["username"] == $_SESSION['currentuser']){
			echo "The command will come through in-game in a moment...<br><br><a href='main.php'>Enter Panel</a>";
			$sql = "INSERT INTO `commands`(`command`) VALUES ('+". $command."-')";
			$conn->query($sql);
			header("Location: main.php?sent=1");
		}
    }
}


?>