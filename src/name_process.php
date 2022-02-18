<?php 
session_start();

$_SESSION['name'] = $_GET['name'];
header("location: index.php")

?>