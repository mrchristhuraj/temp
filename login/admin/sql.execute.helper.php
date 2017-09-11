<?php
    include_once(__DIR__."/../../includes/sql.config.php");  

    if($_REQUEST['mode'] == "SQL") {
        $sql = $_REQUEST['command'];
        $db = mysqli_query($link,$sql);
        if(!$db) 
            die("<br><span class=\"red-text text-darken-3\">".nl2br("Command Failed: ".mysqli_error($link))."<sapn>");
        else {
            die("<br><span class=\"green-text text-darken-3\">".nl2br("Command Successful")."<sapn>");
        }

    }

?> 