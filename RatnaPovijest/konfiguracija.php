<?php

session_start();

$putanjaPovijest = "/Webprogramiranje/RatnaPovijest/";
$mysql_host = "localhost";
$mysql_database = "pov";
$mysql_user = "edunova";
$mysql_password = "edunova";

$pov = "Ratna Povijest";

//server
/*
$putanjaPovijest="/";
$mysql_host = "mysql.hostinger.hr";
$mysql_database = "u806327006_ddord";
$mysql_user = "u806327006_ddord";
$mysql_password = "tPmC2fPP6Q";

*/

$veza = new PDO(
'mysql:host=' . $mysql_host . ';dbname=' . $mysql_database . ';charset=utf8', 
$mysql_user, 
$mysql_password);