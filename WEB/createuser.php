<?php
include 'config.php';
$canuse = false;
echo $currentuser;
$sql = "SELECT username FROM users";
echo "<center><link href='css/bootstrap.min.css' rel='stylesheet' media='screen'><br>";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row to check all dem passwords, not safe but oh well :(
    while($row = $result->fetch_assoc()) {
        if($row["username"] == $_SESSION['currentuser']){
			echo "You have created an account successfully!<br><br><a href='main.php'>Enter Panel</a>" . "With username: " . $currentuser . ".";
			$sql = "INSERT INTO `users`(`username`, `password`) VALUES ('". $_POST["Cusername"]."','".$_POST["Cpassword"]."')";
			$conn->query($sql);
			$check = true;
			break;
		}
		else{
			$check = false;
		}
    }
}

header("Location: main.php?sentU=1");
?>