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
<title><?php echo $sitename; ?> | Account Panel</title>
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
                        <li><a href="/ucp/ucp.php" title="Account Panel">ACCOUNT PANEL</a></li>
                        <li><a href="/download.php" title="Download">DOWNLOAD</a></li>
						<li><a href="/forum/index.php" title="Forum">FORUM</a></li>
            <!--<li><a href="/information.php" title="Information">INFORMATION</a></li>-->
                        <li><a href="/logout.php" title="Logout">LOG OUT</a></li>
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
	<li><a href="/ucp/ucp.php" class="active"><i class="fas fa-user"></i> ACCOUNT PANEL</a></li>
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
			if(isset($_GET['change'])){
                $change = htmlspecialchars($_GET['change']);
            }else{
                ?>
                <center>
                    <p>
                        <font size="6">Invalid action</font>
                    </p>
                    <p>
                        <font size="5">You have not selected any actions.</font>
                    </p> 
				</center>
                <?php
				header( "refresh:5;url=index.php" );
            }
                    
            if($change == "password"){
				
				$curpass = $_POST['curpass'];
				$pass = $_POST['pass'];
				$repass = $_POST['repass'];

				$lgconn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
				$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);

				$nick = $_SESSION["loggedin"];
				
				$sql= "SELECT * FROM account WHERE username = '" . $nick . "' AND sha_pass_hash = '" . sha1(strtoupper($nick).':'.strtoupper($repass)) . "'";
				$result = mysqli_query($lgconn,$sql);
				$user = mysqli_fetch_array($result);

				$sql2= "SELECT * FROM account WHERE username = '" . $nick . "' AND sha_pass_hash = '" . sha1(strtoupper($nick).':'.strtoupper($curpass)) . "'";
				$result2 = mysqli_query($lgconn,$sql2);
				$user2 = mysqli_fetch_array($result2);
				
				$sql3= "SELECT * FROM account WHERE username = '" . $nick . "'";
				$result3= mysqli_query($lgconn,$sql3);
				$user3 = mysqli_fetch_array($result3);
				
				if($nick){
					if (empty($curpass) || empty($pass) || empty($repass)){
						?>
							<center>
							<p><font size="6">Empty fields</font></p>
							<p>
								<font size="5">Complete all fields and try again.</font>
							</p> 
							</center>
							<?php
							header( "refresh:5;url=ucp.php" );
					}else{
						if($curpass && $user2){
							if($pass == $repass){
								if($user['sha_pass_hash'] == $user2['sha_pass_hash']){
									?>
										<center>
										<p><font size="6">Same password</font></p>
										<p>
											<font size="5">You currently have the same password.</font>
										</p> 
										</center>
										<?php
										header( "refresh:5;url=ucp.php" );
								}else{
									if(strlen($repass) < 6){
										?>
										<center>
										<p><font size="6">A short password</font></p>
										<p>
											<font size="5">Your password must contain at least 6 characters.</font>
										</p> 
										</center>
										<?php
										header( "refresh:5;url=ucp.php" );
									}else{
										$passfinal = sha1(strtoupper($nick).':'.strtoupper($repass));
										$sql2 = "UPDATE account SET sha_pass_hash='".$passfinal."' WHERE username='$nick'";
										$insertpass = mysqli_query($lgconn,$sql2);
										$insertlog = mysqli_query($conn, "INSERT INTO logs_acc (`logger`, `logger_id`, `logdetails`, `logdate`) 
										VALUES ('".$_SESSION['loggedin']."', '".$user3['id']."', 'ACCOUNT: User `".$nick."` changed password', NOW());");
										if($insertpass){
											?>
											<center>
											<p><font size="6">Password changed</font></p>
											<p>
												<font size="5">Your password has been changed successfully.</font>
											</p> 
											</center>
											<?php
											unset($_SESSION["loggedin"]);
											session_destroy();
											if(isset($_COOKIE["userRM_login"])) {
												setcookie ("userRM_login","");
											}
											header( "refresh:5;url=ucp.php" );
										}else{
											?>
											<center>
											<p><font size="6">Error when updating</font></p>
											<p>
												<font size="5">An error occurred while updating the password.</font>
											</p> 
											</center>
											<?php
											header( "refresh:5;url=ucp.php" );
										}
									}
								}
							}else{
								?>
										<center>
										<p><font size="6">Passwords mismatch</font></p>
										<p>
											<font size="5">The entered passwords are not the same.</font>
										</p> 
										</center>
										<?php
										header( "refresh:5;url=ucp.php" );
							}
						}else{
							?>
										<center>
										<p><font size="6">Wrong password</font></p>
										<p>
											<font size="5">Your current password does not match.</font>
										</p> 
										</center>
										<?php
										header( "refresh:5;url=ucp.php" );
						}
					}
				}else{
					header( "Location: index.php" );
				}
				mysqli_close($lgconn);
				mysqli_close($conn);

			}elseif($change == "location"){
				$country = $_POST['location'];

				$lgconn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
				$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);

				$nick = $_SESSION["loggedin"];
				
				$sql3= "SELECT * FROM account WHERE username = '" . $nick . "'";
				$result3= mysqli_query($lgconn,$sql3);
				$user3 = mysqli_fetch_array($result3);
				
				if($nick){
									if(strlen($country) > 15){
										?>
										<center>
										<p><font size="6">A long location</font></p>
										<p>
											<font size="5">Your country must contain less than 15 characters.</font>
										</p> 
										</center>
										<?php
										header( "refresh:5;url=ucp.php" );
									}else{
										$sql2 = "UPDATE account SET location='$country' WHERE username='$nick'";
										$insertdetails = mysqli_query($lgconn,$sql2);
										if($insertdetails){
											?>
											<center>
											<p><font size="6">Details changed</font></p>
											<p>
												<font size="5">Your profile details has been changed successfully.</font>
											</p> 
											</center>
											<?php
											header( "refresh:5;url=ucp.php" );
										}else{
											?>
											<center>
											<p><font size="6">Error when updating</font></p>
											<p>
												<font size="5">An error occurred while updating your details.</font>
											</p> 
											</center>
											<?php
											header( "refresh:5;url=ucp.php" );
										}
									}
				}else{
					header( "Location: index.php" );
				}
				mysqli_close($lgconn);
				mysqli_close($conn);
			}elseif($change == "mail"){
				$remail = $_POST['remail'];
				$mail = $_POST['mail'];

				$lgconn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
				$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);

				$nick = $_SESSION["loggedin"];
				
				$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
				$result = mysqli_query($lgconn,$sql);
				$user = mysqli_fetch_array($result);

				$sql2= "SELECT * FROM account WHERE email = '" . $remail . "";
				$result2 = mysqli_query($lgconn,$sql2);
				$user2 = mysqli_fetch_array($result2);
				
				$sql3= "SELECT * FROM account WHERE username = '" . $nick . "'";
				$result3= mysqli_query($lgconn,$sql3);
				$user3 = mysqli_fetch_array($result3);
				
				if($nick){
					if (empty($mail) || empty($remail)){
						?>
							<center>
							<p><font size="6">Empty fields</font></p>
							<p>
								<font size="5">Complete all fields and try again.</font>
							</p> 
							</center>
							<?php
							header( "refresh:5;url=ucp.php" );
					}else{
							if($mail == $remail){
								if($remail == $user['email']){
									?>
										<center>
										<p><font size="6">Same emails</font></p>
										<p>
											<font size="5">You currently have the same emails address.</font>
										</p> 
										</center>
										<?php
										header( "refresh:5;url=ucp.php" );
								}else{
									if($user['mailactivated']==1){
										$sql2 = "UPDATE account SET email='".$remail."' WHERE username='$nick'";
										$insertmail = mysqli_query($lgconn,$sql2);
										$sql4 = "UPDATE account SET mailactivated='0' WHERE username='$nick'";
										$insertactivated = mysqli_query($lgconn,$sql4);
										$insertlog = mysqli_query($conn, "INSERT INTO logs_acc (`logger`, `logger_id`, `logdetails`, `logdate`) 
										VALUES ('".$_SESSION['loggedin']."', '".$user3['id']."', 'ACCOUNT: User `".$nick."` changed email (Mail: ".$remail.")', NOW());");
										if($insertmail){
											?>
											<center>
											<p><font size="6">Email changed</font></p>
											<p>
												<font size="5">Your email address has been changed successfully.</font>
											</p> 
											</center>
											<?php
											header( "refresh:5;url=ucp.php" );
										}else{
											?>
											<center>
											<p><font size="6">Error when updating</font></p>
											<p>
												<font size="5">An error occurred while updating the email.</font>
											</p> 
											</center>
											<?php
											header( "refresh:5;url=ucp.php" );
										}
									}else{
										?>
											<center>
											<p><font size="6">Error when updating</font></p>
											<p>
												<font size="5">In order to change your mail you must have already activated mail.</font>
											</p> 
											</center>
											<?php
											header( "refresh:5;url=ucp.php" );
									}
								}
							}else{
								?>
										<center>
										<p><font size="6">Emails mismatch</font></p>
										<p>
											<font size="5">The entered addresses are not the same.</font>
										</p> 
										</center>
										<?php
										header( "refresh:5;url=ucp.php" );
							}
					}
				}else{
					header( "Location: index.php" );
				}
				mysqli_close($lgconn);
				mysqli_close($conn);
			}else{
				?>
                <center>
                    <p>
                        <font size="6">No action choosed</font>
                    </p>
                    <p>
                        <font size="5">You have not selected an action.</font>
                    </p> 
				</center>
                <?php
			}
			?>     
		</div>
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