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
		
		if(!$rowsgm || $rowsgm['gmlevel']==0 || $rowsgm['gmlevel']==1 || $rowsgm['gmlevel']==2){
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
						<li><a href="/armory/index.php" title="Armory">ARMORY</a></li>
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
		
		?><li><a href="/acp/acp.php"><i class="fas fa-user-secret"></i> ADMIN</a></li>
            <?php
		    if($rowsgm && $rowsgm['gmlevel']>0){ 
				?>
				<li><a href="/acp/manageaccs.php" class="active"><i class="fas fa-user-friends"></i> ACCOUNTS</a></li>
				<li><a href="/acp/support.php"><i class="fas fa-life-ring"></i> SUPPORT</a></li>
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
			    <li><a href="/ucp/ucp.php"><i class="fas fa-user"></i> ACCOUNT</a></li>
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
			if(isset($_GET['id'])){
				$acid = $_GET['id'];
            	$conn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
            	$nick = $_SESSION["loggedin"];
				$checkac = mysqli_query($conn, 'SELECT * FROM account WHERE id="'.$acid.'"');
                if(mysqli_num_rows($checkac)>0){
					if(empty($_POST['username'])){
						?>
						<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">Empty field</font>
							</p>
							<p>
								<font size="5">Field `username` cannot be empty.</font>
							</p> 
						</center>
						</div>
					</div>
						<?php
						header("refresh:5;url=acp.php");
					}elseif(!empty($_POST['gmlevel']) && $_POST['gmlevel']>3){
						?>
						<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">Invalid GM Level</font>
							</p>
							<p>
								<font size="5">Field `GM Level` cannot be more than 3.</font>
							</p> 
						</center>
						</div>
					</div>
						<?php
						header("refresh:5;url=acp.php");
					}elseif(!is_numeric($_POST['coins'])){
						?>
						<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">Empty field</font>
							</p>
							<p>
								<font size="5">Field `coins` cannot be empty.</font>
							</p> 
						</center>
						</div>
					</div>
						<?php
						header("refresh:5;url=acp.php");
					}elseif(!is_numeric($_POST['posts'])){
						?>
						<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">Empty field</font>
							</p>
							<p>
								<font size="5">Field `posts` cannot be empty.</font>
							</p> 
						</center>
						</div>
					</div>
						<?php
						header("refresh:5;url=acp.php");
					}elseif(!is_numeric($_POST['reputation'])){
						?>
						<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">Empty field</font>
							</p>
							<p>
								<font size="5">Field `reputation` cannot be empty.</font>
							</p> 
						</center>
						</div>
					</div>
						<?php
						header("refresh:5;url=acp.php");
					}elseif(empty($_POST['email'])){
						?>
						<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">Empty field</font>
							</p>
							<p>
								<font size="5">Field `email` cannot be empty.</font>
							</p> 
						</center>
						</div>
					</div>
						<?php
						header("refresh:5;url=acp.php");
					}elseif(empty($_POST['location'])){
						?>
						<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">Empty field</font>
							</p>
							<p>
								<font size="5">Field `location` cannot be empty.</font>
							</p> 
						</center>
						</div>
					</div>
						<?php
						header("refresh:5;url=acp.php");
					}else{
						$cmsconn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
						$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);

						$sqledit= "SELECT * FROM account WHERE id = '" . $acid . "'";
						$resultedit = mysqli_query($checkacp,$sqledit);
						$rowsedit = mysqli_fetch_array($resultedit);
						
						$editid = $rowsedit['id'];
						
						$gmedit= "SELECT * FROM account_access WHERE id = '" . $editid . "'";
						$resultgmedit = mysqli_query($checkacp,$gmedit);
						$rowsgmedit = mysqli_fetch_array($resultgmedit);
						
						if($idcheck==$editid){
							header("refresh:5;url=acp.php");
								?>
								<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
								<div id="wm-error-page">
								<center>
									<p>
										<font size="6">Editing failed</font>
									</p>
									<p>
										<font size="5">You cannot edit your own account.</font>
									</p> 
								</center>
								</div>
							</div>
								<?php
						}else{
							if($rowsgm['gmlevel']>$rowsgmedit['gmlevel']){
								header("refresh:5;url=acp.php");
								
								if(empty($_POST['gmlevel'])){
									$deletegm = mysqli_query($checkacp, "DELETE FROM `account_access` WHERE `id` = ".$editid."");
								}else{
									$checkgmexist = mysqli_query($checkacp,"SELECT * FROM account_access WHERE id = ".$editid."");
									if(mysqli_num_rows($checkgmexist)>0){
										$updategm = mysqli_query($checkacp,"UPDATE account_access SET gmlevel = ".$_POST['gmlevel']." WHERE id = ".$editid."");
									}else{
										$newgm = mysqli_query($checkacp, "INSERT INTO account_access (`id`, `gmlevel`, `RealmID`) VALUES ('".$editid."', '".$_POST['gmlevel']."', '-1')");	
									}
								}
								
								$updateuser = mysqli_query($checkacp,"UPDATE account SET username = '".$_POST['username']."', coins = '".$_POST['coins']."', posts = '".$_POST['posts']."', reputation = '".$_POST['reputation']."', location = '".$_POST['location']."' WHERE id = '".$editid."'");
								
								if($rowsedit['email']!=$_POST['email']){
									$updatemail = mysqli_query($checkacp,"UPDATE account SET email = '".$_POST['email']."', mailactivated = '0' WHERE id = '".$editid."'");
								}
								
								$insertlog = mysqli_query($cmsconn, "INSERT INTO logs_gm (`logger`, `logger_id`, `logger_gmlevel`, `logdetails`, `logdate`) 
									  VALUES ('".$_SESSION['loggedin']."', '".$rows['id']."', '".$rowsgm['gmlevel']."', 'MANAGER: User `".$nick."` edited user `".$rowsedit['username']."` (ID: ".$editid.")', NOW());");
								?>
								<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
								<div id="wm-error-page">
								<center>
									<p>
										<font size="6">Successfully edited</font>
									</p>
									<p>
										<font size="5">Account has been successfully edited.</font>
									</p> 
								</center>
								</div>
							</div>
								<?php
							}else{
								header("refresh:5;url=acp.php");
									?>
									<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
									<div id="wm-error-page">
									<center>
										<p>
											<font size="6">Editing failed</font>
										</p>
										<p>
											<font size="5">You're trying to edit GM who is higher or equal to you.</font>
										</p> 
									</center>
									</div>
								</div>
									<?php
							}
						}
					}
				}else{
						?>
						<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">Invalid Player ID</font>
							</p>
							<p>
								<font size="5">Player with that ID not exists.</font>
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