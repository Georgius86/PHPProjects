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

		//include_once 'kontrolaPromijeni.php';
	if(strlen($poruka)==0){
	$izraz = $veza -> prepare('update ratovi set naziv=:naziv,stoljece=:stoljece,gpocetak=:gpocetak,gkraj=:gkraj,stranaa=:stranaa,stranab=:stranab,pobjednik=:pobjednik,opis=:opis where sifra=:sifra');
//print_r($_POST);
$izraz -> execute($_POST);
header("location:index.php");
}else{
	
$izraz = $veza -> prepare('select * from ratovi where sifra=:sifra');
$izraz -> bindParam (":sifra", $sifra);

$izraz -> execute();
$rezultati = $izraz -> fetch(PDO::FETCH_OBJ);	
	
}
}

if($_GET){

$izraz = $veza -> prepare('select * from ratovi where sifra=:sifra ');
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
							Podaci o ratu:
						</legend>
						
								<fieldset>
								<br />	
								<div class="row">
									<div class="large-1 columns">
										<label for="naziv">Naziv rata:</label>
									</div>
									<div class="large-4 columns">
						<input type="text"  name="naziv" id="naziv" value="<?php echo $objekt->naziv;?>" />
									</div>
									<div class="large-7 columns">
						
									</div>
								</div>
								<br />
								<div class="row">
									<div class="large-1 columns">
										<label for="stoljece">Stoljeće:</label>
									</div>
									<div class="large-2 columns">
						<input type="number"  name="stoljece" id="stoljece" value="<?php echo $objekt->stoljece;?>" />
									</div>
									<div class="large-9 columns">
						
									</div>
								</div>
								<br />
								<div class="row">
									<div class="large-1 columns">
										<label for="gpocetak">Početak:</label>
									</div>
									<div class="large-2 columns">
						<input type="number"  name="gpocetak" id="gpocetak" value="<?php echo $objekt->gpocetak;?>"/>
									</div>
									
									<div class="large-1 columns">
										<label for="gkraj">Kraj:</label>
									</div>
									<div class="large-2 columns">
						<input type="number"  name="gkraj" id="gkraj" value="<?php echo $objekt->gkraj;?>" />
									</div>
									<div class="large-6 columns">
						
									</div>
								</div>
								<br />
								<div class="row">
									<div class="large-1 columns">
										<label for="stranaa">Saveznici:</label>
									</div>
									<div class="large-4 columns">
						<select id="stranaa" name="stranaa">
					<?php
			$izraz = $veza -> prepare("select sifra,naziv from strane");
			$izraz -> execute();
			$rezultati = $izraz -> fetchAll(PDO::FETCH_OBJ);
			foreach ($rezultati as $o) :
				?>
				<option <?php 
				if($o->sifra==$objekt->stranaa) echo "selected=\"selected\""; ?>
				 value="<?php echo $o->sifra; ?>"><?php echo $o->naziv; ?></option>
				<?php
				endforeach; ?>
				</select>
									</div>
									
									<div class="large-1 columns">
										<label for="stranab">Neprijatelji:</label>
									</div>
									<div class="large-4 columns">
						<select id="stranab" name="stranab">
					<?php
			$izraz = $veza -> prepare("select sifra,naziv from strane");
			$izraz -> execute();
			$rezultati = $izraz -> fetchAll(PDO::FETCH_OBJ);
			foreach ($rezultati as $o) :
				?>
				<option <?php 
				if($o->sifra==$objekt->stranab) echo "selected=\"selected\""; ?>
				 value="<?php echo $o->sifra; ?>"><?php echo $o->naziv; ?></option>
				<?php
				endforeach; ?>
				</select>
									</div>
									<div class="large-2 columns">
						<!--<a href="../ratovi/strane/index.php" class="alert button tiny lijevo">Dodaj strane</a>-->
									</div>
								</div>
								<br />
								<div class="row">
									<div class="large-1 columns">
										<label for="pobjednik">Ishod rata:</label>
									</div>
									<div class="large-4 columns">
						<input type="text"  name="pobjednik" id="pobjednik" value="<?php echo $objekt->pobjednik;?>" />
									</div>
									<div class="large-7 columns">
						
									</div>
								</div>
								<br />
								<div class="row">
									<div class="large-1 columns">
										<label class="tekstlijevo" for="opis" >Tekst:</label>
									</div>
									<div class="large-11 columns ">
						<textarea class="opissrednje elementlijevo"   name="opis" rows="10" cols="20"><?php echo $objekt->opis;?></textarea>	
									</div>
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