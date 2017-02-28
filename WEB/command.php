<?php
include 'config.php';

$steamid = $_POST["steamid"];
$usergroup = $_POST["usergroup"];

if(isset($steamid) && isset($usergroup)){
	
	echo "The command will come through in-game in a moment...<br><br><a href='main.php'>Enter Panel</a>";
	$sql = "INSERT INTO `commands`(`command`) VALUES ('+ulx adduserid " . $steamid . " " . $usergroup . "-')";
	$conn->query($sql);
	header("Location: main.php?sent=1");
	
	exit();
}








$sql = "SELECT username FROM users";
$command = $_POST["command"];
echo "<center><link href='css/bootstrap.min.css' rel='stylesheet' media='screen'><br>";
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