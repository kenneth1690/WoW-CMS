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
		
		if(!$rowsgm || $rowsgm['gmlevel']==0 || $rowsgm['gmlevel']==1){
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
<title><?php echo $sitename; ?> | Admin Panel</title>
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
			$cmsconn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		}
		$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
		$result = mysqli_query($checkacp,$sql);
		$rows = mysqli_fetch_array($result);
		
		$idcheck = $rows['id'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkacp,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		
		$cmssql= "SELECT * FROM news";
		$resultcms = mysqli_query($cmsconn,$cmssql);
		$rowscms = mysqli_fetch_array($resultcms);
		
		?><li><a href="/ucp/ucp.php">ACCOUNT PANEL</a></li>
        </ul>
        <ul>
            <?php
		    if($rowsgm && $rowsgm['gmlevel']>0){ 
				?>
				<li><a href="/acp/manageaccs.php">ACCOUNTS</a></li>
				<?php
                if($rowsgm && $rowsgm['gmlevel']>1){ 
                ?>
				<li><a href="/acp/listcontent.php?action=news" class="active">NEWS</a></li>  
                <li><a href="/acp/listcontent.php?action=changelogs">CHANGELOGS</a></li>
                <li><a href="/acp/logs.php">LOGS</a></li>
				<?php
				}
				if($rowsgm && $rowsgm['gmlevel']>2){ 
					?>
					<li><a href="/acp/website.php">WEBSITE</a></li>
					<?php
				}
			    ?>
			    <li><a href="/acp/acp.php">ADMIN PANEL</a></li>
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
				session_start();
					
					if(isset($_SESSION["loggedin"])) {
						$nick = $_SESSION["loggedin"];
						$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
						$cmsconn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
					}
					$title = $_POST['title'];
					$content = $_POST['content'];
					
					$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
					$result = mysqli_query($checkacp,$sql);
					$rows = mysqli_fetch_array($result);
					
					$idcheck = $rows['id'];
					
					$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
					$resultgm = mysqli_query($checkacp,$gm);
					$rowsgm = mysqli_fetch_array($resultgm);
					
					if(empty($title) || empty($content)){
						header("refresh:5;url=index.php");
						?>
						<center>
						<p><font size="6">Error when adding</font></p>
						<p>
							<font size="5">The 'title' and 'content' fields can not be empty.</font>
						</p> 
						</center>
						<?php
					}else{
						$cmssql= "INSERT INTO news (`title`, `content`, `author`, `date`) VALUES ('$title', '$content', '$nick', NOW())";
						$resultcms = mysqli_query($cmsconn,$cmssql);
						$insertlog = mysqli_query($cmsconn, "INSERT INTO logs_gm (`logger`, `logger_id`, `logger_gmlevel`, `logdetails`, `logdate`) 
									  VALUES ('".$_SESSION['loggedin']."', '".$rows['id']."', '".$rowsgm['gmlevel']."', 'NEWS: Added News', NOW());");
						header("refresh:5;url=index.php");
						?>
						<center>
						<p><font size="6">News added</font></p>
						<p>
							<font size="5">New news has been added to the database.</font>
						</p> 
						</center>
						<?php
					}
					
					mysqli_close($checkacp);
					mysqli_close($cmsconnn);
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
	<a href="/policies/terms">Terms of Service</a> &nbsp; <a href="/policies/privacy">Privacy Policy</a> &nbsp; <a href="/policies/refund"> Refund Policy </a> &nbsp; <a href="#">Contact Us</a><br>
	Copyright ][ <?php echo $sitename; ?> ][ 2019. All Rights Reserved.
</div>


</body></html>