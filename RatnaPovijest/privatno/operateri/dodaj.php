<?php
include_once '../../konfiguracija.php';
$poruka="";
if($_POST){
	//kontrole
	include_once 'kontrolaDodaj.php';
	echo sizeof($poruka);
	if(strlen($poruka)==0){
	//ostvareni su svi preduvjeti za unos u tablicu
		$izraz = $veza->prepare("insert into operater(ime,prezime,korisnik,lozinka)
			values (:ime,:prezime,:korisnik,md5(:lozinka))");
	unset($_POST["lozinkaponovo"]);
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
							Podaci o operateru
						</legend>
						<div class="row">
							<div class="large-5 columns">
								<br />								
								<img class="slika" src="<?php echo $putanjaPovijest; ?>img/operateri/richard_1.gif" alt="" />
							</div>
							<div class="large-7 columns">
								<fieldset>
								<div class="row">
									<div class="large-3 columns">
										<label for="korisnik">Korisnik:</label>
									</div>
									<div class="large-9 columns">
						<input type="text"  name="korisnik" id="korisnik" 
						value="<?php echo isset($_POST["korisnik"]) ? $_POST["korisnik"] : ""; ?>"/>
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label for="lozinka">Lozinka:</label>
									</div>
									<div class="large-9 columns">
						<input type="password"  name="lozinka" id="lozinka" 
						value="<?php echo isset($_POST["lozinka"]) ? $_POST["lozinka"] : ""; ?>"/>
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label for="lozinkaponovo">Lozinka ponovo:</label>
									</div>
									<div class="large-9 columns">
						<input type="password"  name="lozinkaponovo" id="lozinkaponovo" 
						value="<?php echo isset($_POST["lozinkaponovo"]) ? $_POST["lozinkaponovo"] : ""; ?>"/>
									</div>
								</div>	
								<div class="row">
									<div class="large-3 columns">
										<label for="ime">Ime:</label>
									</div>
									<div class="large-9 columns">
						<input type="text"  name="ime" id="ime" 
						value="<?php echo isset($_POST["ime"]) ? $_POST["ime"] : ""; ?>"/>
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label for="prezime">Prezime:</label>
									</div>
									<div class="large-9 columns">
						<input type="text"  name="prezime" id="prezime" 
						value="<?php echo isset($_POST["prezime"]) ? $_POST["prezime"] : ""; ?>"/>
									</div>
								</div></fieldset>																																																															
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