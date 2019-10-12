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
			if(isset($_GET['action'])){
				$action = htmlspecialchars($_GET['action']);
			}

			if($action == "details"){
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
						
						$ban= "SELECT * FROM account_banned WHERE id = '" . $idcheck . "' ORDER BY bandate DESC";
						$resultban = mysqli_query($checkacp,$ban);
						$rowsban = mysqli_fetch_array($resultban);
						
						$banip= "SELECT * FROM ip_banned WHERE ip = '" . $ipcheck . "' ORDER BY bandate DESC";
						$resultbanip = mysqli_query($checkacp,$banip);
						$rowsbanip = mysqli_fetch_array($resultbanip);
						
						$mute= "SELECT * FROM account_muted WHERE guid = '" . $idcheck . "' ORDER BY mutedate DESC LIMIT 1";
						$resultmute = mysqli_query($checkacp,$mute);
						$rowsmute = mysqli_fetch_array($resultmute);
						
						$bandate = date("F j, Y / H:i:s", $rowsban['bandate']);
						$unbandate = date("F j, Y / H:i:s", $rowsban['unbandate']);
						
						$getbantime = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
						$banipdate = date("F j, Y / H:i:s", $rowsbanip['bandate']);
						$unbanipdate = date("F j, Y / H:i:s", $rowsbanip['unbandate']);
						
						$mutedate = date("F j, Y / H:i:s", $rowsmute['mutedate']);
						$finalmutedate = date("F j, Y / H:i:s", ($rowsmute['mutedate']+$rowsmute['mutetime']));

						$mutedhowmuch = $rowsmute['mutedate']+$rowsmute['mutetime'];
						
						$unixjoin = strtotime($rows['joindate']);
						$joindate = date("F j, Y", $unixjoin);
						
						$now = time();
						$your_date = strtotime($rows['last_login']);
						$datediff = $now - $your_date;
						$esttime = round($datediff / (60 * 60 * 24));
						?>
						<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: 300px;">
						<span>ACCOUNT SUMMARY</span>
						<table>
						<tbody><tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Player searched 
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
							<td>Coins: <font color="gold"><?php echo $rows['coins']; ?></font>
							</td>
						</tr>
						<tr>
							<td>Posts: <font color="ffffff"><?php echo $rows['posts']; ?></font></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Email address: <div class="tooltip"><font color="ffffff"><?php echo $rows['email']; ?></font> 
								<?php
								if($rows['mailactivated']==1){
									?>
									<font color="1df701">*Activated*</font>
									<?php
								}else{
									?>
									<font color="red">*Not activated*</font>
									<?php
								}
								?>
								<span class="tooltiptext"><font color="FFE4B5">EMAIL STATUS</font><br><br>
								<font color="606060">
								<?php
								if($rows['mailactivated']==1){
									?>
									Everything is okay, email address of this user is activated.
									<?php
								}else{
									?>
									Email address of this user is not activated yet.
									<?php
								}
								?>
								</font>
								</span>
							</div>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Avatar:<br><img src="/uploads/avatars/<?php echo $rows['avatar']; ?>" width="100px" height="100px">
						</td>
						</tr>
					</tbody></table>
						</div>
						<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 300px;">
						<span>ACCOUNT DETAILS</span>
						<table>
						<tbody><tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Account status: 
							<?php
							if((($rowsban && ($rowsban['active']=='1')) || ($resultbanip && $rowsbanip['unbandate'])) && !($resultmute && $rowsmute['mutedate'])){ 
							?>
							<div class="tooltip"><span class="q1"><font color="f57b01">Banned</font> <font color="red">(?)</font>
								<span class="tooltiptext"><font color="FFE4B5">ACCOUNT STATUS</font><br><br><font color="9e34e7">Muted:</font> <font color="1df701">no</font><br>
								<?php
								if($resultbanip && $rowsbanip['unbandate']){
									if($rowsbanip['bandate'] == $rowsbanip['unbandate']){
										?>
										<font color="f57b01">Banned:</font> <font color="red">yes (address IP)</font><br>
										<font color="f57b01">*Reason:</font> <font color="red"><?php echo $rowsbanip['banreason']; ?></font><br>
										<font color="f57b01">*Date:</font> <font color="red"><?php echo $banipdate; ?></font><br>
										<font color="f57b01">*Expires:</font> <font color="red">never</font><br>
										<font color="f57b01">*Banned by:</font> <font color="red"><?php echo $rowsbanip['bannedby']; ?></font>
										<?php
									}else{
										?>
										<font color="f57b01">Banned:</font> <font color="red">yes (address IP)</font><br>
										<font color="f57b01">*Reason:</font> <font color="red"><?php echo $rowsbanip['banreason']; ?></font><br>
										<font color="f57b01">*Date:</font> <font color="red"><?php echo $banipdate; ?></font><br>
										<font color="f57b01">*Expires:</font> <font color="red"><?php echo $unbanipdate; ?></font><br>
										<font color="f57b01">*Banned by:</font> <font color="red"><?php echo $rowsbanip['bannedby']; ?></font>
									<?php
									}
								}elseif(($resultban && ($rowsban['active']=='1')) && !($resultbanip && ($rowsbanip['unbandate']>=$getbantime))){
									if($rowsban['bandate'] == $rowsban['unbandate']){
										?>
										<font color="f57b01">Banned:</font> <font color="red">yes (account)</font><br>
										<font color="f57b01">*Reason:</font> <font color="red"><?php echo $rowsban['banreason']; ?></font><br>
										<font color="f57b01">*Date:</font> <font color="red"><?php echo $bandate; ?></font><br>
										<font color="f57b01">*Expires:</font> <font color="red">never</font><br>
										<font color="f57b01">*Banned by:</font> <font color="red"><?php echo $rowsban['bannedby']; ?></font>
										<?php
									}else{
										?>
										<font color="f57b01">Banned:</font> <font color="red">yes (account)</font><br>
										<font color="f57b01">*Reason:</font> <font color="red"><?php echo $rowsban['banreason']; ?></font><br>
										<font color="f57b01">*Date:</font> <font color="red"><?php echo $bandate; ?></font><br>
										<font color="f57b01">*Expires:</font> <font color="red"><?php echo $unbandate; ?></font><br>
										<font color="f57b01">*Banned by:</font> <font color="red"><?php echo $rowsban['bannedby']; ?></font>
									<?php
									}
								}
								?>
								</span>
							</div>
							<font color="white">(</font><a href="unban.php?id=<?php echo $acid; ?>"><font color="lightgreen">Unban</font></a><font color="white">/</font><a href="mute.php?id=<?php echo $acid; ?>"><font color="orange">Mute</font></a><font color="white">)</font>
							<?php
							}elseif(($resultmute && $mutedhowmuch>time()) && !(($rowsban && ($rowsban['active']=='1')) || ($resultbanip && $rowsbanip['unbandate']))){
							?>
							<div class="tooltip"><span class="q1"><font color="9e34e7">Muted</font> <font color="red">(?)</font>
								<span class="tooltiptext"><font color="FFE4B5">ACCOUNT STATUS</font><br><br><font color="9e34e7">Muted:</font> <font color="red">yes</font><br>
								<font color="9e34e7">*Reason:</font> <font color="red"><?php echo $rowsmute['mutereason']; ?></font><br>
								<?php
								if($rowsmute['mutetime']=='0'){
									?>
									<font color="9e34e7">*Date:</font> <font color="red"><?php echo $mutedate; ?></font><br>
									<font color="9e34e7">*Expires:</font> <font color="red">never</font><br>
									<?php
								}else{
									?>
								<font color="9e34e7">*Date:</font> <font color="red"><?php echo $mutedate; ?></font><br>
								<font color="9e34e7">*Expires:</font> <font color="red"><?php echo $finalmutedate; ?></font><br>
								<?php
								}
								?>
								<font color="9e34e7">*Muted by:</font> <font color="red"><?php echo $rowsmute['mutedby']; ?></font><br>
								<font color="f57b01">Banned:</font> <font color="1df701">no</font>
								</span>
							</div>
							<font color="white">(</font><a href="ban.php?id=<?php echo $acid; ?>"><font color="orange">Ban</font></a><font color="white">/</font><a href="unmute.php?id=<?php echo $acid; ?>"><font color="lightgreen">Unmute</font></a><font color="white">)</font>
							<?php
							}elseif(($resultmute && $mutedhowmuch>time()) && (($resultban && ($rowsban['active']=='1')) || ($resultbanip && $rowsbanip['unbandate']))){
							?>
							<div class="tooltip"><font color="9e34e7">Muted</font> <font color="white">&</font> <font color="f57b01">Banned</font> <font color="red">(?)</font>
								<span class="tooltiptext"><font color="FFE4B5">ACCOUNT STATUS</font><br><br><font color="9e34e7">Muted:</font> <font color="red">yes</font><br>
								<font color="9e34e7">*Reason:</font> <font color="red"><?php echo $rowsmute['mutereason']; ?></font><br>
								<?php
								if($rowsmute['mutetime']=='0'){
									?>
									<font color="9e34e7">*Date:</font> <font color="red"><?php echo $mutedate; ?></font><br>
									<font color="9e34e7">*Expires:</font> <font color="red">never</font><br>
									<?php
								}else{
									?>
								<font color="9e34e7">*Date:</font> <font color="red"><?php echo $mutedate; ?></font><br>
								<font color="9e34e7">*Expires:</font> <font color="red"><?php echo $finalmutedate; ?></font><br>
								<?php
								}
								?>
								<font color="9e34e7">*Muted by:</font> <font color="red"><?php echo $rowsmute['mutedby']; ?></font><br>
								<?php
								if($resultbanip && $rowsbanip['unbandate']){
									if($rowsbanip['bandate'] == $rowsbanip['unbandate']){
										?>
										<font color="f57b01">Banned:</font> <font color="red">yes (address IP)</font><br>
										<font color="f57b01">*Reason:</font> <font color="red"><?php echo $rowsbanip['banreason']; ?></font><br>
										<font color="f57b01">*Date:</font> <font color="red"><?php echo $banipdate; ?></font><br>
										<font color="f57b01">*Expires:</font> <font color="red">never</font><br>
										<font color="f57b01">*Banned by:</font> <font color="red"><?php echo $rowsbanip['bannedby']; ?></font>
										<?php
									}else{
										?>
										<font color="f57b01">Banned:</font> <font color="red">yes (address IP)</font><br>
										<font color="f57b01">*Reason:</font> <font color="red"><?php echo $rowsbanip['banreason']; ?></font><br>
										<font color="f57b01">*Date:</font> <font color="red"><?php echo $banipdate; ?></font><br>
										<font color="f57b01">*Expires:</font> <font color="red"><?php echo $unbanipdate; ?></font><br>
										<font color="f57b01">*Banned by:</font> <font color="red"><?php echo $rowsbanip['bannedby']; ?></font>
									<?php
									}
								}elseif(($resultban && ($rowsban['active']=='1')) && !($resultbanip && ($rowsbanip['unbandate']>=$getbantime))){
									if($rowsban['bandate'] == $rowsban['unbandate']){
										?>
										<font color="f57b01">Banned:</font> <font color="red">yes (account)</font><br>
										<font color="f57b01">*Reason:</font> <font color="red"><?php echo $rowsban['banreason']; ?></font><br>
										<font color="f57b01">*Date:</font> <font color="red"><?php echo $bandate; ?></font><br>
										<font color="f57b01">*Expires:</font> <font color="red">never</font><br>
										<font color="f57b01">*Banned by:</font> <font color="red"><?php echo $rowsban['bannedby']; ?></font>
										<?php
									}else{
										?>
										<font color="f57b01">Banned:</font> <font color="red">yes (account)</font><br>
										<font color="f57b01">*Reason:</font> <font color="red"><?php echo $rowsban['banreason']; ?></font><br>
										<font color="f57b01">*Date:</font> <font color="red"><?php echo $bandate; ?></font><br>
										<font color="f57b01">*Expires:</font> <font color="red"><?php echo $unbandate; ?></font><br>
										<font color="f57b01">*Banned by:</font> <font color="red"><?php echo $rowsban['bannedby']; ?></font>
									<?php
									}
								}
								?>
							</div>
							<font color="white">(</font><a href="unban.php?id=<?php echo $acid; ?>"><font color="lightgreen">Unban</font></a><font color="white">/</font><a href="unmute.php?id=<?php echo $acid; ?>"><font color="lightgreen">Unmute</font></a><font color="white">)</font>
							<?php
							}else{
							?>
							<div class="tooltip"><font color="white">In good standing</font> <font color="1df701">(?)</font>
								<span class="tooltiptext"><font color="FFE4B5">ACCOUNT STATUS</font><br><br><font color="9e34e7">Muted:</font> <font color="1df701">no</font><br><font color="f57b01">Banned:</font> <font color="1df701">no</font></span>
							</div>
							<font color="white">(</font><a href="ban.php?id=<?php echo $acid; ?>"><font color="orange">Ban</font></a><font color="white">/</font><a href="mute.php?id=<?php echo $acid; ?>"><font color="orange">Mute</font></a><font color="white">)</font>
							<?php
							}
							?>
							</td>
						</tr>
						<?php
						/*if($rowsgm){ 
						?>
						<tr>
							<td>GM Level: <span><?php echo $rowsgm['gmlevel']; ?></span></td>
						</tr>
						<?php
						}*/
						?>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Join date: <?php echo $joindate; ?></td>
						</tr>
						<tr>
							<td>Last seen (in-game): <?php 
							if($esttime==0){ 
								?>Today from <?php echo $rows['last_ip'];
							}elseif($esttime==1){
								?>Yesterday from <?php echo $rows['last_ip'];
							}elseif($esttime>18080){
								?>Never<?php
							}else{
								echo $esttime;
								?> days ago from <?php echo $rows['last_ip'];
							}
							?>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Community rank: <div class="tooltip">
							<?php
							if($rows['posts']>=0 && $rows['posts']<50){
								?>
								<font color="ffffff">Newbie</font> <font color="1df701">(?)</font>
								<?php
							}elseif($rows['posts']>=50 && $rows['posts']<100){
								?>
								<font color="#1df701">Expert</font> <font color="1df701">(?)</font>
								<?php
							}elseif($rows['posts']>=100 && $rows['posts']<250){
								?>
								<font color="006dd7">Elite</font> <font color="1df701">(?)</font>
								<?php
							}elseif($rows['posts']>=250 && $rows['posts']<500){
								?>
								<font color="9e34e7">Legend</font> <font color="1df701">(?)</font>
								<?php
							}elseif($rows['posts']>=500){
								?>
								<font color="f57b01">Senior</font> <font color="1df701">(?)</font>
								<?php
							}
							?>
								<span class="tooltiptext"><font color="FFE4B5">COMMUNITY RANK</font><br><br>
								<font color="ffffff">Newbie</font> <font color="606060">0-49</font><br>
								<font color="1df701">Expert</font> <font color="606060">50-99</font><br>
								<font color="006dd7">Elite</font> <font color="606060">100-249</font><br>
								<font color="9e34e7">Legend</font> <font color="606060">250-499</font><br>
								<font color="f57b01">Senior</font> <font color="606060">500+</font>
								</span>
							</div>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Location: <font color="ffffff">
							<?php
							$getlocation = $rows['location'];
							echo $getlocation;
							?> 
							</font>
							</td>
						</tr>
					</tbody></table>
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
				$conn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
				?>
				<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
					<div id="wm-error-page">
						<center>
							<font size='5'><b>Search for account by username or ID:</b></font><br><br>
								<?php
								$result = mysqli_query($conn, "SELECT * FROM account");
								?>
								<select id='searchlive'>
									<option>Search for account..</option>
									<?php
									while($row = mysqli_fetch_array($result)){
										?>
										<option value="manageaccs.php?action=details&id=<?php echo $row['id']; ?>"><?php echo $row['username']; ?> (ID: <?php echo $row['id']; ?>)</option>
										<?php
									}
									?>
								</select>
							</center>
						</div>
					</div>
				<?php
				mysqli_close($conn);
			}
			?>
</div>
<div class="clear"></div>
<script>
    $(function(){
      $('#searchlive').on('change', function () {
          var url = $(this).val();
          if (url) {
              window.location = url;
          }
          return false;
      });
    });
</script>
<script>
	$("#searchlive").chosen();
</script>


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