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

$username = $_POST['userID'];
if(isset($_SESSION["loggedin"]) && !empty($_SESSION["loggedin"])){
    header("location: index.php");
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
<title><?php echo $sitename; ?> | Create an Account</title>
<link rel="stylesheet" href="/css/global.css">
<link rel="stylesheet" href="/css/ui.css">
<link rel="stylesheet" href="/css/font-awesomeS.min.css">
<link rel="stylesheet" href="/css/wm-contextmenu.css">
<script async="" src="//www.google-analytics.com/analytics.js"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="/script/ui.js?v=56"></script>
<script src="/script/jquery.wm-listener.js"></script>
<script src="/script/warmane.js?v=57"></script>
<script src="/script/jquery.wm.bpopup.js"></script>
<script src="/script/jquery.wm-contextmenu.js"></script>
</head>
<body>
<noscript>
    &lt;div id="noscript-override"&gt;
        &lt;p&gt;This site makes extensive use of JavaScript.&lt;/b&gt;&lt;br&gt;Please &lt;a href="https://www.google.com/support/adsense/bin/answer.py?answer=12654" target="_blank"&gt;enable JavaScript&lt;/a&gt; in your browser.&lt;/p&gt;
    &lt;/div&gt;
</noscript>
<div class="navigation-wrapper">
    <a href="/" class="navigation-logo"></a>
    <div class="navigation">
        <ul class="navbits">
						<li><a href="/create.php" title="Create Account">CREATE ACCOUNT</a></li>
                        <li><a href="/download.php" title="Download">DOWNLOAD</a></li>
						<li><a href="/forum/index.php" title="Forum">FORUM</a></li>
            <!--<li><a href="/information.php" title="Information">INFORMATION</a></li>-->

						<li><a href="/login.php" title="Login">LOG IN</a></li>
                    </ul>        
    </div>
</div>
<script>
function handlePress(evt){
    evt = (evt) ? evt : ((window.event) ? event :null);
    if(evt){
      if(evt.keyCode==70 && evt.altKey){
        return false;
      }
    }
  }
  document.onkeyup = handlePress;
</script>
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
    	    		<li><a href="#" class="active">CREATE AN ACCOUNT</a></li>
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
    	<form action="created.php" method="post">
        <table>
            <tbody><tr>
                <td><span class="wm-ui-form-identifier">Account name</span></td>
            </tr>
            <tr>
                <td><input class="wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border" type="text" maxlength="25" name="userID" id="userID" required=""></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><span class="wm-ui-form-identifier">Password</span></td>
            </tr>
            <tr>
                <td><input class="wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border" type="password" maxlength="25" name="userPW" id="userPW" required=""></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><span class="wm-ui-form-identifier">Confirm password</span></td>
            </tr>
            <tr>
                <td><input class="wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border" type="password" maxlength="25" name="userConfirmPW" id="userConfirmPW" required=""></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><span class="wm-ui-form-identifier">Email address</span></td>
            </tr>
            <tr>
                <td><input class="wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border" type="text" maxlength="125" name="userEmail" id="userEmail" required=""></td>
            </tr>
        </tbody></table>
    </div>
    <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-two-side-page-ulist wm-ui-left-border wm-ui-top-border">
        <!--<table>
            <tbody><tr>
                <td><span class="wm-ui-form-identifier">Forum username</span></td>
            </tr>
            <tr>
                <td><input class="wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border" type="text" maxlength="25" name="userForumID" id="userForumID" required=""></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                </td>
            </tr>
        </tbody></table>-->
        <div class="wm-ui-position-abottom">
            <div class="wm-ui-checkbox-agreement">
                <input type="checkbox" name="userCM" class="wm-ui-checkbox-generic" id="userCM"><label for="userCM"></label>I agree to <a href="/policies/terms" target="_blank" class="wm-ui-hyper-custom-b">Terms of Service</a> and <a href="/policies/privacy" target="_blank" class="wm-ui-hyper-custom-b">Privacy Policy</a>
            </div>
            <button type="submit" name="registerbtn" class="wm-ui-btn">CREATE AN ACCOUNT</button>
        </div>
    	</form>
	</div>
</div>
<script type="text/javascript">
$(function() {
	$('#frmRegister').on('submit', function(e) {
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			url: '/account/create', 
			data: $(this).serialize(),
			dataType: 'json',
			success: function (data) {}
		});
		return false;
	});
});
</script>


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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-59798617-1', 'auto');
  ga('send', 'pageview');
</script>

<script>
$(function() {
    $.warmane({
        currentBackground: -1,
        alertTime: 1441896182
    });
    
    });
</script>


</body></html>