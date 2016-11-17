<?php
    require_once "vendor/autoload.php";

use hexpang\APIHelper\Helper;
$helper = new Helper("http://ali213.net/");
echo $helper->Get("");
?>