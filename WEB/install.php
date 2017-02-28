<?php
include "config.php";


$sql = "CREATE TABLE commands(command TEXT NOT NULL)";
$conn->query($sql);

$sql = "CREATE TABLE players(name TEXT NOT NULL, steamid TEXT NOT NULL, usergroup TEXT NOT NULL)";
$conn->query($sql);

$sql = "CREATE TABLE users(username TEXT NOT NULL, password TEXT NOT NULL)";
$conn->query($sql);

$sql = "INSERT INTO `users`(`username`, `password`) VALUES('root', 'root')";
$conn->query($sql);

echo "<center>Success! Please remove this install.php file :)";



?>