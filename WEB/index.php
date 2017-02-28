<?php
include 'config.php';
$shouldWarn = $_GET["warn"];
if($_SESSION['currentuser'] != ""){
	header("Location: main.php");
}

?>
<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<script src="js/bootstrap.min.js"></script>
<center>
<title>Fred's Admin System</title>
<h1>Fred's Admin System</h1>

<?php
if($shouldWarn == 1){
	echo "<b>The details you have entered are incorrect, please try again</b>";
}
?>
<br><br>
<form action="login.php" method="post">
Username: <input type="text" name="username"><br>
Password: <input type="password" name="password"><br><br>
<input type="submit">
</form>


</center>
</html>