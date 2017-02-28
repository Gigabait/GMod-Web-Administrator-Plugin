<?php
include 'config.php';
$usergood = false;
$passgood = false;
echo "<center>";
echo '<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">';
$sql = "SELECT username, password FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row to check all dem passwords, not safe but oh well :(
    while($row = $result->fetch_assoc()) {
        if($row["username"] == $_POST["username"]){
			if($_POST["password"] == $row["password"]){
				$_SESSION['currentuser'] = $row["username"];
				echo "You have logged in successfully!<br><br><a href='main.php'>Enter Panel</a>";
				$check = true;
				break;
			}
			else{
				echo "Incorrect Login Details!";
			}
		}
		else{
			echo "Error";
		}
    }
}
header('Location: main.php');
?>
</center>