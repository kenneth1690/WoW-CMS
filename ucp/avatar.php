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
<title><?php echo $sitename; ?> | Account Panel</title>
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
                        <li><a href="/ucp/ucp.php" title="Account Panel">ACCOUNT PANEL</a></li>
                        <li><a href="/download.php" title="Download">DOWNLOAD</a></li>
						<li><a href="/forum/index.php" title="Forum">FORUM</a></li>
            <!--<li><a href="/information.php" title="Information">INFORMATION</a></li>-->
                        <li><a href="/logout.php" title="Logout">LOG OUT</a></li>
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
    <div id="wm-theme-navigation"><a href="javascript:;" data-background="1"></a><a href="javascript:;" data-background="0"></a></div>
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
		if(isset($_SESSION["loggedin"])) {
			$nick = $_SESSION["loggedin"];
			$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		}
		$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
		$result = mysqli_query($checkacp,$sql);
		$rows = mysqli_fetch_array($result);
		
		$idcheck = $rows['id'];
		$ipcheck = $rows['last_ip'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkacp,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		
		?><li><a href="/ucp/ucp.php" class="active"><i class="fas fa-user"></i> ACCOUNT</a></li>
		<li><a href="/ucp/characters.php"><i class="fas fa-users-cog"></i> CHARACTERS</a></li>
		<li><a href="/ucp/donate.php"><i class="fas fa-dollar-sign"></i> DONATE</a></li>
		<li><a href="/ucp/store.php"><i class="fas fa-shopping-cart"></i> STORE</a></li>
		<li><a href="/ucp/trade.php"><i class="fas fa-sync-alt"></i> TRADE</a></li>
		<li><a href="/ucp/support.php"><i class="fas fa-life-ring"></i> SUPPORT</a></li>
		<li><a href="/ucp/lottery.php"><i class="fas fa-ticket-alt"></i> LOTTERY</a></li>
		<li><a href="/ucp/settings.php"><i class="fas fa-cog"></i> SETTINGS</a></li>
		<?php
		$howmuchnotis = mysqli_query($conn, "SELECT * FROM notifications WHERE user = '".$idcheck."' AND readed = 0");
		$rowsnotis = mysqli_fetch_array($howmuchnotis);
		if(mysqli_num_rows($howmuchnotis)>0){
			?>
			<li><a href="/ucp/notifications.php"><i class="fas fa-bell"></i> <?php echo mysqli_num_rows($howmuchnotis); ?></a></li>
			<?php
		}else{
			?>
			<li><a href="/ucp/notifications.php"><i class="fas fa-bell"></i> 0</a></li>
			<?php
		}
		?>
		</ul>
		<ul>
		<?php
		if($rowsgm && $rowsgm['gmlevel']>0){ 
			?>
			<li><a href="/acp/acp.php"><i class="fas fa-user-secret"></i> ADMIN</a></li>
			<?php
		}
		mysqli_close($checkacp);
		?>
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
				$target_dir = "../uploads/avatars/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
				/*if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
						?>
						<center>
						<p><font size="6">Upload failed</font></p>
						<p>
							<font size="5">File is an image - <?php echo $check["mime"]; ?>.</font>
						</p> 
						</center>
						<?php
						header( "refresh:5;url=ucp.php" );
						$uploadOk = 1;
					} else {
						?>
						<center>
						<p><font size="6">Upload failed</font></p>
						<p>
							<font size="5">File is not an image.</font>
						</p> 
						</center>
						<?php
						header( "refresh:5;url=ucp.php" );
						$uploadOk = 0;
					}
				}*/
				// Check if file already exists
				/*f (file_exists($target_file)) {
						?>
						<center>
						<p><font size="6">Upload failed</font></p>
						<p>
							<font size="5">Sorry, file already exists.</font>
						</p> 
						</center>
						<?php
						header( "refresh:5;url=ucp.php" );
					$uploadOk = 0;
				}*/
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 500000) {
						?>
						<center>
						<p><font size="6">Upload failed</font></p>
						<p>
							<font size="5">Sorry, your file is too large.</font>
						</p> 
						</center>
						<?php
						header( "refresh:5;url=ucp.php" );
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						?>
						<center>
						<p><font size="6">Upload failed</font></p>
						<p>
							<font size="5">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</font>
						</p> 
						</center>
						<?php
						header( "refresh:5;url=ucp.php" );
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
						?>
						<center>
						<p><font size="6">Upload failed</font></p>
						<p>
							<font size="5">Sorry, your file was not uploaded.</font>
						</p> 
						</center>
						<?php
						header( "refresh:5;url=ucp.php" );
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						$link = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port); 
						
						$photoname = basename( $_FILES["fileToUpload"]["name"]);
						$session = $_SESSION["loggedin"];
						
						$sql = "UPDATE `account` SET `avatar`='$photoname' WHERE `username`='$session'";
						$qr = mysqli_query($link, $sql);
						
						$sql2= "SELECT * FROM account WHERE username = '" . $_SESSION["loggedin"] . "'";
						$result = mysqli_query($link,$sql2);
						$user = mysqli_fetch_array($result);
						
						$nick = $_SESSION["loggedin"];
						
						$av = basename( $_FILES["fileToUpload"]["name"]);
						
						$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
						$insertlog = mysqli_query($conn, "INSERT INTO logs_acc (`logger`, `logger_id`, `logdetails`, `logdate`) 
											  VALUES ('".$_SESSION['loggedin']."', '".$user['id']."', 'ACCOUNT: User `".$nick."` changed avatar (File: ".$av.")', NOW());");
						if ($insertlog) {
							header( "refresh:5;url=index.php" );
						}
						
						?>
						<center>
						<p><font size="6">Upload successful</font></p>
						<p>
							<font size="5">The file <?php echo basename( $_FILES["fileToUpload"]["name"]) ?> has been uploaded.</font>
						</p> 
						</center>
						<?php
						mysqli_close($link);
						header( "refresh:5;url=ucp.php" );
					} else {
						?>
						<center>
						<p><font size="6">Upload failed</font></p>
						<p>
							<font size="5">Sorry, there was an error uploading your file.</font>
						</p> 
						</center>
						<?php
						header( "refresh:5;url=ucp.php" );
					}
				}
				?>     
		</div>
	</div>
</div>

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