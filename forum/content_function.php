<?php
session_start();

include("check.php");
include('../config/config.php');

$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
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
?>
<!DOCTYPE html>
<html>
<head>
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

</body>
</html>
<?php	function dispcategories() {
		include('../config/config.php');
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$select = mysqli_query($con, "SELECT * FROM categories");
		
		while ($row = mysqli_fetch_assoc($select)) {
			echo "<table id='customers'>";
			echo "<tr>
			<th>".$row['category_title']."</th>
			<th width='35%'>Last topic</th>
			<th width='8%'>Topics</th>
			</tr>";
			dispsubcategories($row['cat_id']);
			echo "</table>";
		}
	}
	
	function dispsubcategories($parent_id) {
		include('../config/config.php');
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$select = mysqli_query($con, "SELECT cat_id, subcat_id, subcategory_title, subcategory_desc FROM categories, subcategories 
									  WHERE ($parent_id = categories.cat_id) AND ($parent_id = subcategories.parent_id)");
		while ($row = mysqli_fetch_assoc($select)) {
			echo "<tr><td><a href='/forum/topics/".$row['cat_id']."/".$row['subcat_id']."'>
				  <font color='839309'>".$row['subcategory_title']."</font><br />";
			echo "<font color='c1b575'>". $row['subcategory_desc']."</font></a></td>";
			echo "<td>None</td>";
			echo "<td>".getnumtopics($parent_id, $row['subcat_id'])."</td></tr>";
		}
	}

	
	function getnumtopics($cat_id, $subcat_id) {
		include('../config/config.php');
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$select = mysqli_query($con, "SELECT category_id, subcategory_id FROM topics WHERE ".$cat_id." = category_id 
									  AND ".$subcat_id." = subcategory_id");
		return mysqli_num_rows($select);
	}

	function disptopics($cid, $scid) {
		include('../config/config.php');
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$select = mysqli_query($con, "SELECT topic_id, author, title, date_posted, views, replies, locked, pinned FROM categories, subcategories, topics 
									  WHERE ($cid = topics.category_id) AND ($scid = topics.subcategory_id) AND ($cid = categories.cat_id)
									  AND ($scid = subcategories.subcat_id) ORDER BY pinned=1 DESC, topic_id DESC");
		if (mysqli_num_rows($select) != 0) {
			echo "<table id='customers'>";
			echo "<tr><th width='30%'>Title</th><th>Posted By</th><th>Date Posted</th><th width='8%'>Views</th><th width='8%'>Replies</th></tr>";
			while ($row = mysqli_fetch_assoc($select)) {
				?>
				<tr><td><a href='/forum/readtopic/<?php echo $cid; ?>/<?php echo $scid; ?>/<?php echo $row['topic_id']; ?>'>
					 <?php
					if($row['locked']==1){
						?>
						<img src="/uploads/lock.png">
						<?php
					}
					if($row['pinned']==1){
						?>
						<img src="/uploads/pin.png">
						<?php
					}
					?><?php echo$row['title']; ?></a></td><td><?php echo $row['author']; ?></td><td><?php echo $row['date_posted']; ?></td><td><?php echo $row['views']; ?></td>
					 <td><?php echo $row['replies']; ?></td></tr>
				<?php
			}
			echo "</table>";
		} else {
			echo "<table id='customers'><tr><th>This category has no topics yet! <a href='/forum/newtopic/".$cid."/".$scid."'>
				 Add the very first topic like a boss!</a></th></tr></table>";
		}
	}
	
	function disptopic($cid, $scid, $tid) {
		include('../config/config.php');
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$select = mysqli_query($con, "SELECT cat_id, subcat_id, topic_id, locked, pinned, author, title, content, date_posted FROM 
									  categories, subcategories, topics WHERE ($cid = categories.cat_id) AND
									  ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id)");
		$row = mysqli_fetch_assoc($select);
		
		if(isset($_SESSION["loggedin"])) {
			$nickauth = $_SESSION["loggedin"];
			$checkauth = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		}
		$sqlauth= "SELECT * FROM account WHERE username = '" . $nickauth . "'";
		$resultauth = mysqli_query($checkauth,$sqlauth);
		$rowsauth = mysqli_fetch_array($resultauth);
		
		$sqlauthor="SELECT * FROM account WHERE username = '" . $row['author'] . "'";
		$resultauthor = mysqli_query($checkauth,$sqlauthor);
		$rowsauthor = mysqli_fetch_array($resultauthor);
		
		$idcheck = $rowsauth['id'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkauth,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		?>
		<table id='customers'><tr><th colspan='2'><?php
					if($row['locked']==1){
						?>
						<img src="/uploads/lock.png">
						<?php
					}
					if($row['pinned']==1){
						?>
						<img src="/uploads/pin.png">
						<?php
					}
					?>Browsing topic: <?php echo $row['title']; ?> / All Replies (<?php echo countReplies($_GET['cid'], $_GET['scid'], $_GET['tid']); ?>)</th></tr><tr><th width='25%'><center>
					<?php
					if($rowsgm['gmlevel']==1){
						?>
						<font color="00ba0d">Moderator</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==2){
						?>
						<font color="cf7c00">Administrator</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==3){
						?>
						<font color="c70000">Head Admin</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==4){
						?>
						<font color="9000b8">Owner</font><br>
						<?php
					}else{
						?>
						<font color="ffffff">Player</font><br>
						<?php
					}
					
					if($rowsauthor['posts']>=0 && $rowsauthor['posts']<50){
						?>
						<font color="ffffff"><?php echo $rowsauthor['username']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=50 && $rowsauthor['posts']<100){
						?>
						<font color="#1df701"><?php echo $rowsauthor['username']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=100 && $rowsauthor['posts']<250){
						?>
						<font color="006dd7"><?php echo $rowsauthor['username']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=250 && $rowsauthor['posts']<500){
						?>
						<font color="9e34e7"><?php echo $rowsauthor['username']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=500){
						?><font color="f57b01"><?php echo $rowsauthor['username']; ?></font><?php
					}
					?>
					<br><img src="http://185.239.238.237/uploads/avatars/<?php echo $rowsauthor['avatar']; ?>" width="100px" height="100px"><br>
					Rank: 
					<?php
					if($rowsauthor['posts']>=0 && $rowsauthor['posts']<50){
						?>
						<font color="ffffff">Newbie</font>
						<?php
					}elseif($rowsauthor['posts']>=50 && $rowsauthor['posts']<100){
						?>
						<font color="#1df701">Expert</font>
						<?php
					}elseif($rowsauthor['posts']>=100 && $rowsauthor['posts']<250){
						?>
						<font color="006dd7">Elite</font>
						<?php
					}elseif($rowsauthor['posts']>=250 && $rowsauthor['posts']<500){
						?>
						<font color="9e34e7">Legend</font>
						<?php
					}elseif($rowsauthor['posts']>=500){
						?><font color="f57b01">Senior</font><?php
					}
					?>
					<br>Posts: <font color="ffffff"><?php echo $rowsauthor['posts']; ?></font>
					</center></th>
		<th><span style="float:right;">Posted date: <?php echo $row['date_posted']; ?></span><br><?php echo $row['content']; ?></th></tr></table>
		<?php
		mysqli_close($checkauth);
	}
	
	function addview($cid, $scid, $tid) {
		include('../config/config.php');
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$update = mysqli_query($con, "UPDATE topics SET views = views + 1 WHERE category_id = ".$cid." AND
									  subcategory_id = ".$scid." AND topic_id = ".$tid."");
	}
	
	function replylink($cid, $scid, $tid) {
		include('../config/config.php');
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$select = mysqli_query($con, "SELECT cat_id, subcat_id, topic_id, author, title, content, locked, date_posted FROM 
									  categories, subcategories, topics WHERE ($cid = categories.cat_id) AND
									  ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id)");
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

		if($row['locked']=='0'){
			echo "<form action='/forum/replyto/".$cid."/".$scid."/".$tid."'>
						<input type='submit' value='REPLY' class='wm-ui-btn'/>
					</form>";
		}elseif($row['locked']=='1'){
			if($rowsgm['gmlevel']>0){
				echo "<form action='/forum/replyto/".$cid."/".$scid."/".$tid."'>
						<input type='submit' value='REPLY' class='wm-ui-btn'/>
					</form>";
				echo "The topic is locked, but you still have permission to reply.";
			}else{
				echo "Topic is locked, you can not reply.";
			}
		}
		mysqli_close($checkacp);
	}
	
	function locklink($cid, $scid, $tid) {
		include('../config/config.php');
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$select = mysqli_query($con, "SELECT cat_id, subcat_id, topic_id, author, title, content, locked, date_posted FROM 
									  categories, subcategories, topics WHERE ($cid = categories.cat_id) AND
									  ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id)");
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

		if($rowsgm['gmlevel']>0){
			if($row['locked']=='0'){
				echo "<form action='/forum/locktopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
							<input type='submit' value='LOCK' class='wm-ui-btn'/>
						</form>";
			}elseif($row['locked']=='1'){
				echo "<form action='/forum/locktopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
							<input type='submit' value='UNLOCK' class='wm-ui-btn'/>
						</form>";
			}
		}
		mysqli_close($checkacp);
	}
	
	function pinlink($cid, $scid, $tid) {
		include('../config/config.php');
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$select = mysqli_query($con, "SELECT cat_id, subcat_id, topic_id, author, title, content, locked, pinned, date_posted FROM 
									  categories, subcategories, topics WHERE ($cid = categories.cat_id) AND
									  ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id)");
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

		if($rowsgm['gmlevel']>0){
			if($row['pinned']=='0'){
				echo "<form action='/forum/pintopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
							<input type='submit' value='PIN' class='wm-ui-btn'/>
						</form>";
			}elseif($row['pinned']=='1'){
				echo "<form action='/forum/pintopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
							<input type='submit' value='UNPIN' class='wm-ui-btn'/>
						</form>";
			}
		}
		mysqli_close($checkacp);
	}
	
	function replytopost($cid, $scid, $tid) {
		include('../config/config.php');
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$select = mysqli_query($con, "SELECT cat_id, subcat_id, topic_id, author, title, content, locked, date_posted FROM 
									  categories, subcategories, topics WHERE ($cid = categories.cat_id) AND
									  ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id)");
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

		if($row['locked']=='0'){
			echo "<div class='content'><form action='/forum/addreply.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
					  <p>Reply: </p>
					  <textarea cols='80' rows='14' id='comment' name='comment' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'></textarea><br />
					  <input type='submit' value='CREATE' class='wm-ui-btn'/>
					  </form></div>";
		}elseif($row['locked']=='1'){
			if($rowsgm['gmlevel']>0){
				echo "<div class='content'><form action='/forum/addreply.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
						  <p>Reply: </p>
						  <textarea cols='80' rows='14' id='comment' name='comment' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'></textarea><br />
						  <input type='submit' value='CREATE' class='wm-ui-btn'/>
						  </form></div>";
				echo "Topic is locked, but you still have permission to reply.";
			}else{
				echo "Topic is locked, you can not reply.";
			}
		}
	}
	
	function dispreplies($cid, $scid, $tid) {
		include('../config/config.php');
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$select = mysqli_query($con, "SELECT replies.author, comment, replies.date_posted FROM categories, subcategories, 
									  topics, replies WHERE ($cid = replies.category_id) AND ($scid = replies.subcategory_id)
									  AND ($tid = replies.topic_id) AND ($cid = categories.cat_id) AND 
									  ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id) ORDER BY reply_id ASC");
		
		
		if (mysqli_num_rows($select) != 0) {
			?>
			<table id='customers'>
			<?php
			while ($row = mysqli_fetch_assoc($select)) {
				if(isset($_SESSION["loggedin"])) {
						$nick = $_SESSION["loggedin"];
						$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
					}
				
				$test = $row['author'];
				
				$sql= "SELECT * FROM account WHERE username = '" . $test . "'";
				$result = mysqli_query($checkacp,$sql);
				$rows = mysqli_fetch_array($result);
				
				$sqlauthor="SELECT * FROM account WHERE username = '" . $row['author'] . "'";
				$resultauthor = mysqli_query($checkacp,$sqlauthor);
				$rowsauthor = mysqli_fetch_array($resultauthor);
					
				$avatar = $rows['avatar'];
				$ipcheck = $rows['last_ip'];
				$idcheck = $rows['id'];
				
				$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
				$resultgm = mysqli_query($checkacp,$gm);
				$rowsgm = mysqli_fetch_array($resultgm);
				?>
				<tr><th width='25%'><center>
				<?php
					if($rowsgm['gmlevel']==1){
						?>
						<font color="00ba0d">Moderator</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==2){
						?>
						<font color="cf7c00">Administrator</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==3){
						?>
						<font color="c70000">Head Admin</font><br>
						<?php
					}elseif($rowsgm['gmlevel']==4){
						?>
						<font color="9000b8">Owner</font><br>
						<?php
					}else{
						?>
						<font color="ffffff">Player</font><br>
						<?php
					}
					
					if($rowsauthor['posts']>=0 && $rowsauthor['posts']<50){
						?>
						<font color="ffffff"><?php echo $row['author']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=50 && $rowsauthor['posts']<100){
						?>
						<font color="#1df701"><?php echo $row['author']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=100 && $rowsauthor['posts']<250){
						?>
						<font color="006dd7"><?php echo $row['author']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=250 && $rowsauthor['posts']<500){
						?>
						<font color="9e34e7"><?php echo $row['author']; ?></font>
						<?php
					}elseif($rowsauthor['posts']>=500){
						?><font color="f57b01"><?php echo $row['author']; ?></font><?php
					}
					?>
				<br><img src="http://185.239.238.237/uploads/avatars/<?php echo $avatar; ?>" width="100px" height="100px"><br>
				Rank: 
				<?php
				if($rowsauthor['posts']>=0 && $rowsauthor['posts']<50){
					?>
					<font color="ffffff">Newbie</font>
					<?php
				}elseif($rowsauthor['posts']>=50 && $rowsauthor['posts']<100){
					?>
					<font color="#1df701">Expert</font>
					<?php
				}elseif($rowsauthor['posts']>=100 && $rowsauthor['posts']<250){
					?>
					<font color="006dd7">Elite</font>
					<?php
				}elseif($rowsauthor['posts']>=250 && $rowsauthor['posts']<500){
					?>
					<font color="9e34e7">Legend</font>
					<?php
				}elseif($rowsauthor['posts']>=500){
					?><font color="f57b01">Senior</font><?php
				}
				?><br>Posts: <font color="ffffff"><?php echo $rowsauthor['posts']; ?></font>
				</center></th><th><span style="float:right;">Posted date: <?php echo $row['date_posted']; ?></span><br><?php echo $row['comment']; ?></th></tr>
				<?php
			}
			?>
			</table>
			<?php
		}
	}
	
	function countReplies($cid, $scid, $tid) {
		include('../config/config.php');
		$con = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$select = mysqli_query($con, "SELECT category_id, subcategory_id, topic_id FROM replies WHERE ".$cid." = category_id AND 
									  ".$scid." = subcategory_id AND ".$tid." = topic_id");
		return mysqli_num_rows($select);
	}
?>





















