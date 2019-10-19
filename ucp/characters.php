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
		
		$ban= "SELECT * FROM account_banned WHERE id = '" . $idcheck . "' ORDER BY bandate DESC";
		$resultban = mysqli_query($checkacp,$ban);
		$rowsban = mysqli_fetch_array($resultban);
		
		$banip= "SELECT * FROM ip_banned WHERE ip = '" . $ipcheck . "' ORDER BY bandate DESC";
		$resultbanip = mysqli_query($checkacp,$banip);
		$rowsbanip = mysqli_fetch_array($resultbanip);
		
		$mute= "SELECT * FROM account_muted WHERE guid = '" . $idcheck . "'";
		$resultmute = mysqli_query($checkacp,$mute);
		$rowsmute = mysqli_fetch_array($resultmute);
		
		$bandate = date("F j, Y / H:i:s", $rowsban['bandate']);
		$unbandate = date("F j, Y / H:i:s", $rowsban['unbandate']);
		
		$getbantime = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
		$banipdate = date("F j, Y / H:i:s", $rowsbanip['bandate']);
		$unbanipdate = date("F j, Y / H:i:s", $rowsbanip['unbandate']);
		
		$mutedate = date("F j, Y / H:i:s", $rowsmute['mutedate']);
		
		$unixjoin = strtotime($rows['joindate']);
		$joindate = date("F j, Y", $unixjoin);
		
		$now = time();
		$your_date = strtotime($rows['last_login']);
		$datediff = $now - $your_date;
		$esttime = round($datediff / (60 * 60 * 24));
		
		
		?><li><a href="/ucp/ucp.php"><i class="fas fa-user"></i> ACCOUNT</a></li>
		<li><a href="/ucp/characters.php" class="active"><i class="fas fa-users-cog"></i> CHARACTERS</a></li>
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
			<li><a href="/acp/acp.php"><i class="fas fa-user-secret"></i> ADMIN PANEL</a></li>
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

<div id="content-wrapper">
<?php 
			if(isset($_GET['action'])){
				$action = htmlspecialchars($_GET['action']);
			}

			if($action == "details"){
				if(isset($_GET['id'])){
					$acid = $_GET['id'];
            		$conn = mysqli_connect($db_host, $db_username, $db_password, $chars_db_name, $db_port);
            		$nick = $_SESSION["loggedin"];
					$checkac = mysqli_query($conn, 'SELECT * FROM characters WHERE guid="'.$acid.'"');
					$checkownerres = mysqli_query($conn,"SELECT * FROM characters WHERE guid = '" . $acid . "'");
					$ownerchar = mysqli_fetch_array($checkownerres);

					$nick = $_SESSION["loggedin"];
					$checkauth = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
					$sql1 = "SELECT * FROM account WHERE username = '" . $nick . "'";
					$result1 = mysqli_query($checkauth,$sql1);
					$rows = mysqli_fetch_array($result1);
					
					$idcheck = $rows['id'];
					if($ownerchar['account']==$rows['id']){
						if(mysqli_num_rows($checkac)>0){
							?>
							<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: 450px;">
								<span>CHARACTERS LIST</span>
								<table>
									<tbody><tr>
										<td>&nbsp;</td>
									</tr>
									<?php
									$charconn = mysqli_connect($db_host, $db_username, $db_password, $chars_db_name, $db_port);
									$sql = "SELECT * FROM characters WHERE account = '" . $rows['id'] . "'";
									$result = $charconn->query($sql);
									while($charr = $result->fetch_assoc()) {
										?>
										<tr>
											<td>
											<?php
										if($charr['class']==1){
											?>
											<font color="C79C6E"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/warrior.gif">
											<?php
										}elseif($charr['class']==2){
											?>
											<font color="F58CBA"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/paladin.gif">
											<?php
										}elseif($charr['class']==3){
											?>
											<font color="ABD473"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/hunter.gif">
											<?php
										}elseif($charr['class']==4){
											?>
											<font color="FFF569"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/rogue.gif">
											<?php
										}elseif($charr['class']==5){
											?>
											<font color="FFFFFF"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/priest.gif">
											<?php
										}elseif($charr['class']==6){
											?>
											<font color="C41F3B"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/deathknight.gif">
											<?php
										}elseif($charr['class']==7){
											?>
											<font color="0070DE"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/shaman.gif">
											<?php
										}elseif($charr['class']==8){
											?>
											<font color="40C7EB"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/mage.gif">
											<?php
										}elseif($charr['class']==9){
											?>
											<font color="8787ED"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/warlock.gif">
											<?php
										}elseif($charr['class']==11){
											?>
											<font color="FF7D0A"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/druid.gif">
											<?php
										}else{
											?>
											Unknown
											<?php
										}
										?>
											<?php
											if($charr['guid']==$_GET['id']){
												?>
												<font color="white">(<a href="characters.php?action=details&id=<?php echo $charr['guid']; ?>"><font color="orange">Selected</font></a>)</font>
												<?php
											}else{
												?>
												<font color="white">(<a href="characters.php?action=details&id=<?php echo $charr['guid']; ?>"><font color="lightgreen">Select</font></a>)</font>
												<?php
											}
											?>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<?php
									}
									?>
								</tbody></table>
							</div>
							<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 450px;">
								<?php
								$checkchar2 = mysqli_connect($db_host, $db_username, $db_password, $chars_db_name, $db_port);
								$sql12 = "SELECT * FROM characters WHERE guid = '" . $acid. "'";
								$resultchar = mysqli_query($checkchar2,$sql12);
								$rowschar = mysqli_fetch_array($resultchar);

								$sql13 = "SELECT * FROM guild_member WHERE guid = '" . $acid. "'";
								$resultguild = mysqli_query($checkchar2,$sql13);
								$rowsguild = mysqli_fetch_array($resultguild);

								$money = $rowschar['money'];
								$gold = intval($money/10000);
								$money = intval($money%10000);
								$silver = intval($money/100);
								$copper = intval($money%100);
								?>
								<span>CHARACTER DETAILS</span>
								<table>
									<tbody><tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>Character ID: <font color="white"><?php echo $rowschar['guid']; ?></font></td>
									</tr>
									<tr>
										<td>Character name: <font color="white"><?php echo $rowschar['name']; ?></font></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>Level & XP: <font color="white"><?php echo $rowschar['level']; ?> (<?php echo $rowschar['xp']; ?> XP)</font>
										</td>
									</tr>
									<tr>
										<td>Money: <img src="/uploads/account/gold.png"> <font color="white"><?php echo $gold; ?></font> / <img src="/uploads/account/silver.png"> <font color="white"><?php echo $silver; ?></font> / <img src="/uploads/account/copper.png"> <font color="white"><?php echo $copper; ?></font>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>Race: <font color="white">
										<?php
										if($rowschar['race']==1){
											?>
											Human <img src="/uploads/account/human.gif">
											<?php
										}elseif($rowschar['race']==2){
											?>
											Orc <img src="/uploads/account/orc.gif">
											<?php
										}elseif($rowschar['race']==3){
											?>
											Dwarf <img src="/uploads/account/dwarf.gif">
											<?php
										}elseif($rowschar['race']==4){
											?>
											Night Elf <img src="/uploads/account/nightelf.gif">
											<?php
										}elseif($rowschar['race']==5){
											?>
											Undead <img src="/uploads/account/undead.gif">
											<?php
										}elseif($rowschar['race']==6){
											?>
											Tauren <img src="/uploads/account/tauren.gif">
											<?php
										}elseif($rowschar['race']==7){
											?>
											Gnome <img src="/uploads/account/gnome.gif">
											<?php
										}elseif($rowschar['race']==8){
											?>
											Troll <img src="/uploads/account/troll.gif">
											<?php
										}elseif($rowschar['race']==10){
											?>
											Blood Elf <img src="/uploads/account/bloodelf.gif">
											<?php
										}elseif($rowschar['race']==11){
											?>
											Draenei <img src="/uploads/account/draenei.gif">
											<?php
										}else{
											?>
											Unknown <img src="/uploads/account/unknown.gif">
											<?php
										}
										?>
										</font></td>
									</tr>
									<tr>
										<td>Class: <font color="white">
										<?php
										if($rowschar['class']==1){
											?>
											<font color="C79C6E">Warrior</font> <img src="/uploads/account/warrior.gif">
											<?php
										}elseif($rowschar['class']==2){
											?>
											<font color="F58CBA">Paladin</font> <img src="/uploads/account/paladin.gif">
											<?php
										}elseif($rowschar['class']==3){
											?>
											<font color="ABD473">Hunter</font> <img src="/uploads/account/hunter.gif">
											<?php
										}elseif($rowschar['class']==4){
											?>
											<font color="FFF569">Rogue</font> <img src="/uploads/account/rogue.gif">
											<?php
										}elseif($rowschar['class']==5){
											?>
											<font color="FFFFFF">Priest</font> <img src="/uploads/account/priest.gif">
											<?php
										}elseif($rowschar['class']==6){
											?>
											<font color="C41F3B">Death Knight</font> <img src="/uploads/account/deathknight.gif">
											<?php
										}elseif($rowschar['class']==7){
											?>
											<font color="0070DE">Shaman</font> <img src="/uploads/account/shaman.gif">
											<?php
										}elseif($rowschar['class']==8){
											?>
											<font color="40C7EB">Mage</font> <img src="/uploads/account/mage.gif">
											<?php
										}elseif($rowschar['class']==9){
											?>
											<font color="8787ED">Warlock</font> <img src="/uploads/account/warlock.gif">
											<?php
										}elseif($rowschar['class']==11){
											?>
											<font color="FF7D0A">Druid</font> <img src="/uploads/account/druid.gif">
											<?php
										}else{
											?>
											Unknown <img src="/uploads/account/unknown.gif">
											<?php
										}
										?>
										</font></td>
									</tr>
									<tr>
										<td>Gender: <font color="white">
										<?php
										if($rowschar['gender']==1){
											?>
											<font color="pink">Female</font> <img src="/uploads/account/female.gif">
											<?php
										}else{
											?>
											<font color="lightblue">Male</font> <img src="/uploads/account/male.gif">
											<?php
										}
										?>
										</font></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>Faction: 
										<?php
										if($rowschar['race']==1 || $rowschar['race']==3 || $rowschar['race']==4 || $rowschar['race']==7 || $rowschar['race']==11){
											?>
											<font color="blue">Alliance</font> <img src="/uploads/account/alliance.png">
											<?php
										}else{
											?>
											<font color="red">Horde</font> <img src="/uploads/account/horde.png">
											<?php
										}
										?>
										</td>
									</tr>
									<tr>
										<td>Guild: 
										<?php
										if(mysqli_num_rows($resultguild)>0){
											$sql14 = "SELECT * FROM guild_member WHERE guid = '" . $acid. "'";
											$ifguild = mysqli_query($checkchar2,$sql14);
											$checkguild = mysqli_fetch_array($ifguild);
											
											$guildidthen = $checkguild['guildid'];
											$sql15 = "SELECT * FROM guild WHERE guildid = '" . $guildidthen. "'";
											$ifshowguild = mysqli_query($checkchar2,$sql15);
											$showguild = mysqli_fetch_array($ifshowguild);
											?>
											<font color="white"><?php echo $showguild['name']; ?></font>
											<?php
										}else{
											?>
											<font color="white">None</font>
											<?php
										}
										?>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>Total playtime: 
										<?php
											$days = intval(intval($rowschar['totaltime']) / (3600*24));
											$hours = (intval($rowschar['totaltime']) / 3600) % 24;
											$minutes = (intval($rowschar['totaltime']) / 60) % 60;
										?>
										<div class="tooltip"><font color="white">Days: <?php echo $days; ?></font> / <font color="white">Hours: <?php echo $hours; ?></font> / <font color="white">Minutes: <?php echo $minutes; ?></font> <font color="1df701">(?)</font>
											<span class="tooltiptext"><font color="FFE4B5">TOTAL PLAYTIME</font><br><br>
											<font color="606060">The total time that the character has been active in the world.</font>
											</span>
										</div>
										</td>
									</tr>
									<?php
									$charid = $_GET['id'];
									$connt = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
									$checktrade = mysqli_query($connt, "SELECT * FROM trades WHERE selled='0' AND charid=$charid ORDER BY id DESC LIMIT 1");
									if(mysqli_num_rows($checktrade)>0){
									?>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>
										<a href='/ucp/managechar.php?action=cancel&charid=<?php echo $_GET['id']; ?>'>
											<input type='submit' value='CANCEL TRADE' class='wm-ui-btn'/>
										</a>
										</td>
									</tr>
									<?php
									}else{
									?>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>
										<a href='/ucp/managechar.php?action=sell&charid=<?php echo $_GET['id']; ?>'>
											<input type='submit' value='PUT ON TRADE' class='wm-ui-btn'/>
										</a>
										</td>
									</tr>
									<?php
									}
									?>
								</tbody></table>
							</div>
							<?php
						}else{
							?>
							<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
							<div id="wm-error-page">
							<center>
								<p>
									<font size="6">Invalid Character ID</font>
								</p>
								<p>
									<font size="5">Character with that ID not exists.</font>
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
								<font size="6">No character owned</font>
							</p>
							<p>
								<font size="5">That is not your character.</font>
							</p> 
						</center>
						</div>
					</div>
					<?php
					header("refresh:5;url=ucp.php");
					}
				}else{
						?>
					<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">No character selected</font>
							</p>
							<p>
								<font size="5">You have not selected a character ID.</font>
							</p> 
						</center>
						</div>
					</div>
					<?php
					header("refresh:5;url=ucp.php");
				}
			}else{
				?>
				<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: 450px;">
					<span>CHARACTERS LIST</span>
					<table>
						<tbody><tr>
							<td>&nbsp;</td>
						</tr>
						<?php
						$nick = $_SESSION["loggedin"];
						$checkauth = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
						$sql1 = "SELECT * FROM account WHERE username = '" . $nick . "'";
						$result1 = mysqli_query($checkauth,$sql1);
						$rows = mysqli_fetch_array($result1);
						
						$idcheck = $rows['id'];
						$charconn = mysqli_connect($db_host, $db_username, $db_password, $chars_db_name, $db_port);
						$sql = "SELECT * FROM characters WHERE account = '" . $rows['id'] . "'";
						$result = $charconn->query($sql);
						if(mysqli_num_rows($result)>0){
						while($charr = $result->fetch_assoc()) {
							?>
							<tr>
								<td><?php
										if($charr['class']==1){
											?>
											<font color="C79C6E"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/warrior.gif">
											<?php
										}elseif($charr['class']==2){
											?>
											<font color="F58CBA"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/paladin.gif">
											<?php
										}elseif($charr['class']==3){
											?>
											<font color="ABD473"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/hunter.gif">
											<?php
										}elseif($charr['class']==4){
											?>
											<font color="FFF569"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/rogue.gif">
											<?php
										}elseif($charr['class']==5){
											?>
											<font color="FFFFFF"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/priest.gif">
											<?php
										}elseif($charr['class']==6){
											?>
											<font color="C41F3B"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/deathknight.gif">
											<?php
										}elseif($charr['class']==7){
											?>
											<font color="0070DE"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/shaman.gif">
											<?php
										}elseif($charr['class']==8){
											?>
											<font color="40C7EB"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/mage.gif">
											<?php
										}elseif($charr['class']==9){
											?>
											<font color="8787ED"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/warlock.gif">
											<?php
										}elseif($charr['class']==11){
											?>
											<font color="FF7D0A"><?php echo $charr['name']; ?> </font> <img src="/uploads/account/druid.gif">
											<?php
										}else{
											?>
											Unknown
											<?php
										}
										?> <font color="white">(<a href="characters.php?action=details&id=<?php echo $charr['guid']; ?>"><font color="lightgreen">Select</font></a>)</font></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<?php
						}
						}else{
							?>
							<tr>
								<td>It looks like you have not any characters, don't you?</td>
							</tr>
							<?php
						}
						?>
					</tbody></table>
				</div>
				<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 450px;">
					<span>CHARACTER DETAILS</span>
					<table>
						<tbody><tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>First please select an character.</td>
						</tr>
					</tbody></table>
				</div>
				<?php
			}
			?>
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