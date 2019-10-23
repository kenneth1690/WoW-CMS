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
						<li><a href="/armory/index.php" title="Armory">ARMORY</a></li>
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
					$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
					$getcid = $_GET['cid'];
					$getscid = $_GET['scid'];
					$select = mysqli_query($conn, "SELECT * FROM `subcategories` WHERE `subcat_id`='$getscid'");
					$row = mysqli_fetch_assoc($select);
					$select2 = mysqli_query($conn, "SELECT * FROM `categories` WHERE `cat_id`='$getcid'");
					$row2 = mysqli_fetch_assoc($select2);
					?>
    	    		<li><a href="/forum/" class="active">Forum</a></li>
					<li>></li>
					<li><a href="<?php echo "/forum/topics/".$_GET['cid']."/".$_GET['scid'].""; ?>" class="active"><?php echo $row2['category_title']; ?></a></li>
            		<li>></li>
					<li><a href="<?php echo "/forum/topics/".$_GET['cid']."/".$_GET['scid'].""; ?>" class="active"><?php echo $row['subcategory_title']; ?></a></li>
            </ul>
    <ul>
        <li><?php
		$dt = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
		echo $dt->format('H:i');
		?></li>
    </ul>
</div>


<div class="content-wrapper">
	<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
		<div id="wm-error-page">
			<?php
					session_start();
					$getscid = $_GET['scid'];
					$select = mysqli_query($conn, "SELECT * FROM `subcategories` WHERE `subcat_id`='$getscid'");
					$row = mysqli_fetch_assoc($select);
					
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
					
					if (isset($_SESSION['loggedin'])) {
						if($row['special']>0){
							if($rowsgm['gmlevel']>0){
								echo "
								<form action='/forum/newtopic/".$_GET['cid']."/".$_GET['scid']."'>
										<input type='submit' value='CREATE NEW TOPIC' class='wm-ui-btn'/>
								</form>";
								echo "Category only for GM's, but you still have permission to create topic.";
							}else{
								echo "Category only for GM's, you can not create topic.";
							}
						}else{
							echo "
								<form action='/forum/newtopic/".$_GET['cid']."/".$_GET['scid']."'>
										<input type='submit' value='CREATE NEW TOPIC' class='wm-ui-btn'/>
								</form>";
						}
					}
				?>
				
		</div>
	</div>
	<?php
		$getcid = $_GET['cid'];
		$getscid = $_GET['scid'];
		$select = mysqli_query($conn, "SELECT * FROM topics WHERE category_id = $getcid AND subcategory_id = $getscid ORDER BY pinned=1 DESC, topic_id DESC");
		if (mysqli_num_rows($select) != 0) {
			echo "<table id='categories'>";
			echo "<tr><th width='30%'>Title</th><th>Posted By</th><th>Date Posted</th><th width='8%'>Views</th><th width='8%'>Replies</th></tr>";
			
			if (isset($_GET['page_no']) && $_GET['page_no']!="") {
				$page_no = $_GET['page_no'];
			}else{
				$page_no = 1;
			}
			
			$cmsconn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
			
			$total_records_per_page = 10;
			$offset = ($page_no-1) * $total_records_per_page;
			$previous_page = $page_no - 1;
			$next_page = $page_no + 1;
			$adjacents = "2"; 

			$result_count = mysqli_query($cmsconn,"SELECT COUNT(*) As total_records FROM `topics`");
			$total_records = mysqli_fetch_array($result_count);
			$total_records = $total_records['total_records'];
			$total_no_of_pages = ceil($total_records / $total_records_per_page);
			$second_last = $total_no_of_pages - 1; // total page minus 1
			
			$result = mysqli_query($cmsconn,"SELECT * FROM topics WHERE category_id = $getcid AND subcategory_id = $getscid ORDER BY pinned=1 DESC, topic_id DESC LIMIT $offset, $total_records_per_page");
			while ($row = mysqli_fetch_assoc($result)) {
				?>
				<tr><td><a href='/forum/readtopic/<?php echo $getcid; ?>/<?php echo $getscid; ?>/<?php echo $row['topic_id']; ?>'>
					 <?php
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
					?><?php
						if(strlen($row['title'])>16){
							echo substr($row['title'], 0, 16);
							echo "...";
						}else{
							echo $row['title'];
						}
					?></a></td><td><?php echo $row['author']; ?></td><td><?php echo $row['date_posted']; ?></td><td><?php echo $row['views']; ?></td>
					 <td><?php echo $row['replies']; ?></td></tr>
				<?php
			}
			echo "</table>";
		} else {
			echo "<table id='categories'><tr><th>This category has no topics yet! <a href='/forum/newtopic/".$cid."/".$scid."'>
				 Add the very first topic like a boss!</a></th></tr></table>";
		}
	?>
	<?php
	if (mysqli_num_rows($select) > 10) {
	?>
	<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
		<div id="wm-error-page">
			<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong><br>
			<?php // if($page_no > 1){ echo "<li><a href='/forum/topics/$getcid/$getscid&page_no=1'>First Page</a></li>"; } ?>
			
			<b><a <?php if($page_no > 1){ echo "href='/forum/topics/$getcid/$getscid&page_no=$previous_page'"; } ?>>Previous&nbsp;&nbsp;</a></b>
			   
			<?php 
			if ($total_no_of_pages <= 10){  	 
				for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
					if ($counter == $page_no) {
						echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
					}else{
						echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
					}
				}
			}elseif($total_no_of_pages > 10){
				if($page_no <= 4) {			
					for ($counter = 1; $counter < 8; $counter++){		 
						if ($counter == $page_no) {
							echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
						}else{
							echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
						}
					}
					echo "<b><a>...</a></b>";
					echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=$second_last'>&nbsp;&nbsp;$second_last&nbsp;&nbsp;</a></b>";
					echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=$total_no_of_pages'>&nbsp;&nbsp;$total_no_of_pages&nbsp;&nbsp;</a></b>";
				}elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
					echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=1'>&nbsp;&nbsp;1&nbsp;&nbsp;</a></b>";
					echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=2'>&nbsp;&nbsp;2&nbsp;&nbsp;</a></b>";
					echo "<b><a>...</a></b>";
					for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
						if ($counter == $page_no) {
							echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
						}else{
							echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
						}                  
				   }
				   echo "<b><a>...</a></b>";
				   echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=$second_last'>&nbsp;&nbsp;$second_last&nbsp;&nbsp;</a></b>";
				   echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=$total_no_of_pages'>&nbsp;&nbsp;$total_no_of_pages&nbsp;&nbsp;</a></b>";      
				}else {
					echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=1'>&nbsp;&nbsp;1&nbsp;&nbsp;</a></b>";
					echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=2'>&nbsp;&nbsp;2&nbsp;&nbsp;</a></b>";
					echo "<b><a>...</a></b>";

					for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
						if ($counter == $page_no) {
							echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
						}else{
							echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
						}                   
					}
				}
			}
			?>
    
			<b><a <?php if($page_no < $total_no_of_pages) { echo "href='/forum/topics/$getcid/$getscid&page_no=$next_page'"; } ?>>&nbsp;&nbsp;Next</a></b>
			<?php
			if($page_no < $total_no_of_pages){
				echo "<b><a href='/forum/topics/$getcid/$getscid&page_no=$total_no_of_pages'>&nbsp;&nbsp;Last</a></b>";
			}
			?>
		</div>
	</div>
	<?php
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