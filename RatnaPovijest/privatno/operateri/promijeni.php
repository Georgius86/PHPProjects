<?php
include_once '../../konfiguracija.php';

if (!((isset($_GET["sifra"]) && ctype_digit($_GET["sifra"])) || isset($_POST["sifra"]))) {
	header("location: ../../logout.php");
}else{
	if(isset($_GET["sifra"])){
		$sifra=$_GET["sifra"];
	}else{
		$sifra=$_POST["sifra"];
	}
}
$poruka="";
if($_POST){
	include_once 'kontrolaPromijeni.php';
	if(strlen($poruka)==0){
					//update
	if(strlen($_POST["lozinka"])>0){
		$izraz  =$veza->prepare("update operater set korisnik=:korisnik, 
		lozinka=md5(:lozinka), ime=:ime, prezime=:prezime where sifra=:sifra");
//		print_r($_POST);
		unset($_POST["lozinkaponovo"]);
	}else{
		$izraz  =$veza->prepare("update operater set korisnik=:korisnik, 
		ime=:ime, prezime=:prezime where sifra=:sifra");
//		print_r($_POST);
		unset($_POST["lozinkaponovo"]);
		unset($_POST["lozinka"]);
	}
	$izraz->execute($_POST);
	header("location: index.php");
					
	}else{
		$o = new stdClass();
		$o->sifra=$_POST["sifra"];
		$o->korisnik=$_POST["korisnik"];
		$o->lozinka=$_POST["lozinka"];
		$o->lozinkaponovo=$_POST["lozinkaponovo"];
		$o->ime=$_POST["ime"];
		$o->prezime=$_POST["prezime"];
	}
}
if($_GET){
$izraz = $veza -> prepare("select * from operater where sifra=:sifra");
$izraz->bindParam("sifra",$sifra);
$izraz -> execute();
$o = $izraz -> fetch(PDO::FETCH_OBJ);
$o->lozinka="";
$o->lozinkaponovo="";
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
						value="<?php echo $o->korisnik ?>"/>
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label for="lozinka">Lozinka:</label>
									</div>
									<div class="large-9 columns">
						<input type="password"  name="lozinka" id="lozinka" 
						value="<?php echo $o->lozinka ?>"/>
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label for="lozinkaponovo">Lozinka ponovo:</label>
									</div>
									<div class="large-9 columns">
						<input type="password"  name="lozinkaponovo" id="lozinkaponovo" 
						value="<?php echo $o->lozinkaponovo ?>"/>
									</div>
								</div>	
								<div class="row">
									<div class="large-3 columns">
										<label for="ime">Ime:</label>
									</div>
									<div class="large-9 columns">
						<input type="text"  name="ime" id="ime" 
						value="<?php echo $o->ime ?>"/>
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label for="prezime">Prezime:</label>
									</div>
									<div class="large-9 columns">
						<input type="text"  name="prezime" id="prezime" 
						value="<?php echo $o->prezime ?>"/>
									</div>
									<input type="hidden" name="sifra" value="<?php echo $o->sifra;?>" />
								</div></fieldset>																																																															
							</div>
						</div>
						
						<div class="row">
			<div class="large-6 columns">
				<a href="index.php" class="alert button tiny">Odustani</a>
				</div>
			<div class="large-6 columns">
				<input type="submit"
						id="autoriziraj"
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