<?php
session_start();

include("check.php");
		include('../config/config.php');
		
		$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$qr1 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'sitename'");
		$qr2 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'siteonline'");
        $qr3 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'offlinemessage'");
        $qr4 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmname'");
        $qr5 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmip'");
        $qr6 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmport'");
        $qr7 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmlist'");
		
		while($row = mysqli_fetch_array($qr1)){
			$sitename = $row['conf_value'];
		}
		while($row = mysqli_fetch_array($qr2)){
			$siteonline = $row['conf_value'];
		}
        while($row = mysqli_fetch_array($qr3)){
			$offlinemessage = $row['conf_value'];
        }
        while($row = mysqli_fetch_array($qr4)){
			$realmname = $row['conf_value'];
        }
        while($row = mysqli_fetch_array($qr5)){
			$realmip = $row['conf_value'];
        }
        while($row = mysqli_fetch_array($qr6)){
			$realmport = $row['conf_value'];
        }
        while($row = mysqli_fetch_array($qr7)){
			$realmlist = $row['conf_value'];
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
<script async="" src="//www.google-analytics.com/analytics.js"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="/script/ui.js?v=56"></script>
<script src="/script/jquery.wm-listener.js"></script>
<script src="/script/warmane.js?v=57"></script>
<script src="/script/jquery.wm.bpopup.js"></script>
<script src="/script/jquery.wm-contextmenu.js"></script>
</head>
<body>
<noscript>
    &lt;div id="noscript-override"&gt;
        &lt;p&gt;This site makes extensive use of JavaScript.&lt;/b&gt;&lt;br&gt;Please &lt;a href="https://www.google.com/support/adsense/bin/answer.py?answer=12654" target="_blank"&gt;enable JavaScript&lt;/a&gt; in your browser.&lt;/p&gt;
    &lt;/div&gt;
</noscript>
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
		
		$cmssql2= "SELECT * FROM changelogs";
		$resultcms2 = mysqli_query($cmsconn,$cmssql2);
		$rowscms2 = mysqli_fetch_array($resultcms2);
		
		?><li><a href="/ucp/ucp.php">ACCOUNT PANEL</a></li>
</ul>
<ul>
        <?php
		if($rowsgm && $rowsgm['gmlevel']>0){ 
            if($rowsgm && $rowsgm['gmlevel']>1){ 
            ?>
            <li><a href="/acp/listnews.php">NEWS</a></li>  
            <li><a href="/acp/listchangelogs.php">CHANGELOGS</a></li>
            <li><a href="/acp/logs.php">LOGS</a></li>
            <li><a href="#" class="active">WEBSITE</a></li>
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
				if(isset($_GET['change'])){
					$change = htmlspecialchars($_GET['change']);
				}else{
					header("location: ../index.php");
				}
					
				if($change == 'sitename'){
					if(empty($_POST['sitename'])){
						?>		
							<center>
							<p><font size="6">Empty field</font></p>
							<p>
								<font size="5">Complete field and try again.</font>
							</p> 
							</center>
						<?php
					}else{
						mysqli_query($conn, 'UPDATE settings SET conf_value="'.$_POST['sitename'].'" WHERE conf_key="sitename"');
						?>		
							<center>
							<p><font size="6">Site name changed</font></p>
							<p>
								<font size="5">Site name has been changed successfully.</font>
							</p> 
							</center>
						<?php
					}
					header("refresh:5;url=website.php");
				}elseif($change == 'siteonline'){
					if($siteonline=='yes'){
						mysqli_query($conn, 'UPDATE settings SET conf_value="no" WHERE conf_key="siteonline"');
					}else{
						mysqli_query($conn, 'UPDATE settings SET conf_value="yes" WHERE conf_key="siteonline"');
					}
					?>		
						<center>
						<p><font size="6">Site status changed</font></p>
						<p>
							<font size="5">Site status has been changed successfully.</font>
						</p> 
						</center>
					<?php
					header("refresh:5;url=website.php");
				}elseif($change == 'offlinemessage'){
					if(empty($_POST['offlinemessage'])){
						?>		
							<center>
							<p><font size="6">Empty field</font></p>
							<p>
								<font size="5">Complete field and try again.</font>
							</p> 
							</center>
						<?php
					}else{
						mysqli_query($conn, 'UPDATE settings SET conf_value="'.$_POST['offlinemessage'].'" WHERE conf_key="offlinemessage"');
						?>		
							<center>
							<p><font size="6">Offline message changed</font></p>
							<p>
								<font size="5">Offline message has been changed successfully.</font>
							</p> 
							</center>
						<?php
					}
					header("refresh:5;url=website.php");
				}elseif($change == 'realmname'){
					if(empty($_POST['realmname'])){
						?>		
							<center>
							<p><font size="6">Empty field</font></p>
							<p>
								<font size="5">Complete field and try again.</font>
							</p> 
							</center>
						<?php
					}else{
						mysqli_query($conn, 'UPDATE settings SET conf_value="'.$_POST['realmname'].'" WHERE conf_key="realmname"');
						?>		
							<center>
							<p><font size="6">Realm name changed</font></p>
							<p>
								<font size="5">Realm name has been changed successfully.</font>
							</p> 
							</center>
						<?php
					}
					header("refresh:5;url=website.php");
				}elseif($change == 'realmip'){
					if(empty($_POST['realmip'])){
						?>		
							<center>
							<p><font size="6">Empty field</font></p>
							<p>
								<font size="5">Complete field and try again.</font>
							</p> 
							</center>
						<?php
					}else{
						mysqli_query($conn, 'UPDATE settings SET conf_value="'.$_POST['realmip'].'" WHERE conf_key="realmip"');
						?>		
							<center>
							<p><font size="6">Realm IP changed</font></p>
							<p>
								<font size="5">Realm IP has been changed successfully.</font>
							</p> 
							</center>
						<?php
					}
					header("refresh:5;url=website.php");
				}elseif($change == 'realmport'){
					if(empty($_POST['realmport'])){
						?>		
							<center>
							<p><font size="6">Empty field</font></p>
							<p>
								<font size="5">Complete field and try again.</font>
							</p> 
							</center>
						<?php
					}else{
						mysqli_query($conn, 'UPDATE settings SET conf_value="'.$_POST['realmport'].'" WHERE conf_key="realmport"');
						?>		
							<center>
							<p><font size="6">Realm port changed</font></p>
							<p>
								<font size="5">Realm port has been changed successfully.</font>
							</p> 
							</center>
						<?php
					}
					header("refresh:5;url=website.php");
				}elseif($change == 'realmlist'){
					if(empty($_POST['realmlist'])){
						?>		
							<center>
							<p><font size="6">Empty field</font></p>
							<p>
								<font size="5">Complete field and try again.</font>
							</p> 
							</center>
						<?php
					}else{
						mysqli_query($conn, 'UPDATE settings SET conf_value="'.$_POST['realmlist'].'" WHERE conf_key="realmlist"');
						?>		
							<center>
							<p><font size="6">Realmlist changed</font></p>
							<p>
								<font size="5">Realmlist has been changed successfully.</font>
							</p> 
							</center>
						<?php
					}
					header("refresh:5;url=website.php");
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
					<?php
					header("refresh:5;url=website.php");
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
	<a href="/policies/terms">Terms of Service</a> &nbsp; <a href="/policies/privacy">Privacy Policy</a> &nbsp; <a href="/policies/refund"> Refund Policy </a> &nbsp; <a href="#">Contact Us</a><br>
	Copyright ][ <?php echo $sitename; ?> ][ 2019. All Rights Reserved.
</div>


</body></html>