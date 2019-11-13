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
		<li><a href="/ucp/store.php" class="active"><i class="fas fa-shopping-cart"></i> STORE</a></li>
		<li><a href="/ucp/trade.php"><i class="fas fa-sync-alt"></i> TRADE</a></li>
		<li><a href="/ucp/support.php"><i class="fas fa-life-ring"></i> SUPPORT</a></li>
		<li><a href="/ucp/lottery.php"><i class="fas fa-ticket-alt"></i> LOTTERY</a></li>
		<li><a href="/ucp/settings.php"><i class="fas fa-cog"></i> SETTINGS</a></li>
		<?php
		$howmuchmess = mysqli_query($conn, "SELECT * FROM messages WHERE status = 0 AND (author_id = '".$idcheck."' OR assigned_to = '".$idcheck."')");
		$rowsmess = mysqli_fetch_array($howmuchmess);
		if(mysqli_num_rows($howmuchmess)>0){
			?>
			<li><a href="/ucp/messages.php"><i class="fas fa-envelope"></i> <?php echo mysqli_num_rows($howmuchmess); ?></a></li>
			<?php
		}else{
			?>
			<li><a href="/ucp/messages.php"><i class="fas fa-envelope"></i> 0</a></li>
			<?php
		}
		?>
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

<div id="content-wrapper">
<?php 
			if(isset($_GET['action'])){
				$action = htmlspecialchars($_GET['action']);
			}

			if($action == "showstores"){
				if(isset($_GET['type'])){
					$type = $_GET['type'];
            		
						if($type==1 || $type==2 || $type==3){
							?>
							<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: 350px; width: 250px;">
								<span>AVAILABLE CATEGORIES</span>
								<table>
									<tbody><tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>IN-GAME</td>
									</tr>
									<tr>
										<td>
											<?php
											if($type==1){
												?>
												<font color="1df701">Free</font> (<a href="store.php?action=showstores&type=1"><font color="orange">Selected</font></a>)<br>
												<?php
											}else{
												?>
												<font color="1df701">Free</font> (<a href="store.php?action=showstores&type=1"><font color="lightgreen">Select</font></a>)<br>
												<?php
											}
											?>
											<?php
											if($type==2){
												?>
												<font color="f57b01">Coins</font> (<a href="store.php?action=showstores&type=2"><font color="orange">Selected</font></a>)<br>
												<?php
											}else{
												?>
												<font color="f57b01">Coins</font> (<a href="store.php?action=showstores&type=2"><font color="lightgreen">Select</font></a>)<br>
												<?php
											}
											?>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>OTHERS</td>
									</tr>
									<tr>
										<td>
											<?php
											if($type==3){
												?>
												<font color="006dd7">Services</font> (<a href="store.php?action=showstores&type=3"><font color="orange">Selected</font></a>)<br>
												<?php
											}else{
												?>
												<font color="006dd7">Services</font> (<a href="store.php?action=showstores&type=3"><font color="lightgreen">Select</font></a>)<br>
												<?php
											}
											?>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
								</tbody></table>
							</div>
							<?php
							if($type==1 || $type==2 || $type==3){
							?>
							<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 50px; width: 736px;">
								<center>
									<?php
									if($type==1){
										?>
										IN-GAME: <font color="1df701">Free</font>
										<?php
									}elseif($type==2){
										?>
										IN-GAME: <font color="f57b01">Coins</font>
										<?php
									}elseif($type==3){
										?>
										OTHERS: <font color="006dd7">Services</font>
										<?php
									}else{
										?>
										You shouldn't see this, report this.
										<?php
									}
									?>
								</center>
							</div>
							<table id="categories">
								<?php
								if($type==1){
									?>
									<tr>
										<th width="60%">Service</th>
										<th width="30%"><center>Cost</center></th>
										<th width="10%"><center>Buy</center></th>
									</tr>
									<tr>
										<th width="60%">Character Unstuck</th>
										<th width="30%"><center>Free</center></th>
										<th width="10%"><center>Buy</center></th>
									</tr>
									<?php
								}elseif($type==2){
									?>
									<tr>
										<th width="60%">Service</th>
										<th width="30%"><center>Cost</center></th>
										<th width="10%"><center>Buy</center></th>
									</tr>
									<tr>
										<th width="60%">Character Rename</th>
										<th width="30%"><center>5 Coins</center></th>
										<th width="10%"><center>Buy</center></th>
									</tr>
									<tr>
										<th width="60%">Character Instant 80 Level Up</th>
										<th width="30%"><center>30 Coins</center></th>
										<th width="10%"><center>Buy</center></th>
									</tr>
									<?php
								}elseif($type==3){
									?>
									<tr>
										<th width="60%">Service</th>
										<th width="30%"><center>Cost</center></th>
										<th width="10%"><center>Buy</center></th>
									</tr>
									<tr>
										<th width="60%">Coins gifting</th>
										<th width="30%"><center>Free</center></th>
										<th width="10%"><center>Buy</center></th>
									</tr>
									<?php
								}else{
									?>
									<tr>
										<th width="60%">Service</th>
										<th width="30%"><center>Cost</center></th>
										<th width="10%"><center>Buy</center></th>
									</tr>
									<tr>
										<th colspan="3">There's no available services to purchase.</th>
									</tr>
									<?php
								}
								?>
							</table>
							<?php
							}else{
							?>
							<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 350px; width: 786px;">
								<span>AVAILABLE SERVICES & PRODUCTS</span>
								<table>
									<tbody><tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>First please select an interesting you category.</td>
									</tr>
								</tbody></table>
							</div>
							<?php
							}
						}else{
						?>
							<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
								<div id="wm-error-page">
								<center>
									<p>
										<font size="6">No category selected</font>
									</p>
									<p>
										<font size="5">You have selected category that not exists.</font>
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
								<font size="6">No category selected</font>
							</p>
							<p>
								<font size="5">You have selected category that not exists.</font>
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
					<span>AVAILABLE CATEGORIES</span>
					<table>
						<tbody><tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>IN-GAME</td>
						</tr>
						<tr>
							<td>
								<font color="1df701">Free</font> (<a href="store.php?action=showstores&type=1"><font color="lightgreen">Select</font></a>)<br>
								<font color="f57b01">Coins</font> (<a href="store.php?action=showstores&type=2"><font color="lightgreen">Select</font></a>)<br>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>OTHERS</td>
						</tr>
						<tr>
							<td>
								<font color="006dd7">Services</font> (<a href="store.php?action=showstores&type=3"><font color="lightgreen">Select</font></a>)<br>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
					</tbody></table>
				</div>
				<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 350px; width: 786px;">
					<span>AVAILABLE SERVICES & PRODUCTS</span>
					<table>
						<tbody><tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>First please select an interesting you category.</td>
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