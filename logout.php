<?php
session_start();

session_destroy();
session_start();
$_SESSION['user_id']  ="";
header("Location:index.php");

?>
