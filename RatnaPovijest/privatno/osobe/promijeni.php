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
		$parametri = array("ime"=>$_POST['ime'],"prezime"=>$_POST['prezime'],"titula"=>$_POST['titula'],"godinarodjenja"=>$_POST['godinarodjenja'],"godinasmrti"=>$_POST['godinasmrti'],"opis"=>$_POST['opis']);
	$izraz = $veza -> prepare('update osobe set ime=:ime,prezime=:prezime,titula=:titula,godinarodjenja=:godinarodjenja,godinasmrti=:godinasmrti,opis=:opis where sifra=:sifra');

$izraz -> execute($parametri);

if(isset($_FILES["slika"])){
			$naziv = date("dmyHms") . "_" .	$_FILES["slika"]["name"];
			$putanja = "img/osobe/" . $_POST["sifra"] . "_" . $naziv; 
			move_uploaded_file($_FILES["slika"]["tmp_name"],  $putanja);
			$izraz = $veza -> prepare("update osobe set slika=:slika where sifra=:sifra;");
			$izraz->bindParam(":slika", $naziv);
			$izraz->bindParam(":sifra", $_POST["sifra"]);
			$izraz -> execute();
		}

header("location:index.php");
}else{
	
$izraz = $veza -> prepare('select * from osobe where sifra=:sifra');
$izraz -> bindParam (":sifra", $sifra);

$izraz -> execute();
$rezultati = $izraz -> fetch(PDO::FETCH_OBJ);	
	
}
}

if($_GET){

$izraz = $veza -> prepare('select * from osobe where sifra=:sifra ');
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
									
								<br /><br /><br /><br />								
								
								
								<img class="slika" src="<?php echo $putanjaPovijest; ?>img/osobe/nepoznato.png " alt="" />
								<br /><br />
								<!--Ako ne radi stavi gore-->
								<!--<?php echo $putanjaPovijest; ?>img/osobe/nepoznato.png <?php echo $objekt->slika;?>-->
					
								<label for="slika">Promijeni sliku:</label>
						<input type="file"  name="slika" id="slika" />
								<p class="poruka">

							</div>
							<div class="large-7 columns">
								<fieldset>
								<div class="row">
									<div class="large-3 columns">
										<label for="ime">Ime:</label>
									</div>
									<div class="large-9 columns">
						<input type="text"  name="ime" id="ime" value="<?php echo $objekt->ime;?>"/>
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label for="prezime">Prezime ili nadimak:</label>
									</div>
									<div class="large-9 columns">
						<input type="text"  name="prezime" id="prezime" value="<?php echo $objekt->prezime;?>"/>
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
				<option <?php 
				if($o->sifra==$objekt->titula) echo "selected=\"selected\""; ?>
				 value="<?php echo $o->sifra; ?>"><?php echo $o->naziv; ?></option>
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
						<input type="number"  name="godinarodjenja" id="godinarodjenja" value="<?php echo $objekt->godinarodjenja;?>" />
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label for="godinasmrti">Godina smrti:</label>
									</div>
									<div class="large-9 columns ">
						<input type="number"  name="godinasmrti" id="godinasmrti" value="<?php echo $objekt->godinasmrti;?>"/>
									</div>
								</div>
								<div class="row">
									<div class="large-3 columns">
										<label class="tekstlijevo" for="opis" >Opis:</label>
									</div>
									<div class="large-9 columns ">
						<textarea class="opissrednje"   name="opis" rows="10" cols="20" > <?php echo $objekt->opis;?></textarea>	
									</div>
									<input type="hidden" name="sifra" value="<?php echo $objekt->sifra;?>" />
									
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
