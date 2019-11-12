<?php
session_start();

include("check.php");
include('../config/config.php');

$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
$qr1 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'sitename'");
$qr2 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'siteonline'");
$qr3 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'offlinemessage'");

while($row = mysqli_fetch_array($qr1)){
    $sitename = $row['conf_value'];
}
while($row = mysqli_fetch_array($qr2)){
    $siteonline = $row['conf_value'];
}
while($row = mysqli_fetch_array($qr3)){
    $offlinemessage = $row['conf_value'];
}

$id = $_SESSION['UID'];
if(!isset($_SESSION["loggedin"]) || empty($_SESSION["loggedin"])){
    header("location: ../login.php");
	exit;
}elseif(isset($_SESSION["loggedin"])){
		$nick = $_SESSION["loggedin"];
		$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		
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
		mysqli_close($checkacp);
}
?>
<html lang="en" class="active"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="csrf-token" content="MTk5MWNlNjFkMmYyOGE5YjM3OTYxZDEyMzQyYWE0MDU=">
<meta name="robots" content="noodp, noydir">
<meta name="google-site-verification" content="YW87KZKk-q94TWTgngHnf4ej3VUW3mWfFgznDZM_HB4">
<meta name="Description" content="Private Server Community.">
<meta name="Keywords" content="<?php echo $sitename; ?>, WoW, World of Warcraft, Warcraft, Private Server, Private WoW Server, WoW Server, Private WoW Server, wow private server, wow server, wotlk server, cataclysm private server, wow cata server, best free private server, largest private server, wotlk private server, blizzlike server, mists of pandaria, mop, cataclysm, cata, anti-cheat, sentinel anti-cheat, warden">
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
<title><?php echo $sitename; ?> | Forum</title>
<link rel="stylesheet" href="/css/global.css">
<link rel="stylesheet" href="/css/ui.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/wm-contextmenu.css">
</head>
<body>

<div class="navigation-wrapper">
    <a href="/" class="navigation-logo"></a>
    <div class="navigation">
        <ul class="navbits">
                        <?php
						if(isset($_SESSION["loggedin"]) && !empty($_SESSION["loggedin"])){
							?><li><a href="/ucp/ucp.php" title="Account Panel">ACCOUNT PANEL</a></li><?php
						}else{
							?><li><a href="/create.php" title="Create Account">CREATE ACCOUNT</a></li><?php
						}?>
                        <li><a href="/download.php" title="Download">DOWNLOAD</a></li>
						<li><a href="/forum/index.php" title="Forum">FORUM</a></li>
            <!--<li><a href="/information.php" title="Information">INFORMATION</a></li>-->
						<li><a href="/armory/index.php" title="Armory">ARMORY</a></li>
                        <?php
						if(isset($_SESSION["loggedin"]) && !empty($_SESSION["loggedin"])){
							?><li><a href="/logout.php" title="Logout">LOG OUT</a></li><?php
						}else{
							?><li><a href="/login.php" title="Login">LOG IN</a></li><?php
						}?>
                    </ul>        
    </div>
</div>
<div id="page-frame">
    <div class="lordaeron-render"></div>
	<div class="frame-corners tl"></div>
    <div class="frame-corners tr"></div>
    <div class="leftmost-frame"></div>
	<div class="header"></div>
    <div class="center">
        <iframe width="100%" height="100%" src="/images/bg3.jpg" frameborder="0" scrolling="no" allowfullscreen=""></iframe>
    </div>
    <div class="footer"></div>
    <div class="rightmost-frame"></div>
	<div class="frame-corners bl"></div>
    <div class="frame-corners br"></div>
</div>
<div id="page-content-wrapper">
	<div id="wm-ui-flash-message"></div>
	<div class="frame-corners tl"></div>
    <div class="frame-corners tr"></div>
	<div class="header"></div>
    <div class="center">
        <div id="page-content">
            
	
<div id="page-navigation" class="wm-ui-generic-frame wm-ui-bottom-border">
	<ul>
					<?php
					$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
					$getcid = $_GET['cid'];
					$getscid = $_GET['scid'];
					$select = mysqli_query($con, "SELECT * FROM `subcategories` WHERE `subcat_id`='$getscid'");
					$row = mysqli_fetch_assoc($select);
					$select2 = mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_id`='$getcid'");
					$row2 = mysqli_fetch_assoc($select2);
					?>
    	    		<li><a href="/forum/" class="active">Forum</a></li>
					<li>></li>
					<li><a href="#" class="active">Delete Content</a></li>
            </ul>
    <ul>
        <li><?php
		$dt = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
		echo $dt->format('H:i');
		?></li>
    </ul>
</div>


<div class="content-wrapper">
	<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
		<div id="wm-error-page">
			<?php
			
			if(isset($_SESSION["loggedin"])) {
					$nick = $_SESSION["loggedin"];
					$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
				}
			
			$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
			$result = mysqli_query($checkacp,$sql);
			$rows = mysqli_fetch_array($result);
				
			$idcheck = $rows['id'];
			$nick = $rows['username'];

			if($_POST['tid']){
					$gettid = $_POST['tid'];
					$select = mysqli_query($con, "SELECT * FROM `topics` WHERE `topic_id`='$gettid'");
					$row = mysqli_fetch_assoc($select);
					
					if(isset($_SESSION["loggedin"])) {
						$nick = $_SESSION["loggedin"];
						$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
					}
					
					$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
					$result = mysqli_query($checkacp,$sql);
					$rows = mysqli_fetch_array($result);
					
					$idcheck = $rows['id'];
					
					if(mysqli_num_rows($select)>0){
								?>
									<center>
									<p>
										<font size="6">Successfully deleted</font>
									</p>
									<p>
										<font size="5">You have successfully deleted that topic.</font>
									</p> 
									</center>
									<?php	  
								header("refresh:5;url=index.php");
								$insertlog = mysqli_query($con, "INSERT INTO logs_gm (`logger`, `logger_id`, `logger_gmlevel`, `logdetails`, `logdate`) VALUES ('".$_SESSION['loggedin']."', '".$rows['id']."', '".$rowsgm['gmlevel']."', 'REPLY: User `".$nick."` deleted topic (TID: ".$_POST['tid'].")', NOW());");
								mysqli_query($con, "DELETE FROM topics WHERE `topic_id`='$gettid'");
					}else{
							?>
									<center>
									<p>
										<font size="6">Something is wrong</font>
									</p>
									<p>
										<font size="5">Topic with that ID is not existing.</font>
									</p> 
									</center>
									<?php header("refresh:5;url=index.php"); ?>
									<?php
					}
			}elseif($_POST['pid']){
					$getpid = $_POST['pid'];
					$select = mysqli_query($con, "SELECT * FROM `replies` WHERE `reply_id`='$getpid'");
					$row = mysqli_fetch_assoc($select);
					
					if(isset($_SESSION["loggedin"])) {
						$nick = $_SESSION["loggedin"];
						$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
					}
					
					$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
					$result = mysqli_query($checkacp,$sql);
					$rows = mysqli_fetch_array($result);
					
					$idcheck = $rows['id'];
					
					if(mysqli_num_rows($select)>0){
								?>
									<center>
									<p>
										<font size="6">Successfully deleted</font>
									</p>
									<p>
										<font size="5">You have successfully deleted that post.</font>
									</p> 
									</center>
									<?php	  
								header("refresh:5;url=index.php");
								$insertlog = mysqli_query($con, "INSERT INTO logs_gm (`logger`, `logger_id`, `logger_gmlevel`, `logdetails`, `logdate`) VALUES ('".$_SESSION['loggedin']."', '".$rows['id']."', '".$rowsgm['gmlevel']."', 'REPLY: User `".$nick."` deleted post (PID: ".$_POST['pid'].")', NOW());");
								mysqli_query($con, "DELETE FROM replies WHERE `reply_id`='$getpid'");
					}else{
							?>
									<center>
									<p>
										<font size="6">Something is wrong</font>
									</p>
									<p>
										<font size="5">Post with that ID is not existing.</font>
									</p> 
									</center>
									<?php header("refresh:5;url=index.php"); ?>
									<?php
					}
			}else{
				?>
					<center>
					<p>
						<font size="6">No action choosed</font>
					</p>
					<p>
						<font size="5">You have not selected an action.</font>
					</p> 
					</center>
				<?php header("refresh:5;url=index.php"); ?>
				<?php
			}
			?>
		</div>
	</div>
</div>
<div class="clear"></div>


            <div class="clear"></div>
        </div>
    </div>
    <div class="footer"></div>
	<div class="frame-corners bl"></div>
    <div class="frame-corners br"></div>
</div>

<div id="page-footer">
	Copyright ][ <?php echo $sitename; ?> ][ 2019. All Rights Reserved.
</div>


</body></html>