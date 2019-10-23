<?php
session_start();

include("check.php");
include('config/config.php');

$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
$qr1 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'sitename'");
$qr2 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'siteonline'");
$qr3 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'offlinemessage'");
$qr4 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmlist'");
$qr5 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmname'");

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
    $realmlist = $row['conf_value'];
}
while($row = mysqli_fetch_array($qr5)){
    $realmname = $row['conf_value'];
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
<title><?php echo $sitename; ?> | Download</title>
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
    	    		<li><a href="#" class="active"><i class="fas fa-download"></i> DOWNLOAD</a></li>
            </ul>
    <ul>
        <li><?php
		$dt = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
		echo $dt->format('H:i');
		?></li>
    </ul>
</div>

<div id="content-wrapper">
    <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border">
        <form name="frmDownload" id="frmDownload" method="post" action="magnet:?xt=urn:btih:033E77FB1317EB30037F100BF9E7632564538A7F&dn=Wrath%20of%20the%20Lich%20King%203.3.5a%20%28wod%20models%29&tr=udp%3a%2f%2ftracker.publicbt.com%3a80%2fannounce&tr=udp%3a%2f%2ftracker.thepiratebay.org%3a80%2fannounce&tr=udp%3a%2f%2ftracker.openbittorrent.com%3a80%2fannounce&tr=http%3a%2f%2ftracker.thepiratebay.org%3a80%2fannounce">
        <table>
            <tbody>
            <tr>
                <td>Can't download magnet links? Get uTorrent <a href="http://www.utorrent.com/" target="_blank" class="wm-ui-hyper-custom-b">here</a>.</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            </tbody></table>
            <button type="submit" class="wm-ui-btn">DOWNLOAD</button>

        </form>
    </div>
    <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border">
        <table>
            <tbody><tr>
                <td>TUTORIAL</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>- Download the game client</td>
            </tr>
			<tr>
                <td>- Change the realmlist to: set realmlist <?php echo $realmlist; ?></td>
            </tr>
            <tr>
                <td>- Start the game client using WoW.exe, not Launcher.exe</td>
            </tr>
            <tr>
                <td>- Log in using your <?php echo $realmname; ?> account name, not email address</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>You can change realmlist in:<br>
                    WoW Client Folder -> Data -> enUS -> reamlist.wtf<br><br>
                    Need help? Visit our <a href="#" class="wm-ui-hyper-custom-b">Community Forum for guides and tutorials.</a>
                </td>
            </tr>
        </tbody></table>
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