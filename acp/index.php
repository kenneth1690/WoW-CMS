<?php
session_start();
$id = $_SESSION['UID'];
header("location: acp.php");
exit;
?>