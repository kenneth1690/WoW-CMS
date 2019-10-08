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
</head>
<body>
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
    	    		<li><a href="#" class="active">LOG IN</a></li>
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
    if(isset($_GET['action'])){
        $action = htmlspecialchars($_GET['action']);
    }else{
    ?>
	<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border">
        <form action="login.php?action=confirm" method="post">
        <input type="hidden" name="return" value="">
        <table>
            <tbody><tr>
                <td><span class="wm-ui-form-identifier">Account name</span></td>
            </tr>
            <tr>
                <td><input class="wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border" type="text" maxlength="25" name="userID" id="userID" required="" value="<?php if(isset($_COOKIE["userRM_login"])) { echo $_COOKIE["userRM_login"]; } ?>"></td>
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
            </tbody>
			</table>
        
        <div class="wm-ui-position-abottom">
            <div class="wm-ui-checkbox-agreement">
                <input type="checkbox" name="userRM" class="wm-ui-checkbox-generic" id="userRM"><label for="userRM"></label>Remember me
            </div>
            <button type="submit" name="loginbtn" id="loginbtn" <?php if(isset($_COOKIE["userRM_login"])) { ?> checked <?php } ?> class="wm-ui-btn">LOG IN</button>
        </div>
        </form>
    </div>
    <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-two-side-page-ulist wm-ui-left-border wm-ui-top-border">
        <ul>
			<li>Need help? Check this out:</li>
            <li><a href="forgot.php?what=password" class="wm-ui-hyper-custom-b">Forgot your account password?</a></li>
        </ul>
    </div>
    <?php
    }
    if($action == "confirm"){
        ?>
        <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border">
    	<?php 
		  $lgconn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		  $conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		  
		  if (isset($_POST['loginbtn'])) {
			$username = $_POST['userID'];
			$pass = $_POST['userPW'];

			$sql= "SELECT * FROM account WHERE username = '" . $username . "' AND sha_pass_hash = '" . sha1(strtoupper($username).':'.strtoupper($pass)) . "'";
			$result = mysqli_query($lgconn,$sql);
			$user = mysqli_fetch_array($result);
			if($user) {
				$_SESSION["UID"] = $user["id"];
				$_SESSION["USERNAME"] = $user["username"];
				$_SESSION["loggedin"] = $user["username"];
				?><span class="wm-ui-form-identifier">You have successfully logged into account '<?php echo $username ?>'.<br><br>Now you can browse the rest of the page.</span><?php
				$insertlog = mysqli_query($conn, "INSERT INTO logs_acc (`logger`, `logger_id`, `logdetails`, `logdate`) 
								  VALUES ('".$_SESSION['loggedin']."', '".$user['id']."', 'ACCOUNT: Logged in to Account: `".$_SESSION['loggedin']."`', NOW());");
				if ($insertlog) {
					header( "refresh:5;url=index.php" );
				}
			}else{
				?><span class="wm-ui-form-identifier">Invalid Account name or Password.<br><br>In a moment you will be taken back to the login page.</span><?php
				header( "refresh:5;url=login.php" );
			}
			mysqli_close($conn);
			mysqli_close($lgconn);
		  }
		?>
	</div>
	<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border">
    	
	</div>
    <?php
    }elseif(isset($_GET['action'])){
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