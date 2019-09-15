<?php
if(!filesize("../config/config.php")){
    header("Location: ../install/index.php");
}elseif(filesize("config/config.php")){
    include("config/config.php");

    $checkoffline = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);

    $query = mysqli_query($checkoffline, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'siteonline'");
    $query2 = mysqli_query($checkoffline, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'offlinemessage'");

    while($row = mysqli_fetch_array($query2)){
        $offlinemessage = $row['conf_value'];
    }
    while($row = mysqli_fetch_array($query)){
        $siteonline = $row['conf_value'];
    }

    if($siteonline=="no"){
        if(isset($_SESSION["loggedin"])){
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
                ?>
                <html>
                    <body style="background-color: #606060">
                    <center>
                        <font size="11"><b>Site is currently offline!</b><br><br>
                        Message from Administration:<br>
                        <?php 
                            echo "'".$offlinemessage."'";
                        ?>
                        </font>
                    </center>
                    </body>
                </html>
                <?php
                die();
            }else{
                //Site is offline but youre GM.
            }
            mysqli_close($checkacp);
        }else{
            ?>
                <html>
                    <body style="background-color: #606060">
                    <center>
                        <font size="11"><b>Site is currently offline!</b><br><br>
                        Message from Administration:<br>
                        <?php 
                            echo "'".$offlinemessage."'";
                        ?>
                        </font>
                    </center>
                    </body>
                </html>
                <?php
            die();
        }
    }
}
?>