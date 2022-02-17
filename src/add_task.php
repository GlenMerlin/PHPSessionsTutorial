<?php
session_start();
$_SESSION['tasks'] += $_GET['amount'];
header('location: tasks.php');
?>