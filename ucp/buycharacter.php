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
  width: 100%;
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


<div class="content-wrapper">
            <?php
            $charid = $_GET['charid'];

            $conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
            $nick = $_SESSION["loggedin"];
            $checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);

            $sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
            $result = mysqli_query($checkacp,$sql);
            $rows = mysqli_fetch_array($result);
            
            $idcheck = $rows['id'];

			if(isset($_GET['action'])){
				$action = htmlspecialchars($_GET['action']);
			}

			if($action == "buy"){
				if(isset($charid)){
					$checkchar = mysqli_connect($db_host, $db_username, $db_password, $chars_db_name, $db_port);
					$resultchar = mysqli_query($checkchar, "SELECT * FROM characters WHERE guid = '" . $charid. "'");
					$rowschar = mysqli_fetch_array($resultchar);
					
					$checkexists = mysqli_query($checkchar, "SELECT * FROM characters WHERE guid = '" . $charid. "'");
					if(mysqli_num_rows($checkexists)>0){
						if($idcheck!=$rowschar['account']){
							$checkselled = mysqli_query($conn, "SELECT * FROM trades WHERE selled='1' AND charid = '" . $charid. "' ORDER BY id DESC LIMIT 1");
							if(mysqli_num_rows($checkselled)==0){
								?>
								<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
		                            <div id="wm-error-page">
                                    <a href='/ucp/buycharacter.php?action=confirmbuy&charid=<?php echo $_GET['charid']; ?>'>
                                        <p>Are you sure you want to buy this character?</p>
                                        <br />
                                        <input type='submit' value="I'M SURE" class='wm-ui-btn'/>
                                    </a>
                                    </div>
                                    </div>
									<?php
							}else{
								?>
								<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
								<div id="wm-error-page">
								<center>
									<p>
										<font size="6">Please wait</font>
									</p>
									<p>
										<font size="5">This character has recently been sold.</font>
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
									<font size="6">Buying failed</font>
								</p>
								<p>
									<font size="5">You're owner of this character.</font>
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
								<font size="6">Invalid character</font>
							</p>
							<p>
								<font size="5">Character with that ID not exists.</font>
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
							<font size="6">Invalid action</font>
						</p>
						<p>
							<font size="5">You have not selected any actions.</font>
						</p> 
					</center>
					</div>
					</div>
					<?php
					header("refresh:5;url=ucp.php");
				}
			}elseif($action == "confirmbuy"){
				if(isset($charid)){
					$checkchar = mysqli_connect($db_host, $db_username, $db_password, $chars_db_name, $db_port);
					$resultchar = mysqli_query($checkchar, "SELECT * FROM characters WHERE guid = '" . $charid. "'");
					$rowschar = mysqli_fetch_array($resultchar);
					
					$checkexists = mysqli_query($checkchar, "SELECT * FROM characters WHERE guid = '" . $charid. "'");
					if(mysqli_num_rows($checkexists)>0){
						if($idcheck!=$rowschar['account']){
							$checkselled = mysqli_query($conn, "SELECT * FROM trades WHERE selled='1' AND charid = '" . $charid. "' ORDER BY id DESC LIMIT 1");
							$checkforsell = mysqli_query($conn, "SELECT * FROM trades WHERE charid = '" . $charid. "'");
							if(mysqli_num_rows($checkselled)==0){
								if(mysqli_num_rows($checkforsell)!=0){
									$traderes = mysqli_query($conn, "SELECT * FROM trades WHERE charid = '" . $charid. "'");
									$rowtrade = mysqli_fetch_array($traderes);
									$seller = $rowtrade['seller_id'];
									$price = $rowtrade['price'];
									if($rows['coins']>=$rowtrade['price']){
										$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
										mysqli_query($checkacp, "UPDATE account SET coins=coins-'$price' WHERE id='$idcheck'");
										mysqli_query($checkacp, "UPDATE account SET coins=coins+'$price' WHERE id='$seller'");
										mysqli_query($checkchar, "UPDATE characters SET account='$idcheck' WHERE guid='$charid'");
										mysqli_query($conn, "UPDATE trades SET selled='1', buyer_id='$idcheck' WHERE charid='".$charid."'");
										
										$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
										$notires = mysqli_query($checkacp, "SELECT * FROM account WHERE id = '" . $seller . "'");
										$rowsnots = mysqli_fetch_array($notires);
										
										$sendnoti = mysqli_query($conn, "INSERT INTO notifications (`title`, `notification`, `user`) VALUES ('Character Selled', 'Hey, ".$rowsnots['username']."! Your character has been successfully bought by a player! Congrats!', '".$rowsnots['id']."')");
										?>
										<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
										<div id="wm-error-page">
										<center>
											<p>
												<font size="6">Action confirmed</font>
											</p>
											<p>
												<font size="5">You successfully bought this character.</font>
											</p> 
										</center>
										</div>
										</div>
										<?php
										header("refresh:5;url=ucp.php");
									}else{
										?>
										<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
										<div id="wm-error-page">
										<center>
											<p>
												<font size="6">Buying failed</font>
											</p>
											<p>
												<font size="5">You have not enough coins.</font>
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
												<font size="6">Buying failed</font>
											</p>
											<p>
												<font size="5">This character is not for buy.</font>
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
										<font size="6">Buying failed</font>
									</p>
									<p>
										<font size="5">This character is not for buy.</font>
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
									<font size="6">Buying failed</font>
								</p>
								<p>
									<font size="5">You're owner of this character.</font>
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
								<font size="6">Invalid character</font>
							</p>
							<p>
								<font size="5">Character with that ID not exists.</font>
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
							<font size="6">Invalid action</font>
						</p>
						<p>
							<font size="5">You have not selected any actions.</font>
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
							<font size="6">Invalid action</font>
						</p>
						<p>
							<font size="5">You have not selected any actions.</font>
						</p> 
					</center>
					</div>
					</div>
					<?php
					header("refresh:5;url=ucp.php");
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