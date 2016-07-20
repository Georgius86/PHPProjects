<?php
if(trim($_POST["ime"])==""){
		$poruka="Ime je obavezno";
		return;
	}
	
	if(trim($_POST["prezime"])==""){
		$poruka="Prezime ili nadimak su obavezni";
		return;
	}
		
	
	$izraz = $veza->prepare("select * from osobe where ime=:ime and prezime=:prezime");
	$i=$_POST["ime"];
	$p=$_POST["prezime"];
	$izraz->bindParam(":ime",$i);
	$izraz->bindParam(":prezime",$p);
	$izraz->execute();
	$osoba = $izraz->fetch(PDO::FETCH_OBJ);

	if(($osoba)!=null){
		$poruka="Osoba postoji";
		return;
	}
	
	
