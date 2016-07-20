<?php
include_once 'konfiguracija.php';

if($_POST){
	$komanda = $veza -> prepare("select * from operater
	where korisnik=:korisnik and lozinka=:lozinka");
	
	$_POST['lozinka']=md5($_POST['lozinka']);
	
	$komanda -> execute($_POST);
	
	$o =$komanda->fetch(PDO::FETCH_OBJ);
	
	if($o!=null){
		$_SESSION['operater']=$o;
		header("location: privatno/pregledStoljeca.php");
	}else{
		$poruka = "Krivo uneseni podaci!";
	}
}
?>
<!doctype html>
<html class="no-js" lang="en">
	<head>
		<?php
		include_once 'head.php';
		?>
	</head>
	<body>
		<?php
		include_once 'zaglavlje.php';
		include_once 'izbornik.php';
		?>
</br></br>
		<div class="row">
			<div class="large-4 columns">
				<fieldset>
					<legend>
				Login za admina
			</legend>
				<form method="post" id="forma"
				action="<?php echo $_SERVER['PHP_SELF'] ?>">
					<div class="row">
						<div class="large-3 columns">
							<label for="korisnickoIme">Korisnik</label>
						</div>
						<div class="large-9 end columns">
							<input type="text"
							id="korisnickoIme"
							name="korisnik" value="ddordevic"/>
							<small id="gki" class="error">Obavezno korisničko ime</small>
						</div>

					</div>
					<div class="row">
						<div class="large-3 columns">
							<label for="lozinkaKorisnika">Lozinka</label>
						</div>
						<div class="large-9 end columns">
							<input type="password"
							id="lozinkaKorisnika"
							name="lozinka" value="ddd"/>
							<small id="gl" class="error">Obavezno lozinka</small>
						</div>
						<input type="submit" class="button tiny desnod" value="Logiraj se" />
				</form>
				</fieldset>
			</div>
		</div>
		
	
	</div>
		<?php
		if(isset($poruka)):
		?>
		<div class="row">
			<div class="large-12 columns">
				<small id="poruka" class="error"><?php echo $poruka; ?></small>
			</div>
		</div>
		<?php
		endif;
		
		
		
		include_once 'podnozje.php';
		include_once 'skripte.php';
		?>
		<script>
			$(function() {

				$("#gki").hide();
				$("#gl").hide();

				$("#forma").submit(function() {
					$("#poruka").hide();
					$("#gki").hide();
					$("#gl").hide();
					$("#korisnickoIme").css("margin-bottom","1rem");
					$("#lozinkaKorisnika").css("margin-bottom","1rem");

					if ($("#korisnickoIme").val() == "") {
						$("#gki").show();
						$("#korisnickoIme").css("margin-bottom","0px");
						$("#korisnickoIme").focus();
						return false;
					}

					if ($("#lozinkaKorisnika").val() == "") {
						$("#gl").show();
						$("#lozinkaKorisnika").css("margin-bottom","0px");
						$("#lozinkaKorisnika").focus();
						return false;
					}

					return true;

				});
			});		
		</script>
	</body>
</html>
