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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet"/>
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
			if(isset($_GET['id'])){
				if(isset($_GET['id'])){
					$acid = $_GET['id'];
            		$conn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
            		$nick = $_SESSION["loggedin"];
					$checkac = mysqli_query($conn, 'SELECT * FROM account WHERE id="'.$acid.'"');
                	if(mysqli_num_rows($checkac)>0){
						$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);

						$sql= "SELECT * FROM account WHERE id = '" . $acid . "'";
						$result = mysqli_query($checkacp,$sql);
						$rows = mysqli_fetch_array($result);
						
						$idcheck = $rows['id'];
						$ipcheck = $rows['last_ip'];
						
						$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
						$resultgm = mysqli_query($checkacp,$gm);
						$rowsgm = mysqli_fetch_array($resultgm);
						
						?>
						<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: 450px;">
						<form action='/acp/edituser.php?id=<?php echo $rows['id']; ?>' method='POST'>
						<span>ACCOUNT EDITOR</span>
						<table>
						<tbody><tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Player editing 
							<?php
							if($rows['posts']>=0 && $rows['posts']<50){
								?>
								<font color="ffffff"><?php echo $rows['username']; ?></font>
								<?php
							}elseif($rows['posts']>=50 && $rows['posts']<100){
								?>
								<font color="#1df701"><?php echo $rows['username']; ?></font>
								<?php
							}elseif($rows['posts']>=100 && $rows['posts']<250){
								?>
								<font color="006dd7"><?php echo $rows['username']; ?></font>
								<?php
							}elseif($rows['posts']>=250 && $rows['posts']<500){
								?>
								<font color="9e34e7"><?php echo $rows['username']; ?></font>
								<?php
							}elseif($rows['posts']>=500){
								?>
								<font color="f57b01"><?php echo $rows['username']; ?></font>
								<?php
							}
							if($rowsgm['gmlevel']==1){
								?>
								<font color="00ba0d">*Moderator*</font>
								<?php
							}elseif($rowsgm['gmlevel']==2){
								?>
								<font color="cf7c00">*Administrator*</font>
								<?php
							}elseif($rowsgm['gmlevel']==3){
								?>
								<font color="c70000">*Head Admin*</font>
								<?php
							}elseif($rowsgm['gmlevel']==4){
								?>
								<font color="9000b8">*Owner*</font>
								<?php
							}else{
								?>
								<font color="ffffff">*Player*</font>
								<?php
							}
							?>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>
								<p>Username: </p>
								<input type='text' id='username' name='username' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border' value='<?php echo $rows['username']; ?>'/><br /><br>
							</td>
						</tr>
						<tr>
							<td>
								<p>GM Level (1-4, empty for none): </p>
								<input type='text' id='gmlevel' name='gmlevel' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border' value='<?php echo $rowsgm['gmlevel']; ?>'/><br /><br>
							</td>
						</tr>
						<tr>
							<td>
								<p>Coins: </p>
								<input type='text' id='coins' name='coins' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border' value='<?php echo $rows['coins']; ?>'/><br /><br>
							</td>
						</tr>
						<tr>
							<td>
								<p>Posts: </p>
								<input type='text' id='posts' name='posts' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border' value='<?php echo $rows['posts']; ?>'/><br /><br>
							</td>
						</tr>
					</tbody></table>
						</div>
						<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 450px;">
						<span>ACCOUNT EDITOR</span>
						<table>
						<tbody><tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>
								<p>Email address: </p>
								<input type='text' id='email' name='email' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border' value='<?php echo $rows['email']; ?>'/><br /><br>
							</td>
						</tr>
						<tr>
							<td>
								<p>Location: </p>
								<input type='text' id='location' name='location' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border' value='<?php echo $rows['location']; ?>'/><br /><br>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>
								<input type='submit' value='EDIT ACCOUNT' class='wm-ui-btn'/>
							</td>
						</tr>
					</tbody></table>
						</form>
						</div>
						<?php
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