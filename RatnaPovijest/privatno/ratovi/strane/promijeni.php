<?php
include_once '../../../konfiguracija.php';
$poruka="";
if(!isset($_SESSION["operater"])){
	header("location: ../../../logout.php");
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
	$izraz = $veza -> prepare('update strane set naziv=:naziv,brojvojnika=:brojvojnika where sifra=:sifra');
//print_r($_POST);
$izraz -> execute($_POST);
header("location:index.php");
}else{
	
$izraz = $veza -> prepare('select * from strane where sifra=:sifra');
$izraz -> bindParam (":sifra", $sifra);

$izraz -> execute();
$rezultati = $izraz -> fetch(PDO::FETCH_OBJ);	
	
}
}

if($_GET){

$izraz = $veza -> prepare('select * from strane where sifra=:sifra ');
$izraz -> bindParam (":sifra", $sifra);

$izraz -> execute();
$objekt = $izraz -> fetch(PDO::FETCH_OBJ);
}
?>

<!doctype html>
<html class="no-js" lang="en">
	<head>
		<?php include_once '../../../head.php';?>
		<link rel="stylesheet" href="<?php echo $putanjaPovijest; ?>css/jquery-ui.css" />
	</head>
	<body>

		<?php include_once '../../../zaglavlje.php';?>

		<?php include_once '../../../izbornik.php'; ?>

		<div class="row">
			<div class="large-12 columns">
				<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
					<fieldset>
						<legend>
							Promijeni strane, dodaj ili obriši zemlje koje učestvuju:
						</legend>
						
								<fieldset>
								<br />	
								
								<div class="row">
									<div class="large-2 columns">
										<label for="naziv">Naziv:</label>
									</div>
									<div class="large-4 columns">
						<input type="text"  name="naziv" id="naziv" value="<?php echo $objekt->naziv;?>"/>
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
						<input type="number"  name="brojvojnika" id="brojvojnika" value="<?php echo $objekt->brojvojnika;?>"/>
									</div>
									<div class="large-8 columns">
						
									</div>
								</div>
								<br />
										<div class="row">
									<div class="large-2 columns">
										<label for="brojvojnika">Zemlje saveznice:</label>
									</div>
									
									<div class="large-10 columns">
						
								
								 <table>
    						 <thead>
    							<tr>
    								<th>Naziv</th>
    								<th>Vladar</th>
    								<th>Akcija</th>   					
    							</tr>
    						 </thead>
						<tbody id="podaci">
    				<?php 
    				
    				$izraz = $veza->prepare("select a.sifra,a.naziv,b.ime,b.prezime from zemlje a inner join osobe b on a.vladar=b.sifra inner join ucestvuju c on a.sifra=c.zemlja where c.strana=:strana");

					$izraz->bindParam(':strana', $objekt->sifra);
					$izraz->execute();
					$zemlje = $izraz->fetchAll(PDO::FETCH_OBJ);
    				
    				foreach ($zemlje as $z) {
						?>
						<tr>
							<td><?php echo $z -> naziv; ?></td>
							<td><?php echo $z -> ime; ?> <?php echo $z -> prezime; ?></td>
							
							<td>								
								 <a class="obrisi" id="<?php echo $z -> sifra; ?>" href="#">Obriši</a>							
							</td>
						</tr>
						<?php
						}
    				?>
    				</tbody>
    					</table>
									</div>
																											
								</div>	
								<br />
								<div class="row">
    			<div class="large-2 columns">
    				<label>Dodaj zemlju:</label>
    				</div>
    			<div class="large-4 columns">
    				<input type="text" id="traziZemlju" />
    				</div>
    			<div class="large-6 columns"></div>
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
	include_once '../../../podnozje.php';
		?>

		<?php
	include_once '../../../skripte.php';
		?>
		<script src="<?php echo $putanjaPovijest; ?>js/vendor/jquery-ui.js"></script>
		
		<script>
			
			$(function() {
				
				$("#traziZemlju").autocomplete({
				    source: "traziZemlju.php?strana=<?php echo $objekt->sifra; ?>",
				    minLength: 1,
				    focus: function( event, ui ) {
				    	event.preventDefault();
				    	},
				    select: function(event, ui) {
				        $(this).val('').blur();
				        event.preventDefault();
				        spremiUBazu(ui.item);
				       // alert(JSON.stringify(ui,null,2));
				       //alert(ui.item.sifra);
				    }
					}).data( "ui-autocomplete" )._renderItem = function( ul, rez) {
				      return $( "<li>" )
				        .append( "<a>" + rez.naziv + ": " + rez.ime + " " + rez.prezime + "</a>" )
				        .appendTo( ul );
				    };
				
				definirajBrisanje();
				
			});
			
			function spremiUBazu(item){
  			$.ajax({
				type: "POST",
				url: "dodajZemljeUStrane.php",
				data: "strana=<?php echo $objekt->sifra; ?>&zemlja=" + item.sifra,
				success: function(vratioServer){
					if(vratioServer=="OK"){
						//dodaj u tablicu
						//alert("dodajem u tablicu " + item.ime);
						
						$("#podaci").append("<tr>" + 
						"<td>" + item.naziv + "</td>" +
						"<td>" + item.ime + " " + item.prezime + "</td>" +						
						"<td><a class=\"obrisi\" id=\"" + item.sifra + "\" href=\"\">Obriši</a></td></tr>"
						);
						$("#traziZemlju").focus();
						definirajBrisanje();
					}
				}
				
			});
  }
  
  function definirajBrisanje(){
  	
  	$(".obrisi").click(function(){
  		var element = $(this);
  		$.ajax({
				type: "POST",
				url: "brisanjeZemljeizStrane.php",
				data: "strana=<?php echo $objekt->sifra; ?>&zemlja=" + element.attr("id"),
				success: function(vratioServer){
					if(vratioServer=="OK"){
						//dodaj u tablicu
						element.parent().parent().remove();
						//alert("obrisao" + element.attr("id"))
					}
				}
				
			});
  		return false;
  	});
  	
  }
			
		</script>
		
	</body>
</html>