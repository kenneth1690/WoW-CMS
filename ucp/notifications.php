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
.noti {
	background-color: #0F0F0F !important;
    color: #fff;
    text-align: left;
    padding: 5px 0;
    border: 1px solid #1e1e1e !important;
    padding-left: 10px !important;
    padding-right: 10px !important;
    bottom: 125%;
    left: 50%;
    opacity: 1;
    transition: opacity 0.3s;
    display: block;
	overflow-wrap: break-word;
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
		
		?><li><a href="/ucp/ucp.php"><i class="fas fa-user"></i> ACCOUNT</a></li>
		<li><a href="/ucp/characters.php"><i class="fas fa-users-cog"></i> CHARACTERS</a></li>
		<li><a href="/ucp/donate.php"><i class="fas fa-dollar-sign"></i> DONATE</a></li>
		<li><a href="/ucp/store.php"><i class="fas fa-shopping-cart"></i> STORE</a></li>
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
			<li><a href="/ucp/notifications.php" class="active"><i class="fas fa-bell"></i> <?php echo mysqli_num_rows($howmuchnotis); ?></a></li>
			<?php
		}else{
			?>
			<li><a href="/ucp/notifications.php" class="active"><i class="fas fa-bell"></i> 0</a></li>
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
    <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: auto;">
        <span>NOTIFICATIONS LIST</span>
		<br><br>
			<?php
			if (isset($_GET['page_no']) && $_GET['page_no']!="") {
				$page_no = $_GET['page_no'];
			}else{
				$page_no = 1;
			}
			
			$cmsconn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);

			$total_records_per_page = 6;
			$offset = ($page_no-1) * $total_records_per_page;
			$previous_page = $page_no - 1;
			$next_page = $page_no + 1;
			$adjacents = "2"; 

			$result_count = mysqli_query($cmsconn,"SELECT COUNT(*) As total_records FROM `notifications` WHERE user = '".$idcheck."'");
			$total_records = mysqli_fetch_array($result_count);
			$total_records = $total_records['total_records'];
			$total_no_of_pages = ceil($total_records / $total_records_per_page);
			$second_last = $total_no_of_pages - 1; // total page minus 1

			$result = mysqli_query($cmsconn,"SELECT * FROM `notifications` WHERE user = '".$idcheck."' ORDER BY id DESC LIMIT $offset, $total_records_per_page");
			if($result->num_rows>0){
				while($row = mysqli_fetch_array($result)){
					?>
					<div class="noti">
						<font color="FFE4B5"><?php echo $row['title']; ?></font><br><br>
						<?php echo $row['notification']; ?>
					</div>
					<br>
					<?php
				}
			}else{
				?>
					Notifications empty.
				<?php
			}
			mysqli_close($cmsconn);
			?>
			<br><br>
			<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong><br>
			<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
			
			<b><a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous&nbsp;&nbsp;</a></b>
			   
			<?php 
			if ($total_no_of_pages <= 10){  	 
				for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
					if ($counter == $page_no) {
						echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
					}else{
						echo "<b><a href='?page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
					}
				}
			}elseif($total_no_of_pages > 10){
				if($page_no <= 4) {			
					for ($counter = 1; $counter < 8; $counter++){		 
						if ($counter == $page_no) {
							echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
						}else{
							echo "<b><a href='?page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
						}
					}
					echo "<b><a>...</a></b>";
					echo "<b><a href='?page_no=$second_last'>&nbsp;&nbsp;$second_last&nbsp;&nbsp;</a></b>";
					echo "<b><a href='?page_no=$total_no_of_pages'>&nbsp;&nbsp;$total_no_of_pages&nbsp;&nbsp;</a></b>";
				}elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
					echo "<b><a href='?page_no=1'>&nbsp;&nbsp;1&nbsp;&nbsp;</a></b>";
					echo "<b><a href='?page_no=2'>&nbsp;&nbsp;2&nbsp;&nbsp;</a></b>";
					echo "<b><a>...</a></b>";
					for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
						if ($counter == $page_no) {
							echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
						}else{
							echo "<b><a href='?page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
						}                  
				   }
				   echo "<b><a>...</a></b>";
				   echo "<b><a href='?page_no=$second_last'>&nbsp;&nbsp;$second_last&nbsp;&nbsp;</a></b>";
				   echo "<b><a href='?page_no=$total_no_of_pages'>&nbsp;&nbsp;$total_no_of_pages&nbsp;&nbsp;</a></b>";      
				}else {
					echo "<b><a href='?page_no=1'>&nbsp;&nbsp;1&nbsp;&nbsp;</a></b>";
					echo "<b><a href='?page_no=2'>&nbsp;&nbsp;2&nbsp;&nbsp;</a></b>";
					echo "<b><a>...</a></b>";

					for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
						if ($counter == $page_no) {
							echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
						}else{
							echo "<b><a href='?page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
						}                   
					}
				}
			}
			?>
    
			<b><a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>&nbsp;&nbsp;Next</a></b>
			<?php
			if($page_no < $total_no_of_pages){
				echo "<b><a href='?page_no=$total_no_of_pages'>&nbsp;&nbsp;Last</a></b>";
			}
			?>
    </div>
    <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: auto;">
		<span>NOTIFICATIONS SETTINGS</span>
		<table>
            <tbody>
			<tr>
                <td>&nbsp;</td>
            </tr>
			<tr>
				<td>
					<form action='/ucp/markreaded.php' method='POST'>
						<input type='submit' value='MARK ALL AS READED' class='wm-ui-btn'/>
					</form>
				</td>
			</tr>
			</tbody>
		</table>
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
	Copyright ][ <?php echo $sitename; ?> ][ 2019. All Rights Reserved.
</div>


</body></html>