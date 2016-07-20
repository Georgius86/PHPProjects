<?php
include_once '../../../konfiguracija.php';
$izraz = $veza->prepare("delete from ucestvuju where strana=:strana and zemlja=:zemlja");
$strana=$_POST["strana"];
$izraz->bindParam(':strana', $strana);	
$zemlja=$_POST["zemlja"];
$izraz->bindParam(':zemlja', $zemlja);	
$izraz->execute();
echo "OK";
