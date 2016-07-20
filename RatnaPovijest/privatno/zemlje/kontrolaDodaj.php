<?php
if(trim($_POST["naziv"])==""){
		$poruka="Naziv je obavezan";
		return;
	}
	
	if(trim($_POST["vladar"])==""){
		$poruka="Prezime ili nadimak su obavezni";
		return;
	}
		
	
	$izraz = $veza->prepare("select a.naziv,concat(a.ime,' ', a.prezime) as vladar from zemlje a inner join osobe b on a.vladar=b.sifra");
	$n=$_POST["naziv"];
	$v=$_POST["vladar"];
	$izraz->bindParam(":naziv",$n);		
	$izraz->bindParam(":vladar",$v);
	$izraz->execute();
	$zemlja = $izraz->fetch(PDO::FETCH_OBJ);
	if(($zemlja)!=null){
		$poruka="Zemlja u kojoj vlada ova osoba već postoji!";
		return;
	}
	
	
