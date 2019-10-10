<?php
session_start();

include("check.php");
include('../config/config.php');

$id = $_SESSION['UID'];
if(!isset($_SESSION["loggedin"]) || empty($_SESSION["loggedin"])){
    header("location: ../login.php");
	exit;
}
	
	$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
	
	$topic = addslashes($_POST['topic']);
	$content = nl2br(addslashes($_POST['content']));
	$cid = $_GET['cid'];
	$scid = $_GET['scid'];
	
	$nm = $_SESSION["loggedin"];
	$cmscn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
	$topictitle = "SELECT * FROM topics WHERE title='$topic'";
	$restop = mysqli_query($cmscn, $topictitle);
	
	if(isset($_SESSION["loggedin"])) {
			$nick = $_SESSION["loggedin"];
			$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		}
	
	$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
	$result = mysqli_query($checkacp,$sql);
	$rows = mysqli_fetch_array($result);
		
	$idcheck = $rows['id'];
	$ipcheck = $rows['last_ip'];

			if (mysqli_num_rows($restop) > 0) {
			  header("Location: topicexists.php");
			}else{
				if(empty($topic) || empty($content)){
					header("Location: emptyerror.php");
				}else{
						if(isset($_SESSION['last_submit']) && ((time() - $_SESSION['last_submit']) < 15)) { //time in seconds! 60 seconds = 1 Minute and 1 minute * 5 = 5 minutes!
							header("Location: wait.php");
							$_SESSION['last_submit'] = time();
						}else{
						$_SESSION['last_submit'] = time();
						$insert = mysqli_query($con, "INSERT INTO topics (`category_id`, `subcategory_id`, `author`, `author_id`, `title`, `content`, `date_posted`) 
								  VALUES ('".$cid."', '".$scid."', '".$_SESSION['loggedin']."', '".$rows['id']."', '".$topic."', '".$content."', NOW());");
								  
						$insertlog = mysqli_query($con, "INSERT INTO logs_forum (`logger`, `logger_id`, `logdetails`, `logdate`) 
								  VALUES ('".$_SESSION['loggedin']."', '".$rows['id']."', 'TOPIC: Created Topic: `".$topic."` (CID: ".$cid." / SCID: ".$scid.")', NOW());");
								  
						$link = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port); 
						
						$session = $_SESSION["loggedin"];
						
						$qrs = mysqli_query($link, "UPDATE `account` SET `posts`=posts+1 WHERE `username`='$session'");
						
						mysqli_close($link);
								  
						if ($insert) {
							header("Location: /forum/topics/".$cid."/".$scid."");
						}
						$_SESSION['last_submit'] = time();
						}
				}
			}
?>