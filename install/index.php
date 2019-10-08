<html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="installer.css">
            <title>WoW-CMS | Installation</title>
        </head>
        <body>
            <?php
			if(isset($_GET['step'])){
				$step = htmlspecialchars($_GET['step']);
			}else{
				$step = 1;
            }
			
			if($step == 1){
				if(filesize("../config/config.php")){
					die("<b><font size='11'>Website already installed.</font></b><br><font size='6'>Your website is installed, you should delete 'install' folder</font>");
				}
				?>		
                <button class="button active">Installation</button> <button class="button">Requirements</button> <button class="button">Database Setup</button> <button class="button">Account Setup</button> <button class="button">Finish</button>
                
                <div class="pane">
                <b>Installation</b><br><br>
                You are on the WoW-CMS installer page. A few installation steps are waiting for you before you can freely use the site. Do you want to start now?
                <br><br>
                <form method="POST" action="index.php?step=2" class="form label-inline">
                    <button class="button">Check Requirements</button>
                </form>
                </div>
				<?php
			}elseif($step == 2){
                ?>		
                <button class="button">Installation</button> <button class="button active">Requirements</button> <button class="button">Database Setup</button> <button class="button">Account Setup</button> <button class="button">Finish</button>
                
                <div class="pane">
                    <b>Requirements</b><br><br>
					<?php
					$canbeinstalled = 0;
					
					if(strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') !== false){
						?>
                        Apache2: <font color="green"><b>Yes</b></font>
                        <?php
						$canbeinstalled=$canbeinstalled+1;
					}else{
						?>
						Apache2: <font color="red"><b>No</b></font>
						<?php
					}
					?>
					<br>
                    <?php
                    if(phpversion() < 7.0){
                        ?>
                        PHP +7.0: <font color="red"><b>No</b></font>   (Your: <b><?php echo phpversion(); ?></b>)
                        <?php
                    }else{
                        ?>
                        PHP +7.0: <font color="green"><b>Yes</b></font>
                        <?php
                        $canbeinstalled=$canbeinstalled+1;
					}
					?>
					<br>
					<?php
					function getMySQLVersion(){ 
						$output = shell_exec('mysql -V'); 
						preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version); 
						return $version[0]; 
					}
					if(getMySQLVersion() < 5.6){
						?>
                        MySQL +5.6: <font color="red"><b>No</b></font>   (Your: <b><?php echo getMySQLVersion(); ?></b>)
                        <?php
					}else{
						?>
                        MySQL +5.6: <font color="green"><b>Yes</b></font>
                        <?php
						$canbeinstalled=$canbeinstalled+1;
					}
					?>
					<br>
					<?php
					if(function_exists("fsockopen")) {
						?>
                        Fsockopen: <font color="green"><b>Enabled</b></font>
                        <?php
                        $canbeinstalled=$canbeinstalled+1;
					}else{
						?>
                        Fsockopen: <font color="red"><b>Disabled</b></font>
                        <?php
					}
					?>
					<br><br>
					<b>Modules</b><br><br>
					<?php
					if(function_exists("mail")) {
						?>
                        PHP mail(): <font color="green"><b>Enabled</b></font>
                        <?php
                        $canbeinstalled=$canbeinstalled+1;
					}else{
						?>
                        PHP mail(): <font color="red"><b>Disabled</b></font>
                        <?php
					}
					?>
					<br>
					<?php
					$mods = apache_get_modules();
					if(array_search("mod_headers",$mods)){
						?>
                        Headers: <font color="green"><b>Enabled</b></font>
                        <?php
                        $canbeinstalled=$canbeinstalled+1;
					}else{
						?>
                        Headers: <font color="red"><b>Disabled</b></font>
                        <?php
					}
					?>
                    <br>
					<?php
					if(array_search("mod_rewrite",$mods)){
						?>
                        Rewrite: <font color="green"><b>Enabled</b></font>
                        <?php
                        $canbeinstalled=$canbeinstalled+1;
					}else{
						?>
                        Rewrite: <font color="red"><b>Disabled</b></font>
                        <?php
					}
					?><br><br>
                    <?php
					if($canbeinstalled == 7){ 
                        ?>
                        <form method="POST" action="index.php?step=3" class="form label-inline">
                            <button class="button">Start installation</button>
                        </form>
                        <?php
					}else{
                        ?>
                        <button class="button">Can't be installed</button>
                        <?php
					}
					?>
                </div>
			<?php
			}elseif($step == 3){
			?>
				<button class="button">Installation</button> <button class="button">Requirements</button> <button class="button active">Database Setup</button> <button class="button">Account Setup</button> <button class="button">Finish</button>
                
                <div class="pane">
					<b>Database Setup</b><br><br>
					<form method="POST" action="index.php?step=4" class="form label-inline">
						Database Host:<br>
						<input id="db_host" name="db_host" size="20" type="text" class="inputcs" value="127.0.0.1"/><br><br>
						
						Database Port:<br>
						<input id="db_port" name="db_port" size="20" type="text" class="inputcs" value="3306"/><br><br>
						
						Database Username:<br>
						<input id="db_username" name="db_username" size="20" type="text" class="inputcs" value="wow"/><br><br>
						
						Database Password:<br>
						<input id="db_password" name="db_password" size="20" type="password" class="inputcs" value=""/><br><br>
						
						Website Database Name:<br>
						<input id="cms_db_name" name="cms_db_name" size="20" type="text" class="inputcs" value="cms"/><br><br>
						
						Auth Database Name:<br>
						<input id="auth_db_name" name="auth_db_name" size="20" type="text" class="inputcs" value="auth"/><br><br>
						
						Characters Database Name:<br>
						<input id="chars_db_name" name="chars_db_name" size="20" type="text" class="inputcs" value="characters"/><br><br>

						World Database Name:<br>
						<input id="world_db_name" name="world_db_name" size="20" type="text" class="inputcs" value="world"/><br><br>
						
						<button class="button">Setup Database</button>
					</form>
				</div>
			<?php
			}elseif($step == 4){
				?>
				<button class="button">Installation</button> <button class="button">Requirements</button> <button class="button">Database Setup</button> <button class="button active">Account Setup</button> <button class="button">Finish</button>
                
				<div class="pane">
				<?php
				$link = @mysqli_connect($_POST['db_host'], $_POST['db_username'], $_POST['db_password'], $_POST['cms_db_name'], $_POST['db_port']) or die('<b>Database Error</b><br><br>There is a problem connecting to your "cms" database, please <a href="javascript: history.go(-1)">go back</a> and make sure you have entered the correct data.');
				$link2 = @mysqli_connect($_POST['db_host'], $_POST['db_username'], $_POST['db_password'], $_POST['auth_db_name'], $_POST['db_port']) or die('<b>Database Error</b><br><br>There is a problem connecting to your "auth" database, please <a href="javascript: history.go(-1)">go back</a> and make sure you have entered the correct data.');
				$link3 = @mysqli_connect($_POST['db_host'], $_POST['db_username'], $_POST['db_password'], $_POST['chars_db_name'], $_POST['db_port']) or die('<b>Database Error</b><br><br>There is a problem connecting to your "characters" database, please <a href="javascript: history.go(-1)">go back</a> and make sure you have entered the correct data.');
				$link4 = @mysqli_connect($_POST['db_host'], $_POST['db_username'], $_POST['db_password'], $_POST['world_db_name'], $_POST['db_port']) or die('<b>Database Error</b><br><br>There is a problem connecting to your "world" database, please <a href="javascript: history.go(-1)">go back</a> and make sure you have entered the correct data.');


				if(is_writable("../config/config.php")){
					file_put_contents("../config/config.php", '<?php
					$db_host = "'.$_POST['db_host'].'";
					$db_username = "'.$_POST['db_username'].'";
					$db_password = "'.$_POST['db_password'].'";
					$db_port = "'.$_POST['db_port'].'";
					$cms_db_name = "'.$_POST['cms_db_name'].'";
					$auth_db_name = "'.$_POST['auth_db_name'].'";
					$chars_db_name = "'.$_POST['chars_db_name'].'";
					$world_db_name = "'.$_POST['world_db_name'].'";
					?>');
				}else{
					die('<b>Config error</b><br><br>Config file is not writable. Please <a href="javascript: history.go(-1)">go back</a> and correct it.');
				}

				if(!file_exists("cms_install.sql")){
					die("<b>Database Error</b><br><br>Couldn't open file cms_install.sql. Please <a href='javascript: history.go(-1)'>go back</a> and check if it's presented in install/ and if it's readable by webserver!");
				}
				if(!file_exists("auth_install.sql")){
					die("<b>Database Error</b><br><br>Couldn't open file auth_install.sql. Please <a href='javascript: history.go(-1)'>go back</a> and check if it's presented in install/ and if it's readable by webserver!");
				}

				$cmsdbname = $_POST['cms_db_name'];
				$checkcms = "SHOW TABLES FROM $cmsdbname";
				$checkres = mysqli_query($checkcms);

				if($checkres){
					die('<b>Installation Error</b><br><br>It looks like the website database is full, please <a href="javascript: history.go(-1)">go back</a> and truncate it.');
				}

				$sql = file_get_contents("cms_install.sql");
				$sql2 = file_get_contents("auth_install.sql");

				if(!mysqli_multi_query($link, $sql)){
					die('<b>Database Error</b><br><br>Could not run the cms_install.sql file. Please <a href="javascript: history.go(-1)">go back</a> and correct it.');
				}
				if(!mysqli_multi_query($link2, $sql2)){
					die('<b>Database Error</b><br><br>Could not run the auth_install.sql file. Please <a href="javascript: history.go(-1)">go back</a> and correct it.');
				}
				
				?>
				<b>Administrator Account Setup</b><br><br>
					<form method="POST" action="index.php?step=5" class="form label-inline">
						Login:<br>
						<input id="acclogin" name="acclogin" size="20" type="text" class="inputcs" value=""/><br><br>
						
						Password:<br>
						<input id="accpass" name="accpass" size="20" type="password" class="inputcs" value=""/><br><br>
						
						Repeat Password:<br>
						<input id="accrepass" name="accrepass" size="20" type="password" class="inputcs" value=""/><br><br>
						
						Email:<br>
						<input id="accmail" name="accmail" size="20" type="text" class="inputcs" value=""/><br><br>
						
						<button class="button">Create Account</button>
					</form>
				</div>
			<?php
			}elseif($step == 5){
				?>
				<button class="button">Installation</button> <button class="button">Requirements</button> <button class="button">Database Setup</button> <button class="button">Account Setup</button> <button class="button active">Finish</button>
                
				<div class="pane">
					<?php
					if (!$_POST['acclogin']){
						die('<b>No account name given</b><br><br>Please <a href="javascript: history.go(-1)">go back</a> and correct it.');
					}
					if (!$_POST['accpass'] || !$_POST['accrepass']){
						die('<b>No password given</b><br><br>Please <a href="javascript: history.go(-1)">go back</a> and correct it.');
					}
					if($_POST['accpass'] != $_POST['accrepass']){
						die('<b>Passwords mismatch</b><br><br>Please <a href="javascript: history.go(-1)">go back</a> and correct it.');
					}
					if (!$_POST['accmail']){
						die('<b>No email given</b><br><br>Please <a href="javascript: history.go(-1)">go back</a> and correct it.');
					}
						
					include("../config/config.php");
					$linkauth = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
					$postlogin = $_POST['acclogin'];
					$postmail = $_POST['accmail'];
					
					$sql_u = "SELECT * FROM account WHERE username='$postlogin'";
					$sql_e = "SELECT * FROM account WHERE email='$postmail'";
					$res_u = mysqli_query($linkauth, $sql_u);
					$res_e = mysqli_query($linkauth, $sql_e);

					if (mysqli_num_rows($res_u) > 0) {
						die('<b>Account name taken</b><br><br>Please <a href="javascript: history.go(-1)">go back</a> and correct it.');
					}else if(mysqli_num_rows($res_e) > 0){
						die('<b>Account email taken</b><br><br>Please <a href="javascript: history.go(-1)">go back</a> and correct it.');
					}else{
						$passfinal = sha1(strtoupper($_POST['acclogin']).':'.strtoupper($_POST['accrepass']));
						mysqli_query($linkauth, "INSERT INTO `account` (`id`, `username`, `sha_pass_hash`, `email`) VALUES ('1', '".$_POST['acclogin']."', '".$passfinal."', '".$_POST['accmail']."' )");
						mysqli_query($linkauth, "INSERT INTO `account_access` (`id`, `gmlevel`, `RealmID`) VALUES ('1', '4', '-1' )");
					}
					?>
					<b>Website successfully installed!</b><br><br>Congratulations! Your WoW-CMS has been successfully installed! Now you can easily go to the home page, but before you do it, I recommend removing the 'install' folder from the site directory!<br><br>
					<form method="POST" action="../index.php" class="form label-inline">
                    	<button class="button">Go to Index</button>
                	</form>
				</div>
            <?php
            } 
            ?>
        </body>
    </html>