<?php
include_once '../../../konfiguracija.php';
if(!isset($_SESSION["operater"])){
	header("location: ../../../logout.php");
}
$poruka="";
if($_POST){
	//kontrole
	//include_once 'kontrolaDodaj.php';
	echo sizeof($poruka);
	if(strlen($poruka)==0){
	//ostvareni su svi preduvjeti za unos u tablicu
		$izraz = $veza -> prepare('insert into strane (naziv,brojvojnika) values (:naziv,:brojvojnika)');
		
			print_r($_POST);
	$izraz->execute($_POST);
	header("location: index.php");
	}
	
	
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
				<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
					<fieldset>
						<legend>
							Ovdje možete dodati sukobljene strane u ratu:
						</legend>
						
								<fieldset>
								<br />	
								<div class="row">
									<div class="large-2 columns">
										<label for="naziv">Naziv strane u ratu:</label>
									</div>
									<div class="large-4 columns">
						<input type="text"  name="naziv" id="naziv" />
									</div>
									<div class="large-6 columns">
						
									</div>
								</div>
								<br />
								<div class="row">
									<div class="large-2 columns">
										<label for="brojvojnika">Broj vojnika:</label>
									</div>
									<div class="large-2 columns">
						<input type="number"  name="brojvojnika" id="brojvojnika" />
									</div>
									<div class="large-8 columns">
						
									</div>
								</div>
								
								
								<br />
								
								<br />
								
								
								
																																								
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
	include_once '../../../podnozje.php';
		?>

		<?php
	include_once '../../../skripte.php';
	$veza=null;
		?>
	</body>
	
</html>