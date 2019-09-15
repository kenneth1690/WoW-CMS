<?php
session_start();

include("check.php");
include('config/config.php');

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
<title><?php echo $sitename; ?> | Log in</title>
<link rel="stylesheet" href="/css/global.css">
<link rel="stylesheet" href="/css/ui.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
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
    	    		<li><a href="#" class="active">FORGOT</a></li>
            </ul>
    <ul>
        <li><?php
		$dt = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
		echo $dt->format('H:i');
		?></li>
    </ul>
</div>

	
	
<div id="content-wrapper">
    <?php
    if(isset($_GET['what'])){
        $what = htmlspecialchars($_GET['what']);
    }else{
        ?>
        <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
        <div id="wm-error-page">
        <center>
            <p>
                <font size="6">No action choosed</font>
            </p>
            <p>
                <font size="5">You have not selected an action.</font>
            </p> 
        </center>
        </div>
        </div>
        <?php
    }
    
    if($what == "password"){
        if(isset($_GET['action']) || !empty($_GET['action'])){
            $mailsend = $_POST['emailsend'];
            $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $newpass = substr(str_shuffle($alphabet), 0, 8);

            $authconn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port); 
            $sql= "SELECT * FROM account WHERE email = '" . $mailsend . "'";
            $result = mysqli_query($authconn,$sql);
            $user = mysqli_fetch_array($result);

            $yourmail = $user['email'];
            $to = $yourmail;
            $subject = $sitename." | Forgot Password";
            $message = "Hello, \nif you see this message it means that someone wanted to restore your account password.\nHere is the new password for your account:\n ".$newpass."\n\nIf you did not report the password change, change the account email address!";
            $headers = "From: ".$sitename;

            mail($to, $subject, $message, $headers);

            $lgconn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
            $passfinal = sha1(strtoupper($user['username']).':'.strtoupper($newpass));
            $sql2 = "UPDATE account SET sha_pass_hash='".$passfinal."' WHERE email='$mailsend'";
            $insertpass = mysqli_query($lgconn,$sql2);
            ?>
            <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
            <div id="wm-error-page">
            <center>
                <p>
                    <font size="6">New password sent</font>
                </p>
                <p>
                    <font size="5">If this email is existing, you will get new password in mail.</font>
                </p> 
            </center>
            </div>
            </div>
        <?php
        }else{
            ?>
            <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border">
                                    <form action='forgot.php?what=password&action=confirm' method='POST'>
                                        <p>Account Email Address: </p>
                                        <input type='text' id='emailsend' name='emailsend' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/>
                                        <br /><br>
                                        <input type='submit' value='SEND NEW PASSWORD' class='wm-ui-btn'/>
                                    </form>
            </div>
            <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border">
                
            </div>
            <?php
        }
    }elseif(isset($_GET['what'])){
        ?>
        <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
        <div id="wm-error-page">
        <center>
            <p>
                <font size="6">No action choosed</font>
            </p>
            <p>
                <font size="5">You have not selected an action.</font>
            </p> 
        </center>
        </div>
        </div>
        <?php
    }
    ?>
</div>
<script type="text/javascript">
$(function() {
    $('#userID').focus();
	$('#frmLogin').on('submit', function(e) {
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			url: '/account/login', 
			data: $(this).serialize(),
			dataType: 'json',
			success: function (result) {
                if(result.captchaupdate) {
                    $('#captcha').show();
                }
            }
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


</body></html>