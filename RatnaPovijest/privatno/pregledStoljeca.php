<?php include_once '../konfiguracija.php'; ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <?php
    include_once '../head.php';
    ?>
  </head>
  <body>
    
   <?php
   include_once '../zaglavlje.php';
     
   include_once '../izbornik.php';
   ?> 
      
    <div class="row">
    	<div class="large 12 columns">
    		<h2>  Kontrolna ploča:</h2>
    	</div>
    	
    </div>
    <div class="row">
    	<div class="large 12 columns tijelo">
    		<p>Na sljedećim karticama možete dodati detalje o povijesnim osobama i zemljama i ratovima u kojima su te zemlje sudjelovale!</p>
    	</div>
    	
    </div>
    <div class="row">
    	<div class="large-12 columns tijelo">
    		<img class="mapa" src="<?php $putanjaPovijest ?> ../img/Europe_1000.jpg" />
    		<p><b>Titule:</b></p> <p>Dodajte nove titule za povijesne veilkane srednje vijeka!</p>
    		<p><b>Osobe:</b></p> <p>Dodajte nove povijesne osobe!</p>
    		<p><b>Zemlje:</b></p> <p>Povežite zemlju sa vladarom kojeg ste kreirali u osobama!</p>
    		<p ><b>Ratovi:</b></p> <p>Dodajte ratove u srednjem vijeku i povežite sa zemljama koje su sudjelovale!</p>
    		
    	
    		</div>
    </div>
    <div class="row">
    	<div class="large 12 columns">
    	 <p>
       	Preuzeto sa <a href="http://hr.wikipedia.org/wiki/Srednji_vijek">Wikipedia.org</a>
       </p>
       </div>
       </div>
    <?php 
    include_once '../podnozje.php';
    
	include_once '../skripte.php';
    ?>
    
  </body>
</html>
