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
	$s=$_POST["sifra"];
	$izraz->bindParam(":ime",$i);
	$izraz->bindParam(":prezime",$p);
	$izraz->bindParam(":sifra",$s);
	$izraz->execute();
	$osoba = $izraz->fetch(PDO::FETCH_OBJ);

	if($osoba!=null){
		$poruka="Osoba postoji";
		return;
	}
	
