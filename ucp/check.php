<?php
if(!filesize("../config/config.php")){
    header("Location: ../install/index.php");
}
?>