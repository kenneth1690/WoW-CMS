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
		}
		$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
		$result = mysqli_query($checkacp,$sql);
		$rows = mysqli_fetch_array($result);
		
		$idcheck = $rows['id'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkacp,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		
		?><li><a href="/acp/acp.php"><i class="fas fa-user-secret"></i> ADMIN PANEL</a></li>
            <?php
		    if($rowsgm && $rowsgm['gmlevel']>0){ 
				?>
				<li><a href="/acp/manageaccs.php" class="active"><i class="fas fa-user-friends"></i> ACCOUNTS</a></li>
				<?php
                if($rowsgm && $rowsgm['gmlevel']>1){ 
                ?>
                <li><a href="/acp/listcontent.php?action=news"><i class="fas fa-newspaper"></i> NEWS</a></li>  
                <li><a href="/acp/listcontent.php?action=changelogs"><i class="fas fa-exclamation-circle"></i> CHANGELOGS</a></li>
                <li><a href="/acp/logs.php"><i class="fas fa-clipboard-list"></i> LOGS</a></li>
                <?php
				}
				if($rowsgm && $rowsgm['gmlevel']>2){ 
					?>
					<li><a href="/acp/website.php"><i class="fas fa-cogs"></i> WEBSITE</a></li>
					<?php
				}
			    ?>
				</ul>
				<ul>
			    <li><a href="/ucp/ucp.php"><i class="fas fa-user"></i> ACCOUNT PANEL</a></li>
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
			<?php 
			if(isset($_GET['action'])){
				$action = htmlspecialchars($_GET['action']);
			}else{
                if(isset($_GET['id'])){
                        $conn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
                        $acid = $_GET['id'];
                        $checkac = mysqli_query($conn, 'SELECT * FROM account WHERE id="'.$acid.'"');
                        if(mysqli_num_rows($checkac)>0){
                            $checkmute = mysqli_query($conn, 'SELECT * FROM account_muted WHERE guid="'.$acid.'"');
							
								$cmscon = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
							
								$sqla= "SELECT * FROM account WHERE id = '" . $acid . "'";
								$resulta = mysqli_query($conn,$sqla);
								$rowa = mysqli_fetch_array($resulta);
								
								$nickbanned = $rowa['username'];
								
                            if($checkmute && mysqli_num_rows($checkmute)==0){
                                ?>
                                <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
                                <div id="wm-error-page">
                                <center>
                                    <p>
                                        <font size="6">Player in good standing</font>
                                    </p>
                                    <p>
                                        <font size="5">You wanted to unmute player who is not muted.</font>
                                    </p> 
                                </center>
                                </div>
                                </div>
                                <?php
                                header("refresh:5;url=acp.php");
                            }else{
                                mysqli_query($conn, 'DELETE FROM account_muted WHERE guid="'.$acid.'"');
                                        $insertlog = mysqli_query($cmscon, "INSERT INTO logs_gm (`logger`, `logger_id`, `logger_gmlevel`, `logdetails`, `logdate`) 
										VALUES ('".$_SESSION['loggedin']."', '".$idcheck."', '".$rowsgm['gmlevel']."', 'MANAGER: User `".$nickbanned."` has been unmuted (ID: ".$acid.")', NOW());");
										?>
                                        <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
                                        <div id="wm-error-page">
                                        <center>
                                            <p>
                                                <font size="6">Unmuted successfully</font>
                                            </p>
                                            <p>
                                                <font size="5">Player has been unmuted successfully.</font>
                                            </p> 
                                        </center>
                                        </div>
                                        </div>
                                        <?php
                                        header("refresh:5;url=acp.php");
                            }
                        }else{
                            ?>
                            <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
                            <div id="wm-error-page">
                            <center>
                                <p>
                                    <font size="6">No player</font>
                                </p>
                                <p>
                                    <font size="5">Player with that ID is not exist.</font>
                                </p> 
                            </center>
                            </div>
                            </div>
                            <?php
                            header("refresh:5;url=acp.php");
                        }
                }else{
                    ?>
                    <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">No player selected</font>
							</p>
							<p>
								<font size="5">You have not selected a player ID.</font>
							</p> 
						</center>
						</div>
					</div>
					<?php
					header("refresh:5;url=acp.php");
                }
            }
			?>
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