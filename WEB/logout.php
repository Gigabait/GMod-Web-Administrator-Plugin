<?php
include "config.php";
echo "<center>";
echo '<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">';

$_SESSION["currentuser"] = "";

if($_SESSION["currentuser"] == ""){
	echo "Logged out Success!";
}
else{
	echo "Error, contact support!";
}

header('Location: index.php');

?>