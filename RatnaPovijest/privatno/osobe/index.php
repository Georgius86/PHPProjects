<?php
include_once '../../konfiguracija.php';

if (isset($_GET["stranica"])) {
	$stranica = $_GET["stranica"];
} else {
	$stranica = 1;
}

$uvjet = "";

if ($_POST) {
	$uvjet = $_POST["uvjet"];
} else if (isset($_GET["uvjet"])) {
	$uvjet = $_GET["uvjet"];
} else if (isset($_SESSION["uvjetosobe"])) {
	$uvjet = $_SESSION["uvjetosobe"];
}
$_SESSION["uvjetosobe"] = $uvjet;
?>
<!doctype html>
<html class="no-js" lang="en">
	<head>
		<?php
		include_once '../../head.php';
 ?>
	</head>
	<body>

		<?php
	include_once '../../zaglavlje.php';
 ?>

		<?php
	include_once '../../izbornik.php';
 ?>
		
		<div class="row">
			<div class="large-12 columns">

				<h2>Pregled važnih srednjovjekovnih osoba:</h2>

				<div class="row">
					<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">

						<div class="large-4 columns">

							<div class="row">
								<div class="large-4 columns">
									<input type="submit" class="button tiny lijevo" value="Traži" />
								</div>
								<div class="large-8 columns">
									<input type="text" name="uvjet" value="<?php echo $uvjet; ?>" />
								</div>
							</div>
					</form>
				</div>
				<div class="large-8 columns">
					<a href="dodaj.php" class="button tiny desno">Dodaj</a>

				</div>
			</div>
			<div class="panel">
				<div id="rezultati" class="row">

					<?php

					$uvjetZaUpit="%" . $uvjet . "%";
					$izraz = $veza -> prepare("select * from osobe where ime like :uvjet or
					prezime like :uvjet limit " . (($stranica * 10)-10) . ",10");
					$izraz->bindParam(":uvjet", $uvjetZaUpit);
					$izraz -> execute();
					$rezultati = $izraz -> fetchAll(PDO::FETCH_OBJ);
					foreach ($rezultati as $o) :
				$dat = $_SERVER["CONTEXT_DOCUMENT_ROOT"] . $putanjaPovijest."img/osobe/". $o->slika;
			//	print_r($dat);
				if(file_exists($dat) && !is_dir($dat)){
					$slika=$putanjaPovijest . "img/osobe/" . $o->slika;
				}
				else{
					$slika=$putanjaPovijest . "img/osobe/nepoznato.png";
				}
					?>

					<div class="large 12 columns end">
						<div class="panel">
							<div class="row">
							<div class="large-6 columns">
				                     
				 				<img class="auto" alt="" src="<?php echo $slika; ?>" />
																	
								</div>
								<div class="large-3 columns">
				                   <div class="row">
				 					 <?php echo $o -> ime; ?><br />
									<?php echo $o -> prezime; ?>
									</div>
									
									
																	
								</div>
									<div class="large-3 columns ">
									
									<a href="promijeni.php?sifra=<?php echo $o -> sifra; ?>" class="button tiny desnod"> Promijeni </a>
									<a href="obrisi.php?sifra=<?php echo $o -> sifra; ?>" class="button tiny desnod"> Obriši </a></div>
							</div>
						</div>
					</div>

					<?php
					endforeach;
 ?>
				</div>

				<div class="row">
					<div class="large-4 columns">
						<a href="index.php?stranica=<?php

						if ($stranica > 1) {
							$prethodna = $stranica - 1;
							echo $prethodna;
						} else {
							echo 1;
						}
						?>&uvjet=<?php echo $uvjet ?>" class="button tiny lijevo">Prethodno</a>
					</div>
					<div class="large-4 columns sredina">
						-<?php echo $stranica; ?>-
					</div>
					<div class="large-4 columns">
						<a href="index.php?stranica=<?php

						echo ++$stranica;
						?>&uvjet=<?php echo $uvjet ?>" class="button tiny desno">Sljedeće</a>
					</div>
				</div>
			</div>
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
