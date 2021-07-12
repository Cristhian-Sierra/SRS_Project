<?php 
//To save
date_default_timezone_set("America/Bogota");
$date = date("Y-m-d");
$time = date("H:i a");  
$areaS=$_POST['areas'];
$countryS=$_POST['countries'];
$categoryS=$_POST['categories'];
$quartileS=$_POST['quartile'];
$hindexS=$_POST['hindex'];
$referencesS=$_POST['references'];
$sjrS=$_POST['sjr'];
$filterSClass = new Filter_search("",$date,$time,$hindexS,$referencesS,$countryS,$categoryS,$areaS,$quartileS,$sjrS);
$filterSClass->insert();

  
?>