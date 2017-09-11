<?php
    $number_of_users = ((int)count(scandir(ini_get("session.save_path")))) - 2;
    echo $number_of_users;
?>