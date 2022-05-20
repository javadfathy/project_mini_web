<?php
session_start();
$_SESSION['user'] = 0;
header('Location: index.php');
?>

