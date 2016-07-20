<?php
include_once '../../../konfiguracija.php';
$izraz = $veza->prepare("insert into ucestvuju (zemlja,strana) values (:zemlja,:strana)");
$strana=$_POST["strana"];
$izraz->bindParam(':strana', $strana);	
$zemlja=$_POST["zemlja"];
$izraz->bindParam(':zemlja', $zemlja);	
$izraz->execute();
echo "OK";