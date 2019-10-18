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
<title><?php echo $sitename; ?> | Lottery</title>
<link rel="stylesheet" href="/css/global.css">
<link rel="stylesheet" href="/css/ui.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/wm-contextmenu.css">
<style>
		#customers {
			  border-collapse: collapse;
			  width: 50%;
			}

			#customers td, #customers th {
			  border: 1px solid #ddd;
			  background: #0f0f0f none repeat-x left;
			  color: #c1b575;
				border-bottom: 1px solid #1e1e1e;
				border-left: 1px solid transparent;
				border-right: 1px solid transparent;
			  padding: 10px;
			  font-size: 15px;
			}

			#customers tr:nth-child(even){background-color: #f2f2f2;}

			#customers tr:hover {background-color: #ddd;}

			#customers th {
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
		
		?><li><a href="/ucp/ucp.php"><i class="fas fa-user"></i> ACCOUNT</a></li>
		<li><a href="/ucp/characters.php"><i class="fas fa-users-cog"></i> CHARACTERS</a></li>
		<li><a href="/ucp/donate.php"><i class="fas fa-dollar-sign"></i> DONATE</a></li>
		<li><a href="/ucp/store.php"><i class="fas fa-shopping-cart"></i> STORE</a></li>
		<li><a href="/ucp/trade.php"><i class="fas fa-sync-alt"></i> TRADE</a></li>
		<li><a href="/ucp/support.php"><i class="fas fa-life-ring"></i> SUPPORT</a></li>
		<li><a href="/ucp/lottery.php" class="active"><i class="fas fa-ticket-alt"></i> LOTTERY</a></li>
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
    <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: 380px;">
        <span>CURRENT LOTTERY</span>
		<table>
            <tbody>
			<tr>
                <td>&nbsp;</td>
            </tr>
			<?php
			$sqllottery = "SELECT * FROM lotteries WHERE status = '1' ORDER BY id DESC LIMIT 1";
			$resultlottery = mysqli_query($conn,$sqllottery);
			$rowlottery = mysqli_fetch_array($resultlottery);
			
			if(time()>$rowlottery['end_date']){
				$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
				$getwinner = mysqli_query($checkacp, "SELECT * FROM account WHERE inlottery = 1 ORDER BY RAND() LIMIT 1");
				$rowswin = mysqli_fetch_array($getwinner);
				if(mysqli_num_rows($getwinner)==1){
					$endlottery = mysqli_query($conn, "UPDATE lotteries SET winner = '".$rowswin['id']."', status = '2' WHERE status = '1'");
					$giveprize = mysqli_query($checkacp, "UPDATE account SET coins = coins+".$rowlottery['prize']." WHERE id = '".$rowswin['id']."'");
					$setinlottery = mysqli_query($checkacp, "UPDATE account SET inlottery = 0 WHERE inlottery = 1");
					$sendnoti = mysqli_query($conn, "INSERT INTO notifications (`title`, `notification`, `user`) VALUES ('Lottery Winner', 'Hey, ".$rowswin['username']."! You won the latest lottery in which the prize was ".$rowlottery['prize']." coins. Congrats!', '".$rowswin['id']."')");
				}
			}
			
			$checkfor = mysqli_query($conn, "SELECT * FROM lotteries WHERE status = 1 ORDER BY id DESC LIMIT 1");
			
			$resultendedlottery = mysqli_query($conn,"SELECT * FROM lotteries WHERE status = '2' ORDER BY id DESC LIMIT 1");
			$rowendedlottery = mysqli_fetch_array($resultendedlottery);
			
			if(mysqli_num_rows($checkfor)==0){
				if(time()>($rowendedlottery['end_date']+7*24*60*60)){
					$enddategen = time() + 24*60*60;
					$rand = rand(1,3);
					if($rand==3){
						$randprize = rand(2,3);
					}elseif($rand==2){
						$randprize = rand(1,2);
					}elseif($rand==1){
						$randprize = 1;
					}
					$newlottery = mysqli_query($conn, "INSERT INTO lotteries (`category`, `prize`, `start_date`, `end_date`) VALUES ('1', '".$randprize."', '".time()."', '".$enddategen."')");
				}
			}
			
			$checkagain = mysqli_query($conn, "SELECT * FROM lotteries WHERE status = 1 ORDER BY id DESC LIMIT 1");
			if(mysqli_num_rows($checkagain)==1){
				$sqllottery = "SELECT * FROM lotteries WHERE status = '1' ORDER BY id DESC LIMIT 1";
				$resultlottery = mysqli_query($conn,$sqllottery);
				$rowlottery = mysqli_fetch_array($resultlottery);
				
				$getstarteddate = gmdate("F j, Y / H:i:s", $rowlottery['start_date']);
				$getendingdate = gmdate("F j, Y / H:i:s", $rowlottery['end_date']);
				?>
				<tr>
					<td>Started: <font color="ffffff"><?php echo $getstarteddate; ?></font></td>
				</tr>
				<tr>
					<td>Ending date: <font color="ffffff"><?php echo $getendingdate; ?></font></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Category: <font color="gold">Coins</font></td>
				</tr>
				<tr>
					<td>Prize: <font color="gold"><?php echo $rowlottery['prize']; ?></font></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Are you IN lottery?: 
					<?php
					if($rows['inlottery']==0){
						?>
						<font color="red">No</font>
						<?php
					}else{
						?>
						<font color="1df701">Yes</font>
						<?php
					}
					?>
					</td>
				</tr>
				<?php
				if($rows['inlottery']==0){
				?>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<form action='/ucp/takeinlottery.php' method='POST'>
							<input type='submit' value='TAKE IN LOTTERY' class='wm-ui-btn'/>
						</form>
					</td>
				</tr>
				<?php
				}
			}else{
			$getlastwinner = mysqli_query($checkacp, "SELECT * FROM account WHERE id = '".$rowendedlottery['winner']."'");
			$rowswinlast = mysqli_fetch_array($getlastwinner);
			?>
			<tr>
                <td>There's no lottery actually.</td>
            </tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Last lottery winner: <font color="ffffff"><?php echo $rowswinlast['username']; ?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Next lottery will be at: <font color="ffffff"><?php echo gmdate("F j, Y / H:i:s", $rowendedlottery['end_date']+7*24*60*60); ?></font></td>
			</tr>
			<?php
			}
			?>
			</tbody>
		</table>
    </div>
	<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 50px;">
	<center>Last 10 lotteries</center>
	</div>
		<table id="customers">
			<tr>
				<th width="45%">Ending</th>
				<th width="37%">Winner</th>
				<th width="18%">Prize</th>
			</tr>
			<?php
			$result = mysqli_query($conn,"SELECT * FROM `lotteries` ORDER BY id DESC LIMIT 10");
				if($result->num_rows>0){
					while($row = mysqli_fetch_array($result)){
						$endingdate = gmdate("F j, Y / H:i:s", $row['end_date']);
						?>
						<tr>
							<th><?php echo $endingdate; ?></th>
							<?php
							if(is_null($row['winner'])){
								?>
								<th>*Not ended*</th>
								<?php
							}else{
								$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
								$sqlwinner = "SELECT * FROM account WHERE id = '" . $row['winner'] . "'";
								$resultwinner = mysqli_query($checkacp,$sqlwinner);
								$rowwinner = mysqli_fetch_array($resultwinner);
								?>
								<th><?php echo $rowwinner['username']; ?></th>
								<?php
							}
							?>
							<th><?php echo $row['prize']; ?> Coins</th>
						</tr>
						<?php
					}
				}else{
					?>
					<tr>
						<th colspan="3">No lotteries</th>
					</tr>
					<?php
				}
				mysqli_close($cmsconn);
			?>
		</table>
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