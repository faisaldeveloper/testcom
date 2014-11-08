<?php
session_start();
include("include/db_config.php");
include("classes/includeClasses.php");


$ATM->logOut();
header("Location: login.php");
?>

