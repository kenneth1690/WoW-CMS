<?php
if(!filesize("../config/config.php")){
    header("Location: ../install/index.php");
}elseif(filesize("config/config.php")){
    include("config/config.php");
}
?>