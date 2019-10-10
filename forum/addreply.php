<?php
session_start();

include("check.php");
include('../config/config.php');

$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);

$id = $_SESSION['UID'];
if(!isset($_SESSION["loggedin"]) || empty($_SESSION["loggedin"])){
    header("location: ../login.php");
	exit;
}
	
	$comment = nl2br(addslashes($_POST['comment']));
	$cid = $_GET['cid'];
	$scid = $_GET['scid'];
	$tid = $_GET['tid'];
	
	if(isset($_SESSION["loggedin"])) {
			$nick = $_SESSION["loggedin"];
			$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		}
	
	$gettid = $_GET['tid'];
	$select3 = mysqli_query($con, "SELECT * FROM `topics` WHERE `topic_id`='$gettid'");
	$row3 = mysqli_fetch_assoc($select3);
	
	$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
	$result = mysqli_query($checkacp,$sql);
	$rows = mysqli_fetch_array($result);
		
	$idcheck = $rows['id'];
	$ipcheck = $rows['last_ip'];
	
	$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
	
	if(empty($comment)){
					header("Location: emptyerror.php");
				}else{
					if(isset($_SESSION['last_submit']) && ((time() - $_SESSION['last_submit']) < 15)) { //time in seconds! 60 seconds = 1 Minute and 1 minute * 5 = 5 minutes!
						header("Location: wait.php");
						$_SESSION['last_submit'] = time();
					}else{
					$_SESSION['last_submit'] = time();
					$insert = mysqli_query($con, "INSERT INTO replies (`category_id`, `subcategory_id`, `topic_id`, `author`, `author_id`, `comment`, `date_posted`)
												  VALUES ('".$cid."', '".$scid."', '".$tid."', '".$_SESSION['loggedin']."', '".$idcheck."', '".$comment."', NOW());");
												  
					$insertlog = mysqli_query($con, "INSERT INTO logs_forum (`logger`, `logger_id`, `logdetails`, `logdate`) 
								  VALUES ('".$_SESSION['loggedin']."', '".$rows['id']."', 'REPLY: Added Reply in Topic: `".$row3['title']."` (CID: ".$cid." / SCID: ".$scid." / TID: ".$tid.")', NOW());");
												  
					$insert2 = mysqli_query($con, "UPDATE `topics` SET `replies`=replies+1 WHERE `topic_id`='$tid'");
												  
												  
					$link = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port); 
										
										$session = $_SESSION["loggedin"];
										
										$qrs = mysqli_query($link, "UPDATE `account` SET `posts`=posts+1 WHERE `username`='$session'");
										
										mysqli_close($link);
										$_SESSION['last_submit'] = time();
					}
				}
	
	
	if ($insert) {
		header("Location: /forum/readtopic/".$cid."/".$scid."/".$tid."");
	}
?>