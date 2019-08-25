<?php
session_start();
include("check.php");
$id = $_SESSION['UID'];
header("location: ucp.php");
exit;
?>