<?php

ob_start(); 
require_once "MonPDO.php";

$title = "Présentation";
$content = ob_get_clean(); 
require_once "template.php";

?>
