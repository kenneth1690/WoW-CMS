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
<title><?php echo $sitename; ?> | Create an Account</title>
<link rel="stylesheet" href="/css/global.css">
<link rel="stylesheet" href="/css/ui.css">
<link rel="stylesheet" href="/css/font-awesomeS.min.css">
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
    <?php
        if(isset($_GET['action'])){
            $action = htmlspecialchars($_GET['action']);
        }else{
            ?>
	<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border">
    	<form action="create.php?action=confirm" method="post">
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
    <?php
    }
    if($action == "confirm"){
        ?>
        <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border">
    	<?php 
		  $regconn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		  
		  if (isset($_POST['registerbtn'])) {
			$username = $_POST['userID'];
			$pass1 = $_POST['userPW'];
			$pass2 = $_POST['userConfirmPW'];
			$email = $_POST['userEmail'];
			$checkbx = $_POST['userCM'];

			$sql_u = "SELECT * FROM account WHERE username='$username'";
			$sql_e = "SELECT * FROM account WHERE email='$email'";
			$res_u = mysqli_query($regconn, $sql_u);
			$res_e = mysqli_query($regconn, $sql_e);

			if (mysqli_num_rows($res_u) > 0) {
			  ?><span class="wm-ui-form-identifier">Account name already taken.<br><br>In a moment you will be taken back to the registration page.</span><?php
			  header( "refresh:5;url=create.php" );
			}else if(mysqli_num_rows($res_e) > 0){
			  ?><span class="wm-ui-form-identifier">Email address already taken.<br><br>In a moment you will be taken back to the registration page.</span><?php
			  header( "refresh:5;url=create.php" );
			}else if(empty($checkbx)){
			  ?><span class="wm-ui-form-identifier">You must agree to <a href="/policies/terms" target="_blank" class="wm-ui-hyper-custom-b">Terms of Service</a> and <a href="/policies/privacy" target="_blank" class="wm-ui-hyper-custom-b">Privacy Policy</a><br><br>In a moment you will be taken back to the registration page.</span><?php
			  header( "refresh:5;url=create.php" );
			}else{
				if(strlen($username) < 4){
					?><span class="wm-ui-form-identifier">Your Account name must be from 4 to 16 characters.<br><br>In a moment you will be taken back to the registration page.</span><?php
					header( "refresh:5;url=create.php" );
				} else if(strlen($username) > 16){
					?><span class="wm-ui-form-identifier">Your Account name must be from 4 to 16 characters.<br><br>In a moment you will be taken back to the registration page.</span><?php
					header( "refresh:5;url=create.php" );
				} else if(preg_match('/[\'^£$%&*()}{@!;:.#~?><>,|=_+¬-]/', $username)){
					?><span class="wm-ui-form-identifier">Your Account name must do not contain special characters.<br><br>In a moment you will be taken back to the registration page.</span><?php
					header( "refresh:5;url=create.php" );
				} else{
					if (preg_match('/(\w)\1{2,}/', $username)) {
						?><span class="wm-ui-form-identifier">Characters in your account name can not be repeated three times in a row.<br><br>In a moment you will be taken back to the registration page.</span><?php
						header( "refresh:5;url=create.php" );
					}else{
						if(!($pass1==$pass2)){
							?><span class="wm-ui-form-identifier">The passwords do not match.<br><br>In a moment you will be taken back to the registration page.</span><?php
							header( "refresh:5;url=create.php" );
						}else{
							if(strlen($pass2) < 6){
								?><span class="wm-ui-form-identifier">Your password must be from at least from 6 characters.<br><br>In a moment you will be taken back to the registration page.</span><?php
								header( "refresh:5;url=create.php" );
							}else{
								if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
									?><span class="wm-ui-form-identifier">Invalid email address format.<br><br>In a moment you will be taken back to the registration page.</span><?php
									header( "refresh:5;url=create.php" );
								} else{
								   $passfinal = sha1(strtoupper($username).':'.strtoupper($pass2));
								   $query = "INSERT INTO account (username, sha_pass_hash, email, expansion) VALUES ('$username', '$passfinal', '$email', '2')";
								   $results = mysqli_query($regconn, $query);

								   $conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
								   $sql3= "SELECT * FROM account WHERE username = '" . $username . "'";
									$result3= mysqli_query($regconn,$sql3);
									$user3 = mysqli_fetch_array($result3);

								   $newtoken = md5($user3['email']);
								   $yourmail = $user3['email'];
								   $to = $yourmail;
								   $subject = $sitename." | Email Activation";
								   $message = "Hello, \nthank you ".$_SESSION['loggedin']." registering, now we invite you to email activation..\n\nIn order to do this, click link right there:\n".htmlentities("http://".$_SERVER['SERVER_NAME']."/ucp/mail.php?action=activate")."&".htmlentities("token=".$newtoken);
								   $headers = "From: ".$sitename;

								   $insertlog = mysqli_query($conn, "INSERT INTO logs_acc (`logger`, `logger_id`, `logdetails`, `logdate`) 
								   VALUES ('".$username."', '".$user3['id']."', 'ACCOUNT: Created Account: `".$username."`', NOW());");
								   mysqli_close($regconn);
									?><span class="wm-ui-form-identifier">Account '<?php echo $username ?>' has been successfully created.<br><br>Now you can join to the WoW server.</span><?php
									header( "refresh:5;url=index.php" );
								} 
							}
						}
					}
				}
			}
		  }
		  mysqli_close($regconn);
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