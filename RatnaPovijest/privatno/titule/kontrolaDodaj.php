<?php
if(trim($_POST["naziv"])==""){
		$poruka="Naziv je obavezan";
		return;
	}
	
	
	$izraz = $veza->prepare("select * from titule where naziv=:naziv");
	$n=$_POST["naziv"];
	$izraz->bindParam(":naziv",$n);
	$izraz->execute();
	$titula = $izraz->fetch(PDO::FETCH_OBJ);
	if($titula!=null){
		$poruka="Titula već postoji!";
		return;
	}
	
	
	
	