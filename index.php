<?php
session_start();

include("check.php");
include('config/config.php');

$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
$qr1 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'sitename'");
$qr2 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'siteonline'");
$qr3 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'offlinemessage'");
$qr4 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmname'");
$qr5 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmip'");
$qr6 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmport'");

while($row = mysqli_fetch_array($qr1)){
    $sitename = $row['conf_value'];
}
while($row = mysqli_fetch_array($qr2)){
    $siteonline = $row['conf_value'];
}
while($row = mysqli_fetch_array($qr3)){
    $offlinemessage = $row['conf_value'];
}
while($row = mysqli_fetch_array($qr4)){
    $realmname = $row['conf_value'];
}
while($row = mysqli_fetch_array($qr5)){
    $realmip = $row['conf_value'];
}
while($row = mysqli_fetch_array($qr6)){
    $realmport = $row['conf_value'];
}

function getplayercount() {
	$conn=mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
	$querysql="SELECT * FROM characters WHERE online = ?";
	$queryplayers=mysqli_query($conn, $querysql);
	if(mysqli_num_rows($queryplayers) > 0) {
		if(mysqli_num_rows($queryplayers) == 1000){
			?>
			<span style="color: red;">
			<?php
			echo mysqli_num_rows($queryplayers);
			?>
			</span>
			<?php
		}else if(mysqli_num_rows($queryplayers) >= 750){
			?>
			<span style="color: orange;">
			<?php
			echo mysqli_num_rows($queryplayers);
			?>
			</span>
			<?php
		}else{
			echo mysqli_num_rows($queryplayers);
		}
	}else{
		echo 0;
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
<title><?php echo $sitename; ?> | WoW Private Server</title>
<link rel="stylesheet" href="/css/global.css">
<link rel="stylesheet" href="/css/ui.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/wm-contextmenu.css">
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
    	    		<li><a href="/" class="active">NEWS</a></li>
            		<!--<li><a href="/stream" class="">STREAM</a></li>-->
            		<!--<li><a href="/devlog" class="">DEVLOG</a></li>-->
            		<li><a href="/changelog.php">CHANGELOG</a></li>
            		<li><a href="/bugtracker.php">BUGTRACKER</a></li>
            </ul>
    <ul>
        <li><?php
		$dt = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
		echo $dt->format('H:i');
		?></li>
    </ul>
</div>


<div id="content-wrapper">
    <div class="page-articles-left">
        <div id="content-inner" class="wm-ui-generic-frame page-articles wm-ui-top-border wm-ui-right-border">
			
			
			<?php
			$newscon=mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
			// Check connection
			if (mysqli_connect_errno())
			  {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }

			$sql="SELECT * FROM news ORDER BY id DESC";
			$result=mysqli_query($newscon,$sql);

			if(mysqli_num_rows($result)==0){
				?>
				<div class="wm-ui-article-title">
					<p>No news</p>
				</div><br>
				<div class="wm-ui-article-content">
				<p>There's no news actually!</p>
				<p><i>
				Stay tuned!
				</i></p>
				<p>&nbsp;</p>
				</div>
				<?php
			}

			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$newdate = date("F j, Y", strtotime($row['date']));
				$convdate = gmdate("F n, Y", $phpdate);
				?>
				<div class="wm-ui-article-title">
					<p><?php echo $row['title']; ?></p>
					<p><?php echo $newdate; ?></p>
				</div>
				<div class="wm-ui-article-content">
				<p><?php echo $row['content']; ?></p>
				<p><i>
				News by <?php echo $row['author']; ?>
				<?php
				if(!empty($row['edited_by'])){
					?>
					(edited by <?php echo $row['edited_by']; ?>)
					<?php
				}
				?>
				</i></p>
				<p>&nbsp;</p>
				</div>
				<?php
			}
			
			mysqli_close($newscon);
			?>

            
          </div>
    </div>
    <div id="content-inner" class="wm-ui-generic-frame page-articles page-articles-right wm-ui-statisticbox wm-ui-left-border wm-ui-top-border" style="height: auto">
        <table id="wm-ui-plugin-statistics">
			<tbody>
				<tr>
					<td>
						<img src="images/wotlk.png"> <?php echo $realmname; ?>
					</td>
					<td class="statistics">
						<?php echo getplayercount(); ?> players
					</td>
				</tr>
				<tr>
					<td>
						<div class="spacer"></div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div class="seperator"></div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="spacer"></div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<i class="fas fa-eye"></i> Server status: <span><?php
						$connection = @fsockopen($realmip, $realmport);

						if (is_resource($connection)) {
							echo '<span class="server-online">Online</span>';
						} else {
							echo '<span class="server-offline">Offline</span>';
						}
						?></span>
					</td>
				</tr>
			</tbody>
		</table>
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
	Copyright ][ <?php echo $sitename; ?> ][ 2019. All Rights Reserved.
</div>


</body></html>