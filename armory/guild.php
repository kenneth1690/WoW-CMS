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
<title><?php echo $sitename; ?> | Armory</title>
<link rel="stylesheet" href="/css/global.css">
<link rel="stylesheet" href="/css/ui.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/wm-contextmenu.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet"/>
<script type="text/javascript" src="https://wotlkdb.com/static/widgets/power.js"></script><script>var aowow_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": true }</script>
<style>
		#customers {
			  border-collapse: collapse;
			  width: 100%;
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
    	    		<li><a href="/armory/character.php"><i class="fas fa-user-ninja"></i> CHARACTER</a></li>
            		<li><a href="/armory/guild.php"class="active"><i class="fas fa-users"></i> GUILD</a></li>
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
			if(isset($_GET['gid'])){
					$gid = $_GET['gid'];
            		$conn = mysqli_connect($db_host, $db_username, $db_password, $chars_db_name, $db_port);
            		$nick = $_SESSION["loggedin"];
					$checkguild = mysqli_query($conn, 'SELECT * FROM guild WHERE guildid="'.$gid.'"');
					$grow = mysqli_fetch_array($checkguild);
                	if(mysqli_num_rows($checkguild)>0){
						?>
						<table id="customers">
							<tr>
								<th width="20%">Name</th>
								<th width="5%"><center>Class</center></th>
								<th width="5%"><center>Race</center></th>
								<th width="5%"><center>Faction</center></th>
								<th width="5%"><center>Level</center></th>
								<th width="20%">Rank</th>
							</tr>
							<?php
							if (isset($_GET['page_no']) && $_GET['page_no']!="") {
								$page_no = $_GET['page_no'];
							}else{
								$page_no = 1;
							}

							$total_records_per_page = 100;
							$offset = ($page_no-1) * $total_records_per_page;
							$previous_page = $page_no - 1;
							$next_page = $page_no + 1;
							$adjacents = "2"; 

							$result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM `guild_member` WHERE guildid=$gid");
							$total_records = mysqli_fetch_array($result_count);
							$total_records = $total_records['total_records'];
							$total_no_of_pages = ceil($total_records / $total_records_per_page);
							$second_last = $total_no_of_pages - 1; // total page minus 1

							$result = mysqli_query($conn,"SELECT * FROM `guild_member` WHERE guildid=$gid ORDER BY rank DESC LIMIT $offset, $total_records_per_page");
							if($result->num_rows>0){
								while($row = mysqli_fetch_array($result)){
									$charres = mysqli_query($conn, "SELECT * FROM characters WHERE guid = '" . $row['guid']. "'");
									$charrow = mysqli_fetch_array($charres);
									?>
									<tr>
										<?php
											$days = intval(intval($charrow['totaltime']) / (3600*24));
											$hours = (intval($charrow['totaltime']) / 3600) % 24;
											$minutes = (intval($charrow['totaltime']) / 60) % 60;
											
											$money = $charrow['money'];
											$gold = intval($money/10000);
											$money = intval($money%10000);
											$silver = intval($money/100);
											$copper = intval($money%100);
										?>
										<th><div class="tooltip" style="font-weight: normal;"><a href='/armory/character.php?charid=<?php echo $charrow['guid']; ?>'><font color="white"><?php echo $charrow['name']; ?></font> <font color="1df701">(?)</font> 
											<?php
											$sql14 = "SELECT * FROM guild_member WHERE guid = '" . $row['guid']. "'";
											$ifguild = mysqli_query($conn,$sql14);
											$checkguild = mysqli_fetch_array($ifguild);
											
											$guildidthen = $checkguild['guildid'];
											$sql15 = "SELECT * FROM guild WHERE guildid = '" . $guildidthen. "'";
											$ifshowguild = mysqli_query($conn,$sql15);
											$showguild = mysqli_fetch_array($ifshowguild);
											
											$getrank = $checkguild['rank'];
											$showrank = mysqli_query($conn,"SELECT * FROM guild_rank WHERE guildid = '" . $guildidthen. "' AND rid = '" . $getrank . "'");
											$rrank = mysqli_fetch_array($showrank);
											if($charrow['guid']==$grow['leaderguid']){
												?>
												<font color="1df701">*Leader*</font>
												<?php
											}
											?>
											</a>
											<span class="tooltiptext"><font color="FFE4B5">CHARACTER DETAILS</font><br>
											<br><font color="606060">Name: <font color="white"><?php echo $charrow['name']; ?></font> (ID: <font color="white"><?php echo $charrow['guid']; ?></font>)
											<br>Level & XP: <font color="white"><?php echo $charrow['level']; ?></font> (<font color="white"><?php echo $charrow['xp']; ?> XP</font>)
											<br>Money: <img src="/uploads/account/gold.png"> <font color="white"><?php echo $gold; ?></font> / <img src="/uploads/account/silver.png"> <font color="white"><?php echo $silver; ?></font> / <img src="/uploads/account/copper.png"> <font color="white"><?php echo $copper; ?></font>
											<br>Race: 
											<font color="white">
										<?php
										if($charrow['race']==1){
											?>
											Human 
											<?php
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fhuman.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/human.gif">
												<?php
											}
											?>
											<?php
										}elseif($charrow['race']==2){
											?>
											Orc 
											<?php
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/forc.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/orc.gif">
												<?php
											}
											?>
											<?php
										}elseif($charrow['race']==3){
											?>
											Dwarf 
											<?php
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fdwarf.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/dwarf.gif">
												<?php
											}
											?>
											<?php
										}elseif($charrow['race']==4){
											?>
											Night Elf 
											<?php
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fnightelf.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/nightelf.gif">
												<?php
											}
											?>
											<?php
										}elseif($charrow['race']==5){
											?>
											Undead 
											<?php
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fundead.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/undead.gif">
												<?php
											}
											?>
											<?php
										}elseif($charrow['race']==6){
											?>
											Tauren 
											<?php
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/ftauren.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/tauren.gif">
												<?php
											}
											?>
											<?php
										}elseif($charrow['race']==7){
											?>
											Gnome 
											<?php
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fgnome.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/gnome.gif">
												<?php
											}
											?>
											<?php
										}elseif($charrow['race']==8){
											?>
											Troll 
											<?php
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/ftroll.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/troll.gif">
												<?php
											}
											?>
											<?php
										}elseif($charrow['race']==10){
											?>
											Blood Elf 
											<?php
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fbloodelf.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/bloodelf.gif">
												<?php
											}
											?>
											<?php
										}elseif($charrow['race']==11){
											?>
											Draenei 
											<?php
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fdraenei.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/draenei.gif">
												<?php
											}
											?>
											<?php
										}else{
											?>
											Unknown <img src="/uploads/account/unknown.gif">
											<?php
										}
										?>
										</font>
											<br>Class: 
											<font color="white">
										<?php
										if($charrow['class']==1){
											?>
											<font color="C79C6E">Warrior</font> <img src="/uploads/account/classes/warrior.gif">
											<?php
										}elseif($charrow['class']==2){
											?>
											<font color="F58CBA">Paladin</font> <img src="/uploads/account/classes/paladin.gif">
											<?php
										}elseif($charrow['class']==3){
											?>
											<font color="ABD473">Hunter</font> <img src="/uploads/account/classes/hunter.gif">
											<?php
										}elseif($charrow['class']==4){
											?>
											<font color="FFF569">Rogue</font> <img src="/uploads/account/classes/rogue.gif">
											<?php
										}elseif($charrow['class']==5){
											?>
											<font color="FFFFFF">Priest</font> <img src="/uploads/account/classes/priest.gif">
											<?php
										}elseif($charrow['class']==6){
											?>
											<font color="C41F3B">Death Knight</font> <img src="/uploads/account/classes/deathknight.gif">
											<?php
										}elseif($charrow['class']==7){
											?>
											<font color="0070DE">Shaman</font> <img src="/uploads/account/classes/shaman.gif">
											<?php
										}elseif($charrow['class']==8){
											?>
											<font color="40C7EB">Mage</font> <img src="/uploads/account/classes/mage.gif">
											<?php
										}elseif($charrow['class']==9){
											?>
											<font color="8787ED">Warlock</font> <img src="/uploads/account/classes/warlock.gif">
											<?php
										}elseif($charrow['class']==11){
											?>
											<font color="FF7D0A">Druid</font> <img src="/uploads/account/classes/druid.gif">
											<?php
										}else{
											?>
											Unknown <img src="/uploads/account/unknown.gif">
											<?php
										}
										?>
										</font>
										<br>Gender: 
										<?php
										if($charrow['gender']==1){
											?>
											<font color="pink">Female</font> <img src="/uploads/account/female.gif">
											<?php
										}else{
											?>
											<font color="lightblue">Male</font> <img src="/uploads/account/male.gif">
											<?php
										}
										?>
										<br>Faction: 
										<?php
										if($charrow['race']==1 || $charrow['race']==3 || $charrow['race']==4 || $charrow['race']==7 || $charrow['race']==11){
											?>
											<font color="blue">Alliance</font> <img src="/uploads/account/alliance.png">
											<?php
										}else{
											?>
											<font color="red">Horde</font> <img src="/uploads/account/horde.png">
											<?php
										}
										?>
										<br>Guild: 
										<?php
										$sql13 = "SELECT * FROM guild_member WHERE guid = '" . $charrow['guid']. "'";
										$moreguild = mysqli_query($conn,$sql13);
										if(mysqli_num_rows($moreguild)>0){
											$sql14 = "SELECT * FROM guild_member WHERE guid = '" . $charrow['guid']. "'";
											$ifguildm = mysqli_query($conn,$sql14);
											$checkguildm = mysqli_fetch_array($ifguildm);
											
											$guildidthenm = $checkguildm['guildid'];
											$sql15 = "SELECT * FROM guild WHERE guildid = '" . $guildidthenm. "'";
											$ifshowguildm = mysqli_query($conn,$sql15);
											$showguildm = mysqli_fetch_array($ifshowguildm);
											?>
											<font color="white"><?php echo $showguildm['name']; ?></font>
											<?php
										}else{
											?>
											<font color="white">None</font>
											<?php
										}
										?>
										<br>Total playtime: <font color="white">Days: <?php echo $days; ?></font> / <font color="white">Hours: <?php echo $hours; ?></font> / <font color="white">Minutes: <?php echo $minutes; ?></font></font>
											</span>
										</div></th>
										<th><center>
										<?php
										if($charrow['class']==1){
											?>
											<img src="/uploads/account/classes/warrior.gif">
											<?php
										}elseif($charrow['class']==2){
											?>
											<img src="/uploads/account/classes/paladin.gif">
											<?php
										}elseif($charrow['class']==3){
											?>
											<img src="/uploads/account/classes/hunter.gif">
											<?php
										}elseif($charrow['class']==4){
											?>
											<img src="/uploads/account/classes/rogue.gif">
											<?php
										}elseif($charrow['class']==5){
											?>
											<img src="/uploads/account/classes/priest.gif">
											<?php
										}elseif($charrow['class']==6){
											?>
											<img src="/uploads/account/classes/deathknight.gif">
											<?php
										}elseif($charrow['class']==7){
											?>
											<img src="/uploads/account/classes/shaman.gif">
											<?php
										}elseif($charrow['class']==8){
											?>
											<img src="/uploads/account/classes/mage.gif">
											<?php
										}elseif($charrow['class']==9){
											?>
											<img src="/uploads/account/classes/warlock.gif">
											<?php
										}elseif($charrow['class']==11){
											?>
											<img src="/uploads/account/classes/druid.gif">
											<?php
										}else{
											?>
											<img src="/uploads/account/unknown.gif">
											<?php
										}
										?>
										</center>
										</th>
										<th>
										<center>
										<?php
										if($charrow['rowchardetails']==1){
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fhuman.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/human.gif">
												<?php
											}
										}elseif($charrow['race']==2){
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/forc.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/orc.gif">
												<?php
											}
										}elseif($charrow['race']==3){
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fdwarf.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/dwarf.gif">
												<?php
											}
										}elseif($charrow['race']==4){
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fnightelf.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/nightelf.gif">
												<?php
											}
										}elseif($charrow['race']==5){
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fundead.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/undead.gif">
												<?php
											}
										}elseif($charrow['race']==6){
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/ftauren.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/tauren.gif">
												<?php
											}
										}elseif($charrow['race']==7){
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fgnome.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/gnome.gif">
												<?php
											}
										}elseif($charrow['race']==8){
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/ftroll.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/troll.gif">
												<?php
											}
										}elseif($charrow['race']==10){
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fbloodelf.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/bloodelf.gif">
												<?php
											}
										}elseif($charrow['race']==11){
											if($charrow['gender']==1){
												?>
												<img src="/uploads/account/races/fdraenei.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/draenei.gif">
												<?php
											}
										}else{
											?>
											<img src="/uploads/account/unknown.gif">
											<?php
										}
										?>
										</center>
										</th>
										<th>
										<center>
										<?php
										if($charrow['race']==1 || $charrow['race']==3 || $charrow['race']==4 || $charrow['race']==7 || $charrow['race']==11){
											?>
											<img src="/uploads/account/alliance.png">
											<?php
										}else{
											?>
											<img src="/uploads/account/horde.png">
											<?php
										}
										?>
										</center>
										</th>
										<th><center><?php echo $charrow['level']; ?></th>
										<th><?php echo $rrank['rname']; ?></th>
									</tr>
									<?php
								}
							}else{
								?>
								<tr>
									<th colspan="6">No members</th>
								</tr>
								<?php
							}
							mysqli_close($cmsconn);
							?>
						</table>
						<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
							<div id="wm-error-page">
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
						</div>
						<?php
					}else{
						?>
						<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">Invalid Guild ID</font>
							</p>
							<p>
								<font size="5">Guild with that ID not exists.</font>
							</p> 
						</center>
						</div>
					</div>
					<?php
					}
			}else{
				$conn = mysqli_connect($db_host, $db_username, $db_password, $chars_db_name, $db_port);
				?>
				<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
					<div id="wm-error-page">
						<center>
							<font size='5'><b>Search for guild by name or GID:</b></font><br><br>
								<?php
								$result = mysqli_query($conn, "SELECT * FROM guild");
								?>
								<select id='searchlive'>
									<option>Search for guild..</option>
									<?php
									while($row = mysqli_fetch_array($result)){
										?>
										<option value="guild.php?gid=<?php echo $row['guildid']; ?>"><?php echo $row['name']; ?> (GID: <?php echo $row['guildid']; ?>)</option>
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