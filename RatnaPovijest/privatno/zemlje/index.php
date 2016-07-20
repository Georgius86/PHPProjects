<?php
include_once '../../konfiguracija.php';

if (isset($_GET["stranica"])) {
	$stranica = $_GET["stranica"];
} else {
	$stranica = 1;
}

$trazizemlje ="";
$uvjet = "";

if ($_POST) {
	$uvjet = $_POST["uvjet"];
	
	if ($_POST["trazizemlje"]!="") {
		$trazizemlje = $_POST["trazizemlje"];
	}
}else{
	$trazizemlje=0;
}



if($_POST){
	//print_r($_POST);
}
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

				<h2>Pregled srednjovjekovnih zemalja:</h2>

				<div class="row">
					<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">

						<div class="large-8 columns">

							<div class="row">
								<div class="large-4 columns">
									<input type="submit" class="button tiny lijevo" value="Traži" />
								</div>
								
								<!-- NOVO DODANO -->	
								<div class="large-4 columns">
									
									<select class="traziSelect" name="trazizemlje">
													
										<!-- NOVO DODANO -->			
													<?php
                      
											$izraz = $veza -> prepare("
							select distinct (a.sifra), a.naziv from zemlje a inner join osobe b on a.vladar=b.sifra 
							");
							$izraz -> execute();
							
										$rezultati = $izraz -> fetchAll(PDO::FETCH_OBJ);			
													
													
													foreach ($rezultati as $o) :
														?>
														<option 
													
													<?php if($trazizemlje==$o->sifra) echo "selected=\"selected\"" ?>
													
														
													value="<?php echo $o->sifra ?>"><?php echo $o->naziv; ?></option>
													<?php
                                                    endforeach;
													?>
													<option <?php if($trazizemlje==0) echo "selected=\"selected\"" ?> value="0">
														Svi
													</option>
													
												
												</select>
												
								</div>
								<div class="large-4 columns">
									<input type="text" name="uvjet" value="<?php echo $uvjet; ?>" />
								</div>
								<!-- NOVO DODANO -->	
							</div>
					</form>
				</div>
				<div class="large-4 columns">
					<a href="dodaj.php" class="button tiny desno">Dodaj</a>

				</div>
			</div>
			<div class="panel">
				<div id="rezultati" class="row">

					<?php

					$uvjetZaUpit="%" . $uvjet . "%";
					
				
					if($trazizemlje==0){
					$izraz = $veza -> prepare("
					select a.sifra as sifra,a.naziv,b.ime,b.prezime 
					from zemlje a 
					inner join osobe b on a.vladar=b.sifra 
					where concat(b.ime, ' ', b.prezime) like :uvjet limit  " 
					. (($stranica * 10)-10) . ",10");
					$izraz->bindParam(":uvjet", $uvjetZaUpit);
					}else{
						$izraz = $veza -> prepare("
					select a.sifra as sifra,a.naziv,b.ime,b.prezime 
					from zemlje a 
					inner join osobe b on a.vladar=b.sifra 
					where concat(b.ime, ' ', b.prezime) like :uvjet and a.sifra=:trazizemlje  limit  " 
					. (($stranica * 10)-10) . ",10");
					$izraz->bindParam(":uvjet", $uvjetZaUpit);
					$izraz->bindParam(":trazizemlje", $trazizemlje);
					}
					
					
					
				
					$izraz -> execute();
					$rezultati = $izraz -> fetchAll(PDO::FETCH_OBJ);					
					foreach ($rezultati as $o) :
					
					?>

					<div class="large-12 columns end">
						<div class="panel">
							<div class="row">
								
								<div class="large-12 columns tablica">
				                     
				 <table>	
				<tr>
   					 <th class="tablica"><?php echo $o->naziv; ?></th>
  				</tr>			
				<tr>
   					 <td class="tablica">Vladar: <?php echo $o->ime; ?> <?php echo $o->prezime; ?></td>
  				</tr>	
  				
  				</table>
									<a href="promijeni.php?sifra=<?php echo $o -> sifra; ?>" class="button tiny desno"> Promijeni </a>
									<a href="obrisi.php?sifra=<?php echo $o -> sifra; ?>" class="button tiny desnod"> Obriši </a>
																	
								</div>
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
