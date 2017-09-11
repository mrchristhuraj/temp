<?php
    session_start();
    $username = $_SESSION['uname'];
    $html = utf8_decode(rawurldecode($_REQUEST['html']));

    exec("mkdir $username");
    exec("chmod 777 $username");
    chdir($username);
    $file_code=fopen("main.html","w+");
    fwrite($file_code,$html);
    fclose($file_code);
    exec("chmod 777 main.html");
    $pwd = exec('pwd');
     $command = "xvfb-run -a $pwd/../../../../wkhtmltox/bin/wkhtmltoimage $pwd"."/main.html"." ".$pwd."/result.jpg 2>&1";
    exec("chmod 777 result.jpg");
    exec($command);

?>
