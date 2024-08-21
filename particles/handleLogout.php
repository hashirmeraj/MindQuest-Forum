<?php
session_start();
$logoutAlert = false;
echo 'Loggedin you out';
if (session_destroy()) {
    $logoutAlert = true;
}


header("Location: /MindQuest/index.php?logoutSucess=true");
