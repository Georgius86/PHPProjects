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

if($_POST){
	
    $izraz  =$veza->prepare("delete from ratovi where sifra=:sifra");		
	//print_r($_POST);
	$izraz->execute($_POST);
	header("location: index.php");
}				
	

if($_GET){
$izraz = $veza -> prepare('select a.sifra,a.naziv as nazivRata,a.gpocetak,a.gkraj,a.pobjednik,a.opis,b.naziv as nazivStranea,c.naziv as nazivStraneb
			from ratovi a inner join strane b on a.stranaa=b.sifra 
            inner join strane c on a.stranab=c.sifra where a.sifra=:sifra');
$izraz->bindParam("sifra",$sifra);
$izraz -> execute();
$rezultati = $izraz -> fetch(PDO::FETCH_OBJ);

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
							Podaci o ratovima:
						</legend>
																	
					<table>	
						<thead>
    				<tr>
    					<th>Naziv</th>
    					<th>Početak</th>
    					<th>Kraj</th>
    					<th>Saveznici</th>
    					<th>Neprijatelji</th>
    					<th>Pobjednik</th>
    				</tr>
    			</thead>
    			<tbody>
    				<tr>
							<td><?php echo $rezultati->nazivRata; ?></td>
							<td><?php echo $rezultati->gpocetak; ?></td>
							<td><?php echo $rezultati->gkraj; ?></td>
							<td><?php echo $rezultati->nazivStranea; ?></td>
							<td><?php echo $rezultati->nazivStraneb; ?></td>
							<td><?php echo $rezultati->pobjednik; ?></td>
						</tr>
    				<tr></tr>
					
  				<tbody>				
  				</table>
  				<br/>
  				<table>
  					<tr>
  						<th>Opis:</th>
  					</tr>
  					<tr>
  						<td><?php echo $rezultati->opis; ?></td>
  					</tr>
  				</table>
				  
						
						<input type="hidden" name="sifra" value="<?php echo $rezultati->sifra;?>" />
						
						<div class="row">
			<div class="large-6 columns">
				<a href="index.php" class="alert button tiny lijevo">Odustani</a>
				</div>
			<div class="large-6 columns">
				<input type="submit"
						id="autoriziraj"
						class="button tiny desno"
						value="Obriši" />
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