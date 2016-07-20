<?php
include_once '../../../konfiguracija.php';

if (!((isset($_GET["sifra"]) && ctype_digit($_GET["sifra"])) || isset($_POST["sifra"]))) {
	header("location: ../../../logout.php");
}else{
	if(isset($_GET["sifra"])){
		$sifra=$_GET["sifra"];
	}else{
		$sifra=$_POST["sifra"];
	}
}

if($_POST){
	
    $izraz  =$veza->prepare("delete from strane where sifra=:sifra");		
	//print_r($_POST);
	$izraz->execute($_POST);
	
	header("location: index.php");
}				
	

if($_GET){
$izraz = $veza -> prepare('select * from strane where sifra=:sifra');
$izraz->bindParam("sifra",$sifra);
$izraz -> execute();
$rezultati = $izraz -> fetch(PDO::FETCH_OBJ);

}
?>
<!doctype html>
<html class="no-js" lang="en">
	<head>
		<?php include_once '../../../head.php';?>
	</head>
	<body>

		<?php include_once '../../../zaglavlje.php';?>

		<?php include_once '../../../izbornik.php'; ?>

		<div class="row">
			<div class="large-12 columns">
				<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
					<fieldset>
						<legend>
							Obriši stranu u ratu:
						</legend>
																	
					<h1> <?php echo $rezultati->naziv; ?></h1>
				  
						
						<input type="hidden" name="sifra" value="<?php echo $rezultati->sifra;?>" />
						
						<div class="row">
			<div class="large-6 columns">
				<a href="index.php" class="alert button tiny lijevo">Odustani</a>
				</div>
			<div class="large-6 columns">
				<input type="submit"
						id="autoriziraj"
						class="button tiny desno"
						value="Obriši" />
				</div>
				
				</div>	
						
						
					</fieldset>
				</form>
				
			</div>
		</div>

		<?php
	include_once '../../../podnozje.php';
		?>

		<?php
	include_once '../../../skripte.php';
	
		?>
	</body>
</html>