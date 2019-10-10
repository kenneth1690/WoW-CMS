<?php
session_start();

include("check.php");
include('../config/config.php');

$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);

$id = $_SESSION['UID'];
if(!isset($_SESSION["loggedin"]) || empty($_SESSION["loggedin"])){
    header("location: ../login.php");
	exit;
}
	
	$cid = $_GET['cid'];
	$scid = $_GET['scid'];
	$tid = $_GET['tid'];
	
		if(isset($_SESSION["loggedin"])) {
			$nick = $_SESSION["loggedin"];
			$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		}
		
		
		$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
		$result = mysqli_query($checkacp,$sql);
		$rows = mysqli_fetch_array($result);
		
		$idcheck = $rows['id'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkacp,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		
		if(!$rowsgm || $rowsgm['gmlevel']==0){
			header("location: ../index.php");
			exit;
		}
	
	$select3 = mysqli_query($con, "SELECT * FROM `topics` WHERE `topic_id`='$tid'");
	$row3 = mysqli_fetch_assoc($select3);
	
	$title = mysqli_real_escape_string($con, $row3['title']);
		
	$ipcheck = $rows['last_ip'];
	
				if($rowsgm['gmlevel']>0){
					if($tid){
						if($row3['locked']==0){
							$insert2 = mysqli_query($con, "UPDATE `topics` SET `locked`='1' WHERE `topic_id`='$tid'");
							$insertlog = mysqli_query($con, "INSERT INTO logs_gm (`logger`, `logger_id`, `logger_gmlevel`, `logdetails`, `logdate`) 
									  VALUES ('".$_SESSION['loggedin']."', '".$rows['id']."', '".$rowsgm['gmlevel']."', 'TOPIC: Locked Topic: `$title` (CID: ".$cid." / SCID: ".$scid." / TID: ".$tid.")', NOW());");
						}elseif($row3['locked']==1){
							$insert2 = mysqli_query($con, "UPDATE `topics` SET `locked`='0' WHERE `topic_id`='$tid'");
							$insertlog = mysqli_query($con, "INSERT INTO logs_gm (`logger`, `logger_id`, `logger_gmlevel`, `logdetails`, `logdate`) 
									  VALUES ('".$_SESSION['loggedin']."', '".$rows['id']."', '".$rowsgm['gmlevel']."', 'TOPIC: Unlocked Topic: `$title` (CID: ".$cid." / SCID: ".$scid." / TID: ".$tid.")', NOW());");
						}
					}else{
						header("Location: /forum/index.php");
					}
				}
												  

	
	
	if ($insert2 && $insertlog) {
		header("Location: /forum/readtopic/".$cid."/".$scid."/".$tid."");
	}
?>