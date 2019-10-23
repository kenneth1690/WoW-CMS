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
					<li><a href="<?php echo "/forum/topics/".$_GET['cid']."/".$_GET['scid'].""; ?>" class="active"><?php echo $row2['category_title']; ?></a></li>
            		<li>></li>
					<li><a href="<?php echo "/forum/topics/".$_GET['cid']."/".$_GET['scid'].""; ?>" class="active"><?php echo $row['subcategory_title']; ?></a></li>
					<li>></li>
					<li><a href="#" class="active">New Topic</a></li>
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
					$getscid = $_GET['scid'];
					$select = mysqli_query($con, "SELECT * FROM `subcategories` WHERE `subcat_id`='$getscid'");
					$row = mysqli_fetch_assoc($select);
					
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
					
					if (isset($_SESSION['loggedin'])) {
						if($row['special']>0){
							if($rowsgm['gmlevel']>0){
								echo "<form action='/forum/addnewtopic.php?cid=".$_GET['cid']."&scid=".$_GET['scid']."'
								  method='POST'>
								  <p>Title: </p>
								  <input type='text' id='topic' name='topic' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/>
								  <p>Content (HTML supported): </p>
								  <textarea id='content' name='content' rows='14' cols='80' class='wm-ui-input-generic input-lg2 wm-ui-generic-frame wm-ui-all-border'></textarea><br /><br>
								  <input type='submit' value='CREATE' class='wm-ui-btn'/></form>";
								echo "Category only for GM's, but you still have permission to create topic.";
							}else{
								echo "Category only for GM's, you can not create topic.";
							}
						}else{
							echo "<form action='/forum/addnewtopic.php?cid=".$_GET['cid']."&scid=".$_GET['scid']."'
								  method='POST'>
								  <p>Title: </p>
								  <input type='text' id='topic' name='topic' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/>
								  <p>Content (HTML supported): </p>
								  <textarea id='content' name='content' rows='14' cols='80' class='wm-ui-input-generic input-lg2 wm-ui-generic-frame wm-ui-all-border'></textarea><br /><br>
								  <input type='submit' value='CREATE' class='wm-ui-btn'/></form>";
						}
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