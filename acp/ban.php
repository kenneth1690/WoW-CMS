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
		}elseif(isset($_SESSION["loggedin"])){
		$nick = $_SESSION["loggedin"];
		$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		
		$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
		$result = mysqli_query($checkacp,$sql);
		$rows = mysqli_fetch_array($result);
		
		$idcheck = $rows['id'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkacp,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		
		if(!$rowsgm || $rowsgm['gmlevel']==0){
			header("location: ../index.php");
			exit;
		}
		mysqli_close($checkacp);
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
<title><?php echo $sitename; ?> | Admin Panel</title>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="minified/themes/default.min.css" />
<script src="minified/sceditor.min.js"></script>
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
	<?php
		if(isset($_SESSION["loggedin"])) {
			$nick = $_SESSION["loggedin"];
			$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		}
		$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
		$result = mysqli_query($checkacp,$sql);
		$rows = mysqli_fetch_array($result);
		
		$idcheck = $rows['id'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkacp,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		
		?><li><a href="/ucp/ucp.php">ACCOUNT PANEL</a></li>
        </ul>
        <ul>
            <?php
		    if($rowsgm && $rowsgm['gmlevel']>0){ 
				?>
				<li><a href="/acp/manageaccs.php" class="active">ACCOUNTS</a></li>
				<?php
                if($rowsgm && $rowsgm['gmlevel']>1){ 
				?>
				<li><a href="/acp/listcontent.php?action=news">NEWS</a></li>  
				<li><a href="/acp/listcontent.php?action=changelogs">CHANGELOGS</a></li>
                <li><a href="/acp/logs.php">LOGS</a></li>
				<?php
				}
				if($rowsgm && $rowsgm['gmlevel']>2){ 
					?>
					<li><a href="/acp/website.php">WEBSITE</a></li>
					<?php
				}
			    ?>
			    <li><a href="/acp/acp.php">ADMIN PANEL</a></li>
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
			<?php 
			if(isset($_GET['action'])){
				$action = htmlspecialchars($_GET['action']);
			}

			if($action == "confirm"){
				if(isset($_GET['id'])){
                    if(!empty($_POST['banreason'])){
                        $conn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
                        $acid = $_GET['id'];
                        $checkac = mysqli_query($conn, 'SELECT * FROM account WHERE id="'.$acid.'"');
                        if(mysqli_num_rows($checkac)>0){
                            $checkban = mysqli_query($conn, 'SELECT * FROM account_banned WHERE active=1 AND id="'.$acid.'"');
                            if(mysqli_num_rows($checkban)>0){
                                ?>
                                <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
                                <div id="wm-error-page">
                                <center>
                                    <p>
                                        <font size="6">Already banned</font>
                                    </p>
                                    <p>
                                        <font size="5">You want to ban player who is already banned.</font>
                                    </p> 
                                </center>
                                </div>
                                </div>
                                <?php
                                header("refresh:5;url=acp.php");
                            }else{
                                $checkgm = mysqli_query($conn, 'SELECT * FROM account_access WHERE id="'.$acid.'"');
                                if(mysqli_num_rows($checkgm)>0){
                                    if($rowsgm['gmlevel']==4){
                                        $bantime = time();
                                        $bandays = $_POST['bandays'];
                                        $banreason = $_POST['banreason'];
                                        $finalbantime = time() + ($bandays*24)*60*60;
                                        mysqli_query($conn, 'INSERT INTO account_banned (id, bandate, unbandate, bannedby, banreason, active) VALUES ("'.$acid.'", "'.$bantime.'", "'.$finalbantime.'", "'.$nick.'", "'.$banreason.'", 1)');
                                        ?>
                                        <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
                                        <div id="wm-error-page">
                                        <center>
                                            <p>
                                                <font size="6">Banned successfully</font>
                                            </p>
                                            <p>
                                                <font size="5">Player has been banned successfully.</font>
                                            </p> 
                                        </center>
                                        </div>
                                        </div>
                                        <?php
                                        header("refresh:5;url=acp.php");
                                    }else{
                                        ?>
                                        <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
                                        <div id="wm-error-page">
                                        <center>
                                            <p>
                                                <font size="6">Access denied</font>
                                            </p>
                                            <p>
                                                <font size="5">You want to ban GM but you're not allowed to do that.</font>
                                            </p> 
                                        </center>
                                        </div>
                                        </div>
                                        <?php
                                        header("refresh:5;url=acp.php");
                                    }
                                }else{
                                        $bantime = time();
                                        $bandays = $_POST['bandays'];
                                        $banreason = $_POST['banreason'];
                                        $finalbantime = time() + ($bandays*24)*60*60;
                                        mysqli_query($conn, 'INSERT INTO account_banned (id, bandate, unbandate, bannedby, banreason, active) VALUES ("'.$acid.'", "'.$bantime.'", "'.$finalbantime.'", "'.$nick.'", "'.$banreason.'", 1)');
                                        ?>
                                        <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
                                        <div id="wm-error-page">
                                        <center>
                                            <p>
                                                <font size="6">Banned successfully</font>
                                            </p>
                                            <p>
                                                <font size="5">Player has been banned successfully.</font>
                                            </p> 
                                        </center>
                                        </div>
                                        </div>
                                        <?php
                                        header("refresh:5;url=acp.php");
                                }
                            }
                        }else{
                            ?>
                            <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
                            <div id="wm-error-page">
                            <center>
                                <p>
                                    <font size="6">No player</font>
                                </p>
                                <p>
                                    <font size="5">Player with that ID is not exist.</font>
                                </p> 
                            </center>
                            </div>
                            </div>
                            <?php
                            header("refresh:5;url=acp.php");
                        }
                    }else{
                        ?>
                        <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
                            <div id="wm-error-page">
                            <center>
                                <p>
                                    <font size="6">Empty fields</font>
                                </p>
                                <p>
                                    <font size="5">Complete all fields and do it again.</font>
                                </p> 
                            </center>
                            </div>
                        </div>
                        <?php
                        header("refresh:5;url=acp.php");
                    }
                }else{
                    ?>
                    <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">No player selected</font>
							</p>
							<p>
								<font size="5">You have not selected a player ID.</font>
							</p> 
						</center>
						</div>
					</div>
					<?php
					header("refresh:5;url=acp.php");
                }
			}else{
				if(isset($_GET['id'])){
                    $conn = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
                    $acid = $_GET['id'];
                    $checkac = mysqli_query($conn, 'SELECT * FROM account WHERE id="'.$acid.'"');
                	if(mysqli_num_rows($checkac)>0){
                        $checkban = mysqli_query($conn, 'SELECT * FROM account_banned WHERE active=1 AND id="'.$acid.'"');
                        if(mysqli_num_rows($checkban)>0){
                            ?>
                            <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
                            <div id="wm-error-page">
                            <center>
                                <p>
                                    <font size="6">Already banned</font>
                                </p>
                                <p>
                                    <font size="5">You want to ban player who is already banned.</font>
                                </p> 
                            </center>
                            </div>
                            </div>
                            <?php
                            header("refresh:5;url=acp.php");
                        }else{
                            $checkgm = mysqli_query($conn, 'SELECT * FROM account_access WHERE id="'.$acid.'"');
                            if(mysqli_num_rows($checkgm)>0){
                                if($rowsgm['gmlevel']==4){
                                    ?>
                                    <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
		                            <div id="wm-error-page">
                                    <form action='ban.php?id=<?php echo $_GET['id']; ?>&action=confirm' method='POST'>
                                        <p>Ban days (empty for perm): </p>
                                        <input type='text' id='bandays' name='bandays' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/>
                                        <p>Ban reason: </p>
                                        <input type='text' id='banreason' name='banreason' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/>
                                        <br /><br>
                                        <input type='submit' value='CONFIRM BAN' class='wm-ui-btn'/>
                                    </form>
                                    </div>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
                                    <div id="wm-error-page">
                                    <center>
                                        <p>
                                            <font size="6">Access denied</font>
                                        </p>
                                        <p>
                                            <font size="5">You want to ban GM but you're not allowed to do that.</font>
                                        </p> 
                                    </center>
                                    </div>
                                    </div>
                                    <?php
                                    header("refresh:5;url=acp.php");
                                }
                            }else{
                                ?>
                                    <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
		                            <div id="wm-error-page">
                                    <form action='ban.php?id=<?php echo $_GET['id']; ?>&action=confirm' method='POST'>
                                        <p>Ban days (empty for perm): </p>
                                        <input type='text' id='bandays' name='bandays' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/>
                                        <p>Ban reason: </p>
                                        <input type='text' id='banreason' name='banreason' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/>
                                        <br /><br>
                                        <input type='submit' value='CONFIRM BAN' class='wm-ui-btn'/>
                                    </form>
                                    </div>
                                    </div>
                                    <?php
                            }
                        }
                    }else{
                        ?>
                        <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">No player</font>
							</p>
							<p>
								<font size="5">Player with that ID is not exist.</font>
							</p> 
						</center>
						</div>
                        </div>
                        <?php
                        header("refresh:5;url=acp.php");
                    }
                }else{
                    ?>
                    <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">No player selected</font>
							</p>
							<p>
								<font size="5">You have not selected a player ID.</font>
							</p> 
						</center>
						</div>
					</div>
					<?php
					header("refresh:5;url=acp.php");
                }
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
<script>
$(window).load(function() {
    $('.page-articles-right').height($('.page-articles-left').height()-42);
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
        alertTime: 1441894995
    });
    
    });
</script>


</body></html>