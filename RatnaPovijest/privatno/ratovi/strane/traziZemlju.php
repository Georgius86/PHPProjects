<?php
include_once '../../../konfiguracija.php';
if(isset($_GET["term"])){
$uv="%" . $_GET["term"] . "%";
}
else {
	$uv="%";
}
$izraz = $veza->prepare("select a.sifra,a.naziv, b.ime, b.prezime 
from zemlje a inner join osobe b on a.vladar=b.sifra 
where a.sifra not in (select distinct zemlja from ucestvuju where strana=:strana)  
and a.naziv like :uvjet order by a.naziv");
$strana=$_GET["strana"];
$izraz->bindParam(':strana', $strana);	
$izraz->bindParam(':uvjet', $uv);
$izraz->execute();
echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));