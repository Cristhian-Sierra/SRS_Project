<?php 
require("business/Administrator.php");
require("business/LogAdministrator.php");
require("business/Area.php");
require("business/Areacategory.php");
require("business/Category.php");
require("business/Journalcategory.php");
require("business/Journal.php");
require("business/Country.php");
require("business/Filter_search.php");

$pid=base64_decode($_GET['pid']);
include($pid);
?>
