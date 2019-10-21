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

if(!$_GET['tid']){
	header("location: /404.php");
}

$id = $_SESSION['UID'];
if(!isset($_SESSION["loggedin"]) || empty($_SESSION["loggedin"])){
    header("location: ../login.php");
	exit;
}
	$select = mysqli_query($conn, "SELECT * FROM topics WHERE category_id = $getcid AND subcategory_id = $getscid AND topic_id = $gettid");
	$row = mysqli_fetch_assoc($select);

	if($row['locked']=='1'){
		$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
						
		$nick = $_SESSION["loggedin"];
						
		$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
		$result = mysqli_query($checkacp,$sql);
		$rows = mysqli_fetch_array($result);
						
		$idcheck = $rows['id'];
						
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkacp,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);

		if(!$rowsgm || $rowsgm['gmlevel']==0){
			header("location: /forum/index.php");
			exit;
		}
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
  font-weight: normal;
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
					<li>></li>
					<li><a href="#" class="active">New Reply</a></li>
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
		$idgmcheck = $row['author_id'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idgmcheck . "'";
		$resultgm = mysqli_query($checkauth,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		
		$gmmy= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgmmy = mysqli_query($checkauth,$gmmy);
		$rowsgmmy = mysqli_fetch_array($resultgmmy);
		
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
					?><b>Browsing topic: <?php echo $row['title']; ?> / All Replies (<?php echo mysqli_num_rows($countreplies); ?>)</b></th></tr><tr><th width='25%'><center>
					<?php
					if($rowsgm['gmlevel']==1){
						?>
						<font color="00ba0d">Game Master</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==2){
						?>
						<font color="cf7c00">Administrator</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==3){
						?>
						<font color="c70000">Head Admin</font><br>
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
		<th><span style="float:right; text-align: right;">
				<?php
				if($idcheck==$row['author_id'] || $rowsgmmy['gmlevel']>0){
					?>
					<a href="/forum/editpost.php?tid=<?php echo $_GET['tid']; ?>">Edit</a> / 
					<?php
				}
				?>
				Posted date: <?php echo $row['date_posted']; ?>
				<?php
				if(!is_null($row['edited_by']) && !is_null($row['edited_date'])){
					?>
					 / Edited <?php echo $row['edited_date']; ?> by <?php echo $row['edited_by']; ?>
					<?php
				}
				?>
				</span><br><br><?php echo $row['content']; ?></th></tr></table>
		<?php
		mysqli_close($checkauth);
		
		$selectreps = mysqli_query($con, "SELECT * FROM replies WHERE category_id = $getcid AND subcategory_id = $getscid AND topic_id = $gettid ORDER BY reply_id ASC");
		
		
		if (mysqli_num_rows($selectreps) != 0) {
			?><br>
			<table id='categories'>
			<th colspan='2'><b>Replies:</b></th></tr>
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

			$result_count = mysqli_query($cmsconn,"SELECT COUNT(*) As total_records FROM `replies`");
			$total_records = mysqli_fetch_array($result_count);
			$total_records = $total_records['total_records'];
			$total_no_of_pages = ceil($total_records / $total_records_per_page);
			$second_last = $total_no_of_pages - 1; // total page minus 1
			
			$select3 = mysqli_query($con, "SELECT * FROM replies WHERE category_id = $getcid AND subcategory_id = $getscid AND topic_id = $gettid LIMIT $offset, $total_records_per_page");
			
			while ($row = mysqli_fetch_assoc($select3)) {
				if(isset($_SESSION["loggedin"])) {
						$nick = $_SESSION["loggedin"];
						$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
					}
				
				$test = $row['author'];
				
				$sqlauth= "SELECT * FROM account WHERE username = '" . $nick . "'";
				$resultauth = mysqli_query($checkacp,$sqlauth);
				$rowsauth = mysqli_fetch_array($resultauth);
				
				$sql= "SELECT * FROM account WHERE username = '" . $test . "'";
				$result = mysqli_query($checkacp,$sql);
				$rows = mysqli_fetch_array($result);
				
				$sqlauthor="SELECT * FROM account WHERE username = '" . $row['author'] . "'";
				$resultauthor = mysqli_query($checkacp,$sqlauthor);
				$rowsauthor = mysqli_fetch_array($resultauthor);
					
				$avatar = $rows['avatar'];
				$ipcheck = $rows['last_ip'];
				$idcheck = $rowsauth['id'];
				$idgmcheck = $row['author_id'];
				
				$gmmy= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
				$resultgmmy = mysqli_query($checkacp,$gmmy);
				$rowsgmmy = mysqli_fetch_array($resultgmmy);
				
				$gm= "SELECT * FROM account_access WHERE id = '" . $idgmcheck . "'";
				$resultgm = mysqli_query($checkacp,$gm);
				$rowsgm = mysqli_fetch_array($resultgm);
				?>
				<tr><th width='25%'><center>
				<?php
					if($rowsgm['gmlevel']==1){
						?>
						<font color="00ba0d">Game Master</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==2){
						?>
						<font color="cf7c00">Administrator</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==3){
						?>
						<font color="c70000">Head Admin</font><br>
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
				</center></th>
				<th><span style="float:right; text-align: right;">
				<?php
				if($idcheck==$row['author_id'] || $rowsgmmy>0){
					?>
					<a href="/forum/editpost.php?pid=<?php echo $row['reply_id']; ?>">Edit</a> / 
					<?php
				}
				?>
				Posted date: <?php echo $row['date_posted']; ?>
				<?php
				if(!is_null($row['edited_by']) && !is_null($row['edited_date'])){
					?>
					/ Edited <?php echo $row['edited_date']; ?> by <?php echo $row['edited_by']; ?>
					<?php
				}
				?>
				</span><br><?php echo $row['comment']; ?></th></tr>
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
				$select = mysqli_query($conn, "SELECT * FROM topics WHERE category_id = $getcid AND subcategory_id = $getscid AND topic_id = $gettid");
				$row = mysqli_fetch_assoc($select);
				if($row['locked']=='0'){
					echo "<div class='content'><form action='/forum/addreply.php?cid=".$getcid."&scid=".$getscid."&tid=".$gettid."' method='POST'>
							  <p>Reply: </p>
							  <textarea cols='80' rows='14' id='comment' name='comment' class='wm-ui-input-generic input-lg2 wm-ui-generic-frame wm-ui-all-border'></textarea><br />
							  <br><input type='submit' value='CREATE' class='wm-ui-btn'/>
							  </form></div>";
				}elseif($row['locked']=='1'){
					if($rowsgm['gmlevel']>0){
						echo "<div class='content'><form action='/forum/addreply.php?cid=".$getcid."&scid=".$getscid."&tid=".$gettid."' method='POST'>
								  <p>Reply: </p>
								  <textarea cols='80' rows='14' id='comment' name='comment' class='wm-ui-input-generic input-lg2 wm-ui-generic-frame wm-ui-all-border'></textarea><br />
								  <br><input type='submit' value='CREATE' class='wm-ui-btn'/>
								  </form></div>";
						echo "Topic is locked, but you still have permission to reply.";
					}else{
						echo "Topic is locked, you can not reply.";
					}
				}
			}
			?>
		</div>
	</div>
	<?php
	$select2 = mysqli_query($con, "SELECT * FROM replies WHERE category_id = $getcid AND subcategory_id = $getscid AND topic_id = $gettid");
	
	?>
	<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
		<div id="wm-error-page">
			<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong><br>
			<?php // if($page_no > 1){ echo "<li><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=1'>First Page</a></li>"; } ?>
			
			<b><a <?php if($page_no > 1){ echo "href='/forum/replyto/$getcid/$getscid/$gettid&page_no=$previous_page'"; } ?>>Previous&nbsp;&nbsp;</a></b>
			   
			<?php 
			if ($total_no_of_pages <= 10){  	 
				for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
					if ($counter == $page_no) {
						echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
					}else{
						echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
					}
				}
			}elseif($total_no_of_pages > 10){
				if($page_no <= 4) {			
					for ($counter = 1; $counter < 8; $counter++){		 
						if ($counter == $page_no) {
							echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
						}else{
							echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
						}
					}
					echo "<b><a>...</a></b>";
					echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=$second_last'>&nbsp;&nbsp;$second_last&nbsp;&nbsp;</a></b>";
					echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=$total_no_of_pages'>&nbsp;&nbsp;$total_no_of_pages&nbsp;&nbsp;</a></b>";
				}elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
					echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=1'>&nbsp;&nbsp;1&nbsp;&nbsp;</a></b>";
					echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=2'>&nbsp;&nbsp;2&nbsp;&nbsp;</a></b>";
					echo "<b><a>...</a></b>";
					for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
						if ($counter == $page_no) {
							echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
						}else{
							echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
						}                  
				   }
				   echo "<b><a>...</a></b>";
				   echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=$second_last'>&nbsp;&nbsp;$second_last&nbsp;&nbsp;</a></b>";
				   echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=$total_no_of_pages'>&nbsp;&nbsp;$total_no_of_pages&nbsp;&nbsp;</a></b>";      
				}else {
					echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=1'>&nbsp;&nbsp;1&nbsp;&nbsp;</a></b>";
					echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=2'>&nbsp;&nbsp;2&nbsp;&nbsp;</a></b>";
					echo "<b><a>...</a></b>";

					for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
						if ($counter == $page_no) {
							echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
						}else{
							echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
						}                   
					}
				}
			}
			?>
    
			<b><a <?php if($page_no < $total_no_of_pages) { echo "href='/forum/replyto/$getcid/$getscid/$gettid&page_no=$next_page'"; } ?>>&nbsp;&nbsp;Next</a></b>
			<?php
			if($page_no < $total_no_of_pages){
				echo "<b><a href='/forum/replyto/$getcid/$getscid/$gettid&page_no=$total_no_of_pages'>&nbsp;&nbsp;Last</a></b>";
			}
			?>
		</div>
	</div>
	<?php
	
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