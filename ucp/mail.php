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
	<?php
		if(isset($_SESSION["loggedin"])) {
			$nick = $_SESSION["loggedin"];
			$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		}
		$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
		$result = mysqli_query($checkacp,$sql);
		$rows = mysqli_fetch_array($result);
		
		$idcheck = $rows['id'];
		$ipcheck = $rows['last_ip'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkacp,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		
		?><li><a href="/ucp/ucp.php" class="active"><i class="fas fa-user"></i> ACCOUNT</a></li>
		<li><a href="/ucp/characters.php"><i class="fas fa-users-cog"></i> CHARACTERS</a></li>
		<li><a href="/ucp/donate.php"><i class="fas fa-dollar-sign"></i> DONATE</a></li>
		<li><a href="/ucp/store.php"><i class="fas fa-shopping-cart"></i> STORE</a></li>
		<li><a href="/ucp/trade.php"><i class="fas fa-sync-alt"></i> TRADE</a></li>
		<li><a href="/ucp/support.php"><i class="fas fa-life-ring"></i> SUPPORT</a></li>
		<li><a href="/ucp/lottery.php"><i class="fas fa-ticket-alt"></i> LOTTERY</a></li>
		<li><a href="/ucp/settings.php"><i class="fas fa-cog"></i> SETTINGS</a></li>
		<?php
		$howmuchnotis = mysqli_query($conn, "SELECT * FROM notifications WHERE user = '".$idcheck."' AND readed = 0");
		$rowsnotis = mysqli_fetch_array($howmuchnotis);
		if(mysqli_num_rows($howmuchnotis)>0){
			?>
			<li><a href="/ucp/notifications.php"><i class="fas fa-bell"></i> <?php echo mysqli_num_rows($howmuchnotis); ?></a></li>
			<?php
		}else{
			?>
			<li><a href="/ucp/notifications.php"><i class="fas fa-bell"></i> 0</a></li>
			<?php
		}
		?>
		</ul>
		<ul>
		<?php
		if($rowsgm && $rowsgm['gmlevel']>0){ 
			?>
			<li><a href="/acp/acp.php"><i class="fas fa-user-secret"></i> ADMIN</a></li>
			<?php
		}
		mysqli_close($checkacp);
		?>
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
            $authconn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port); 
			$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
			
            $sql= "SELECT * FROM account WHERE username = '" . $_SESSION["loggedin"] . "'";
            $result = mysqli_query($authconn,$sql);
            $user = mysqli_fetch_array($result);
			
			$nick = $_SESSION["loggedin"];

            if(!isset($_SESSION["loggedin"]) && empty($_SESSION["loggedin"])){
                header( "refresh:5;url=index.php" );
                ?>
                <center>
                    <p>
                        <font size="6">Not logged in</font>
                    </p>
                    <p>
                        <font size="5">You must be logged in to activate mail.</font>
                    </p> 
				</center>
                <?php
				header( "refresh:5;url=index.php" );
                die();
            }

            if(isset($_GET['action'])){
                $action = htmlspecialchars($_GET['action']);
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
                    
            if($action == "activate"){
                if(isset($_GET['token'])){
                    $token = htmlspecialchars($_GET['token']);
                    $convmail = md5($user['email']);
                    if($_GET['token']==$convmail){
                        if($user['mailactivated']==1){
                            ?>
                            <center>
                                <p>
                                    <font size="6">Invalid activation</font>
                                </p>
                                <p>
                                    <font size="5">Your address email is already activated.</font>
                                </p> 
                            </center>
                            <?php
							header( "refresh:5;url=index.php" );
                        }else{
                            $mail = $user['email'];
                            mysqli_query($authconn, "UPDATE account SET mailactivated='1' WHERE email='".$mail."'");
							$sendnoti = mysqli_query($con, "INSERT INTO notifications (`title`, `notification`, `user`) VALUES ('Email Verified', 'Hey, ".$nick."! You successfully verified your email address. Pogchamp!', '".$user['id']."')");
							$insertlog = mysqli_query($con, "INSERT INTO logs_acc (`logger`, `logger_id`, `logdetails`, `logdate`) 
								  VALUES ('".$_SESSION['loggedin']."', '".$user['id']."', 'ACCOUNT: User `".$nick."` verified email (Mail: ".$mail.")', NOW());");
							
                            ?>
                            <center>
                                <p>
                                    <font size="6">Successfully activated</font>
                                </p>
                                <p>
                                    <font size="5">Your email has been successfully activated.</font>
                                </p> 
                            </center>
                            <?php
							header( "refresh:5;url=index.php" );
                        }
                    }else{
                        ?>
                        <center>
                            <p>
                                <font size="6">Invalid token</font>
                            </p>
                            <p>
                                <font size="5">The token you provided is not valid.</font>
                            </p> 
                        </center>
                        <?php
						header( "refresh:5;url=index.php" );
                    }
                }else{
                    ?>
                    <center>
                        <p>
                            <font size="6">Invalid token</font>
                        </p>
                        <p>
                            <font size="5">The token you provided is not valid.</font>
                        </p> 
					</center>
                    <?php
					header( "refresh:5;url=index.php" );
                }
            }elseif($action == "generate"){
                if($user['mailactivated']==1){
                    ?>
                    <center>
                        <p>
                            <font size="6">Invalid activation</font>
                        </p>
                        <p>
                            <font size="5">Your address email is already activated.</font>
                        </p> 
					</center>
                    <?php
					header( "refresh:5;url=index.php" );
                }else{
                    $newtoken = md5($user['email']);
                    $yourmail = $user['email'];
                    $to = $yourmail;
                    $subject = $sitename." | Email Activation";
                    $message = "Hello, \nthank you ".$_SESSION['loggedin']." for deciding to activate your email.\n\nIn order to do this, click link right there:\n".htmlentities("http://".$_SERVER['SERVER_NAME']."/ucp/mail.php?action=activate")."&".htmlentities("token=".$newtoken);
                    $headers = "From: ".$sitename;

                    mail($to, $subject, $message, $headers);
                    ?>
                    <center>
                        <p>
                            <font size="6">Successfully generated</font>
                        </p>
                        <p>
                            <font size="5">An activation link was sent to the email.</font>
                        </p> 
					</center>
                    <?php
					header( "refresh:5;url=index.php" );
                }
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
				header( "refresh:5;url=index.php" );
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