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
	
	if(isset($_SESSION["loggedin"])) {
			$nick = $_SESSION["loggedin"];
			$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		}
	
	$getticid = $_GET['ticid'];
	$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
	$select3 = mysqli_query($con, "SELECT * FROM `tickets` WHERE `id`='$getticid'");
	$row3 = mysqli_fetch_assoc($select3);
	
	$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
	$result = mysqli_query($checkacp,$sql);
	$rows = mysqli_fetch_array($result);
		
	$idcheck = $rows['id'];
	$ipcheck = $rows['last_ip'];
	
	$checktic = mysqli_query($con, 'SELECT * FROM tickets WHERE id="'.$getticid.'"');
    if(mysqli_num_rows($checktic)>0){
		$rowtic = mysqli_fetch_array($checktic);
		if($idcheck!=$rowtic['author_id']){
			header("refresh:5;url=index.php");
		}
	}
	
	if(empty($comment)){
					header("Location: emptyerror.php");
				}else{
					if(isset($_SESSION['last_submit']) && ((time() - $_SESSION['last_submit']) < 15)) { //time in seconds! 60 seconds = 1 Minute and 1 minute * 5 = 5 minutes!
						header("Location: wait.php");
						$_SESSION['last_submit'] = time();
					}else{
					$_SESSION['last_submit'] = time();
					$insert = mysqli_query($con, "INSERT INTO ticket_answers (`ticket_id`, `answer`, `author`, `author_id`, `date_posted`)
												  VALUES ('".$getticid."', '".$comment."', '".$_SESSION['loggedin']."', '".$idcheck."', NOW());");
											
					$insert2 = mysqli_query($con, "UPDATE `tickets` SET `readed`='0' WHERE `ticket_id`='$getticid'");

					$_SESSION['last_submit'] = time();
					
					header("Location: /ucp/viewticket.php?ticid=".$getticid."");
					}
				}
	
	
?>