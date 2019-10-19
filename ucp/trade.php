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
<style>
#categories {
  border-collapse: collapse;
  width: 738px;
}

#categories td, #categories th {
  border: 1px solid #ddd;
  background: #0f0f0f none repeat-x left;
  color: #c1b575;
    border-bottom: 1px solid #1e1e1e;
    border-left: 1px solid transparent;
    border-right: 1px solid transparent;
  padding: 10px;
  font-size: 15px;
}

#categories tr:nth-child(even){background-color: #f2f2f2;}

#categories tr:hover {background-color: #ddd;}

#categories th {
	word-break: break-all;
  padding-top: 6.5px;
  padding-bottom: 6.5px;
  text-align: left;
  background-color: #131313;
  color: #505050;
  box-shadow: -2px 2px 2px transparent;
  border-top-right-radius: 0px;
	border-top-left-radius: 0px;
	border-left: 1px solid transparent;
	border-right: 1px solid transparent;
    border: 1px solid #1e1e1e;
	font-size: 15px;
	vertical-align: text-top;
}

</style>
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
		<li><a href="/ucp/characters.php"><i class="fas fa-users-cog"></i> CHARACTERS</a></li>
		<li><a href="/ucp/donate.php"><i class="fas fa-dollar-sign"></i> DONATE</a></li>
		<li><a href="/ucp/store.php"><i class="fas fa-shopping-cart"></i> STORE</a></li>
		<li><a href="/ucp/trade.php" class="active"><i class="fas fa-sync-alt"></i> TRADE</a></li>
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

			if($action == "showtrades"){
				if(isset($_GET['class'])){
					$acid = $_GET['class'];
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
						if($acid==1 || $acid==2 || $acid==3 || $acid==4 || $acid==5 || $acid==6 || $acid==7 || $acid==8 || $acid==9 || $acid==11){
							?>
							<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: 350px; width: 250px;">
								<span>AVAILABLE CLASSES</span>
								<table>
									<tbody><tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>
											<font color="C79C6E">Warrior</font> <img src="/uploads/account/warrior.gif"> 
											<?php
											if($acid==1){
												?>
												(<a href="trade.php?action=showtrades&class=1"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=1"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="F58CBA">Paladin</font> <img src="/uploads/account/paladin.gif"> 
											<?php
											if($acid==2){
												?>
												(<a href="trade.php?action=showtrades&class=2"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=2"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="ABD473">Hunter</font> <img src="/uploads/account/hunter.gif"> 
											<?php
											if($acid==3){
												?>
												(<a href="trade.php?action=showtrades&class=3"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=3"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="FFF569">Rogue</font> <img src="/uploads/account/rogue.gif"> 
											<?php
											if($acid==4){
												?>
												(<a href="trade.php?action=showtrades&class=4"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=4"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="FFFFFF">Priest</font> <img src="/uploads/account/priest.gif"> 
											<?php
											if($acid==5){
												?>
												(<a href="trade.php?action=showtrades&class=5"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=5"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="C41F3B">Death Knight</font> <img src="/uploads/account/deathknight.gif"> 
											<?php
											if($acid==6){
												?>
												(<a href="trade.php?action=showtrades&class=6"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=6"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="0070DE">Shaman</font> <img src="/uploads/account/shaman.gif"> 
											<?php
											if($acid==7){
												?>
												(<a href="trade.php?action=showtrades&class=7"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=7"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="40C7EB">Mage</font> <img src="/uploads/account/mage.gif"> 
											<?php
											if($acid==8){
												?>
												(<a href="trade.php?action=showtrades&class=8"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=8"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="8787ED">Warlock</font> <img src="/uploads/account/warlock.gif"> 
											<?php
											if($acid==9){
												?>
												(<a href="trade.php?action=showtrades&class=9"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=9"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="FF7D0A">Druid</font> <img src="/uploads/account/druid.gif"> 
											<?php
											if($acid==11){
												?>
												(<a href="trade.php?action=showtrades&class=11"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=11"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
								</tbody></table>
							</div>
							<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 50px; width: 736px;">
							<center>Trades for
							<?php
							if($acid==1){
								?>
								<font color="C79C6E">Warrior</font> <img src="/uploads/account/warrior.gif">
								<?php
							}elseif($acid==2){
								?>
								<font color="F58CBA">Paladin</font> <img src="/uploads/account/paladin.gif">
								<?php
							}elseif($acid==3){
								?>
								<font color="ABD473">Hunter</font> <img src="/uploads/account/hunter.gif">
								<?php
							}elseif($acid==4){
								?>
								<font color="FFF569">Rogue</font> <img src="/uploads/account/rogue.gif">
								<?php
							}elseif($acid==5){
								?>
								<font color="FFFFFF">Priest</font> <img src="/uploads/account/priest.gif">
								<?php
							}elseif($acid==6){
								?>
								<font color="C41F3B">Death Knight</font> <img src="/uploads/account/deathknight.gif">
								<?php
							}elseif($acid==7){
								?>
								<font color="0070DE">Shaman</font> <img src="/uploads/account/shaman.gif">
								<?php
							}elseif($acid==8){
								?>
								<font color="40C7EB">Mage</font> <img src="/uploads/account/mage.gif">
								<?php
							}elseif($acid==9){
								?>
								<font color="8787ED">Warlock</font> <img src="/uploads/account/warlock.gif">
								<?php
							}elseif($acid==11){
								?>
								<font color="FF7D0A">Druid</font> <img src="/uploads/account/druid.gif">
								<?php
							}
							?>
							</center>
							</div>
								
							<?php
						}else{
						?>
							<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
								<div id="wm-error-page">
								<center>
									<p>
										<font size="6">No class selected</font>
									</p>
									<p>
										<font size="5">You have selected class that not exists.</font>
									</p> 
								</center>
								</div>
							</div>
							<?php
							header("refresh:5;url=trade.php");
						}
				}else{
						?>
					<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">No class selected</font>
							</p>
							<p>
								<font size="5">You have selected class that not exists.</font>
							</p> 
						</center>
						</div>
					</div>
					<?php
					header("refresh:5;url=trade.php");
				}
			}else{
				?>
				<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: 350px; width: 200px;">
					<span>AVAILABLE CLASSES</span>
					<table>
						<tbody><tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>
								<font color="C79C6E">Warrior</font> <img src="/uploads/account/warrior.gif"> (<a href="trade.php?action=showtrades&class=1"><font color="lightgreen">Select</font></a>)<br>
								<font color="F58CBA">Paladin</font> <img src="/uploads/account/paladin.gif"> (<a href="trade.php?action=showtrades&class=2"><font color="lightgreen">Select</font></a>)<br>
								<font color="ABD473">Hunter</font> <img src="/uploads/account/hunter.gif"> (<a href="trade.php?action=showtrades&class=3"><font color="lightgreen">Select</font></a>)<br>
								<font color="FFF569">Rogue</font> <img src="/uploads/account/rogue.gif"> (<a href="trade.php?action=showtrades&class=4"><font color="lightgreen">Select</font></a>)<br>
								<font color="FFFFFF">Priest</font> <img src="/uploads/account/priest.gif"> (<a href="trade.php?action=showtrades&class=5"><font color="lightgreen">Select</font></a>)<br>
								<font color="C41F3B">Death Knight</font> <img src="/uploads/account/deathknight.gif"> (<a href="trade.php?action=showtrades&class=6"><font color="lightgreen">Select</font></a>)<br>
								<font color="0070DE">Shaman</font> <img src="/uploads/account/shaman.gif"> (<a href="trade.php?action=showtrades&class=7"><font color="lightgreen">Select</font></a>)<br>
								<font color="40C7EB">Mage</font> <img src="/uploads/account/mage.gif"> (<a href="trade.php?action=showtrades&class=8"><font color="lightgreen">Select</font></a>)<br>
								<font color="8787ED">Warlock</font> <img src="/uploads/account/warlock.gif"> (<a href="trade.php?action=showtrades&class=9"><font color="lightgreen">Select</font></a>)<br>
								<font color="FF7D0A">Druid</font> <img src="/uploads/account/druid.gif"> (<a href="trade.php?action=showtrades&class=11"><font color="lightgreen">Select</font></a>)
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
					</tbody></table>
				</div>
				<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 350px; width: 786px;">
					<span>AVAILABLE TRADES</span>
					<table>
						<tbody><tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>First please select an interesting you class.</td>
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