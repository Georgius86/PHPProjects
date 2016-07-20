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
		$izraz = $veza -> prepare('insert into osobe (ime,prezime,titula,godinarodjenja, godinasmrti,opis) 
	values (:ime,:prezime,:titula,:godinarodjenja, :godinasmrti,:opis)');
		
			//print_r($_POST);
	$izraz->execute(array("ime"=>$_POST['ime'],"prezime"=>$_POST['prezime'],"titula"=>$_POST['titula'],"godinarodjenja"=>$_POST['godinarodjenja'],"godinasmrti"=>$_POST['godinasmrti'],"opis"=>$_POST['opis']));
	
	$zadnji = $veza->lastInsertId();
	
	print_r($_FILES);
	if(isset($_FILES["slika"])){
			$naziv = date("dmyHms") . "_" .	$_FILES["slika"]["name"];
			$putanja = "img/osobe/" . $zadnji . "_" . $naziv; 
			move_uploaded_file($_FILES["slika"]["tmp_name"],  $putanja);
			$izraz = $veza -> prepare("update osobe set slika=:slika where sifra=:sifra;");
			$izraz->bindParam(":slika", $naziv);
			$izraz->bindParam(":sifra", $zadnji);
			$izraz -> execute();
		}
	
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
							Podaci o važnim osobama srednjeg vijeka
						</legend>
						<div class="row">
							<div class="large-5 columns">
								<br /><br /><br /><br />								
								<img class="slika" src="<?php echo $putanjaPovijest; ?>img/osobe/nepoznato.png" alt="" />
								<br /><br />
								<label for="slika">Dodaj sliku:</label>
						<input type="file"  name="slika" id="slika" />
							</div>
							<div class="large-7 columns">
								<fieldset>
								<div class="row">
									<div class="large-3 columns">
										<label for="naziv">Ime:</label>
									</div>
									<div class="large-9 columns">
						<input type="text"  name="ime" id="ime" />
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label for="prezime">Prezime ili nadimak:</label>
									</div>
									<div class="large-9 columns">
						<input type="text"  name="prezime" id="prezime" />
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label for="titula">Titula:</label>
									</div>
									<div class="large-9 columns">
						<select id="titula" name="titula">
					<?php
			$izraz = $veza -> prepare("select sifra,naziv from titule");
			$izraz -> execute();
			$rezultati = $izraz -> fetchAll(PDO::FETCH_OBJ);
			foreach ($rezultati as $o) :
				?>
				<option value="<?php echo $o->sifra; ?>"><?php echo $o->naziv; ?></option>
				<?php
				endforeach; ?>
				</select>
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label for="godinarodjenja">Godina rođenja:</label>
									</div>
									<div class="large-9 columns">
						<input type="number"  name="godinarodjenja" id="godinarodjenja" />
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label for="godinasmrti">Godina smrti:</label>
									</div>
									<div class="large-9 columns ">
						<input type="number"  name="godinasmrti" id="godinasmrti" />
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label class="tekstlijevo" for="opis" >Opis:</label>
									</div>
									<div class="large-9 columns ">
						<textarea class="opissrednje"   name="opis" rows="10" cols="20">Napišite nešto o osobi ...</textarea>	
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
						value="Dodaj" />
				</div>
				
				</div>	
						
						
					</fieldset>
				</form>
			
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