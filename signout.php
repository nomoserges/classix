<?php
require_once 'lib/Functions.php';
session_destroy();
$link = null;
if(isset($_SERVER['HTTP_REFERER'])&&!empty($_SERVER['HTTP_REFERER'])){
    $link = $_SERVER['HTTP_REFERER'];
}else {
    $link = $library->getServerHost()."login.php";
}
header("Location: ".$link);
