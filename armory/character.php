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
    	    		<li><a href="/armory/character.php" class="active"><i class="fas fa-user-ninja"></i> CHARACTER</a></li>
            		<li><a href="/armory/guild.php"><i class="fas fa-users"></i> GUILD</a></li>
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
			if(isset($_GET['charid'])){
					$charid = $_GET['charid'];
            		$conn = mysqli_connect($db_host, $db_username, $db_password, $chars_db_name, $db_port);
            		$nick = $_SESSION["loggedin"];
					$checkchar = mysqli_query($conn, 'SELECT * FROM characters WHERE guid="'.$charid.'"');
                	if(mysqli_num_rows($checkchar)>0){
						$reschar = mysqli_query($conn, 'SELECT * FROM characters WHERE guid="'.$charid.'"');
						$rowschar = mysqli_fetch_array($reschar);
						
						$eq = $rowschar["equipmentCache"];
						$seteq = explode(" ", $eq);
						?>
						<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: auto;">
								<?php
								$sql13 = "SELECT * FROM guild_member WHERE guid = '" . $charid. "'";
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
										<td>Name: <font color="white"><?php echo $rowschar['name']; ?></font> (ID: <font color="white"><?php echo $rowschar['guid']; ?></font>)</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>Level & XP: <font color="white"><?php echo $rowschar['level']; ?></font> (<font color="white"><?php echo $rowschar['xp']; ?> XP</font>)
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
											Human 
											<?php
											if($rowschar['gender']==1){
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
										}elseif($rowschar['race']==2){
											?>
											Orc 
											<?php
											if($rowschar['gender']==1){
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
										}elseif($rowschar['race']==3){
											?>
											Dwarf 
											<?php
											if($rowschar['gender']==1){
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
										}elseif($rowschar['race']==4){
											?>
											Night Elf 
											<?php
											if($rowschar['gender']==1){
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
										}elseif($rowschar['race']==5){
											?>
											Undead 
											<?php
											if($rowschar['gender']==1){
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
										}elseif($rowschar['race']==6){
											?>
											Tauren 
											<?php
											if($rowschar['gender']==1){
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
										}elseif($rowschar['race']==7){
											?>
											Gnome 
											<?php
											if($rowschar['gender']==1){
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
										}elseif($rowschar['race']==8){
											?>
											Troll 
											<?php
											if($rowschar['gender']==1){
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
										}elseif($rowschar['race']==10){
											?>
											Blood Elf 
											<?php
											if($rowschar['gender']==1){
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
										}elseif($rowschar['race']==11){
											?>
											Draenei 
											<?php
											if($rowschar['gender']==1){
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
										</font></td>
									</tr>
									<tr>
										<td>Class: <font color="white">
										<?php
										if($rowschar['class']==1){
											?>
											<font color="C79C6E">Warrior</font> <img src="/uploads/account/classes/warrior.gif">
											<?php
										}elseif($rowschar['class']==2){
											?>
											<font color="F58CBA">Paladin</font> <img src="/uploads/account/classes/paladin.gif">
											<?php
										}elseif($rowschar['class']==3){
											?>
											<font color="ABD473">Hunter</font> <img src="/uploads/account/classes/hunter.gif">
											<?php
										}elseif($rowschar['class']==4){
											?>
											<font color="FFF569">Rogue</font> <img src="/uploads/account/classes/rogue.gif">
											<?php
										}elseif($rowschar['class']==5){
											?>
											<font color="FFFFFF">Priest</font> <img src="/uploads/account/classes/priest.gif">
											<?php
										}elseif($rowschar['class']==6){
											?>
											<font color="C41F3B">Death Knight</font> <img src="/uploads/account/classes/deathknight.gif">
											<?php
										}elseif($rowschar['class']==7){
											?>
											<font color="0070DE">Shaman</font> <img src="/uploads/account/classes/shaman.gif">
											<?php
										}elseif($rowschar['class']==8){
											?>
											<font color="40C7EB">Mage</font> <img src="/uploads/account/classes/mage.gif">
											<?php
										}elseif($rowschar['class']==9){
											?>
											<font color="8787ED">Warlock</font> <img src="/uploads/account/classes/warlock.gif">
											<?php
										}elseif($rowschar['class']==11){
											?>
											<font color="FF7D0A">Druid</font> <img src="/uploads/account/classes/druid.gif">
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
											$sql14 = "SELECT * FROM guild_member WHERE guid = '" . $charid. "'";
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
								</tbody></table><br><br>
								<span>CHARACTER GUILD</span>
						</div>
						<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: auto;">
						<span>CHARACTER EQUIPMENT</span><br>
						<br>
						Head: 
						<?php 
						if($seteq[0]!=0){ // Head /0
							?>
							<a href="#" rel="item=<?php echo $seteq[0]?>">Head</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>Neck: 
						<?php 
						if($seteq[2]!=0){ // Neck /2
							?>
							<a href="#" rel="item=<?php echo $seteq[2]?>">Neck</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>Shoulder: 
						<?php 
						if($seteq[4]!=0){ // Shoulder /4
							?>
							<a href="#" rel="item=<?php echo $seteq[4]?>">Shoulder</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>Back: 
						<?php 
						if($seteq[28]!=0){ // Back /28
							?>
							<a href="#" rel="item=<?php echo $seteq[28]?>">Back</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>Chest: 
						<?php 
						if($seteq[8]!=0){ // Chest /8
							?>
							<a href="#" rel="item=<?php echo $seteq[8]?>">Chest</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>Shirt: 
						<?php 
						if($seteq[6]!=0){ // Shirt /6
							?>
							<a href="#" rel="item=<?php echo $seteq[6]?>">Shirt</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>Tabard: TODO
						<br>Wrist: 
						<?php 
						if($seteq[16]!=0){ // Wrist /16
							?>
							<a href="#" rel="item=<?php echo $seteq[16]?>">Wrist</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>
						<br>Hands: 
						<?php 
						if($seteq[18]!=0){ // Hands /18
							?>
							<a href="#" rel="item=<?php echo $seteq[18]?>">Hands</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>Waist: 
						<?php 
						if($seteq[10]!=0){ // Waist /10
							?>
							<a href="#" rel="item=<?php echo $seteq[10]?>">Waist</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>Legs: 
						<?php 
						if($seteq[12]!=0){ // Legs /12
							?>
							<a href="#" rel="item=<?php echo $seteq[12]?>">Legs</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>Feet: 
						<?php 
						if($seteq[14]!=0){ // Feet /14
							?>
							<a href="#" rel="item=<?php echo $seteq[14]?>">Feet</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>1st Finger: 
						<?php 
						if($seteq[20]!=0){ // 1st Finger /20
							?>
							<a href="#" rel="item=<?php echo $seteq[20]?>">1st Finger</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>2nd Finger: 
						<?php 
						if($seteq[22]!=0){ // 2nd Finger /22
							?>
							<a href="#" rel="item=<?php echo $seteq[22]?>">2nd Finger</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>1st Trinket: 
						<?php 
						if($seteq[24]!=0){ // 1st Trinket /24
							?>
							<a href="#" rel="item=<?php echo $seteq[24]?>">1st Trinket</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>2nd Trinket: 
						<?php 
						if($seteq[26]!=0){ // 2nd Trinket /26
							?>
							<a href="#" rel="item=<?php echo $seteq[26]?>">2nd Trinket</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>
						<br>1st Hand: 
						<?php 
						if($seteq[30]!=0){ // 1st Hand /30
							?>
							<a href="#" rel="item=<?php echo $seteq[30]?>">1st Hand</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>2nd Hand: 
						<?php 
						if($seteq[32]!=0){ // 2nd Hand /32
							?>
							<a href="#" rel="item=<?php echo $seteq[32]?>">2nd Hand</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>Other: 
						<?php 
						if($seteq[34]!=0){ // Other /34
							?>
							<a href="#" rel="item=<?php echo $seteq[34]?>">Other</a>
							<?php
						}else{
							?>
							Empty
							<?php
						}
						?>
						<br>
						<br>Bags: 
						<?php 
						if($seteq[38]!=0 || $seteq[40]!=0 || $seteq[42]!=0 || $seteq[44]!=0){
							if($seteq[38]!=0){ // Bag /38
								?>
								<br><a href="#" rel="item=<?php echo $seteq[38]?>">Bag</a>
								<?php
							}
							if($seteq[40]!=0){ // Bag /40
								?>
								<br><a href="#" rel="item=<?php echo $seteq[40]?>">Bag</a>
								<?php
							}
							if($seteq[42]!=0){ // Bag /42
								?>
								<br><a href="#" rel="item=<?php echo $seteq[42]?>">Bag</a>
								<?php
							}
							if($seteq[44]!=0){ // Bag /44
								?>
								<br><a href="#" rel="item=<?php echo $seteq[44]?>">Bag</a>
								<?php
							}
						}else{
							?>
							Empty
							<?php
						}
						?>
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
				$conn = mysqli_connect($db_host, $db_username, $db_password, $chars_db_name, $db_port);
				?>
				<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
					<div id="wm-error-page">
						<center>
							<font size='5'><b>Search for character by name or GUID:</b></font><br><br>
								<?php
								$result = mysqli_query($conn, "SELECT * FROM characters");
								?>
								<select id='searchlive'>
									<option>Search for character..</option>
									<?php
									while($row = mysqli_fetch_array($result)){
										?>
										<option value="character.php?charid=<?php echo $row['guid']; ?>"><?php echo $row['name']; ?> (GUID: <?php echo $row['guid']; ?>)</option>
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