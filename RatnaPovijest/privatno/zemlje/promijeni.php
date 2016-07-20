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
//	$veza->beginTransaction();
		//include_once 'kontrolaPromijeni.php';
	if(strlen($poruka)==0){
	$izraz = $veza -> prepare('update zemlje set naziv=:naziv,vladar=:vladar where sifra=:sifra');
print_r($_POST);
$izraz -> execute($_POST);
header("location:index.php");
}else{
	
$izraz = $veza -> prepare('select * from zemlje where sifra=:sifra');
$izraz -> bindParam (":sifra", $sifra);

$izraz -> execute();
$rezultati = $izraz -> fetch(PDO::FETCH_OBJ);	
	
}
}

if($_GET){

$izraz = $veza -> prepare('select * from zemlje where sifra=:sifra ');
$izraz -> bindParam (":sifra", $sifra);

$izraz -> execute();
$objekt = $izraz -> fetch(PDO::FETCH_OBJ);
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
							Podaci o važnim osobama srednjeg vijeka
						</legend>
						<div class="row">
							<div class="large-5 columns">
								<br />								
								<img class="slika1" src="<?php echo $putanjaPovijest; ?>img/zemlje/England.png" alt="" />
							</div>
							<div class="large-7 columns">
								<fieldset>
								<div class="row">
									<div class="large-3 columns">
										<label for="naziv">Naziv:</label>
									</div>
									<div class="large-9 columns">
						<input type="text"  name="naziv" id="naziv" value="<?php echo $objekt->naziv;?>"/>
									</div>
								</div>						
								<div class="row">
									<div class="large-3 columns">
										<label for="vladar">Vladar:</label>
									</div>
									<div class="large-9 columns">
						<select id="vladar" name="vladar">
					<?php
			$izraz = $veza -> prepare("select a.sifra,concat(a.ime,' ', a.prezime) as vladar,a.titula,b.naziv from osobe a inner join titule b on a.titula=b.sifra");
			$izraz -> execute();
			$rezultati = $izraz -> fetchAll(PDO::FETCH_OBJ);
			foreach ($rezultati as $o) :
				?>
				<option <?php 
				if($o->sifra==$objekt->vladar) echo "selected=\"selected\""; ?>
				 value="<?php echo $o->sifra; ?>"><!--<?php echo $o->naziv; ?>:--> <?php echo $o->vladar; ?></option>
				<?php
				endforeach; ?>
				</select>
									</div>
								</div>																							
										
								<br />
									<p class="poruka">
				<?php
				if(strlen($poruka)>0){
					echo $poruka;
				}
				
				 ?>
				 </p>							
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
					<input type="hidden" name="sifra" value="<?php echo $objekt->sifra;?>" />
				</form>
				
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