<?php
include_once '../../konfiguracija.php';
if(!isset($_SESSION["operater"])){
	header("location: ../../logout.php");
}
$poruka="";
if($_POST){
	//kontrole
	include_once 'kontrolaDodaj.php';
	echo sizeof($poruka);
	if(strlen($poruka)==0){
	//ostvareni su svi preduvjeti za unos u tablicu
		$izraz = $veza -> prepare('insert into zemlje (naziv,vladar) values (:naziv,:vladar)');
		
			print_r($_POST);
	$izraz->execute($_POST);
	header("location: index.php");
	}
	
	
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
							Podaci o zemljama srednjeg vijeka
						</legend>
						<div class="row">
							<div class="large-5 columns">
								<br />								
								<img class="slika" src="<?php echo $putanjaPovijest; ?>img/zemlje/England.png" alt="" />
							</div>
							<div class="large-7 columns">
								<fieldset>
								<div class="row">
									<div class="large-3 columns">
										<label for="naziv">Naziv:</label>
									</div>
									<div class="large-9 columns">
						<input type="text"  name="naziv" id="naziv" />
									</div>
								</div>
								
								<div class="row">
									<div class="large-3 columns">
										<label for="vladar">Vladar:</label>
									</div>
									<div class="large-9 columns">
						<select id="vladar" name="vladar">
					<?php
			$izraz = $veza -> prepare("select a.sifra,concat(a.ime,' ', a.prezime) as vladar,b.naziv from osobe a inner join titule b on a.titula=b.sifra");
			$izraz -> execute();
			$rezultati = $izraz -> fetchAll(PDO::FETCH_OBJ);
			foreach ($rezultati as $o) :
				?>
				<option value="<?php echo $o->sifra; ?>"><?php echo $o->naziv; ?>: <?php echo $o->vladar; ?></option>
				<?php
				endforeach; ?>
				</select>
									</div>
								</div>
								<!--<div class="row">
									<div class="large-9 columns">
										<label >(ukoliko nema osobe na popisu dodajte je)</label>
									</div>
									<div class="large-3 columns">
						<a href="../osobe/dodaj.php" class="alert button tiny desno">Dodaj vladara</a>
									</div>
								</div>-->
																																								
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
						value="Dodaj" />
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
	$veza=null;
		?>
	</body>
	
</html>