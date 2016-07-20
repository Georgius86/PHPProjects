<?php
if(trim($_POST["korisnik"])==""){
		$poruka="Obavezno korisničko ime";
		return;
	}
	
	
	$izraz = $veza->prepare("select * from operater where korisnik=:korisnik");
	$k=$_POST["korisnik"];
	$izraz->bindParam(":korisnik",$k);
	$izraz->execute();
	$operater = $izraz->fetch(PDO::FETCH_OBJ);
	if($operater!=null){
		$poruka="Korisničko ime je zauzeto, odaberite drugo";
		return;
	}
	
	
	
	if(trim($_POST["lozinka"])==""){
		$poruka="Obavezno lozinka";
		return;
	}
	if(trim($_POST["lozinkaponovo"])==""){
		$poruka="Obavezno ponovite lozinku!";
		return;
	}
	
	if(trim($_POST["lozinka"])!=trim($_POST["lozinkaponovo"])){
		$poruka="Lozinke se ne podudaraju!";
		return;
	}
	
	
	if(trim($_POST["ime"])==""){
		$poruka="Obavezno ime";
		return;
	}
	if(trim($_POST["prezime"])==""){
		$poruka="Obavezno prezime";
		return;
	}