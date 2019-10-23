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
<title><?php echo $sitename; ?> | Bugtracker</title>
<link rel="stylesheet" href="/css/global.css">
<link rel="stylesheet" href="/css/ui.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/wm-contextmenu.css">
<style>
		#customers {
			  border-collapse: collapse;
			  width: 100%;
			}

			#customers td, #customers th {
			  border: 1px solid #ddd;
			  background: #0f0f0f none repeat-x left;
			  color: #c1b575;
				border-bottom: 1px solid #1e1e1e;
				border-left: 1px solid transparent;
				border-right: 1px solid transparent;
			  padding: 10px;
			  font-size: 15px;
			}

			#customers tr:nth-child(even){background-color: #f2f2f2;}

			#customers tr:hover {background-color: #ddd;}

			#customers th {
			  padding-top: 6.5px;
			  padding-bottom: 6.5px;
			  text-align: left;
			  background-color: #131313;
			  color: #505050;
			  box-shadow: -2px 2px 2px transparent;
			  border-top-right-radius: 0px;
				border-top-left-radius: 0px;
				border-left: 1px solid transparent;
				border-right: 1px solid transparent;
				border: 1px solid #1e1e1e;
				font-size: 15px;
				vertical-align: text-top;
			}
		</style>
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
						<li><a href="/armory/index.php" title="Armory">ARMORY</a></li>
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
    	    		<li><a href="/"><i class="fas fa-newspaper"></i> NEWS</a></li>
            		<!--<li><a href="/stream" class="">STREAM</a></li>-->
            		<!--<li><a href="/devlog" class="">DEVLOG</a></li>-->
            		<li><a href="/changelog.php"><i class="fas fa-exclamation-circle"></i> CHANGELOG</a></li>
            		<li><a href="/bugtracker.php" class="active"><i class="fas fa-bug"></i> BUGTRACKER</a></li>
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
		if(isset($_GET['action'])){
            $action = htmlspecialchars($_GET['action']);
        }else{
            ?>
            <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
				<div id="wm-error-page">
					<form action="bugtracker.php?action=newbug" method="POST">
						<input type='submit' value='REPORT BUG' class='wm-ui-btn'/>
					</form>
				</div>
			</div>
		<table id="customers">
			<tr>
				<th width="40%">Problem</th>
				<th width="20%">Author</th>
				<th width="20%">Date</th>
				<th width="10%">Solved (?)</th>
				<th width="10%">Details</th>
			</tr>
			<?php
			$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);

			if (isset($_GET['page_no']) && $_GET['page_no']!="") {
				$page_no = $_GET['page_no'];
			}else{
				$page_no = 1;
			}

			$total_records_per_page = 50;
			$offset = ($page_no-1) * $total_records_per_page;
			$previous_page = $page_no - 1;
			$next_page = $page_no + 1;
			$adjacents = "2"; 

			$result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `bugtracker`");
			$total_records = mysqli_fetch_array($result_count);
			$total_records = $total_records['total_records'];
			$total_no_of_pages = ceil($total_records / $total_records_per_page);
			$second_last = $total_no_of_pages - 1; // total page minus 1

			$result = mysqli_query($con,"SELECT * FROM `bugtracker` ORDER BY solved=0 DESC, date DESC LIMIT $offset, $total_records_per_page");
			if($result->num_rows>0){
				while($row = mysqli_fetch_array($result)){
					?>
					<tr>
					<th><?php echo $row['title']; ?></th>
					<th><?php echo $row['author']; ?></th>
					<th><?php echo $row['date']; ?></th>
					<th><?php
					if($row['solved']==1){
						?>
						<font color="1df701">Yes</font>
						<?php
					}elseif($row['solved']==0){
						?>
						<font color="f57b01">No</font>
						<?php
					}
					?></th>
					<th><a href='viewbug.php?bgid=<?php echo $row['id']; ?>'>View</a></th>
					</tr>
					<?php
				}
			}else{
				?>
				<tr>
					<th colspan="5">No bugs reported.</th>
				</tr>
				<?php
			}
			mysqli_close($con);
			?>
		</table>
	<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
		<div id="wm-error-page">
			<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong><br>
			<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
			
			<b><a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous&nbsp;&nbsp;</a></b>
			   
			<?php 
			if ($total_no_of_pages <= 10){  	 
				for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
					if ($counter == $page_no) {
						echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
					}else{
						echo "<b><a href='?page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
					}
				}
			}elseif($total_no_of_pages > 10){
				if($page_no <= 4) {			
					for ($counter = 1; $counter < 8; $counter++){		 
						if ($counter == $page_no) {
							echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
						}else{
							echo "<b><a href='?page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
						}
					}
					echo "<b><a>...</a></b>";
					echo "<b><a href='?page_no=$second_last'>&nbsp;&nbsp;$second_last&nbsp;&nbsp;</a></b>";
					echo "<b><a href='?page_no=$total_no_of_pages'>&nbsp;&nbsp;$total_no_of_pages&nbsp;&nbsp;</a></b>";
				}elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
					echo "<b><a href='?page_no=1'>&nbsp;&nbsp;1&nbsp;&nbsp;</a></b>";
					echo "<b><a href='?page_no=2'>&nbsp;&nbsp;2&nbsp;&nbsp;</a></b>";
					echo "<b><a>...</a></b>";
					for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
						if ($counter == $page_no) {
							echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
						}else{
							echo "<b><a href='?page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
						}                  
				   }
				   echo "<b><a>...</a></b>";
				   echo "<b><a href='?page_no=$second_last'>&nbsp;&nbsp;$second_last&nbsp;&nbsp;</a></b>";
				   echo "<b><a href='?page_no=$total_no_of_pages'>&nbsp;&nbsp;$total_no_of_pages&nbsp;&nbsp;</a></b>";      
				}else {
					echo "<b><a href='?page_no=1'>&nbsp;&nbsp;1&nbsp;&nbsp;</a></b>";
					echo "<b><a href='?page_no=2'>&nbsp;&nbsp;2&nbsp;&nbsp;</a></b>";
					echo "<b><a>...</a></b>";

					for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
						if ($counter == $page_no) {
							echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
						}else{
							echo "<b><a href='?page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
						}                   
					}
				}
			}
			?>
    
			<b><a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>&nbsp;&nbsp;Next</a></b>
			<?php
			if($page_no < $total_no_of_pages){
				echo "<b><a href='?page_no=$total_no_of_pages'>&nbsp;&nbsp;Last</a></b>";
			}
			?>
		</div>
	</div>
            <?php
        }
                    
        if($action == "newbug"){
			?>
			<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
				<div id="wm-error-page">
					<?php 
						session_start();
							$getscid = $_GET['scid'];
							$select = mysqli_query($con, "SELECT * FROM `subcategories` WHERE `subcat_id`='$getscid'");
							$row = mysqli_fetch_assoc($select);
							
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
							
							?>
							<form action="bugtracker.php?action=confirmbug" method='POST'>
								<p>Problem: </p>
								<input type='text' id='problem' name='problem' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/>
								<p>Description (HTML supported): </p>
								<textarea id='description' name='description' rows='14' cols='80' class='wm-ui-input-generic input-lg2 wm-ui-generic-frame wm-ui-all-border'></textarea><br /><br>
								<input type='submit' value='REPORT BUG' class='wm-ui-btn'/>
							</form>
				</div>
			</div>
			<?php
		}elseif($action == "confirmbug"){
			session_start();
					
					if(isset($_SESSION["loggedin"])) {
						$nick = $_SESSION["loggedin"];
						$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
						$cmsconn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
					}
					
					$problem = $_POST['problem'];
					$description = $_POST['description'];
					
					$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
					$result = mysqli_query($checkacp,$sql);
					$rows = mysqli_fetch_array($result);
					
					$idcheck = $rows['id'];
					
					$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
					$resultgm = mysqli_query($checkacp,$gm);
					$rowsgm = mysqli_fetch_array($resultgm);
					
					if(empty($problem) || empty($description)){
						header("refresh:5;url=index.php");
						?>
						<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
						<p><font size="6">Error when adding</font></p>
						<p>
							<font size="5">The 'problem' and 'description' fields can not be empty.</font>
						</p> 
						</center>
						</div>
						</div>
						<?php
						header("refresh:5;url=index.php");
					}else{
						$cmssql= "INSERT INTO bugtracker (`title`, `content`, `author`, `date`) VALUES ('$problem', '$description', '$nick', NOW())";
						$resultcms = mysqli_query($cmsconn,$cmssql);
						$insertlog = mysqli_query($cmsconn, "INSERT INTO logs_bugs (`logger`, `logger_id`, `logdetails`, `logdate`) 
									  VALUES ('".$_SESSION['loggedin']."', '".$rows['id']."', 'BUGTRACKER: User `".$nick."` created bug titled `".$problem."`', NOW());");
						header("refresh:5;url=index.php");
						?>
						<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
						<p><font size="6">Bug reported</font></p>
						<p>
							<font size="5">New bug report has been added to the database.</font>
						</p> 
						</center>
						</div>
						</div>
						<?php
					}
					
					mysqli_close($checkacp);
					mysqli_close($cmsconnn);
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