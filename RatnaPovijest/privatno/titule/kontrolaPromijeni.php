<?php

if(trim($_POST["naziv"])==""){
		$poruka="Naziv je obavezan!";
		return;
	}
	
	
	$izraz = $veza->prepare("select * from titule where naziv=:naziv and sifra!=:sifra");
	$n=$_POST["naziv"];
	$izraz->bindParam(":naziv",$n);
	$s=$_POST["sifra"];
	$izraz->bindParam(":sifra",$s);
	$izraz->execute();
	$titula = $izraz->fetch(PDO::FETCH_OBJ);
	if($titula!=null){
		$poruka="Titula postoji";
		return;
	}
	
	
