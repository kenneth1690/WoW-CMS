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

$update = mysqli_query($conn, "UPDATE topics SET views = views + 1 WHERE category_id = ".$_GET['cid']." AND
									  subcategory_id = ".$_GET['scid']." AND topic_id = ".$_GET['tid']."");
?>
<html lang="en" class="active"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="csrf-token" content="MTk5MWNlNjFkMmYyOGE5YjM3OTYxZDEyMzQyYWE0MDU=">
<meta name="robots" content="noodp, noydir">
<meta name="google-site-verification" content="YW87KZKk-q94TWTgngHnf4ej3VUW3mWfFgznDZM_HB4">
<meta name="Description" content="Private Server Community.">
<meta name="Keywords" content="<?php echo $sitename; ?>, WoW, World of Warcraft, Warcraft, Private Server, Private WoW Server, WoW Server, Private WoW Server, wow private server, wow server, wotlk server, cataclysm private server, wow cata server, best free private server, largest private server, wotlk private server, blizzlike server, mists of pandaria, mop, cataclysm, cata, anti-cheat, sentinel anti-cheat, warden">
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
<title><?php echo $sitename; ?> | Forum</title>
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
                        <?php
						if(isset($_SESSION["loggedin"]) && !empty($_SESSION["loggedin"])){
							?><li><a href="/ucp/ucp.php" title="Account Panel">ACCOUNT PANEL</a></li><?php
						}else{
							?><li><a href="/create.php" title="Create Account">CREATE ACCOUNT</a></li><?php
						}?>
                        <li><a href="/download.php" title="Download">DOWNLOAD</a></li>
						<li><a href="/forum/index.php" title="Forum">FORUM</a></li>
            <!--<li><a href="/information.php" title="Information">INFORMATION</a></li>-->
                        <?php
						if(isset($_SESSION["loggedin"]) && !empty($_SESSION["loggedin"])){
							?><li><a href="/logout.php" title="Logout">LOG OUT</a></li><?php
						}else{
							?><li><a href="/login.php" title="Login">LOG IN</a></li><?php
						}?>
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
					$getcid = $_GET['cid'];
					$getscid = $_GET['scid'];
					$gettid = $_GET['tid'];
					$select = mysqli_query($conn, "SELECT * FROM `subcategories` WHERE `subcat_id`='$getscid'");
					$row = mysqli_fetch_assoc($select);
					$select2 = mysqli_query($conn, "SELECT * FROM `categories` WHERE `cat_id`='$getcid'");
					$row2 = mysqli_fetch_assoc($select2);
					$select3 = mysqli_query($conn, "SELECT * FROM `topics` WHERE `topic_id`='$gettid'");
					$row3 = mysqli_fetch_assoc($select3);
					?>
    	    		<li><a href="/forum/" class="active">Forum</a></li>
					<li>></li>
					<li><a href="<?php echo "/forum/topics/".$_GET['cid']."/".$_GET['scid'].""; ?>" class="active"><?php echo $row2['category_title']; ?></a></li>
            		<li>></li>
					<li><a href="<?php echo "/forum/topics/".$_GET['cid']."/".$_GET['scid'].""; ?>" class="active"><?php echo $row['subcategory_title']; ?></a></li>
					<li>></li>
					<li><a href="<?php echo "/forum/readtopic/".$_GET['cid']."/".$_GET['scid']."/".$_GET['tid'].""; ?>" class="active"><?php echo $row3['title']; ?></a></li>
            </ul>
    <ul>
        <li><?php
		$dt = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
		echo $dt->format('H:i');
		?></li>
    </ul>
</div>


<div class="content-wrapper">
	<?php
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$select = mysqli_query($con, "SELECT * FROM topics WHERE category_id = $getcid AND subcategory_id = $getscid AND topic_id = $gettid");
		$row = mysqli_fetch_assoc($select);
		
		if(isset($_SESSION["loggedin"])) {
			$nickauth = $_SESSION["loggedin"];
			$checkauth = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		}
		$sqlauth= "SELECT * FROM account WHERE username = '" . $nickauth . "'";
		$resultauth = mysqli_query($checkauth,$sqlauth);
		$rowsauth = mysqli_fetch_array($resultauth);
		
		$sqlauthor="SELECT * FROM account WHERE username = '" . $row['author'] . "'";
		$resultauthor = mysqli_query($checkauth,$sqlauthor);
		$rowsauthor = mysqli_fetch_array($resultauthor);
		
		$idcheck = $rowsauth['id'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkauth,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		
		$countreplies = mysqli_query($conn, "SELECT * FROM replies WHERE category_id = $getcid AND subcategory_id = $getscid AND topic_id = $gettid");
		?>
		<table id='categories'><tr><th colspan='2'><?php
					if($row['locked']==1){
						?>
						<img src="/uploads/lock.png">
						<?php
					}
					if($row['pinned']==1){
						?>
						<img src="/uploads/pin.png">
						<?php
					}
					?>Browsing topic: <?php echo $row['title']; ?> / All Replies (<?php echo mysqli_num_rows($countreplies); ?>)</th></tr><tr><th width='25%'><center>
					<?php
					if($rowsgm['gmlevel']==1){
						?>
						<font color="00ba0d">Moderator</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==2){
						?>
						<font color="cf7c00">Administrator</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==3){
						?>
						<font color="c70000">Head Admin</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==4){
						?>
						<font color="9000b8">Owner</font><br>
						<?php
					}else{
						?>
						<font color="ffffff">Player</font><br>
						<?php
					}
					
					if($rowsauthor['posts']>=0 && $rowsauthor['posts']<50){
						?>
						<font color="ffffff"><?php echo $rowsauthor['username']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=50 && $rowsauthor['posts']<100){
						?>
						<font color="#1df701"><?php echo $rowsauthor['username']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=100 && $rowsauthor['posts']<250){
						?>
						<font color="006dd7"><?php echo $rowsauthor['username']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=250 && $rowsauthor['posts']<500){
						?>
						<font color="9e34e7"><?php echo $rowsauthor['username']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=500){
						?><font color="f57b01"><?php echo $rowsauthor['username']; ?></font><?php
					}
					?>
					<br><img src="/uploads/avatars/<?php echo $rowsauthor['avatar']; ?>" width="100px" height="100px"><br>
					Rank: 
					<?php
					if($rowsauthor['posts']>=0 && $rowsauthor['posts']<50){
						?>
						<font color="ffffff">Newbie</font>
						<?php
					}elseif($rowsauthor['posts']>=50 && $rowsauthor['posts']<100){
						?>
						<font color="#1df701">Expert</font>
						<?php
					}elseif($rowsauthor['posts']>=100 && $rowsauthor['posts']<250){
						?>
						<font color="006dd7">Elite</font>
						<?php
					}elseif($rowsauthor['posts']>=250 && $rowsauthor['posts']<500){
						?>
						<font color="9e34e7">Legend</font>
						<?php
					}elseif($rowsauthor['posts']>=500){
						?><font color="f57b01">Senior</font><?php
					}
					?>
					<br>Posts: <font color="ffffff"><?php echo $rowsauthor['posts']; ?></font>
					</center></th>
		<th><span style="float:right;">Posted date: <?php echo $row['date_posted']; ?></span><br><?php echo $row['content']; ?></th></tr></table>
		<?php
		mysqli_close($checkauth);
		
		$select = mysqli_query($con, "SELECT * FROM replies WHERE category_id = $getcid AND subcategory_id = $getscid AND topic_id = $gettid ORDER BY reply_id ASC");
		
		
		if (mysqli_num_rows($select) != 0) {
			?>
			<table id='categories'>
			<?php
			while ($row = mysqli_fetch_assoc($select)) {
				if(isset($_SESSION["loggedin"])) {
						$nick = $_SESSION["loggedin"];
						$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
					}
				
				$test = $row['author'];
				
				$sql= "SELECT * FROM account WHERE username = '" . $test . "'";
				$result = mysqli_query($checkacp,$sql);
				$rows = mysqli_fetch_array($result);
				
				$sqlauthor="SELECT * FROM account WHERE username = '" . $row['author'] . "'";
				$resultauthor = mysqli_query($checkacp,$sqlauthor);
				$rowsauthor = mysqli_fetch_array($resultauthor);
					
				$avatar = $rows['avatar'];
				$ipcheck = $rows['last_ip'];
				$idcheck = $rows['id'];
				
				$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
				$resultgm = mysqli_query($checkacp,$gm);
				$rowsgm = mysqli_fetch_array($resultgm);
				?>
				<tr><th width='25%'><center>
				<?php
					if($rowsgm['gmlevel']==1){
						?>
						<font color="00ba0d">Moderator</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==2){
						?>
						<font color="cf7c00">Administrator</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==3){
						?>
						<font color="c70000">Head Admin</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==4){
						?>
						<font color="9000b8">Owner</font><br>
						<?php
					}else{
						?>
						<font color="ffffff">Player</font><br>
						<?php
					}
					
					if($rowsauthor['posts']>=0 && $rowsauthor['posts']<50){
						?>
						<font color="ffffff"><?php echo $row['author']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=50 && $rowsauthor['posts']<100){
						?>
						<font color="#1df701"><?php echo $row['author']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=100 && $rowsauthor['posts']<250){
						?>
						<font color="006dd7"><?php echo $row['author']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=250 && $rowsauthor['posts']<500){
						?>
						<font color="9e34e7"><?php echo $row['author']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=500){
						?><font color="f57b01"><?php echo $row['author']; ?></font><?php
					}
					?>
				<br><img src="/uploads/avatars/<?php echo $avatar; ?>" width="100px" height="100px"><br>
				Rank: 
				<?php
				if($rowsauthor['posts']>=0 && $rowsauthor['posts']<50){
					?>
					<font color="ffffff">Newbie</font>
					<?php
				}elseif($rowsauthor['posts']>=50 && $rowsauthor['posts']<100){
					?>
					<font color="#1df701">Expert</font>
					<?php
				}elseif($rowsauthor['posts']>=100 && $rowsauthor['posts']<250){
					?>
					<font color="006dd7">Elite</font>
					<?php
				}elseif($rowsauthor['posts']>=250 && $rowsauthor['posts']<500){
					?>
					<font color="9e34e7">Legend</font>
					<?php
				}elseif($rowsauthor['posts']>=500){
					?><font color="f57b01">Senior</font><?php
				}
				?><br>Posts: <font color="ffffff"><?php echo $rowsauthor['posts']; ?></font>
				</center></th><th><span style="float:right;">Posted date: <?php echo $row['date_posted']; ?></span><br><?php echo $row['comment']; ?></th></tr>
				<?php
			}
			?>
			</table>
			<?php
		}
		?>
	<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
		<div id="wm-error-page">
			<?php
					if (isset($_SESSION['loggedin'])) {
						$select = mysqli_query($con, "SELECT * FROM topics WHERE category_id = $getcid AND subcategory_id = $getscid AND topic_id = $gettid");
						$row = mysqli_fetch_assoc($select);
						
						$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
						
						$nick = $_SESSION["loggedin"];
						
						$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
						$result = mysqli_query($checkacp,$sql);
						$rows = mysqli_fetch_array($result);
						
						$idcheck = $rows['id'];
						
						$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
						$resultgm = mysqli_query($checkacp,$gm);
						$rowsgm = mysqli_fetch_array($resultgm);

						if($row['locked']=='0'){
							echo "<form action='/forum/replyto/".$getcid."/".$getscid."/".$gettid."'>
										<input type='submit' value='REPLY' class='wm-ui-btn'/>
									</form>";
						}elseif($row['locked']=='1'){
							if($rowsgm['gmlevel']>0){
								echo "<form action='/forum/replyto/".$getcid."/".$getscid."/".$gettid."'>
										<input type='submit' value='REPLY' class='wm-ui-btn'/>
									</form>";
								echo "The topic is locked, but you still have permission to reply.";
							}else{
								echo "Topic is locked, you can not reply.";
							}
						}
						
						if($rowsgm['gmlevel']>0){
							if($row['locked']=='0'){
								echo "<form action='/forum/locktopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
											<input type='submit' value='LOCK' class='wm-ui-btn'/>
										</form>";
							}elseif($row['locked']=='1'){
								echo "<form action='/forum/locktopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
											<input type='submit' value='UNLOCK' class='wm-ui-btn'/>
										</form>";
							}
						}
						
						if($rowsgm['gmlevel']>0){
							if($row['pinned']=='0'){
								echo "<form action='/forum/pintopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
											<input type='submit' value='PIN' class='wm-ui-btn'/>
										</form>";
							}elseif($row['pinned']=='1'){
								echo "<form action='/forum/pintopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
											<input type='submit' value='UNPIN' class='wm-ui-btn'/>
										</form>";
							}
						}
						mysqli_close($checkacp);
					}
				?>
		</div>
	</div>
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
	<a href="/policies/terms">Terms of Service</a> &nbsp; <a href="/policies/privacy">Privacy Policy</a> &nbsp; <a href="/policies/refund"> Refund Policy </a> &nbsp; <a href="#">Contact Us</a><br>
	Copyright ][ <?php echo $sitename; ?> ][ 2019. All Rights Reserved.
</div>


</body></html>