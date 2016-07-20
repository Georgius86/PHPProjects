<?php

if(trim($_POST["korisnik"])==""){
		$poruka="Obavezno korisničko ime";
		return;
	}
	
	
	$izraz = $veza->prepare("select * from operater where korisnik=:korisnik and sifra!=:sifra");
	$k=$_POST["korisnik"];
	$izraz->bindParam(":korisnik",$k);
	$s=$_POST["sifra"];
	$izraz->bindParam(":sifra",$s);
	$izraz->execute();
	$operater = $izraz->fetch(PDO::FETCH_OBJ);
	if($operater!=null){
		$poruka="Korisničko ime je zauzeto, odaberite drugo";
		return;
	}
	
	

	
	if((strlen(trim($_POST["lozinka"]))>0 ||
	strlen(trim($_POST["lozinkaponovo"]))>0) && 
	 trim($_POST["lozinka"])!=trim($_POST["lozinkaponovo"])){
		$poruka="Lozinke ne odgovaraju";
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