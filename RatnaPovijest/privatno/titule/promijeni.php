<?php
include_once '../../konfiguracija.php';
$poruka="";
if(!isset($_SESSION["operater"])){
	header("location: ../../logout.php");
}
if(isset($_GET["sifra"])){
	$sifra=$_GET["sifra"];
	
}else if (isset($_POST["sifra"])){
 $sifra= $_POST["sifra"];
}
else {
	header("location:index.php");
}

if ($_POST){
		include_once 'kontrolaPromijeni.php';
	if(strlen($poruka)==0){
	$izraz = $veza -> prepare('update titule set naziv=:naziv,opis=:opis where sifra=:sifra');

$izraz -> execute($_POST);
header("location:index.php");
}else{
	
$izraz = $veza -> prepare('select * from titule where sifra=:sifra');
$izraz -> bindParam (":sifra", $sifra);
$izraz -> execute();
$rezultati = $izraz -> fetch(PDO::FETCH_OBJ);	
	
}
}

if($_GET){

$izraz = $veza -> prepare('select * from titule where sifra=:sifra');
$izraz -> bindParam (":sifra", $sifra);
$izraz -> execute();
$rezultati = $izraz -> fetch(PDO::FETCH_OBJ);
}
?>

<!doctype html>
<html class="no-js" lang="en">
	<head>
		<?php include_once '../../head.php';?>
	</head>
	<body>

		<?php include_once '../../zaglavlje.php';?>

		<?php include_once '../../izbornik.php'; ?>

		<div class="row">
			<div class="large-12 columns">
				<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
					<fieldset>
						<legend>
							Podaci o tituli
						</legend>
						<div class="row">
							<div class="large-5 columns">
								<br />								
								<img class="slika" src="<?php echo $putanjaPovijest; ?>img/titule/Crown.png" alt="" />
							</div>
							<div class="large-7 columns">
								<fieldset>
								<div class="row">
									<div class="large-3 columns">
										<label for="naziv">Naziv:</label>
									</div>
									<div class="large-9 columns">
						<input type="text"  name="naziv" id="naziv" value="<?php echo $rezultati -> naziv; ?>"/>
									</div>
								</div>
								<div class="row">
									<div class="large-12 columns">
										<label class="tekstlijevo" for="opis" >Opis:</label>
									</div>									
								</div>
								<br />
								<div class="row">
									<div class="large-12 columns">
										<input class="opissrednje"  type="text"  name="opis" id="opis" value="<?php echo $rezultati -> opis; ?>"/>     		
								<!--		<textarea class="opissrednje"   type="text" name="opis" form="opis">Opišite titulu...</textarea>		-->						
									</div>
									<input type="hidden" name="sifra" value="<?php echo $rezultati->sifra;?>" />
								</div>									
								</fieldset>																																																															
							</div>
						</div>
						
												
						<div class="row">
			<div class="large-6 columns">
				<a href="index.php" class="alert button tiny lijevo">Odustani</a>
				</div>
			<div class="large-6 columns">
				<input type="submit"
						class="button tiny desno"
						value="Promijeni" />
				</div>
				
				</div>	
						
						
					</fieldset>
				</form>
				<p class="poruka">
				<?php
				if(strlen($poruka)>0){
					echo $poruka;
				}
				
				 ?>
				 </p>
			</div>
		</div>

		<?php
	include_once '../../podnozje.php';
		?>

		<?php
	include_once '../../skripte.php';
		?>
	</body>
</html>